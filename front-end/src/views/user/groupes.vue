<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Groupes</h1>
    
    
    <div class="">
        <center><button @click="toggle" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Creer votre group</button></center><br>


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


        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close hidden">&times;</span>
                <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Modifier une categorie</h3>
                        <hr class="mb-11">
                        <form class="space-y-6">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom </label>
                                <input type="text" v-model="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Nom" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <input type="text" v-model="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="description" required>
                            </div>
                            <button type="button" @click="creerUngroupe" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Creer</button>
                        </form>
                    </div>
                </div>
        </div>
</template>



<script >
    import axios from 'axios'
    import Header from '@/components/header_user.vue'
    import { userStore } from '@/stores/userStore'
export default{
    name:'favories',
    setup(){
      const user = userStore()
      return { user }
    },
    data(){
        return {
            groups:'',
            nom:null,
            description:null
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
        creerUngroupe(){
            var form =new FormData();
            form.append('nom',this.nom);
            form.append('description',this.description);
            form.append('id_user',this.user.id);
            axios({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/groupe/creerUngroupe',
                data:form
                })
                .then((res) =>{
                    if(res.data=="added"){
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
                        title: 'groupe crée'
                        })
                        this.getGroups();
                    }
                })
        },
        rejoindreGroup(id){
            axios({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/user/rejoindreGroup',
                data:{
                    id_group:id,
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
                        this.nom='';
                        this.description='';
                    }
                    else{
                        Toast.fire({
                        icon: 'error',
                        title: 'Déja integrer dans le groupe'
                        })
                    }
                    
                })
        },
        toggle(){
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
        }
    },
    mounted(){
        this.getGroups();
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