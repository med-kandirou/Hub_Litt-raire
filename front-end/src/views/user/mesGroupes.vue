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
                <tr v-for="g in mesgroupes" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ g.nom }}
                    </td>
                    <td class="px-6 py-4">
                        {{ g.description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ g.created_at.slice(0,10) }} <br>

                    </td>
                    <td class="px-6 py-4">
                        <button @click="supprimerMongroup(g.id)" type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Supprimer</button>
                    </td>
                </tr>
        </tbody>
    </table>

</template>

<script >
    import axios from 'axios'
    import Header from '@/components/header_user.vue'
    import { userStore } from '@/stores/userStore'
export default{
    name:'mesGroupes',
    setup(){
      const user = userStore()
      return { user }
    },
    data(){
        return{
            mesgroupes: '',
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
                    this.getmesGroupes();
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
                    Toast.fire({
                        icon: 'success',
                        title: 'groupe a été supprimé'
                    })
                })
        },
        getmesGroupes(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/user/mesGroupes/'+this.user.id+'',
                })
                .then((res) =>{
                    this.mesgroupes=res.data;
            })
        }
    },
    mounted(){
        this.user.checkifuser();
        this.getmesGroupes();
    }
}


</script>