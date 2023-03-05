<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Discuter dans le groupe</h1>
    
    <div class="flex">
        <div class="w-1/2">
            <ul v-for="membre in membres">
                <div class="flex justify-center">
                    <div>
                        <img class="rounded-full w-20 mr-2" src="https://flowbite.com/application-ui/demo/images/users/jese-leos.png">
                    </div>
                    <div class="mt-auto mb-auto">
                        <p class="">{{membre.nom}} {{membre.nom}}</p>
                        <p class="text-gray-600">{{membre.email}}</p>
                    </div>
                </div>
            </ul>
        </div>
        <div class="w-1/2">
            <h1 class="text-center text-2xl font-extrabold tracking-tight leading-none text-gray-900">Messages</h1>
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