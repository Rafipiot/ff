import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        devSourcemap: false,
        preprocessorOptions: {
            scss: {
                quietDeps: true,
                verbose: false,
            },
        },
    },
    build: {
        rollupOptions: {
            onwarn(warning, warn) {
                // Suppress deprecation warnings from Bootstrap
                if (warning.code === 'DEPRECATED_FEATURE') {
                    return;
                }
                warn(warning);
            }
        }
    }
});
