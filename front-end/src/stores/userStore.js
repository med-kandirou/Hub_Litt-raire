import { defineStore } from 'pinia'

export const userStore = defineStore('userStore', {
    state: () => ({ 
        id:'',
        nom:'',
        prenom:'',
        email:'',
        password:'',
        role:'',
    }),
    getters: {
      
    },
    actions: {
        
    },
    persist:true
  })
  