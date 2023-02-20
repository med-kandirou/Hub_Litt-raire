<template>
  <div class="">
    <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer sm:hidden" @click="openSidebar" >
      <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
    </span>
    <div class="sidebar  top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center" >
      <div class="text-gray-100 text-xl">
        <div class="p-2.5 mt-1 flex items-center">
          <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-600"></i>
          <h1 class="font-bold text-gray-200 text-[15px] ml-3">Hub litteraire</h1>
          <i
            class="bi bi-x cursor-pointer ml-28 lg:hidden"
            @click="openSidebar"
          ></i>
        </div>
        <div class="my-2 bg-gray-600 h-[1px]"></div>
      </div>
      <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
        <i class="bi bi-house-door-fill"></i>
        <router-link to="/admin/ajouter_livre"><span class="text-[15px] ml-4 text-gray-200 font-bold">Ajouter un livre</span></router-link> 
      </div>
      <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
        <i class="bi bi-house-door-fill"></i>
        <router-link to="/admin/livres"><span class="text-[15px] ml-4 text-gray-200 font-bold">Livres</span></router-link> 
      </div>
      <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
        <i class="bi bi-house-door-fill"></i>
        <router-link to="/admin/groupes"><span class="text-[15px] ml-4 text-gray-200 font-bold">Groupes</span></router-link> 
      </div>
      <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
        <i class="bi bi-bookmark-fill"></i>
        <router-link to="/admin/categories"><span class="text-[15px] ml-4 text-gray-200 font-bold">Categories</span></router-link>
      </div>
      <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
        <i class="bi bi-house-door-fill"></i>
        <router-link to="/admin/users"><span class="text-[15px] ml-4 text-gray-200 font-bold">Users</span></router-link>
      </div>
      <div class="my-4 bg-gray-600 h-[1px]"></div>
      <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
        <i class="bi bi-box-arrow-in-right"></i>
        <span @click="logout" class="text-[15px] ml-4 text-gray-200 font-bold">Déconnecter</span>
      </div>
    </div>
</div>


</template>

<script >
import Cookies from "vue-cookies";

export default {
    name:'sidebar',
    methods :{
        openSidebar() {
            document.querySelector(".sidebar").classList.toggle("hidden");
        },
        logout(){
            Cookies.remove('id');
            Cookies.remove('nom');
            Cookies.remove('prenom');
            Cookies.remove('email');
            Cookies.remove('password');
            this.$router.push('/login');
        }
    }
}
</script>