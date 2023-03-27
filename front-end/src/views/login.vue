<template>

<section class="h-screen">
  <div class="px-6 h-full text-gray-800">
    <div
      class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6"
    >
      <div
        class="grow-0 shrink-1 md:shrink-0 basis-auto xl:w-6/12 lg:w-6/12 md:w-9/12 mb-12 md:mb-0"
      >
        <img
          src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="w-full"
          alt="Sample image"
        />
      </div>
      <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
        <form>
          <div
            class="flex items-center my-4 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5"
          >
            <p class="text-center font-semibold mx-4 mb-0">Se connecter {{ user.name }}</p>
          </div>

          <!-- Email input -->
          <div class="mb-6">
            <input
              type="text"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              placeholder="Email address"
              v-model="email"
            />
          </div>
          <!-- Password input -->
          <div class="mb-6">
            <input
              type="password"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              placeholder="Password"
              v-model="password"
            />
          </div>

          <div class="text-center lg:text-left">
            <button @click="login"
              type="button"
              class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
            >
              Se connecter
            </button>
            <p class="text-sm font-semibold mt-2 pt-1 mb-0">
              vous n'avez pas un compte ?
              <router-link to="/signup"><a href="#" class="text-red-600 hover:text-red-700 focus:text-red-700 transition duration-200 ease-in-out">S'inscrire</a></router-link>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>


</template>

<script >

import axios from 'axios';
import { userStore } from '@/stores/userStore'

export default{
    name:'login',
    setup(){
      const user = userStore()
      return { user }
    },
    data(){
      return {
        email:'',
        email_err:'',
        password:'',
        password_err:'',
      }
    },
    methods:{
      login(){
        var form= new FormData();
        form.append('email',this.email);
        form.append('password',this.password);
        axios({
              method: 'POST',
              url: 'http://127.0.0.1:8000/api/login',
              data:form
            })
            .then((res) =>{
              if(res.data.user==null){
                this.$swal.fire(
                  'Oops!',
                  'Email or mot de passe invalid !',
                  'error'
                )
              }
              else if(res.data.user!=null)
              {
                  this.user.id=res.data.user.id;
                  this.user.nom=res.data.user.nom;
                  this.user.prenom=res.data.user.prenom;
                  this.user.email=res.data.user.email;
                  this.user.password=res.data.user.password;
                  this.user.role=res.data.user.role;
                  this.$swal.fire(
                    'Succes!',
                    'Connection avec succes',
                    'success'
                  ).then((result) => {
                  if (result.isConfirmed) {
                    if(res.data.user.role==0){
                      location.href='/user/livres';
                    }
                    else{
                      location.href='/admin/livres';
                    }
                  }})
              }
              else{
                this.$swal.fire(
                  'Oops!',
                  'Email or mot de passe invalid !',
                  'error'
                )
              }
            })
      },

      test(){
        this.user.changevalue();
      }
    },
}


</script>