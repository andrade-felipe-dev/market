<template>
  <v-app>
    <v-main>
      <NavigationDrawer>
        <router-view />
      </NavigationDrawer>
    </v-main>
  </v-app>
</template>

<script>
import NavigationDrawer from './components/NavigationDrawer.vue'

export default {
  components: [
    NavigationDrawer
  ]
}



</script>
