<template>
  <div class="row justify-content-center">

    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="d-flex bd-highlight mb-3" >
        
       
       
                  <div class=" bd-highlight ">
                    <router-link to="/store-category" class="btn btn-info btn-icon-split">
                          <span class="icon text-white-50">
                          <i class="fas fa-plus-circle"></i>
                          </span>
                          <span class="text">Yeni Kategori Ekle</span>
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
                  <h6 class="m-0 font-weight-bold text-primary">Kategori Listesi</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Kategori İsmi</th>
                        
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="category in filtersearch" :key="category.id">
                        <td>{{category.category_name}}</td>
                       
                        <td>
                          <router-link :to="{name:'edit-category', params:{id:category.id}}"  class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></router-link>
                          <a  @click="deleteCategory(category.id)" class="btn btn-sm btn-danger" style="margin-left:5px; color:white;"><i class="fas fa-trash"></i></a></td>
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
      categories:[],
      searchTerm: '',
    }
  },
  computed:{
    filtersearch(){
      return this.categories.filter(category =>{
        return category.category_name.match(this.searchTerm)
      })
    }

  },
  methods:{
     allCategory(){
       axios.get('/api/category')
       .then(({data})=>(this.categories=data))
       .catch()
     },
     deleteCategory(id){
             Swal.fire({
              title: 'Silmek isteğinizden Emin misiniz?',
              text: "Bu işlem geri Alınamaz!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Kabul ediyorum!'
            }).then((result) => {
              if (result.value) {
                axios.delete('/api/category/'+id)
               .then(() => {
                this.categories = this.categories.filter(category => {
                  return category.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'category'})
               })
              
              }
            })


     }
  },
  created(){
    this.allCategory();
  },

  mounted() {
    console.log('Component mounted.')
  },
}
</script>
