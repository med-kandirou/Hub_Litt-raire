<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Discuter dans le groupe</h1>
    
    <div class="flex">
        <div class="w-1/2">
            <h1 class="text-center text-2xl font-extrabold tracking-tight leading-none text-gray-900">membres</h1>
            <div class="ml-10" v-for="membre in membres">
                <div class="flex mb-3">
                    <div>
                        <img class="rounded-full w-20 mr-2" src="https://flowbite.com/application-ui/demo/images/users/jese-leos.png">
                    </div>
                    <div class="mt-auto mb-auto">
                        <p class="">{{membre.nom}} {{membre.prenom}}</p>
                        <p class="text-gray-600">{{membre.email}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/2">
            <h1 class="text-center text-2xl mb-2 font-extrabold tracking-tight leading-none text-gray-900">Messages</h1>
                <div class="overflow-y-auto h-80">
                    <div v-for="message in messages">
                    <dir v-if="message.id_user==user.id">
                        <div class="flex justify-end mr-10">
                            <div>
                                <p>{{message.nom}} {{message.prenom}}</p>
                                <p class="border border-1 p-2 rounded-md bg-green-300 text-white">{{message.message}}</p>
                            </div> 
                        </div>
                    </dir>
                    <div v-else>
                        <div class="flex justify-start ml-10">
                            <div>
                                <p>{{message.nom}} {{message.prenom}}</p>
                                <p class="border border-1 p-2 rounded-md bg-green-700 text-white">{{message.message}}</p>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <input type="text" v-model="sendmessage" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Envoyer un message" >
                <button type="button" @click="send" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Envoyer</button>
            </div>
        </div>
    </div>
</template>


<script setup>
    import Header from '@/components/header_user.vue'
    import axios from 'axios';
    import { onMounted , ref} from 'vue';
    import { userStore } from '@/stores/userStore'
    import { useRoute } from 'vue-router';
    const route = useRoute()
    let membres = ref([]);
    let sendmessage = ref('');
    let messages = ref('');
    const user = userStore()
    function getMessages() {
        axios({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/messages/'+route.params.id,
            })
            .then((res) =>{
                messages.value=res.data;
        })
    }
    function getMembres() {
        axios({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/membres/'+route.params.id,
            })
            .then((res) =>{
                membres.value=res.data;
        })
    }
    function send(){
        axios({
            method: 'POST',
            url: 'http://127.0.0.1:8000/api/messages',
            data:{
                idgroup:route.params.id,
                iduser:user.id,
                message:sendmessage.value
            }
            })
            .then((res) =>{
                console.log(res);
                sendmessage.value='';
                getMessages();
        })
    }

    
    onMounted(() => {
        getMembres();
        getMessages();
    })
</script>