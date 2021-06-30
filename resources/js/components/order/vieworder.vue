<template>
 
              <!-- TABLE FOR -------------------------------------------------- -->
              <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SİPARİŞ DETAYLARI</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">SİPARİŞ DETAYLARI</li>
            </ol>
          </div>
           <!-- ROW 1------------------- -->
   <div class="row">
            <div class="col-lg-6 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">SİPARİŞ DETAYLARI</h6>
                </div>
                <div class="table-responsive">
                 <ul class="list-group m-2">
                  <li class="list-group-item"><b>İsim : </b>{{orders.name}}</li>
                  <li class="list-group-item"><b>Telefon : </b>{{orders.phone}}</li>
                  <li class="list-group-item"><b>Adres : </b>{{orders.adress}}</li>
                  <li class="list-group-item"><b>Tarih : </b>{{orders.order_date}}</li>
                  <li class="list-group-item"><b>Ödeme Şekli : </b>{{orders.payby}}</li>
                </ul>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
            <!--SIDE ROW********************************************************** -->
              <div class="col-lg-6 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">SİPRARİŞ DETAYLARI</h6>
                </div>
                <div class="table-responsive">
                <ul class="list-group m-2">
                  <li class="list-group-item"><b>Ara Toplam : </b>{{orders.sub_total}} ₺</li>
                  <li class="list-group-item"><b>KDV : </b> %{{orders.vat}}</li>
                  <li class="list-group-item"><b>Toplam : </b>{{orders.total}} ₺ </li>
                  <li class="list-group-item"><b>Toplam Tutar : </b>{{orders.pay}} ₺</li>
                  <li class="list-group-item"><b>Ödeme Süresi : </b>{{orders.due}}</li>
                </ul>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
            <!--SIDE ROW********************************************************** -->


          </div>
           <!-- ROW 1------------------- -->
           <!-- ROW 2------------------- -->
            <div class="row">
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
                        <th>Ürün Kodu</th>
                        <th>Resim</th>
                        <th>Miktar</th>
                        <th>Birim Fiyat</th>
                        <th>Toplam Tutar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="detail in details" :key="detail.id">
                        <td>{{detail.product_name}}</td>
                        <td>{{detail.product_code}}</td>
                        <td><img :src="'/'+ detail.image" style="width:40px; height:40px;"> </td>
                        <td>{{detail.pro_quantity}}</td>
                        <td>{{detail.product_price}} ₺</td>
                        <td>{{detail.sub_total}} ₺</td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
           <!-- ROW 2------------------- -->
         
          <!--Row-->
        </div>
              <!-- TABLE FOR -------------------------------------------------- -->
   
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

      errors: {},
      orders:{},
      details:{},
    }
  },
  created() {
   let id =this.$route.params.id
   //console.log(this.$route)
   axios.get('/api/order/details/'+id)
   .then(({data})=>(this.orders=data))
   .catch(console.log('error'))

   axios.get('/api/order/orderdetails/'+id)
   .then(({data})=>(this.details=data))
   .catch(console.log('error'))
  },

  
  methods: {

  
  },

  mounted() {
    console.log('Component mounted.')
  },
}
</script>
