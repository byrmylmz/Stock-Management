<template>
  <div class="container" >
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Forget Password</h1>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input
                        type="email"
                        class="form-control"
                        id="exampleInputEmail"
                        aria-describedby="emailHelp"
                        placeholder="Extisting Email Adress"
                      />
                    </div>

                    <div class="form-group">
                      <a href="index.html" class="btn btn-primary btn-block">
                        Send Email
                      </a>
                    </div>
                  </form>
                  <hr />
                  <div class="text-center">
                    <router-link to="/">
                      <p class="font-weight-bold small">Back to Login!</p>
                    </router-link>
                  </div>
                  <div class="text-center"></div>
                </div>
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
  created(){
    if(User.loggedIn()){
      this.$router.push({name:'home'})
    }
  },
  mounted() {
    console.log('Component mounted.')
  },
}
</script>
