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
    @click:row="loadProduct"
    @update:options="loadItems"
  >
    <template v-slot:top>
      <div class="d-flex justify-end mr-3">
        <v-btn color="primary" append-icon="mdi-plus" @click="openModal">
          Cadastrar
        </v-btn>
      </div>
      <v-dialog v-model="modal" max-width="600px" max-height="600px" persistent>
        <v-card height="550px" title="Cadastrar">
          <v-divider></v-divider>

          <v-row class="text-center">
            <v-col cols="6" class="pa-6 pb-0">
              <v-text-field :rules="[rules.required]" clearable v-model="value.name" label="Nome *">
              </v-text-field>
            </v-col>

            <v-col cols="6" class="pa-6 pb-0">
              <v-text-field clearable v-model="value.description" label="Descrição">
              </v-text-field>
            </v-col>

            <v-col cols="6" class="pa-6 pt-0 pb-1">
              <v-text-field  v-model="value.priceInCents" label="Preço *" type="number">
              </v-text-field>
            </v-col>

            <v-col cols="6" class="pa-6 pt-0 pb-1">
              <v-text-field clearable v-model="value.unit" label="Unidade">
              </v-text-field>
            </v-col>

            <v-col cols="6" class="pa-6 pt-0 pb-1">
              <v-text-field clearable v-model="value.brand" label="Marca">
              </v-text-field>
            </v-col>

            <v-col cols="6" class="pa-6 pt-0 pb-1">
              <v-text-field clearable v-model="value.observation" label="Observação">
              </v-text-field>
            </v-col>

            <v-col cols="12" class="pa-6 pt-0 pb-1">
              <v-select
                :rules="[rules.required]" 
                item-value="id"
                item-title="name"
                v-model="value.productTypeId" 
                label="Tipos de produto *"
                :items="productTypes"
              >
              </v-select>
            </v-col>
          </v-row>
          <v-divider></v-divider>
          <div class="d-flex justify-end mt-3 mr-3 mb-3">
            <v-btn variant="text" class="mr-3" @click="closeModal">
              Cancelar
            </v-btn>
        
            <v-btn color="primary" @click="registerForm">
              Salvar
            </v-btn>
          </div>
        </v-card>
      </v-dialog>
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
        { title: 'Descrição', key: 'description' },
        { title: 'Preço', key: 'priceInCents' },
        { title: 'Unidade', key: 'unit' },
        { title: 'Marca', key: 'brand' },
        { title: 'Observação', key: 'observation' },
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
          const { data } = await axios.get('http://localhost:8080/product');
          this.items = data.data;
          this.totalItems = this.items.length;
        } catch (error) {
          console.log('error'); 
        } finally {
          this.loading = false;
        }
      }, 

      goToRegister() {
        this.$router.push('product-type/register');
      },

      openModal() {
        this.loadProductTypes();
        this.modal = true;
      },

      closeModal() {
        this.modal = false;
        this.value = {};
        this.loadItems();
      },

      async loadProductTypes() {
        this.loading = true; 
        try {
          const { data } = await axios.get('http://localhost:8080/product-type');
          this.productTypes = data.data.map(item => ({
            id: item.id,
            name: item.name
          }));
        } catch (error) {
          console.log('error'); 
        } finally {
          this.loading = false;
        }
      },

      async registerForm() {
        this.loadingButton = true;
        try {
          if (this.value.id) {
            await axios.put(`http://localhost:8080/product/${this.value.id}`, this.value);
          } else {
            await axios.post('http://localhost:8080/product', this.value);
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
          await axios.delete(`http://localhost:8080/product/${row.id}`)
        } catch (error) {
          console.log(error)
        } finally {
          this.loadItems();
        }
      },

      async loadProduct(e, { item }) {
        try {
          const { data } = await axios.get(`http://localhost:8080/product/${item.id}`)
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
      }
    },
  }
</script>