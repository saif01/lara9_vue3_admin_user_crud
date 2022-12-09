<template>
  <div>
    <router-link :to="{name:'Dashboard'}">Home</router-link>
    <br />
    <router-link :to="{name:'About'}">About</router-link>
    <br />
  </div>
</template>

<script>
export default {
  data() {
    return {
      drawer: null
    };
  }
};
</script>



