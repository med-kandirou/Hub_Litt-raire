import { defineStore } from 'pinia'
import router from '../router'

export const userStore = defineStore('userStore', {
    state: () => ({ 
        id:'',
        nom:'',
        prenom:'',
        email:'',
        password:'',
        role:-1,
    }),
    getters: {
      
    },
    actions: {
        checkifuser(){
            if(this.id.length==0){
                router.push('/login');
            }
            else if(this.role!=0){
                router.push('notfound');
            }
        },
        checkifAdmin(){
            if(this.id==''){
                router.push('login');
            }
            else if(this.role!=1){
                router.push('notfound');
            }
        }
    },
    persist:true
  })
  