<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Discuter dans le groupe</h1>
    
    <div class="flex">
        <div class="w-1/2">
            <div v-for="membre in membres">
                <div class="flex mb-3">
                    <div>
                        <img class="rounded-full w-20 mr-2" src="https://flowbite.com/application-ui/demo/images/users/jese-leos.png">
                    </div>
                    <div class="mt-auto mb-auto">
                        <p class="">{{membre.nom}} {{membre.nom}}</p>
                        <p class="text-gray-600">{{membre.email}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/2">
            <h1 class="text-center text-2xl font-extrabold tracking-tight leading-none text-gray-900">Messages</h1>
 
            <div class="relative">
                <input type="text" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Envoyer un message" >
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Envoyer</button>
            </div>
        </div>
    </div>
</template>


<script setup>
    import Header from '@/components/header_user.vue'
    import axios from 'axios';
    import { onMounted , ref} from 'vue';
    import { useRoute } from 'vue-router';
    const route = useRoute()
    let membres = ref([]);
    function getMembres() {
        axios({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/membres/'+route.params.id,
            })
            .then((res) =>{
                membres.value=res.data;
        })
       
    }

    
    onMounted(() => {
        getMembres();
    })
</script>