var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var util = require('gulp-util');
var gulpif = require('gulp-if');
var plumber = require('gulp-plumber');
var uglify = require('gulp-uglify');

var config = {
    assetsDir: 'app/Resources/assets',
    sassPattern: 'sass/**/*.scss',
    jsPattern: 'js/**/*.js',
    production: !!util.env.production,
    sourceMaps: !util.env.production
};

var app = {};
app.addStyles = function(path, filename){
    gulp.src(path)
        .pipe(plumber())
        .pipe( gulpif(config.sourceMaps, sourcemaps.init()) )
        .pipe(sass())
        .pipe(concat(filename))
        .pipe(config.production ? cleanCSS({compatibility: 'ie8'}) : util.noop() )
        .pipe( gulpif(config.sourceMaps, sourcemaps.write('.')) )
        .pipe(gulp.dest('web/css'))
};

app.addScripts = function(path, filename){
    gulp.src(path)
        .pipe(plumber())
        .pipe( gulpif(config.sourceMaps, sourcemaps.init()) )
        .pipe(concat(filename))
        .pipe( config.production ? uglify() : util.noop() )
        .pipe( gulpif(config.sourceMaps, sourcemaps.write('.')) )
        .pipe(gulp.dest('web/js'))
};

gulp.task('watch', function(){
    gulp.watch(config.assetsDir + '/' + config.sassPattern, ['styles']);
    gulp.watch(config.assetsDir + '/' + config.jsPattern, ['scripts']);
});

gulp.task('scripts', function(){
    app.addScripts([
        config.assetsDir + '/js/main.js'
    ], 'all.js');
});

gulp.task('styles', function () {
    app.addStyles([
        config.assetsDir + '/sass/style.scss'
    ], 'main.css');
    // если надо сделать файл для отдельной страницы достаточно вызвать метод addStyle передавая туда масив с файлами для другой страницы
    /*app.addStyles([
        config.assetsDir + '/sass/other.scss'
    ], 'otherName.css');*/
});

gulp.task('default', ['styles', 'scripts', 'watch']);
