<template lang="">
  <div>
    <!-- Container Fluid-->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </div>

    <div class="row mb-3">
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">
                 BUGÜNKİ SATIŞ
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                 {{todaysell}} ₺
                </div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-success mr-2">
                    <i class="fa fa-arrow-up"></i>
                    3.48%
                  </span>
                  <span>Since last month</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Annual) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">
                    BUGÜNKİ KAZANÇ
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{income}} ₺</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-success mr-2">
                    <i class="fas fa-arrow-up"></i>
                    12%
                  </span>
                  <span>Since last years</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-shopping-cart fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- New User Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">
                  Vadesi Gelen Ödemeler
                </div>
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                  {{due}}
                </div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-success mr-2">
                    <i class="fas fa-arrow-up"></i>
                    20.4%
                  </span>
                  <span>Since last month</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">
                  BUGüNKİ HARCAMALAR
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{expense}}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-danger mr-2">
                    <i class="fas fa-arrow-down"></i>
                    1.10%
                  </span>
                  <span>Since yesterday</span>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-comments fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


    
          
    
  
    </div>
    <!--Row-->
<!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Stoğu Biten Ürünler</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>İsim</th>
                        <th>Kod</th>
                        <th>Fotoğraf</th>
                        <th>Kategori</th>
                        <th>Satın Alma Fiyatı</th>
                        <th>Stok Durumu</th>
                        <th>Miktar</th>
                        <th>Eylem</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in products" :key="product.id">
                        <td>{{product.product_name}}</td>
                        <td>{{product.product_code}}</td>
                        <td><img :src="product.image" style="width:30px; height:30px;"></td>
                        <td>{{product.category_name}}</td>
                        <td>{{product.buying_price}}</td>
                        <td v-if="product.product_quantity >=1"> <span class="badge badge-success">Stok Müsait</span></td>
                        <td v-else> <span class="badge badge-danger">Stok Bitti</span></td>
                        <td>{{product.product_quantity}}</td>
                        <td>
                          <router-link :to="{name:'edit-stock', params:{id:product.id}}"  class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></router-link>
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
    <!---Container Fluid-->
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
      todaysell:'',
      income:'',
      due:'',
      expense:'',
      products:''

    }

  },

  mounted(){
    this.TodaySell();
    this.TodayIncome();
    this.TodayDue();
    this.TodayExpense();
    this.Stockout();


  },

  methods:{
    TodaySell(){
      axios.get('/api/today/sell')
      .then(({data})=>(this.todaysell=data))
      .catch()
    },
    TodayIncome(){
      axios.get('/api/today/income')
      .then(({data})=>(this.income=data))
      .catch()
    },
    TodayDue(){
      axios.get('/api/today/due')
      .then(({data})=>(this.due=data))
      .catch()
    },
    TodayExpense(){
      axios.get('/api/today/expense')
      .then(({data})=>(this.expense=data))
      .catch()
    },
    Stockout(){
      axios.get('/api/today/stockout')
      .then(({data})=>(this.products=data))
      .catch()
    },

  }
}
</script>
 
