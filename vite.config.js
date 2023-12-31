import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/asyncButton.js',
                'resources/js/bootstrap.js',
                'resources/js/calendar.js',
                'resources/js/ISOInput.js',
                'resources/js/chatBot.js',
            ],
            refresh: true,
        }),
    ],
});
