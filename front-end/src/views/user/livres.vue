<template>
    <Header />

    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Les livres</h1>
    <div class="flex justify-around">
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categorie :</label>
            <select v-model="categorie" @change="getLivrebyCat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choisir une categorie</option>
                <option v-for="cat in categories" :value="cat.id">
                    {{cat.nom}}
                </option>

            </select>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date :</label>
            <input type="date" v-model="date" @change="getLivrebyDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom :</label>
            <input type="text" v-model="nom" @keyup="getLivrebyNom" placeholder="nom de livre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

    </div><br><br>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <div v-for="livre in livres">
            <Livre page="livre"  @ajouterFavorie="ajouterFavorie" :id_livre="livre.id" :image="livre.image" :nom="livre.nom_livre" :file="livre.pdf" :cat="livre.nom_cat" :date="livre.created_at"  />
        </div>      
    </div>

</template>



<script >
    import axios from 'axios'
    import Livre from '@/components/livre.vue'
    import Header from '@/components/header_user.vue'
    import { userStore } from '@/stores/userStore'
export default{
    name:'livres',
    setup(){
      const user = userStore()
      return { user }
    },
    data(){
        return{
            livres:'',
            mesReactions:[],
            categorie:'',
            categories:'',
            nom:'',
            date:''
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
        
        getMesReaction(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/user/getMesReaction/'+this.user.id+'',
                })
                .then((res) =>{
                    this.mesReactions=res.data;
                    console.log(this.mesReactions)
            })
        },
        // checkReact(){
        // //    for(let i=0;i<this.mesReactions.length;i++){
        // //         console.log(i);
        // //    }
        //     console.log(this.mesReactions)
        // },
        ajouterFavorie(id){
            axios({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/user/ajouterFavorie',
                data:{
                    id_livre:id,
                    id_user:this.user.id
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
        },
        getCats(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/admin/getCats',
                })
                .then((res) =>{
                    this.categories=res.data;
            })
        },
        getLivrebyDate(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/user/getLivrebyDate/'+this.date+'',
                })
                .then((res) =>{
                    this.livres=res.data;
            })
        },
        getLivrebyCat(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/user/getLivrebyCat/'+this.categorie+'',
                })
                .then((res) =>{
                    this.livres=res.data;
            })
        },
        getLivrebyNom(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/user/getLivrebyNom/'+this.nom+'',
                })
                .then((res) =>{
                    this.livres=res.data;
            })
        },
    },
    mounted(){
        this.user.checkifuser();
        this.getMesReaction();
        // this.checkReact();
        this.getLivres();
        this.getCats();
    },
    created(){
       
    }
    


}
</script>

