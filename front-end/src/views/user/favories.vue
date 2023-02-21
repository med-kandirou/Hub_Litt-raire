<template>
    <Header />
    <h1 class="mt-10 mb-9 text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900">Mes favories</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <div v-for="livre in livres">
            <Livre page="favorie" @ajouterFavorie="ajouterFavorie" :id_livre="livre.id" :image="livre.image" :nom="livre.nom_livre" :file="livre.pdf" :cat="livre.nom_cat" :date="livre.created_at"  />
        </div>      
    </div>

</template>


<script >
import Header from '@/components/header_user.vue'
export default{
    name:'favories_comp',
    components:{
        Header
    }

}
</script>