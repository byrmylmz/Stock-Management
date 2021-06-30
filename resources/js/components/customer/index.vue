<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="d-flex bd-highlight mb-3" >       
                  <div class=" bd-highlight ">
                    <router-link to="/store-customer" class="btn btn-info btn-icon-split">
                          <span class="icon text-white-50">
                          <i class="fas fa-plus-circle"></i>
                          </span>
                          <span class="text">Yeni Müşteri Ekle</span>
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
                  <h6 class="m-0 font-weight-bold text-primary">Kişi Listesi</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>İsim Soyisim</th>
                        <th>Fotoğraf</th>
                        <th>Email</th>
                        <th>Adress</th>
                        <th>Telefon Numarasi</th>
                        <th>Eylem</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in filtersearch" :key="customer.id">
                        <td>{{customer.name}}</td>
                        <td><img :src="customer.photo" style="width:30px; height:30px;"></td>
                        <td>{{customer.phone}}</td>
                        <td>{{customer.email}}</td>
                        <td>{{customer.adress}}</td>
                        <td>
                          <router-link :to="{name:'edit-customer', params:{id:customer.id}}"  class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></router-link>
                          <a  @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger" style="margin-left:5px; color:white;"><i class="fas fa-trash"></i></a></td>
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
      customers:[],
      searchTerm: '',
    }
  },
  computed:{
    filtersearch(){
      return this.customers.filter(customer =>{
        return customer.name.match(this.searchTerm)
      })
    }

  },
  methods:{
     allCustomers(){
       axios.get('/api/customer/')
       .then(({data})=>(this.customers=data))
       .catch()
     },
     deleteCustomer(id){
             Swal.fire({
              title: 'Silmek isteğinizden Emin misiniz?',
              text: "Bu işlem geri Alınamaz!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Kabul ediyorum!'
            }).then((result) => {
              if (result.value) {
                axios.delete('/api/customer/'+id)
               .then(() => {
                this.customers = this.customers.filter(customer => {
                  return customer.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'customer'})
               })
              
              }
            })


     }
  },
  created(){
    this.allCustomers();
  },

  mounted() {
    console.log('Component mounted.')
  },
}
</script>
