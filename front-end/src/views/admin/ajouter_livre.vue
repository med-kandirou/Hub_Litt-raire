<template>
    <div class="grid sm:grid-cols-4">
        <Sidebar class="sm:h-screen bg-gray-900 fixed"/>
        <div class="sm:col-start-2 sm:col-span-3 mx-auto">
            <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Ajouter un livre</h1>

            
            <form @submit.prevent="onSubmit">
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de livre</label>
                    <input type="text" v-model="nom" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Nom" >
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image de livre</label>
                    <input type="file" @change="uploadimage" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
                </div>
                <div class="mb-6">
                    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contenu de livre</label>
                    <input type="file" @change="uploadfile" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" >
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                    <select v-model="selectedCat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected >Select category</option>
                        <option v-for="cat in categories" :value="cat.id" >{{ cat.nom }}</option>
                    </select>       
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ajouter</button>
            </form>
        </div>
    </div>
    

</template>


<script >
    import axios from 'axios'
    import Sidebar from '@/components/sidebar.vue'
    export default {
    name:'ajouter_livre',
    components:{
        Sidebar
    },
    data(){
        return {
            categories:'',
            nom:'',
            image:'',
            file:'',
            selectedCat:'',
            UrlImage:'',
            UrlFile:''
        }
    },
    methods:{
        uploadimage(e){
            this.image = e.target.files[0];
        },
        uploadfile(e){
            this.file = e.target.files[0];
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
        async onSubmit(){
            const signatureImage = await fetch('http://127.0.0.1:8000/api/livre/getsignature').then((data) => (data.json()));
            let formImage = new FormData();
            formImage.append('file', this.image);
            formImage.append("api_key", 296547854239657)
            formImage.append("signature",signatureImage.signature)
            formImage.append("timestamp",signatureImage.timestamp)
            formImage.append("folder", "books");
            axios.post("https://api.cloudinary.com/v1_1/dxn7gskyn/auto/upload",formImage)
            .then((res) => {
                this.UrlImage=res.data.url;
            })

            const signaturePDF = await fetch('http://127.0.0.1:8000/api/livre/getsignature').then((data) => (data.json()));
            let formPdf = new FormData();
            formPdf.append('file', this.file);
            formPdf.append("api_key", 296547854239657)
            formPdf.append("signature",signaturePDF.signature)
            formPdf.append("timestamp",signaturePDF.timestamp)
            formPdf.append("folder", "books");
            axios.post("https://api.cloudinary.com/v1_1/dxn7gskyn/auto/upload",formPdf)
            .then((res) => {
                this.UrlFile=res.data.url;
            })

            //console.log(this.UrlFile);
            // axios({
            //     method: 'POST',
            //     url: 'http://127.0.0.1:8000/api/livre/addLivre',
            //     data:{
            //         nom:this.nom,
            //         image:this.image,
            //         file:this.file,
            //         cat:this.selectedCat
            //     }
            //     })
            //     .then((res) =>{
            //         // if(res.data="added"){
            //         //     this.$swal.fire(
            //         //         'Succes!',
            //         //         'Livre a été bien ajouté',
            //         //         'success'
            //         //     )
            //         // }

            //         console.log(res);
            //     })

            
        }
    
    },
    mounted(){
        this.getCats();
    }
    
}  
</script>