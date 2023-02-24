<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Mes favories</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <div v-for="favorie in favories">
            <Livre page="favorie" @supprimerfavorie="supprimerfavorie" :id_favorie="favorie.id_favorie" :id_livre="favorie.id" :image="favorie.image" :nom="favorie.nom_livre" :file="favorie.pdf" :cat="favorie.nom_cat" :date="favorie.created_at"  />
        </div>      
    </div>

</template>


<script >
    import axios from 'axios'
    import Cookies from 'vue-cookies'
    import Header from '@/components/header_user.vue'
    import Livre from '@/components/livre.vue'
    import { userStore } from '@/stores/userStore'
export default{
    name:'favories_comp',
    setup(){
      const user = userStore()
      return { user }
    },
    data(){
        return {
            favories:''
        }
    },
    components:{
        Header,
        Livre
    },
    methods:{
        getLivres(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/user/getFavories/'+this.user.id+'',
                })
                .then((res) =>{
                    this.favories=res.data;
            })
        },
        supprimerfavorie(id){
            axios({
                method: 'DELETE',
                url: 'http://127.0.0.1:8000/api/user/supprimerFavorie/'+id+'',
                })
                .then((res) =>{
                    this.getLivres();
                })
        }
    },
    mounted(){
        this.getLivres();
    }
}
</script>