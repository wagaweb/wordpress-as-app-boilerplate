var settings = {
    plugin: {
        slug: 'your-plugin',
        cwd: "wp-content/plugins/your-plugin"
    },
    theme: {
        slug: 'your-theme',
        cwd: "wp-content/themes/your-theme"
    },
    default_paths: {
        build: [ "**/*", "!.*" , "!Gruntfile.js", "!gulpfile.js" , "!gulpfile.config.js" , "!gulpfile.config-sample.js", "!package.json", "!bower.json", "!Movefile", "!Movefile-sample", "!assets/cache/**", "!{builds,builds/**}", "!{node_modules,node_modules/**}", "!{bower_components,bower_components/**}"],
        build_dir: "./builds",
        main_js: ['./assets/src/js/main.js'],
        scripts: ['./assets/src/js/**/*.js'],
        bundle_js: ['./assets/src/js/bundle.js'],
        main_scss: './assets/src/sass/style.scss',
        styles: ['./assets/src/sass/**/*.scss']
    }
};

module.exports = {
    your_plugin: settings.plugin,
    your_theme: settings.theme,
    paths: settings.default_paths
};