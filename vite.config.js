import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/css/search.css',
        'resources/js/app.js',
        'resources/js/slider.js',
        'resources/js/search.js',
        'resources/js/cropper.js',
      ],
      refresh: true,
    }),
  ],
});
