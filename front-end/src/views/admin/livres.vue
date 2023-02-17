<template>
    <div class="grid sm:grid-cols-4">
        <Sidebar class="sm:h-screen bg-gray-900 fixed"/>
        <div class="sm:col-start-2 sm:col-span-3 mx-auto">
            <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Les livres</h1>
        </div>
    </div>
    

    


</template>


<script >
    import Sidebar from '@/components/sidebar.vue'
    export default {
    name:'livres',
    components:{
        Sidebar
    },
    }
</script>