<template>
  <div class="row justify-content-center">

    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="d-flex bd-highlight mb-3" >
        
       
       
                  <div class=" bd-highlight ">
                    <router-link to="/store-employee" class="btn btn-info btn-icon-split">
                          <span class="icon text-white-50">
                          <i class="fas fa-plus-circle"></i>
                          </span>
                          <span class="text">Yeni Kişi Ekle</span>
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
                        <th>Bağlı Daire</th>
                        <th>Telefon</th>
                        <th>Bakiye</th>
                        <th>Hesap Tipi</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="employee in filtersearch" :key="employee.id">
                        <td>{{employee.name}}</td>
                        <td><img :src="employee.photo" style="width:30px; height:30px;"></td>
                        <td>{{employee.civilid}}</td>
                        <td>{{employee.phone}}</td>
                        <td>{{employee.job}}</td>
                        <td><span class="badge badge-success">Kat Maliki</span></td>
                        <td>
                          <router-link :to="{name:'pay-salary', params:{id:employee.id}}"  class="btn btn-sm btn-primary">Pay Salary</router-link>
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
      employees:[],
      searchTerm: '',
    }
  },
  computed:{
    filtersearch(){
      return this.employees.filter(employee =>{
        return employee.name.match(this.searchTerm)
      })
    }

  },
  methods:{
     allEmployee(){
       axios.get('/api/employee')
       .then(({data})=>(this.employees=data))
       .catch()
     },

  },
  created(){
    this.allEmployee();
  },

  mounted() {
    console.log('Component mounted.')
  },
}
</script>
