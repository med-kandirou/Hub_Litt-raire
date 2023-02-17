import { createRouter, createWebHistory } from 'vue-router'

import index from '../views/index.vue'
import login from '../views/login.vue'
import signup from '../views/signup.vue'
import Livres from '../views/user/livres.vue'
import profile from '../views/user/profile.vue'
import groupes from '../views/user/groupes.vue'
import favories from '../views/user/favories.vue'


//admin
import Users from '../views/admin/users.vue'
import livres_admin from '../views/admin/livres.vue'
import groupes_Admin from '../views/admin/groupes.vue'
import categories_admin from '../views/admin/categories.vue'
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
  },
  {
    path: '/user/groupes',
    name: 'groupes',
    component: groupes
  },
  {
    path: '/user/favories',
    name: 'favories',
    component: favories
  },
  {
    path: '/admin/livres',
    name: 'livres_admin',
    component: livres_admin
  },
  {
    path: '/admin/groupes',
    name: 'groupes_Admin',
    component: groupes_Admin
  },
  {
    path: '/admin/users',
    name: 'Users',
    component: Users
  },
  {
    path: '/admin/categories',
    name: 'categories_admin',
    component: categories_admin
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router