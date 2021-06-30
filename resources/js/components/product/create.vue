<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card shadow-sm">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Ürün Ekle</h1>
                </div>
                <hr />
                <form
                  class="user"
                  @submit.prevent="productInsert"
                  enctype="multipart/form-data"
                >
                  <!-- form group -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Ürün Adı</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          v-model="form.product_name"
                        />
                      </div>
                      <div class="col-md-6">
                        <label>Ürün Kodu</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputEmail"
                          aria-describedby="emailHelp"
                          v-model="form.product_code"
                        />
                      </div>
                    </div>
                  </div>
                  <!-- form group -->
                  <!-- category and supplier -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Ürün Kategorisi</label>
                        <select
                          class="form-control"
                          id="exampleFormControlSelect1"
                          v-model="form.category_id"
                        >
                          <option :value="category.id" v-for="category in categories">{{category.category_name}}</option>
                         
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label>Ürün Tedarikçisi</label>
                        <select
                          class="form-control"
                          id="exampleFormControlSelect1"
                          v-model="form.supplier_id"
                        >
                        <option :value="supplier.id" v-for="supplier in suppliers">{{supplier.name}}</option>

                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- category and supplier -->
                  <!-- root byıng prıce and sellıng prıce -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-4">
                        <label>Ürün Root</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          v-model="form.root"
                        />
                        <small class="text-danger"></small>
                      </div>
                      <div class="col-md-4">
                        <label>Satın Alma Fiyatı</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          v-model="form.buying_price"
                        />
                        <small class="text-danger"></small>
                      </div>
                      <div class="col-md-4">
                        <label>Satış Fiyatı</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          v-model="form.selling_price"
                        />
                        <small class="text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <!-- root byıng prıce and sellıng prıce -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Satın Alma Tarhihi</label>
                        <input
                          type="date"
                          class="form-control"
                          id="exampleInputFirstName"
                          v-model="form.buying_date"
                        />
                        <small class="text-danger"></small>
                      </div>
                      <div class="col-md-6">
                        <label>Ürün Miktarı</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputFirstName"
                          v-model="form.product_quantity"
                        />
                        <small class="text-danger"></small>
                      </div>
                    </div>
                  </div>
                  <!-- profıl fotografı -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <input
                          type="file"
                          class="custom-file-input"
                          id="customFile"
                          @change="onFileSelected"
                        />
                        <label class="custom-file-label" for="customFile">
                          Choose file
                        </label>
                      </div>

                      <div class="col-md-6">
                        <img
                          :src="form.image"
                          style="height: 40px; width: 40px;"
                        />
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

                  <router-link
                    to="/product"
                    style="text-decoration-line: none;"
                  >
                    <button
                      type="submit"
                      class="btn btn-warning btn-icon-split"
                    >
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
        product_name: null,
        product_code: null,
        category_id: null,
        supplier_id: null,
        root: null,
        buying_price: null,
        selling_price: null,
        buying_date: null,
        image: null,
        product_quantity: null,
      },
      errors: {},
      categories: {},
      suppliers: {},
    }
  },
  methods: {
    onFileSelected(event) {
      let file = event.target.files[0]
      if (file.size > 1048770) {
        Notification.image_validation()
      } else {
        let reader = new FileReader()
        reader.onload = (event) => {
          this.form.image = event.target.result
          console.log(event.target.result)
        }
        reader.readAsDataURL(file)
      }
    },

    productInsert() {
      axios
        .post('api/product', this.form)
        .then(() => {
          this.$router.push({ name: 'product' })
          Notification.success()
        })
        .catch((error) => (this.errors = error.response.data.errors))
    },
  },

  created() {
      axios.get('/api/category/')
      .then(({data})=>(this.categories=data))
      
      axios.get('/api/supplier/')
      .then(({data})=>(this.suppliers=data))

  },
}
</script>
