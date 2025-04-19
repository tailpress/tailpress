import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        manifest: true,
        outDir: 'dist',
        rollupOptions: {
            input: ['resources/js/app.js', 'resources/css/app.css'],
        },
    },
    server: {
        port: 3000,
        cors: true,
        origin: 'http://tailpress.test'
    }
});
