<template>
  <v-app>
    <sidebar />
    <router-view></router-view>
  </v-app>
</template>

<script>
import sidebar from "./pages/common/sidebar.vue";
export default {
  components: { sidebar },
  data() {}
};
</script>