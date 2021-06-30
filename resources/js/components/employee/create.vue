<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card shadow-sm ">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Kişi ekle</h1>
                </div>
                <hr />
                <form
                  class="user"
                  @submit.prevent="employeeInsert"
                  enctype="multipart/form-data"
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
                          placeholder="Ad Soyad"
                          v-model="form.name"
                        />
                      
                      </div>
                      <div class="col-md-6">
                        <label>Telefon Numarası</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputEmail"
                          aria-describedby="emailHelp"
                          placeholder="Telefon Numarası"
                          v-model="form.phone"
                        />
                       
                      </div>
                    </div>
                  </div>
                  <!-- form group -->
                  <!-- form group -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Email</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Email"
                          v-model="form.email"
                        />
                        <small class="text-danger"></small>
                      </div>
                      <div class="col-md-6">
                        <label>Adres</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Adres"
                          v-model="form.adress"
                        />
                        <small class="text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Şifre</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Şifre"
                          v-model="form.password"
                        />
                        <small class="text-danger"></small>
                      </div>
                      <div class="col-md-6">
                        <label>TC Kimlik</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="TC Kimlik"
                          v-model="form.civilid"
                        />
                        <small class="text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Doğum Tarihi</label>
                        <input
                          type="date"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Doğum Tarihi"
                          v-model="form.bd"
                        />
                        <small class="text-danger"></small>
                      </div>
                      <div class="col-md-6">
                        <label>Meslek</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Meslek"
                          v-model="form.job"
                        />
                        <small class="text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <!-- profıl fotografı -->
                           <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
   <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">

       <label class="custom-file-label" for="customFile">Choose file</label>
            </div>


     <div class="col-md-6">
        <img :src="form.photo" style="height: 40px; width: 40px;">
      
            </div>     
            
          </div>
        </div>
                  <!-- form group -->
            

                <button type="submit" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                  </span>
                  <span class="text">Kaydet</span>
                </button>
                
                <router-link to="/employee" style="text-decoration-line: none;">
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
        name: null,
        phone: null,
        email: null,
        password: null,
        civilid: null,
        bd: null,
        job: null,
        photo:null,
      },
      errors: {}
    }
  },
  methods: {
     onFileSelected(event){
     let file = event.target.files[0];
     if (file.size > 1048770) {
      Notification.image_validation()
     }else{
      let reader = new FileReader();
      reader.onload = event =>{
        this.form.photo = event.target.result
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
     }

    },
    employeeInsert() {
      
      axios
        .post('api/employee', this.form)
        .then(() => {
          this.$router.push({ name: 'employee' })
          Notification.success()
        })
        .catch((error) => (this.errors = error.response.data.errors))
    },
  },
  mounted() {
    console.log('Component mounted.')
  },
}
</script>
