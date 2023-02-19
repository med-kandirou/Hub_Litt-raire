<template>

    <div class="grid sm:grid-cols-4">
        <Sidebar class="sm:h-screen bg-gray-900 fixed"/>
        <div class="sm:col-start-2 sm:col-span-3 mx-auto w-full">
            <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Les utilisateurs</h1>
            <div class="">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nom
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Prenom
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date de creation
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date de mise a jour
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ user.nom }}
                            </td>
                            <td class="px-6 py-4">
                                {{ user.prenom }}
                            </td>
                            <td class="px-6 py-4">
                                {{ user.email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ user.created_at.slice(0,10) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ user.updated_at.slice(0,10) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</template>


<script >

    import axios from 'axios';
    import Sidebar from '@/components/sidebar.vue'
    export default {
    name:'users',
    data(){
        return{
            users:''
        }
    },
    components:{
        Sidebar
    },
    methods:{
        getusers(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/admin/getUsers',
                })
                .then((res) =>{
                    this.users=res.data;
            })
        }
    },
    mounted(){
        this.getusers();
    }
    }
</script>