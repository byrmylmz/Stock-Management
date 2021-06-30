<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card shadow-sm ">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Müşteri ekle</h1>
                </div>
                <hr />
                <form
                  class="user"
                  @submit.prevent="customerInsert"
                  enctype="multipart/form-data"
                >
                  <!-- form group -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Müşteri Adı Soyadı</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          
                          v-model="form.name"
                        />
                      </div>
                      <div class="col-md-6">
                        <label>Müşteri Email</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputEmail"
                          aria-describedby="emailHelp"
                          v-model="form.email"
                        />
                      </div>
                    </div>
                  </div>
                  <!-- form group -->
                  <!-- form group -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Müşteri Adresi</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          v-model="form.adress"
                        />
                      </div>
                      <div class="col-md-6">
                        <label>Müşteri Telefon Numarasi</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          v-model="form.phone"
                        />
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
        email: null,
        adress: null,
        phone: null,
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
    customerInsert() {

      axios
        .post('api/customer', this.form)
        .then(() => {
          this.$router.push({ name: 'customer' })
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
