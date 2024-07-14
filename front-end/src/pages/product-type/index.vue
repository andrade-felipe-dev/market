<template>
  <v-data-table-server
    height="83vh"
    fixed-header
    fixed-footer
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items="items"
    :items-length="totalItems"
    :loading="loading = false"
    :search="search"
    item-value="name"
    @update:options="loadItems"
  ></v-data-table-server>
</template>

<script>
  import axios from 'axios';

  export default {
    data: () => ({
      itemsPerPage: 5,
      headers: [
        { title: 'Nome', align: 'name', key: 'name' },
        { title: 'Descrição', key: 'description' },
        { title: 'Categoria', key: 'category' },
        { title: 'Taxa', key: 'tax' }
      ],
      search: '',
      items: [],
      loading: true,
      totalItems: 0,
    }),

    methods: {
      async loadItems() {
        this.loading = true; 
        try {
          const { data } = await axios.get('http://localhost:8080/product-type');
          this.items = data.data;
          this.totalItems = this.items.length
        } catch (error) {
          console.log('error'); 
        } finally {
          this.loading = false;
        }
      }
    },
  }
</script>