<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Les livres</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <div v-for="reservation in reservations">
            
        </div>      
    </div>

</template>



<script >
import Header from '@/components/header_user.vue'

export default{
    name:'livres',
    components:{
        Header
    }

}
</script>

