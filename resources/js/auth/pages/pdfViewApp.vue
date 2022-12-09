<template>
    <div>
        <vue-pdf-app style="height: 100vh;" :pdf="file" :config="config" isSidebarHidden="false"></vue-pdf-app>
    </div>
</template>

<script>
import VuePdfApp from "vue-pdf-app";
import "vue-pdf-app/dist/icons/main.css";

export default {
    components: {
        VuePdfApp
    },

    props: ['file'],

    data() {
        return {
            config: {
                toolbar: {
                    toolbarViewerLeft: { findbar: false }
                }
            },
        };
    },
};
</script>

