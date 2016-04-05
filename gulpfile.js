var pkg = require('./package.json'),
    config = require('./configs/gulpfile-config');

var gulp = require('gulp'),
    concat = require('gulp-concat'),
    rename = require("gulp-rename"),
    sourcemaps = require('gulp-sourcemaps'),
    jsmin = require('gulp-jsmin'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
    browserify = require('gulp-browserify'),
    zip = require('gulp-zip'),
    bower = require('gulp-bower'),
    copy = require('gulp-copy'),
    rsync  = require('gulp-rsync'),
    merge  = require('merge-stream'),
    runSequence  = require('run-sequence');

/**
 * Compile CSS
 */
gulp.task('compile_sass',function(){
    var theme = gulp.src(config.paths.main_scss, { cwd: config.shop_theme.cwd })
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(sourcemaps.write("."))
        .pipe(gulp.dest('./',{ cwd: config.shop_theme.cwd }));

    var plugin = gulp.src(config.paths.main_scss, { cwd: config.shop_plugin.cwd })
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(sourcemaps.write("."))
        .pipe(gulp.dest('./assets/dist/css',{ cwd: config.shop_plugin.cwd }));

    return merge(theme,plugin);
});

/**
 * Creates and minimize bundle.js
 */
gulp.task('compile_js', ['browserify'] ,function(){
    var theme = gulp.src(config.paths.bundle_js, { cwd: config.shop_theme.cwd })
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(rename('main.min.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./assets/dist/js', { cwd: config.shop_theme.cwd }));

    var plugin = gulp.src(config.paths.bundle_js, { cwd: config.shop_plugin.cwd })
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(rename(config.shop_plugin.slug+'.min.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./assets/dist/js', { cwd: config.shop_plugin.cwd }));

    return merge(theme,plugin);
});

/**
 * Browserify magic! Creates bundle.js
 */
gulp.task('browserify', function(){
    var theme = gulp.src(config.paths.main_js, { cwd: config.shop_theme.cwd })
        .pipe(browserify({
            insertGlobals : true,
            debug : true
        }))
        .pipe(rename('bundle.js'))
        .pipe(gulp.dest('./assets/src/js', { cwd: config.shop_theme.cwd }));

    var plugin = gulp.src(config.paths.main_js, { cwd: config.shop_plugin.cwd })
        .pipe(browserify({
            insertGlobals : true,
            debug : true
        }))
        .pipe(rename('bundle.js'))
        .pipe(gulp.dest('./assets/src/js', { cwd: config.shop_plugin.cwd }));

    return merge(theme,plugin);
});

/**
 * Bower Vendors
 */
gulp.task('bower_install',function(){
    var theme = bower({ cwd: config.shop_theme.cwd });
    var plugin = bower({ cwd: config.shop_plugin.cwd });
    return merge(theme,plugin);
});

gulp.task('bower_update',function(){
    var theme = bower({ cwd: config.shop_theme.cwd, cmd: 'update' });
    var plugin = bower({ cwd: config.shop_plugin.cwd, cmd: 'update' });
    return merge(theme,plugin);
});

/**
 * Copy files and folder to server
 * via rsync
 */
gulp.task('rsync', function() {
    var theme = gulp.src(config.shop_theme.rsync.src)
        .pipe(rsync(config.shop_theme.rsync.options));

    var plugin = gulp.src(config.shop_plugin.rsync.src)
        .pipe(rsync(config.shop_plugin.rsync.options));

    return merge(theme,plugin);
});

// Rerun the task when a file changes
gulp.task('watch', function() {
    gulp.watch(config.shop_theme.cwd+"/assets/src/js/**/*",['compile_js']);
    gulp.watch(config.shop_plugin.cwd+"/assets/src/js/**/*",['compile_js']);

    gulp.watch(config.shop_theme.cwd+"/assets/src/sass/**/*",['compile_sass']);
    gulp.watch(config.shop_plugin.cwd+"/assets/src/sass/**/*",['compile_sass']);
});

gulp.task('default', function(callback){
    runSequence('bower_install','bower_update',['compile_sass','compile_js'], 'watch', callback);
});