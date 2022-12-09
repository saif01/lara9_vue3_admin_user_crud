<template>
    <v-app>
       <router-view></router-view>
       <vue-progress-bar></vue-progress-bar>
    </v-app>
</template>

<script>
   
    export default {
        data() {
            return {
               
                
            }
        },
        methods: {
           
        },

        created() {

            this.$Progress.start();

            this.$confetti.start({
                particles: [{
                        type: 'heart',
                        colors: [
                            'red',
                            'pink',
                            'DodgerBlue',
                            'OliveDrab',
                            'SlateBlue',
                        ],
                    },
                    {
                        type: 'rect',
                        colors: [
                            '#ba0000',
                            'lightblue',
                            'PaleGreen'
                        ],
                    },
                ],
                defaultDropRate: 8,
                defaultSize: 8,
            });
            setTimeout(() => {
                this.$confetti.stop();
            }, 2500);

            this.$Progress.finish();
        }


    }
</script>

