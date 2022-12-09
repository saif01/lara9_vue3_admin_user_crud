import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel([
            './resources/js/Project/User/js/app.js',
            './resources/js/Project/Admin/js/app.js',
            // './resources/js/auth/js/app.js'
            // refresh: true,
        ]),
    ],
});


// export default defineConfig({
//     plugins: [vue()],
//     build: {
//         rollupOptions: {
//             input: [
//                 './resources/js/Project/User/js/app.js',
//                 './resources/js/Project/Admin/js/app.js',


//             ],
//         },
//     },
// })
