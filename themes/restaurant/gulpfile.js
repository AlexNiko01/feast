var gulp = require('gulp'),
    scss = require('gulp-sass'),
    cssmin = require('gulp-cssmin'),
    uglify = require("gulp-uglify"),
    rename = require("gulp-rename"),
    ftp = require('gulp-ftp'),
    order = require("gulp-order"),
    concat = require('gulp-concat');

function swallowError(error) {
    console.log(error.toString());
    this.emit('end');
}

function getFtpOptions(path) {
    return {
        user: 'w_new-netmaki_1c8d36c4',
        pass: '4191cd8990',
        port: 21,
        host: 'ftp.new-netmaki.1gb.ua',
        remotePath: '/wp-content/themes/restaurant/' + path
    };
}
gulp.task('styles', function () {
    gulp.src('scss/*.scss')
        .pipe(scss({style: 'expanded',}))
        .pipe(cssmin())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(ftp(getFtpOptions('css')))
        .pipe(gulp.dest('css'))
        .on('error', swallowError);
});

gulp.task('minify-js', function () {
    gulp.src([
        "./js/vendor/jquery-3.2.0.js",
        "./js/vendor/masonry.pkgd.min.js",
        "./js/bootstrap.js",
        "./bower_components/moment/moment.js",
        "./js/bootstrap-datetimepicker.js",
        "./js/slick.js",
        "./js/masonry/*.js",
        "./js/scripts.js",
        "./js/ajax.js"
    ]) // path to your files

        .pipe(concat('all.js'))
        // .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(ftp(getFtpOptions('scripts')))
        .pipe(gulp.dest('scripts'));
});
gulp.task('default', ['styles', 'minify-js'], function () {
    gulp.watch('scss/*.scss', ['styles']);
    // gulp.watch('scss/*/*.scss', ['styles']);
    gulp.watch('js/*.js', ['minify-js']);
});

