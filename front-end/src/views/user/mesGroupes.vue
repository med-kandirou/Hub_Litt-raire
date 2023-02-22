<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Mes groupes</h1>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date de creation
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="group in groupes" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ group.nom }}
                    </td>
                    <td class="px-6 py-4">
                        {{ group.description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ group.created_at.slice(0,10) }}
                    </td>
                    <td class="px-6 py-4">
                        <button @click="supprimerMongroup(group.id)" type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Supprimer</button>
                    </td>
                </tr>
        </tbody>
    </table>

</template>

<script >
    import axios from 'axios'
    import Cookies from 'vue-cookies'
    import Header from '@/components/header_user.vue'
export default{
    name:'mesGroupes',
    date(){
        return{
            groupes:null
        }
    },
    components:{
        Header
    },
    methods:{
        supprimerMongroup(id){
            axios({
                method: 'DELETE',
                url: 'http://127.0.0.1:8000/api/user/supprimerMongroup/'+id+'',
                })
                .then((res) =>{
                    console.log(res);
                })
        },
        Mesgroupes(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/user/mesGroupes/'+Cookies.get('id')+'',
                })
                .then((res) =>{
                    this.groupes=res.data;
            })
        }
    },
    created(){
        this.Mesgroupes();
    }
}


</script>