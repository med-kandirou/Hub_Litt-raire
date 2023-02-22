<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Groupes</h1>
    <div class="">
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
                                Créateur
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date de creation
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="group in groups" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ group.nom }}
                            </td>
                            <td class="px-6 py-4">
                                {{ group.description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ group.nom_user }}
                            </td>
                            <td class="px-6 py-4">
                                {{ group.created_at.slice(0,10) }}
                            </td>
                            <td class="px-6 py-4">
                                <button @click="rejoindreGroup(group.id)" type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Rejoindre</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
</template>



<script >
    import axios from 'axios'
    import Header from '@/components/header_user.vue'
export default{
    name:'favories',
    data(){
        return {
            groups:''
        }
    },
    components:{
        Header
    },
    methods:{
        getGroups(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/groupe/getGroups',
                })
                .then((res) =>{
                    this.groups=res.data;
            })
        },
        rejoindreGroup(id){
            axios({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/user/rejoindreGroup',
                data:{
                    id_group:id,
                    id_user:Cookies.get('id')
                }
                })
                .then((res) =>{
                    const Toast = this.$swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
                    if(res.data='added'){
                        Toast.fire({
                        icon: 'success',
                        title: 'Ajouté au favories'
                        })
                    }
                    else{
                        Toast.fire({
                        icon: 'error',
                        title: 'Déja integrer dans le group'
                        })
                    }
                    
                })
        }
    },
    mounted(){
        this.getGroups();
    }

}
</script>