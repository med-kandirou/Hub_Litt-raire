<template>
    <div class="grid sm:grid-cols-4">
        <Sidebar class="sm:h-screen bg-gray-900 fixed"/>
        <div class="sm:col-start-2 sm:col-span-3 w-full">
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
                                <td class="px-6 py-4 w-36 h-5/6">
                                    <a :href="livre.pdf" target="_blank"><img :src="livre.image"></a>
                                </td>
                                <td class="px-6 py-4">
                                    {{ livre.nom_livre }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ livre.nom_cat }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ livre.created_at.slice(0,10) }}
                                </td>
                                <td class="px-6 py-4">
                                    <button @click="supprimerLivre(livre.id)" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Archiver</button> 
                                    <button @click="toggle(livre.id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Modifier</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close hidden">&times;</span>

                    <div class="px-6 py-6 lg:px-8">
                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Modifier une categorie</h3>
                            <hr class="mb-11">
                            <form class="space-y-6">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de categorie</label>
                                    <input type="text" v-model="livre.nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Nom de categorie" >
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                                    <input type="file" @change="uploadimage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                </div>
                                <div>
                                    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contenu</label>
                                    <input type="file" @change="uploadfile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                </div>
                                <div>
                                    <select v-model="livre.selectedCat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option v-for="cat in categories" :value="cat.id" >{{ cat.nom }}</option>
                                    </select> 
                                </div>
                                <button type="button" @click="modifierBook" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Modifier</button>
                            </form>
                        </div>
                        </div>
                </div>
                </div>
        </div>
    </div>
    

</template>


<script >
    import axios from 'axios'
    import Sidebar from '@/components/sidebar.vue'
    import { userStore } from '@/stores/userStore'
    export default {
    name:'livres',
    setup(){
      const user = userStore()
      return { user }
    },
    components:{
        Sidebar
    },
    data(){
        return {
            livres:null,
            livre:{
                id:null,
                nom:null,
                selectedCat:''
            },
            categories:'',
            image:{
                file:'',
                url:'',
            },
            pdf:{
                file:'',
                url:''
            }
        }
    },
    methods:{
        uploadimage(e){
            this.image.file = e.target.files[0];
        },
        uploadfile(e){
            this.pdf.file = e.target.files[0];
        },
        async modifierBook(){
            if(this.image.file!=''){
                const signatureImage = await fetch('http://127.0.0.1:8000/api/livre/getsignature').then((data) => (data.json()));
                let formImage = new FormData();
                formImage.append('file', this.image.file);
                formImage.append("api_key", 296547854239657)
                formImage.append("signature",signatureImage.signature)
                formImage.append("timestamp",signatureImage.timestamp)
                formImage.append("folder", "books");
                await axios.post("https://api.cloudinary.com/v1_1/dxn7gskyn/auto/upload",formImage)
                .then((res) => {
                    this.image.url=res.data.url;
                })
            }
            if(this.pdf.file!=''){
                const signaturepdf = await fetch('http://127.0.0.1:8000/api/livre/getsignature').then((data) => (data.json()));
                let formImage = new FormData();
                formImage.append('file', this.pdf.file);
                formImage.append("api_key", 296547854239657)
                formImage.append("signature",signaturepdf.signature)
                formImage.append("timestamp",signaturepdf.timestamp)
                formImage.append("folder", "books");
                await axios.post("https://api.cloudinary.com/v1_1/dxn7gskyn/auto/upload",formImage)
                .then((res) => {
                    this.pdf.url=res.data.url;
                })
            }
            axios.post('http://127.0.0.1:8000/api/livre/updateLivre',{
                id:this.livre.id,
                image: this.image.url,
                nom:this.livre.nom,
                file:this.pdf.url,
                id_cat:this.livre.selectedCat
            })
            .then((res)=>{
                if(res.data="added"){
                        this.$swal.fire(
                            'Succes!',
                            'Livre a été bien ajouté',
                            'success'
                    )
                }
                this.getLivres();
            })
        },
        getLivres(){
            axios({
                method: 'GET',
                url: 'http://127.0.0.1:8000/api/admin/getLivres',
                })
                .then((res) =>{
                    this.livres=res.data;
            })
        },
        supprimerLivre(id){
            axios({
                method: 'PATCH',
                url: 'http://127.0.0.1:8000/api/livre/supprimerLivre/'+id+'',
                })
                .then((res) =>{
                    if(res.data=='deleted'){
                        this.getLivres();
                }  
            })
        },
        getcate(){
            axios({
                method: 'get',
                url: 'http://127.0.0.1:8000/api/admin/getCats',})
                .then((res) =>{
                    this.categories=res.data;
            });
        },
        toggle(id){
            axios({
                method: 'get',
                url: 'http://127.0.0.1:8000/api/livre/getlivre/'+id+'',})
                .then((res) =>{
                    this.livre.nom=res.data.nom;
                    this.livre.id=res.data.id;
            });
            this.getcate();
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];
            modal.style.display = "block";
            span.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        },
    }, 
    mounted(){
        this.user.checkifAdmin();
        this.getLivres();
    }
    }
</script>

<style scoped>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

