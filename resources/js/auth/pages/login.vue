<template>
  <div>
    <div v-if="announce" class="login_view bg-dark">
      <div id="particle-container">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
      </div>
      <div class="col-lg-5 col-md-8 col-12 div_center">
        <v-form>
          <v-card class="pb-4">
            <v-card-title class="justify-center">
              <v-avatar size="40">
                <img src="/all-assets/common/logo/cpb/axons.png" alt="CPB-IT" />
              </v-avatar>
              <span class="mx-3">CPB-IT Portal</span>
              <v-avatar size="40">
                <img src="/all-assets/common/logo/cpb/cpbit.png" alt="CPB-IT" />
              </v-avatar>
            </v-card-title>
            <v-card-text>
              <!-- Error -->
              <v-alert v-if="error" shaped prominent type="error" dismissible>{{ errorMsg }}</v-alert>

              <form @submit.prevent="login()">
                <v-text-field
                  type="text"
                  label="Login ID"
                  :rules="[v => !!v || 'Login ID is required!']"
                  v-model="form.login"
                  prepend-icon="mdi-account-alert-outline"
                  required
                ></v-text-field>
                <div v-if="form.errors.has('login')" v-html="form.errors.get('login')" />

                <v-text-field
                  :type="passwordType ?'text': 'password'"
                  :append-icon="passwordType ?'mdi-eye':'mdi-eye-remove'"
                  @click:append="passwordType=!passwordType"
                  label="Password"
                  :rules="[v => !!v || 'Password is required!']"
                  v-model="form.password"
                  prepend-icon="mdi-lock-alert-outline"
                  required
                ></v-text-field>
                <div v-if="form.errors.has('password')" v-html="form.errors.get('password')" />

                <v-btn
                  block
                  depressed
                  class="light-blue darken-4 text-white"
                  :loading="loading"
                  type="submit"
                >
                  Login
                  <v-icon right>mdi-login</v-icon>
                </v-btn>
              </form>
            </v-card-text>

            <v-row>
              <div class="col-lg-6 col-md-12 text-center text-lg-start">
                <div class="px-2">
                  <router-link :to="{ name: 'Register' }" class="text_color">Register ?</router-link>
                  <v-btn
                    x-small
                    @click="viewManual('Register_Manual.pdf')"
                    :loading="pdfReadyLoading"
                    class="text-capitalize"
                  >
                    Manual
                    <v-icon right>mdi-eye</v-icon>
                  </v-btn>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 text-center text-lg-end">
                <div class="px-2">
                  <a
                    href="https://bdwacenter.cpbangladesh.com/RDWeb/Pages/en-US/password.aspx"
                    target="_blank"
                  >Password Expire ?</a>
                  <v-btn
                    x-small
                    @click="viewManual('Change_Password.pdf')"
                    :loading="pdfReadyLoading"
                    class="text-capitalize"
                  >
                    Manual
                    <v-icon right>mdi-eye</v-icon>
                  </v-btn>
                </div>
              </div>
            </v-row>

            <!-- <div class="text-center">
              

             
            </div>-->
          </v-card>
        </v-form>
      </div>

      <div class="col-lg-4 col-md-8 col-12" v-if="announcementMessage.length">
        <div class="section_title h3 mb-2">Announcement</div>
        <!-- <div v-for="data in announcementMessage" :key="data.id"> -->
        <div class="notice_box">
          <v-card class="notice_card mb-3" v-for="data in announcementMessage" :key="data.id">
            <v-card-text class="card_text">
              <div class="d-flex align-items-center">
                <div>
                  <div
                    class="d-flex flex-column justify-content-center align-items-center pa-1 bg-primary text-white rounded"
                  >
                    <div>{{ data.created_at | moment("DD")}}</div>
                    <div>{{ data.created_at | moment("MMMM")}}</div>
                  </div>
                </div>
                <div class="ml-2">
                  <div class="message_color">{{ data.message }}</div>
                </div>
              </div>
            </v-card-text>
          </v-card>
        </div>
        <!-- </div> -->
      </div>
    </div>

    <!-- Welcome Message -->
    <!-- <div v-else class="d-flex justify-content-center align-items-center h-100 w-100">
            <div>
                <v-img src="/all-assets/common/announce.gif" height="200" width="200" class="mx-auto"></v-img>
                <h1 class="announce_text">Welcome, To our new system</h1>
            </div>
    </div>-->

    <!-- viewDocumentDialog -->
    <v-dialog v-model="viewDocument" width="100%" height="100vh" class="pdf_manual">
      <v-card height="100vh">
        <vue-pdf-app :file="pdf" />
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
// vform
import Form from "vform";
import VuePdfApp from "./pdfViewApp.vue";

