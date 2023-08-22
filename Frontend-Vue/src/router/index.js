import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
//agrego la importación de mis vistas
import ClienteNew from '../views/ClienteNew.vue'
import ClienteEdit from '../views/ClienteEdit.vue'
import ClienteView from '../views/ClienteView.vue'
import Checkout from '../views/Checkout.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/createC', //ruta para crear un nuevo cliente
    name: 'createC',
    component: ClienteNew
  },
  {
    path: '/editC/:id', //agrego el parámetro id para que sea dinámico
    name: 'editC',
    component: ClienteEdit
  },
  {
    path: '/viewC/:id', //agrego el parámetro id para que sea dinámico
    name: 'viewC',
    component: ClienteView
  },
  {
    path: '/checkout/:id', //agrego el parámetro id para que sea dinámico
    name: 'checkout',
    component: Checkout
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
