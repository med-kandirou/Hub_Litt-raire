<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Les livres</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <div v-for="livre in livres">
            <Livre @ajouterFavorie="ajouterFavorie" :id_livre="livre.id" :image="livre.image" :nom="livre.nom_livre" :file="livre.pdf" :cat="livre.nom_cat" :date="livre.created_at"  />
        </div>      
    </div>

</template>



<script >
    import Cookies from 'vue-cookies'
    import axios from 'axios'
    import Livre from '@/components/livre.vue'
    import Header from '@/components/header_user.vue'

export default{
    name:'livres',
    data(){
        return{
            livres:''
        }
    },
    components:{
        Header,
        Livre
    },methods:{
        getLivres(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/admin/getLivres',
                })
                .then((res) =>{
                    this.livres=res.data;
            })
        },
        ajouterFavorie(id){
            axios({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/user/ajouterFavorie',
                data:{
                    id_livre:id,
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
                    if(res.data=='added'){
                        Toast.fire({
                            icon: 'success',
                            title: 'Ajouté au favories'
                        })
                    }
                    else{
                        Toast.fire({
                            icon: 'success',
                            title: 'Déja ajouté'
                        })
                    }
            })
        }
    },
    mounted(){
        this.getLivres();
    }
    


}
</script>

