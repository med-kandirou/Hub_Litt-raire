<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Mon profile</h1>
    <form class="grid justify-items-center ">
        <div class="mb-6">
            <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom </label>
            <input type="text" v-model="nom" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
        </div>
        <div class="mb-6">
            <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom</label>
            <input type="text" v-model="prenom" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="text" v-model="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" v-model="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
        </div>
        <button @click="modifier" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Modifier</button>
    </form>

</template>

<script>
    import axios from 'axios';
    import Header from '@/components/header_user.vue'
    import { userStore } from '@/stores/userStore'

    export default {
        setup(){
            const user = userStore()
            return { user }
        },
        name:'profile',
        components:{
            Header
        },data(){
            return{
                id:this.user.id,
                nom:this.user.nom,
                prenom:this.user.prenom,
                email:this.user.email,
                password:this.user.password
            }
        },
        methods:{
            modifier(){
                axios({
                method: 'PUT',
                url: 'http://127.0.0.1:8000/api/user/modifierCompte/'+this.user.id,
                data:{
                    nom:this.nom,
                    prenom:this.prenom,
                    email:this.email,
                    password:this.password
                }
                })
                .then((res) =>{
                    if(res.data.etat='updated'){
                        this.user.nom=this.nom;
                        this.user.prenom=this.prenom;
                        this.user.email=this.email;
                        this.user.password=this.password;
                        this.$swal.fire(
                            'Succes!',
                            'votre compte est modifié ',
                            'success'
                        )
                    }
                })
            }
        },
    }
</script>