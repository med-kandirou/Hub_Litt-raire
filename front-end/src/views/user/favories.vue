<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Mes favories</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <div v-for="favorie in favories">
            <Livre page="favorie" @supprimerfavorie="supprimerfavorie" :id_livre="favories.id" :image="favories.image" :nom="favories.nom_livre" :file="favories.pdf" :cat="favories.nom_cat" :date="favories.created_at"  />
        </div>      
    </div>

</template>


<script >
import Cookies from 'vue-cookies'
import Header from '@/components/header_user.vue'
export default{
    name:'favories_comp',
    data(){
        return {
            favories:''
        }
    },
    components:{
        Header
    },
    methods:{
        getLivres(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/user/getFavories/'+Cookies.get('id')+'',
                })
                .then((res) =>{
                    this.favories=res.data;
            })
        },
    },
    mounted(){
        this.getLivres();
    }
}
</script>