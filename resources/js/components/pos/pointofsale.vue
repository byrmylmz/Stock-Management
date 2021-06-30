<template>
  <div>
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">POS</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">POS</li>
        </ol>
      </div>

      <div class="row mb-3">
        <!-- Area Chart -->
      <div class="col-xl-5 col-lg-5 mb-5">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Sepet Eklenen Ürünler</h6>
                  <a class="m-0 float-right btn btn-info btn-sm" href="#">Müşteri Ekle <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive" >
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light" >
                      <tr >
                        <th>İsim</th>
                        <th>Miktar</th>
                        <th>Birim</th>
                        <th>Toplam</th>
                        <th>Eylem</th>
                      </tr>
                    </thead>
                    <tbody style="font-size:13px">
                      <tr v-for="card in cards" :key="card.id">
                        <td>{{card.pro_name}}</td>
                        <td>
                          <input type="text" readonly :value="card.pro_quantity" style="width:20px">
                          <button @click.prevent="increment(card.id)" class="class btn btn-success btn-sm">+</button>
                          <button v-if="card.pro_quantity >=2"  @click.prevent="decrement(card.id)" class="btn btn-danger btn-sm" >-</button>
                          <button v-else  @click.prevent="decrement(card.id)" class="btn btn-danger btn-sm" disabled>-</button>

                       </td>
                        <td>{{card.pro_price}}</td>
                        <td>{{card.sub_total}}</td>
                        <td><a @click="removeItem(card.id)" class="btn btn-sm btn-warning" style="color:white;">X</a></td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                      Toplam Adet:
                      <strong>{{qty}}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                      Tutar:
                      <strong>{{subtotal}} TL</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                      %18 KDV
                      <strong>{{vats.vat}} %</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                      Toplam Tutar
                      <strong>{{subtotal*vats.vat/100 +subtotal}} TL</strong>
                    </li>
                  </ul>
                  <br>

                  <!-- FORM SECTION FOR PAY -->
                  <form action="" @submit.prevent="orderdone">
                    <!-- acilir menu for customer -->
                    <div class="form-group">
                    <label for="customer name">Müşteri İsmi</label>   
                    <select name="" id="" class="form-control" v-model="customer_id">
                      <option  v-for="customer in customers" :key="customer.id" :value="customer.id">{{customer.name}}</option>
                     
                    </select>
                    </div>
                    <!-- ode -->
                    <div class="form-group">
                    <label for="pay">Ödeme</label>  
                    <input type="text" class="form-control" required v-model="pay">
                    </div>
                    <!-- vade input form -->
                    <div class="form-group">
                    <label for="pay">Vade</label>  
                    <input type="text" class="form-control" required v-model="due">
                    </div>
                      <!-- Odeme yontemi acilir menu -->
                      <div class="form-group">
                    <label for="Ödeme Yöntemi">Ödeme Yöntemi</label>   
                    <select name="" id="" class="form-control" v-model="payby">
                      <option value="HandCash" >Kapıda Ödeme</option>
                      <option value="Cheaque">Çek ile Ödeme</option>
                      <option value="GiftCard">Hediye Kartı ile Ödeme</option>
                    </select>
                    </div>
                    <br>
                    <!--submit button  -->
                    <button class="btn btn-success" type="submit">Gonder</button>
                  </form>


                </div>
              </div>
            </div>
        <!-- Pie Chart -->
        <div class="col-xl-7 col-lg-7">
          <div class="card mb-4">
            <div
              class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
            >
              <h6 class="m-0 font-weight-bold text-primary">Ürünler</h6>
            </div>
            <!-- TAB----------------------------->
            <ul class="nav nav-tabs m-2" id="myTab" role="tablist">
              <li class="nav-item mr-1" role="presentation"
              >
                <button
                  class="nav-link active"
                  id="home-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#home"
                  type="button"
                  role="tab"
                  aria-controls="home"
                  aria-selected="true"
                >
                  Bütün Ürünler
                </button>
              </li>
              <li class="nav-item mr-1" role="presentation" 
               v-for="category in categories"
               :key="category.id"
              >
                <a
                  class="nav-link"
                  id="profile-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#profile"
                  type="button"
                  role="tab"
                  aria-controls="profile"
                  aria-selected="false"
                  @click="subproduct(category.id)"
                >
                  {{category.category_name}}
                </a>
              </li>

            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                         <!-- CARD BODY -->
            <div class="card-body">
              <input
                type="text"
                placeholder="Arama yap."
                class="form-control mb-2"
                style="width: 300px;"
                v-model="searchTerm"
              />
              <!-- Product list in row -->
              <div class="row">
                <div
                  class="col-lg-3 col-md-3 col-sm-6 col-6"
                  v-for="product in filtersearch"
                  :key="product.id"
                >
                  <button @click.prevent="AddToCard(product.id)" class="btn btn-sm">
                    <div class="card mb-2" style="width: 12rem;">
                      <img :src="product.image" class="card-img-top p-2" />
                      <div class="card-body">
                        <p class="card-title">{{ product.product_name }}</p>
                      <!-- <p class="card-text">sdsd</p> -->
                        <span
                          v-if="product.product_quantity >= 1"
                          class="badge badge-success"
                        >
                          Stok Müsait {{ product.product_quantity }}
                        </span>
                        <span v-else class="badge badge-danger">
                          Stok Bitti
                        </span>
                        <br />
                      </div>
                    </div>
                  </button>
                </div>
              </div>
              <!-- Product list in row -->
            </div>
            <!-- CARD BODY -->

              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <!-- CARD BODY -->
                 <div class="card-body">
              <input
                type="text"
                placeholder="Arama yap."
                class="form-control mb-2"
                style="width: 300px;"
                v-model="getsearchTerm"
              />
              <!-- Product list in row -->
                <div class="row">
                <div
                  class="col-lg-3 col-md-3 col-sm-6 col-6"
                  v-for="getproduct in getfiltersearch"
                  :key="getproduct.id"
                >
                  <button @click.prevent="AddToCard(getproduct.id)" class="btn btn-sm">
                    <div class="card mb-2" style="width: 12rem;">
                      <img :src="getproduct.image" class="card-img-top p-2" />
                      <div class="card-body">
                        <h7 class="card-title">{{ getproduct.product_name }}</h7>
                        <!-- <p class="card-text"></p> -->
                        <br />
                        <span
                          v-if="getproduct.product_quantity >= 1"
                          class="badge badge-success"
                        >
                          Stok Müsait {{ getproduct.product_quantity }}
                        </span>
                        <span v-else class="badge badge-danger">
                          Stok Bitti
                        </span>
                        <br />
                      </div>
                    </div>
                  </button>
                </div>
              </div>
              <!-- Product list in row -->
            </div>
            <!-- CARD BODY -->



              </div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">


              </div>
            </div>
            
            <!-- TAB---------------------------------->

      
          </div>
        </div>
      </div>
      <!--Row-->
    </div>
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

  created() {
    this.allProduct();
    this.allCategory();
    this.allCustomer();
    this.cardProduct();
    this.vat();
    Reload.$on('AfterAdd',()=>{
      this.cardProduct();
    })
    
  },

  data() {
    return {
      customer_id:'',
      pay:'',
      due:'',
      payby:'',
      products:[],
      getproducts: [],
      categories:[],
      searchTerm: '',
      getsearchTerm: '',
      customers:[],
      errors:'',
      cards:[],
      vats:'',
    }
  },

  computed: {
    filtersearch() {
      return this.products.filter((product) => {
        return product.name.match(this.searchTerm)
      })
    },
    getfiltersearch() {
      return this.getproducts.filter((getproduct) => {
        return getproduct.product_name.match(this.getsearchTerm)
      })
    },
    qty(){
      let sum=0;
      for(let i=0; i<this.cards.length; i++){
        sum +=(parseFloat(this.cards[i].pro_quantity));
      }
      return sum;
    },
    subtotal(){
      let sum=0;
      for(let i=0; i<this.cards.length; i++){
        sum +=(parseFloat(this.cards[i].sub_total));
      }
      return sum;

    },
  },

  //-------------------------------METHODS--------------------------
  methods: {
    //card methods here
    AddToCard(id){
      axios
        .get('/api/addToCard/'+id)
        .then(() => {
          Reload.$emit('AfterAdd');
          Notification.card_success()
        })
        .catch()
    },

    cardProduct(){
      axios
       .get('/api/card/product')
        .then(({ data }) => (this.cards = data))
        .catch()

    },

    removeItem(id){
       axios
        .get('/api/remove/card/'+id)
        .then(() => {
          Reload.$emit('AfterAdd');
          Notification.card_delete()
        })
        .catch()

    },
     increment(id){
        axios
        .get('/api/increment/'+id)
        .then(() => {
          Reload.$emit('AfterAdd');
          Notification.success()
        })
        .catch()
       

     },
     decrement(id){
        axios
        .get('/api/decrement/'+id)
        .then(() => {
          Reload.$emit('AfterAdd');
          Notification.success()
        })
        .catch()


     },
      vat(){
        axios
         .get('/api/vats/')
        .then(({ data }) => (this.vats = data))
        .catch()

      },

      orderdone(){
       let total=this.subtotal*this.vats.vat/100 + this.subtotal;
       var data={qty:this.qty,
                 sub_total:this.subtotal,
                 customer_id:this.customer_id,
                 payby:this.payby,
                 pay:this.pay,
                 due:this.due,
                 vat:this.vats.vat, 
                 total:total,}

        axios.post('/api/orderdone',data)
        .then(()=>{
          Notification.success()
         this.$router.push({name:'home'})
        })
        .catch(error=>this.errors=error.response.data.errors)
      },

    //card methods here

    allProduct() {
      axios
        .get('/api/product')
        .then(({ data }) => (this.products = data))
        .catch()
    },
    allCategory() {
      axios
        .get('/api/category')
        .then(({ data }) => (this.categories = data))
        .catch()
    },
      allCustomer() {
      axios
        .get('/api/customer')
        .then(({ data }) => (this.customers = data))
        .catch(console.log('error'))
    },
    subproduct(id) {
      axios
        .get('/api/getting/product/'+id)
        .then(({ data }) => (this.getproducts = data))
        .catch()
    },
  },
  

  mounted() {
    console.log('Component mounted.')
  },
}
</script>
