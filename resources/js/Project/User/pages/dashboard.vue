<template>
  <div>
    <h1 class="text-center">This is dashboard Vue Js 3</h1>
    <v-card class="mx-auto" max-width="auto">
      <v-card-text>
        <h3>I am Vuetify 3 component</h3>

        <div class="text--primary">
          relating to or dependent on charity; charitable.
          <br />"an eleemosynary educational institution."
        </div>
      </v-card-text>
      <v-card-actions>
        <v-btn variant="text" color="teal-accent-4" @click="reveal = true">Learn More</v-btn>
      </v-card-actions>

      <v-expand-transition>
        <v-card
          v-if="reveal"
          class="transition-fast-in-fast-out v-card--reveal"
          style="height: 100%;"
        >
          <v-card-text class="pb-0">
            <p class="text-h4 text--primary">Origin</p>
            <p>late 16th century (as a noun denoting a place where alms were distributed): from medieval Latin eleemosynarius, from late Latin eleemosyna ‘alms’, from Greek eleēmosunē ‘compassion’</p>
          </v-card-text>
          <v-card-actions class="pt-0">
            <v-btn variant="text" color="teal-accent-4" @click="reveal = false">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-expand-transition>
    </v-card>
  </div>
</template>

<script>
export default {
  data: () => ({
    reveal: false
  })
};
</script>


<style>
.v-card--reveal {
  bottom: 0;
  opacity: 1 !important;
  position: absolute;
  width: 100%;
}
</style>