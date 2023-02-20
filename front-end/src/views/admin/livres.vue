<template>
    <div class="grid sm:grid-cols-4">
        <Sidebar class="sm:h-screen bg-gray-900 fixed"/>
        <div class="sm:col-start-2 sm:col-span-3 mx-auto">
            <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Les livres</h1>
            
            <form @submit.prevent="onSubmit">
                <input type="file" @change="Upload"><br>
                <button type="submit" class="bg-slate-500">ajouter</button>
            </form>
        </div>
    </div>
    

</template>


<script >
    import axios from 'axios'
    import Sidebar from '@/components/sidebar.vue'
    export default {
    name:'livres',
    components:{
        Sidebar
    },
    data(){
        return {
            file: null,
        }
    },
    methods:{
        Upload(e){
            this.file = e.target.files[0];
        },
        onSubmit(){
            let form = new FormData();
            form.append('file', this.file);
            axios.post( 'http://127.0.0.1:8000/api/livre/addLivre',form,
            ).then(function(res){
                console.log(res);
            })
        }
    }
    }
</script>