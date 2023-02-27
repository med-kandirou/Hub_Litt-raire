<template>
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a :href="file" target="_blank">
            <img class="rounded-t-lg" :src="image" />
        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ nom }}</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Categorie : {{cat}}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Date d'ajout : {{date.slice(0,10)}}</p>
            <div v-if="page=='livre'">
                <button @click="this.$emit('ajouterFavorie',id_livre)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Ajouter au favories
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div class="flex justify-around mt-4">
                    <button><img height="40" width="40" src="../../public/like.svg" alt="like"></button>
                    <button><img height="40" width="40" src="../../public/like.svg" alt="disike"></button>
                </div>
            </div>
            <div v-else>
                <button @click="this.$emit('supprimerfavorie',id_favorie)" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    supprimer du favories
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script >

    export default{
        name:'livre_comp',
        props:{
            id_livre:Number,
            image:String,
            file:String,
            nom:String,
            cat:String,
            date:String,
            id_favorie:Number,
            page:String
        },
    }
</script>