<template>
  <v-data-table-server
    height="80vh"
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items="items"
    :items-length="totalItems"
    :loading="loading = false"
    :search="search"
    item-value="id"
    @click:row="selectRow"
    @update:options="loadItems"
  >
    <template v-slot:top>
      <div class="d-flex justify-end mr-3">
        <v-btn color="primary" append-icon="mdi-plus" @click="goToRegister">
          Cadastrar
        </v-btn>
      </div>
    </template>  

    <template v-slot:item.saleTime="{item}">
      {{ formatDate(item?.saleTime) }}
    </template>

    <template v-slot:item.priceInCents="{item}"> 
      {{ formatPriceInCentsToReais(item?.priceInCents) }}
    </template>

    <template v-slot:item.actions="{ item }">
      <v-icon
        size="small"
        @click.stop="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
  </v-data-table-server>
</template>

<script>
  import axios from 'axios';

  export default {
    data: () => ({
      itemsPerPage: 5,
      headers: [
        { title: 'Nome', align: 'name', key: 'name' },
        { title: 'Data da Venda', key: 'saleTime' },
        { title: 'Preço Total', key: 'priceInCents' },
        { key: 'actions'}
      ],
      search: '',
      items: [],
      loading: true,
      totalItems: 0,
      modal: false,
      value: {},
      rules: {
        required: value => !!value || 'Campo é obrigatório!',
      },
      productTypes: []
    }),

    methods: {
      async loadItems() {
        this.loading = true; 
        try {
          const { data } = await axios.get('http://localhost:8080/sale');
          this.items = data.data;
          this.totalItems = this.items.length;
        } catch (error) {
          console.log('error'); 
        } finally {
          this.loading = false;
        }
      }, 

      goToRegister() {
        this.$router.push('sale/store');
      },

      selectRow(e, { item }) {
        this.$router.push('/sale/store');
      },

      closeModal() {
        this.modal = false;
        this.value = {};
        this.loadItems();
      },

      async registerForm() {
        this.loadingButton = true;
        try {
          if (this.value.id) {
            await axios.put(`http://localhost:8080/sale/${this.value.id}`, this.value);
          } else {
            await axios.post('http://localhost:8080/sale', this.value);
          }
        } catch (error) {
          console.error(error);
        } finally {
          this.loadingButton = false;
          this.closeModal();
        }
      },

      async deleteItem(row) {
        try {
          await axios.delete(`http://localhost:8080/sale/${row.id}`)
        } catch (error) {
          console.log(error)
        } finally {
          this.loadItems();
        }
      },

      async loadProduct(e, { item }) {
        try {
          const { data } = await axios.get(`http://localhost:8080/sale/${item.id}`)
          this.value = data.data
          this.value.productTypeId = data.data.productType.id
          this.openModal();
        } catch (error) {
          console.log(error)
        }
      },

      formatPriceInCentsToReais(priceInCents) {
        let priceInReais = priceInCents / 100;
        return priceInReais.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
      },

      formatDate(valueDate) {
        const date = new Date(valueDate);
        const day = String(date.getDate()).padStart(2, '0');
        const mounth = String(date.getMonth() + 1).padStart(2, '0'); // Mês é zero indexado
        const year = date.getFullYear();
        const hour = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');

        return `${day}/${mounth}/${year} ${hour}:${minutes}`;
      }
    },
  }
</script>