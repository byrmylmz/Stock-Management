<template>
  <div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card shadow-sm ">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Kategori Ekle</h1>
                </div>
                <hr />
                <form
                  class="user"
                  @submit.prevent="searchDate"
                  enctype="multipart/form-data"
                >
                  <!-- form group -->
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                        <label>Tarihe Göre Arama Yap</label>
                        <input
                          type="date"
                          class="form-control"
                          id="exampleInputFirstName"
                          v-model="date"
                          required
                        />
                      
                      </div>

                    </div>
                  </div>
                  <!-- form group -->
                 
            

                <button type="submit" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                  </span>
                  <span class="text">Arama Yap</span>
                </button>
                <router-link to="/category" style="text-decoration-line: none;">
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

       <!-- ROW 2------------------- -->
            <div class="row ">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Siparişin İçerdiği Ürünler</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Ürün İsmi</th>
                        <th>Miktar</th>
                        <th>SubTotal</th>
                        <th>Vat</th>
                        <th>Total</th>
                        <th>Pay</th>
                        <th>Due</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in orders" :key="order.id">
                        <td>{{order.name}}</td>
                        <td>{{order.qty}}</td>
                        <td>{{order.sub_total}} </td>
                        <td>{{order.vat}}</td>
                        <td>{{order.total}}</td>
                        <td>{{order.pay}}</td>
                        <td>{{order.due}}</td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
           <!-- ROW 2------------------- -->
      
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
        date:'',
        orders:{}
  
    }
  },
  methods: {
     
 
    searchDate() {
     var data={date:this.date}
      axios.post('api/search/order', data)
            .then(({data})=>(this.orders=data))
           .catch((error) => (this.errors = error.response.data.errors))
    },
  },
  
  mounted() {
    console.log('Component mounted.')
  },
}
</script>
