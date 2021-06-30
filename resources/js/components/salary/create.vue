<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card shadow-sm ">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Maaş Ödeme</h1>
                </div>
                <hr />
                <form
                  class="user"
                  @submit.prevent="SalaryPaid"
                
                >
                  <!-- form group -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Kişi Adı Soyadı</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                         
                          v-model="form.name"
                        />
                      
                      </div>
                        <div class="col-md-6">
                        <label>Email</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                         
                          v-model="form.email"
                        />
                        <small class="text-danger"></small>
                      </div>
                     
                    </div>
                  </div>
                  <!-- form group -->
                  <!-- form group -->
                  <div class="form-group">
                    <div class="form-row">
                    <div class="col-md-6">
                        <label>Aylar</label>
                        <select
                          class="form-control"
                          id="exampleFormControlSelect1"
                          v-model="form.salary_month"
                        >
                          <option value="Ocak">Ocak</option>
                          <option value="Şubat">Şubat</option>
                          <option value="Mart">Mart</option>
                          <option value="Nisan">Nisan</option>
                          <option value="Mayıs">Mayıs</option>
                          <option value="Haziran">Haziran</option>
                          <option value="Temmuz">Temmuz</option>
                          <option value="Ağustos">Ağustos</option>
                          <option value="Eylül">Eylül</option>
                          <option value="Ekim">Ekim</option>
                          <option value="Kasım">Kasım</option>
                          <option value="Aralık">Aralık</option>
                         
                        </select>
                      </div>

                      <div class="col-md-6">
                        <label>Maaş</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          
                          v-model="form.civilid"
                        />
                        <small class="text-danger"></small>
                      </div>
                    </div>
                  </div>

                 
        
                  <!-- form group -->
            

                <button type="submit" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                  </span>
                  <span class="text">Öde</span>
                </button>
                
                <router-link to="/given-salary" style="text-decoration-line: none;">
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
  
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: '/' })
    }
  },

  data() {
    return {
      form: {
        name: '',
        email: '',
        salary_month: '',
        civilid: '',
     
      },
      errors: {}
    }
  },
  created() {
   let id =this.$route.params.id
   axios.get('/api/employee/'+id)
   .then(({data})=>(this.form=data))
   .catch(console.log('error'))
  },

  
  methods: {
    
    SalaryPaid(){
  	  let id = this.$route.params.id
       axios.post('/api/salary/paid/'+id,this.form)
       .then(() => {
        this.$router.push({ name: 'given-salary'})
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
