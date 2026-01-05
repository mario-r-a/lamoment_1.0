import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',  // Tailwind CSS (untuk admin/auth pages)
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        // JANGAN timpa public/css/style.css
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    // Build Tailwind CSS ke public/build/, BUKAN public/css/
                    if (assetInfo.name === 'app.css') {
                        return 'assets/[name]-[hash][extname]';
                    }
                    return 'assets/[name]-[hash][extname]';
                }
            }
        }
    }
});
