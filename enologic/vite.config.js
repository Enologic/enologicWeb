import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss', //Bootstrap
                'resources/css/app.css', // Debe estar vacio para que lo compile SASS
                'resources/css/custom.scss', 
                'resources/css/custom.css', 
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
