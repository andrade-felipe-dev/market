<template>
  <v-container fluid class="fill-height">
    <v-card class="w-100 mb-auto" title="Dados da Venda">
      <v-autocomplete
        label="Produtos"
        return-object
        item-value="id"
        item-title="displayName"
        :items="formattedProducts"
        v-model="selectedProducts"
        multiple
      ></v-autocomplete>
  
      <v-row>
        <v-col v-for="(option, index) in selectedProducts" :key="index" cols="6" class="pa-6 pb-0">
          
          <v-card :title="`Nome: ${option.name} - Preço: ${formatPriceInCentsToReais(option.priceInCents)} - Taxa: ${option.productType.tax}%`">
            <v-text-field :rules="[rules.more1]" @change="calculateOperation(option)" clearable label="Quantidade *" type="number" v-model="option.quantity">
            </v-text-field>
            <v-card-text>

              <span v-if="option.quantity > 0">  Total calculado: {{ option.total }}</span>
              <span v-else>Calculando...</span>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-card>
   
    <div class="mt-auto ml-auto">
      <v-btn variant="text" @click="backPage" class="mr-3">Cancelar</v-btn>
      <v-btn color="primary" @click="save" >Salvar</v-btn>
    </div>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data: () => ({
    id: null,
    selectedProducts: [],
    products: [],
    loadedSale: {},
    rules: {
      required: value => !!value || 'Campo é obrigatório!',
      more1: value => !isNaN(value) && value > 1 || 'Valor deve ser maior que 1'
    },
  }),

  computed: {
    formattedProducts() {
      return this.products.map(product => ({
        ...product,
        displayName: `Nome do Produto: ${product.name} - Preço ${this.formatPriceInCentsToReais(product.priceInCents)}`,
      }));
    },
  },

  async created() {
    this.id = this.$route.params.id
    await this.loadProducts();
    if (this.id) {
      await this.loadSale();
    }
  },
  
  methods: {
    async loadSale() {
      try {
        const { data } = await axios.get(`http://localhost:8080/sale/${this.id}`);
        this.loadedSale = data.data
        
        this.selectedProducts = this.products.filter(product => {
          let p = this.loadedSale.saleProducts.find(item => item.product.id === product.id)
          
          if (p) {
            product.quantity = p.quantity;
            product.displayName = `Nome do Produto: ${product.name} - Preço ${this.formatPriceInCentsToReais(product.priceInCents)}`
            product.total = this.calculateOperation(product);
            return true;
          }
          
          return false;
        })
      } catch (error) {
        console.log(error); 
      } finally {
        this.loading = false;
      }
    },

    async save() {
      let formatData = {};
      
      formatData.products = this.selectedProducts.map(item => ({
        'id': item.id,
        'quantity': parseInt(item.quantity)
      }))
      formatData.saleTime = this.formatDate()

      try {
        if (!this.id) {
          const { data } = await axios.post('http://localhost:8080/sale', formatData);
        } else {
          const { data } = await axios.put(`http://localhost:8080/sale/${this.id}`, formatData);
        }

        this.backPage();
      } catch(error) {
        console.log(error);
      }
    },

    async loadProducts() {
      try {
        const { data } = await axios.get('http://localhost:8080/product');
        this.products = data.data;
      } catch (error) {
        console.log(error); 
      } finally {
        this.loading = false;
      }
    }, 

    backPage() {
      this.$router.push('/sale');
    },


    formatDate() {
      const date = new Date();
      const day = String(date.getDate()).padStart(2, '0');
      const mounth = String(date.getMonth() + 1).padStart(2, '0'); // Mês é zero indexado
      const year = date.getFullYear();
      const hour = String(date.getHours()).padStart(2, '0');
      const minutes = String(date.getMinutes()).padStart(2, '0');
      const seconds = String(date.getSeconds()).padStart(2, '0');

      return `${year}-${mounth}-${day} ${hour}:${minutes}:${seconds}`;
    },
    
    formatPriceInCentsToReais(priceInCents) {
      console.log(priceInCents)
      if (priceInCents === 0) {
        return 'R$ {0,00}'

      }

      let priceInReais = priceInCents / 100;
      return priceInReais.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

    },

    async calculateOperation(option) {
      const sendData = {
        'quantity': parseInt(option.quantity),
        'priceInCents': option.priceInCents,
        'tax': option.productType.tax
      }

      let total = 0;

      try {
        const { data } = await axios.post(`http://localhost:8080/calculate-price`, sendData)
        total = data.data 
      } catch (error) {
        console.log(error)
      }

      option.total = this.formatPriceInCentsToReais(total);
    }
  },
  
}
</script>

<style>

</style>