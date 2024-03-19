import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import  path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/tailwind.css',
                'resources/css/app.css',
                'resources/css/main.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
            '~bootstrap': path.resolve(__dirname,"node_modules/bootstrap/dist")
        },
    },
});
