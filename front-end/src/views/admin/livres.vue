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
        async onSubmit(){
            const signatureResponse = await fetch('http://127.0.0.1:8000/api/livre/getsignature').then((data) => (data.json()));
            
            let form = new FormData();
            form.append('file', this.file);
            form.append("api_key", 296547854239657)
            form.append("signature",signatureResponse.signature)
            form.append("timestamp",signatureResponse.timestamp)
            //   optionals Params
            form.append("folder", "books");
            axios.post("https://api.cloudinary.com/v1_1/dxn7gskyn/auto/upload",form)
            .then((res) => {
                console.log(res)
            })
            
        }
    }
    }
</script>