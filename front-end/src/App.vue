
<template>
  <Header />
  <RouterView />

</template>


<script>
 import Header from './components/header.vue'
  export default {
    name:'App',
    components:{
      Header
    },
    data(){
      return {
        
      }
    }
    
  }
</script>


<style scoped>

</style>
