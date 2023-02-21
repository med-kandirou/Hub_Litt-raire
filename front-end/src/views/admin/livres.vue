<template>
    <div class="grid sm:grid-cols-4">
        <Sidebar class="sm:h-screen bg-gray-900 fixed"/>
        <div class="sm:col-start-2 sm:col-span-3 mx-auto">
            <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Les livres</h1>
                <div class="">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    image de livre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nom de livre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    categorie
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date de creation
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="livre in livres" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    <a :href="livre.pdf"><img :src="livre.image"></a>
                                </td>
                                <td class="px-6 py-4">
                                    {{ livre.nom_livre }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ livre.nom_cat }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ livre.created_at }}
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
    name:'livres',
    components:{
        Sidebar
    },
    data(){
        return {
            livres:null
        }
    },
    methods:{
        getLivres(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/admin/getLivres',
                })
                .then((res) =>{
                    this.livres=res.data;
            })
        }
        
    }
    }
</script>