import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            server: {
                hmr: {
                    host: 'task-managment-production-b874.up.railway.app',
                },
            },
        }),
    ],
    base: '/',
});
