<template>
  <div class="row justify-content-center">

    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="d-flex bd-highlight mb-3" >
        
       
       
                  <div class=" bd-highlight ">
                    <router-link to="/store-product" class="btn btn-info btn-icon-split">
                          <span class="icon text-white-50">
                          <i class="fas fa-plus-circle"></i>
                          </span>
                          <span class="text">Stok Yönetimi</span>
                        </router-link >
                  </div>
              <div class="ml-auto bd-highlight  ">
                <input type="text" placeholder="Arama yap." class="form-control" style="width:300px; " v-model="searchTerm">
              </div>

      </div>
      <div class="card shadow-sm ">
            
         
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Ürün Listesi</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>İsim</th>
                        <th>Kod</th>
                        <th>Fotoğraf</th>
                        <th>Kategori</th>
                        <th>Satın Alma Fiyatı</th>
                        <th>Stok Durumu</th>
                        <th>Miktar</th>
                        <th>Eylem</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filtersearch" :key="product.id">
                        <td>{{product.product_name}}</td>
                        <td>{{product.product_code}}</td>
                        <td><img :src="product.image" style="width:30px; height:30px;"></td>
                        <td>{{product.category_name}}</td>
                        <td>{{product.buying_price}}</td>
                        <td v-if="product.product_quantity >=1"> <span class="badge badge-success">Stok Müsait</span></td>
                        <td v-else> <span class="badge badge-danger">Stok Bitti</span></td>
                        <td>{{product.product_quantity}}</td>
                        <td>
                          <router-link :to="{name:'edit-stock', params:{id:product.id}}"  class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></router-link>
                         </td>
                      </tr>
                    
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->
            </div>
    
      
    

</template>

<script>
export default {
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: '/' })
    }
  },
  data(){
    return{
      products:[],
      searchTerm: '',
    }
  },
  computed:{
    filtersearch(){
      return this.products.filter(product =>{
        return product.name.match(this.searchTerm)
      })
    }

  },
  methods:{
     allProduct(){
       axios.get('/api/product')
       .then(({data})=>(this.products=data))
       .catch()
     },

    
  },
  created(){
    this.allProduct();
  },

  mounted() {
    console.log('Component mounted.')
  },
}
</script>
