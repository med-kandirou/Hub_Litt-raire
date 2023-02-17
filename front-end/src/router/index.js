import { createRouter, createWebHistory } from 'vue-router'

import index from '../views/index.vue'
import login from '../views/login.vue'
import signup from '../views/signup.vue'
import Livres from '../views/user/livres.vue'
import profile from '../views/user/profile.vue'
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
  },
  {
    path: '/user/livres',
    name: 'Livres',
    component: Livres
  },
  {
    path: '/user/profile',
    name: 'profile',
    component: profile
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router