import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/images/image_ee43ecbd.svg',
                'resources/images/image_ee43ecbd.png',
                'resources/images/Bhumi_Ageung_Talaga.png',
                'resources/images/museumtalagamanggung.png',
                'resources/images/stog.png',
                'resources/images/webicon.png',
                'resources/images/facebook.svg',
                'resources/images/youtube.svg',
            ],
            refresh: true,
        }),
    ],
});
