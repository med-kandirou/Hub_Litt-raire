import { createRouter, createWebHistory } from 'vue-router'

import index from '../views/index.vue'
import login from '../views/login.vue'
import signup from '../views/signup.vue'
const routes = [
  {
    path: '/',
    name: 'home',
    component: index
  },
  {
    path: '/login',
    name: 'login',
    component: login
  },
  {
    path: '/signup',
    name: 'signup',
    component: signup
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router