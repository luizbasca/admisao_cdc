import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/pages/funcionarios.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Permite acesso externo
        port: 5173,
        hmr: {
            host: '192.168.4.100', // Substitua pelo IP do seu servidor VPN se necessário
            port: 5173,
        },
        watch: {
            usePolling: true, // Necessário para ambientes Docker/VPN
        }
    },
    assetsInclude: ['**/*.woff', '**/*.woff2', '**/*.ttf', '**/*.eot']
});