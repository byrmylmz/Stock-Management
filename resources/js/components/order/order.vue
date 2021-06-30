<template>
  <div class="row justify-content-center">

    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="d-flex bd-highlight mb-3" >
        
       
       
                  <div class=" bd-highlight ">
                    <router-link to="/store-expense" class="btn btn-info btn-icon-split">
                          <span class="icon text-white-50">
                          <i class="fas fa-plus-circle"></i>
                          </span>
                          <span class="text">Yeni Harcama Ekle</span>
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
                  <h6 class="m-0 font-weight-bold text-primary">Bugün Verilen Siparişler</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Müşteri İsmi</th>
                        <th>Toplam Tutar</th>
                        <th>Ödeme</th>
                        <th>Vade</th>
                        <th>Ödeme Yöntemi</th>
                        <th>Eylem</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in filtersearch" :key="order.id">
                        <td>{{order.name}}</td>
                        <td>{{order.total}}</td>
                        <td>{{order.pay}}</td>
                        <td>{{order.due}}</td>
                        <td>{{order.payby}}</td>
                        <td>
                          <router-link :to="{name:'view-order', params:{id:order.id}}"  class="btn btn-sm btn-primary"><i class="far fa-eye"></i></router-link>
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
      orders:[],
      searchTerm: '',
    }
  },
  computed:{
    filtersearch(){
      return this.orders.filter(order =>{
        return order.name.match(this.searchTerm)
      })
    }
  },
  methods:{
     allOrder(){
       axios.get('/api/orders')
       .then(({data})=>(this.orders=data))
       .catch()
     },

  },
  created(){
    this.allOrder();
  },

  mounted() {
    console.log('Component mounted.')
  },
}
</script>