export default {
  components: {
    "vue-pdf-app": VuePdfApp
  },

  data() {
    return {
      announce: true,

      passwordType: false,
      loading: false,
      password: null,

      error: false,
      errorMsg: "",

      viewDocument: false,
      pdfReadyLoading: false,
      pdf: "",

      // Form
      form: new Form({
        login: "",
        password: ""
      }),

      announcementMessage: ""
    };
  },
  methods: {
    // Login
    login() {
      this.loading = true;
      this.form
        .post("/login_action")
        .then(response => {
          console.log(response.data);

          let resData = response.data;

          // Error
          if (resData.status == "error") {
            console.log(resData);
            this.error = true;
            this.errorMsg = resData.msg;
          }

          // Success
          if (resData.status == "success") {
            console.log(resData);
            this.error = false;

            // redirect with reload
            window.location.href = "/";
          }

          this.loading = false;
        })
        .catch(error => {
          this.loading = false;

          console.log(error);
        });
    },

    //register
    register() {
      //redirect
      window.location.href = "/register";
    },

    // PDF
    base64ToArrayBuffer(base64) {
      var binary_string = window.atob(base64);
      var len = binary_string.length;
      var bytes = new Uint8Array(len);
      for (var i = 0; i < len; i++) {
        bytes[i] = binary_string.charCodeAt(i);
      }
      this.pdf = bytes.buffer;
      this.pdfReadyLoading = false;
      this.viewDocument = true;
      return bytes.buffer;
    },

    // PDF
    viewManual(nameVal) {
      this.pdfReadyLoading = true;
      axios
        .get("/user-manuals?name=" + nameVal)
        .then(res => {
          this.base64ToArrayBuffer(res.data);
        })
        .catch(error => {
          this.pdfReadyLoading = false;
          console.error(error);
        });
    },

    // announcement
    announcement() {
      axios.get("/super-announcement/announcement").then(response => {
        // console.log(response.data);
        this.announcementMessage = response.data;
      });
    }
  },

  created() {
    this.announcement();
  }
};
</script>



<style scoped lang="scss">
.login_view {
  position: relative;
  width: 100vw;
  height: 100vh;
}

.div_center {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 7777;
}

.cpb_logo {
  height: 50px;
  // position: absolute;
  // top: 50%;
  // left: 50%;
  // transform: translate(-50%, -50%);
  // z-index: -1;
  // opacity: 0.1;
}

.usericon {
  height: 22px;
  width: 22px;
  fill: #555;
}

.passicon {
  height: 22px;
  width: 22px;
  fill: #555;
}

.input_password:focus,
.input_id:focus {
  border-color: #ddd;
  box-shadow: none;
  outline: none;
}

.input-group-text {
  border-radius: 8px;
}

.input_id,
.input_password {
  padding-left: 0.5rem;
  border-left: none;
  border-radius: 8px;
  background-color: transparent;
}

.input_password {
  border-right: none !important;
}

.register {
  cursor: pointer;
}

/* animation */
.particle {
  position: absolute;
  border-radius: 50%;
}

@for $i from 1 through 30 {
  @keyframes particle-animation-#{$i} {
    100% {
      transform: translate3d(
        (random(90) * 1vw),
        (random(90) * 1vh),
        (random(100) * 20px)
      );
    }
  }

  .particle:nth-child(#{$i}) {
    animation: particle-animation-#{$i} 60s infinite;
    $size: random(5) + 5 + px;
    opacity: random(100) / 100;
    height: $size;
    width: $size;
    animation-delay: -$i * 0.2s;
    transform: translate3d(
      (random(90) * 1vw),
      (random(90) * 1vh),
      (random(100) * 1px)
    );
    background: hsl(random(360), 70%, 50%);
  }
}

.announce_text {
  font-family: Satisfy, cursive;
  font-size: 5em;
  color: SandyBrown;
  text-shadow: 0.02em 0.02em 0 Brown, 0 0 0.5em violet;
}

.pdf_manual {
  position: absolute;
  z-index: 9999;
}

// notice
.section_title {
  border-bottom: 3px solid #2196f3;
  margin: 0px 0;
  width: fit-content;
  color: #2196f3;
}

.card_text {
  padding: 6px;
}

.message_color {
  color: #2e4166;
}

.notice_card:hover {
  box-shadow: 0px 0px 5px 1px rgba(148, 148, 148, 0.3);
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

.notice_card:hover .message_color {
  color: #0072bc;
}

.notice_box {
  height: 200px;
  overflow: auto;
}
</style>
