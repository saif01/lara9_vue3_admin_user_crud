<template>
  <v-app>
    <sidebar />
    <router-view></router-view>
  </v-app>
</template>

<script>
import sidebar from "./pages/common/sidebar.vue";
import footer from "./pages/common/footer.vue";
import Form from "vform";
export default {
  components: {
    sidebar,
    "page-footer": footer
  },

  data() {
    return {
      showModal: true,
      editmode: false,
      currentUrl: "/store",
      allData: "",
      form: new Form({
        name: "",
        email: "",
        image: ""
      })
    };
  },

  methods: {
    createData() {
      this.form.post(this.currentUrl + "/store").then(response => {
        console.log(this.reponse.data);
      });
    },

    updateData() {},

    getData() {
      axios.get(this.currentUrl + "/index").then(response => {
        this.allData = response.data;
      });
    }
  },

  created() {
    //this.getData();
  }
};
</script>