<template>

    <div class="grid sm:grid-cols-4">
        <Sidebar class="sm:h-screen bg-gray-900 fixed"/>
        <div class="sm:col-start-2 sm:col-span-3 w-full">
            <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Les categories</h1>
            <div class="">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Numero
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nom categorie
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date de creation
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Operations
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="categorie in categories" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ categorie.id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ categorie.nom }}
                            </td>
                            <td class="px-6 py-4">
                                {{ categorie.created_at }}
                            </td>
                            <td class="px-6 py-4">
                                <button @click="supprimerCat(categorie.id)" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Supprimer</button>
                                <button @click="update(categorie.id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Modifier</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>


<script >
    import axios from 'axios'
    import Sidebar from '@/components/sidebar.vue'
    export default {
    name:'categories',
    data(){
        return {
            categories:''
        }
    },
    components:{
        Sidebar
    },
    methods:{
        getCats(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/admin/getCats',
                })
                .then((res) =>{
                    this.categories=res.data;
            })
        },
        supprimerCat(id){
            axios({
                method: 'DELETE',
                url: 'http://127.0.0.1:8000/api/categorie/supprimerCat/'+id+'',
                })
                .then((res) =>{
                    if(res.data=='deleted'){
                        console.log(res.data);
                    }  
            })
        },
        modifierCat(id){
            // axios({
            //     method: 'DELETE',
            //     url: 'http://127.0.0.1:8000/api/admin/supprimerCat/'+id+'',
            //     })
            //     .then((res) =>{
            //         this.categories=res.data;
            // })
        }
    },
    mounted(){
        this.getCats();
    }
    }
</script>