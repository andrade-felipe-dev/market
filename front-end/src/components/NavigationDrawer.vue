<template>
  <v-card>
    <v-layout>
      <v-app-bar
        color="primary"
        permanent
      >
        <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

        <v-toolbar-title>Market</v-toolbar-title>

      </v-app-bar>

      <v-navigation-drawer
        v-model="drawer"
        :location="$vuetify.display.mobile ? 'bottom' : undefined"
        temporary
      >
        <v-list>
          <v-list-item
            v-for="item in items"
            :key="item.value"
            @click="navigate(item.value)"
            link
          >
            <v-list-item :prepend-icon="item.icon" :title="item.title" :value="item.value"></v-list-item>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>

      <v-main class="d-flex flex-column" style="height: 100vh;">
        <v-container fluid class="fill-height pa-0 ma-0">
          <router-view></router-view>
        </v-container>
      </v-main>
    </v-layout>
  </v-card>
</template>

<script>
  export default {
    data: () => ({
      drawer: false,
      items: [
        {
          title: 'Inicio',
          value: '/',
          icon: 'mdi-home',
        },

        {
          title: 'Tipo do Produto',
          value: '/product-type',
          icon: 'mdi-archive-cog',
        },
        {
          title: 'Produto',
          value: '/product',
          icon: 'mdi-archive',
        },
        {
          title: 'Venda',
          value: '/sale',
          icon: 'mdi-cart-percent',
        }
      ],
    }),
    methods: {
      navigate(value) {
        this.$router.push(value);
        this.drawer = false;
      }
    },
  }
</script>
