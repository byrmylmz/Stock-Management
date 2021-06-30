<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card shadow-sm ">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Tedarikçi Ekle</h1>
                </div>
                <hr />
                <form
                  class="user"
                  @submit.prevent="supplierInsert()"
                  enctype="multipart/form-data"
                >
                  <!-- form group -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label> Tedarikçi Adı</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Tedarikçi Adı"
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
                        <label>Yetkili</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Yetkili Kişi"
                          v-model="form.authority"
                        />
                        <small class="text-danger"></small>
                      </div>
                      <div class="col-md-6">
                        <label>Şehir</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Şehir"
                          v-model="form.city"
                        />
                        <small class="text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>İlçe</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="İlçe"
                          v-model="form.district"
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
                  <!-- iban ve bakiye -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>IBAN</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="IBAN"
                          v-model="form.iban"
                        />
                        <small class="text-danger"></small>
                      </div>
                      <div class="col-md-6">
                        <label>Bakiye</label>
                        <input
                          type="text"
                          
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Bakiye"
                          v-model="form.balance"
                        />
                        <small class="text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <!-- iban ve bakiye -->
                  <!-- bakiye tipi ve due date -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Bakiye Tipi</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Bakiye Tipi"
                          v-model="form.balance_type"
                        />
                        <small class="text-danger"></small>
                      </div>
                      <div class="col-md-6">
                        <label>Son Ödeme Tarihi</label>
                        <input
                          type="date"
                          class="form-control"
                          id="exampleInputFirstName"
                          placeholder="Son Ödeme Tarihi"
                          v-model="form.due_date"
                        />
                        <small class="text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <!-- bakiye tipi ve due date -->
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
export default{
  created(){
    if(!User.loggedIn()){
      this.$router.push({name: '/'})
    }
  },
  data(){
    return{
      form:{
        name:null,
        phone:null,
        authority:null,
        city:null,
        district:null,
        adress:null,
        iban:null,
        balance:null,
        balance_type:null,
        due_date:null,
        photo:null,
      },
      errors:{}
    }
  },

  
  methods:{
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
    supplierInsert(){
      axios.post('api/supplier',this.form)
      .then(()=>{
        this.$router.push({name:'supplier'})
        Notification.success()
      })
      .catch((error)=>(this.errors=error.response.data.errors))
    }
  },
  mounted(){
    console.log('component yuklendi...')
  },
}
</script>
