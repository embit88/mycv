export default {
    build: {
        rollupOptions: {
            input: [
                'app/resources/assets/client/default_theme/css/app.css',
                'app/resources/assets/client/default_theme/js/app.js',

                'app/resources/assets/admin/css/app.css',
                'app/resources/assets/admin/js/app.js',
            ],
        },
        manifest: 'assets/manifest.json',
        minify: true,
        outDir: "build",
    },
    root: 'public'
}