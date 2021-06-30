<template>
  <div class="row justify-content-center">

    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="d-flex bd-highlight mb-3" >
        
       
       
                  <div class=" bd-highlight ">
                    <router-link to="/store-employee" class="btn btn-info btn-icon-split">
                          <span class="icon text-white-50">
                          <i class="fas fa-plus-circle"></i>
                          </span>
                          <span class="text">Geri</span>
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
                        <th>Isim</th>
                        <th>Ay</th>
                        <th>Maaş Tutarı</th>
                        <th>Tarih</th>
                        <th>Eylem</th>
                       
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filtersearch" :key="salary.id">
                        <td>{{salary.name}}</td>
                        <td>{{salary.salary_month}}</td>
                        <td>{{salary.amount}}</td>
                        <td>{{salary.salary_date}}</td>
                        <td>
                          <router-link :to="{name:'edit-salary', params:{id:salary.id}}"  class="btn btn-sm btn-primary">Duzenle</router-link>
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
      salaries:[],
      searchTerm: '',
    }
  },
  computed:{
    filtersearch(){
      return this.salaries.filter(salary =>{
        return salary.name.match(this.searchTerm)
      })
    }

  },
  methods:{
     viewSalary(){
      let id = this.$route.params.id
       axios.get('/api/salary/view/'+id)
         
         .then(({data}) => (this.salaries = data))
       .catch(error =>this.errors = error.response.data.errors)
     },
  },

  created(){
    this.viewSalary();
  },

  mounted() {
    console.log('Component mounted.')
  },
}
</script>
