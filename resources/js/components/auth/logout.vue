<template>
  
</template>

<script>
export default {
  created(){
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      Toast.fire({
          icon:'success',
          title:'Successfuly Logout'
          
      })
    
      this.$router.push({name:'/'})
    
  },
  mounted() {
    console.log('Component mounted.')
  },
}
</script>
