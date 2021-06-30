<template>
  <div class="row justify-content-center">

    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="d-flex bd-highlight mb-3" >
        
       
       
                  <div class=" bd-highlight ">
                    <router-link to="/store-supplier" class="btn btn-info btn-icon-split">
                          <span class="icon text-white-50">
                          <i class="fas fa-plus-circle"></i>
                          </span>
                          <span class="text">Yeni Tedarikçi Ekle</span>
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
                  <h6 class="m-0 font-weight-bold text-primary">Tedarikçi Listesi</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>İsim Soyisim</th>
                        <th>Fotoğraf</th>
                        <th>Bağlı Daire</th>
                        <th>Telefon</th>
                        <th>Bakiye</th>
                        <th>Hesap Tipi</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in filtersearch" :key="supplier.id">
                        <td>{{supplier.name}}</td>
                        <td><img :src="supplier.photo" style="width:30px; height:30px;"></td>
                        <td></td>
                        <td>{{supplier.phone}}</td>
                        <td>{{supplier.balance}}</td>
                        <td><span class="badge badge-success">Tedarikçi</span></td>
                        <td>
                          <router-link :to="{name:'edit-supplier', params:{id:supplier.id}}"  class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></router-link>
                          <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger" style="margin-left:5px; color:white;"><i class="fas fa-trash"></i></a></td>
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
    created(){
      if(!User.loggedIn()){
        $this.$router.push({name:'/'})
      }
    },
    data(){
      return{
        suppliers:[],
        searchTerm:'',
      }
    },
  computed:{
    filtersearch(){
      return this.suppliers.filter(supplier =>{
        return supplier.name.match(this.searchTerm)
      })
    }

  },
    methods:{
    allsupplier(){
       axios.get('/api/supplier')
       .then(({data})=>(this.suppliers=data))
       .catch()
     },

  deleteSupplier(id){
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
                axios.delete('/api/supplier/'+id)
               .then(() => {
                this.suppliers = this.suppliers.filter(supplier => {
                  return supplier.id != id
                })
               })
               .catch(() => {
                this.$router.push({name:'supplier'})
               })
              
              }
            })


     }


    },
     created(){
    this.allsupplier();
  },

  mounted() {
    console.log('Component mounted.')
  },

}
</script>
