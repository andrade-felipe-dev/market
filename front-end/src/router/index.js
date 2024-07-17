import { createRouter, createWebHistory } from 'vue-router/auto'
import HomeView from '../pages/index.vue'
import ProductTypeView from '../pages/product-type/index.vue'
import ProductView from '../pages/product/index.vue'
import SaleView from '../pages/sale/index.vue'
import SaleStore from '../pages/sale/store/index.vue'


const routes = [
  {name: 'Home', path: '/', component: HomeView },
  {name: 'ProductType', path: '/product-type', component: ProductTypeView },
  {name: 'Product', path: '/product', component: ProductView },
  {name: 'Sale', path: '/sale', component: SaleView },
  {name: 'SaleStore', path: '/sale/store', component: SaleStore },
  {name: 'UpdateStore', path: '/sale/store/:id', component: SaleStore },

]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

router.onError((err, to) => {
  if (err?.message?.includes?.('Failed to fetch dynamically imported module')) {
    if (!localStorage.getItem('vuetify:dynamic-reload')) {
      console.log('Reloading page to fix dynamic import error')
      localStorage.setItem('vuetify:dynamic-reload', 'true')
      location.assign(to.fullPath)
    } else {
      console.error('Dynamic import error, reloading page did not fix it', err)
    }
  } else {
    console.error(err)
  }
})

router.isReady().then(() => {
  localStorage.removeItem('vuetify:dynamic-reload')
})

export default router
