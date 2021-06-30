<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card shadow-sm ">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Stok Guncelle</h1>
                </div>
                <hr />
                <form
                  class="user"
                  @submit.prevent="stockUpdate"
                 
                >
                   <!-- form group -->
               <div class="form-group">

          <div class="form-row">
            <div class="col-md-12">
              <label for="exampleFormControlSelect1">Ürün</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Product Name" v-model="form.product_quantity">
     
            </div>
          </div>
        </div>
         
                  <!-- form group -->
               

            

                <button type="submit" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                  </span>
                  <span class="text">Güncelle</span>
                </button>
                
                <router-link to="/product" style="text-decoration-line: none;">
                  <button type="submit" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Vazgeç</span>
                  </button>
                </router-link>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },

    data(){
    return {
      form:{
         product_quantity: '' 
        
      },
      errors:{},
   
    }
  },
  created(){
  	let id = this.$route.params.id
  	axios.get('/api/product/'+id)
  	.then(({data}) => (this.form = data))
  	.catch(console.log('error'))


  },

 
  
  methods: {

    stockUpdate(){
  	  let id = this.$route.params.id
       axios.post('/api/stock/update/'+id,this.form)
       .then(() => {
        this.$router.push({ name: 'stock'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  
  },

  mounted() {
    console.log('Component mounted.')
  },
}
</script>
