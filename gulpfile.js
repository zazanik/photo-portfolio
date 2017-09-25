// "use strict";

let browserSync = require('browser-sync');
let autoPrefix = require('gulp-autoprefixer');
let jsonlint = require("gulp-jsonlint");
let htmlLint = require('gulp-html-lint');
let sassLint = require('gulp-sass-lint');
let phplint = require('gulp-phplint');
let connect = require('gulp-connect-php');
let minCss = require('gulp-minify-css');
let jshint = require('gulp-jshint');
let concat = require('gulp-concat');
let gulp = require('gulp');
let sass = require('gulp-sass');
let args = require('yargs').argv;
let rebaseUrls = require('gulp-css-rebase-urls');
let replace = require('gulp-replace');

const sassDistribution = {
    name: 'main.css',
    path: './web/dist/styles/',
    autoPrefix: {
        browsers: [
            'last 3 versions'
        ],
        cascade: false
    },
    nodePath: {
        includePaths: './node_modules/'
    }
};

const sassLintOptions = {
    rules: {
        'no-important': 0,
        'nesting-depth': 0,
        'property-sort-order': 0,
        'clean-import-paths': 0
    }
};

const htmlLintOptions = {
    rules: {
        'class-style': false,
        'id-class-style': false,
        'attr-req-value': false,
        'attr-name-style': false,
        'attr-bans': [
            'align', 'background', 'bgcolor', 'border', 'frameborder',
            'longdesc', 'marginwidth', 'marginheight', 'scrolling', 'width'
        ]
    }
};

const phpOptions = {
    'skipPassedFiles': true
};

/**
 * Build css distribution
 */
gulp.task('sass', () => {
    return gulp.src('./web/src/styles/*.scss')
        .pipe(sass(sassDistribution.nodePath).on('error', sass.logError))
        .pipe(autoPrefix(sassDistribution.autoPrefix))
        .pipe(rebaseUrls())
        // .pipe(replace('url("template/', 'url("../../'))
        .pipe(concat(sassDistribution.name))
        .pipe(minCss())
        .pipe(gulp.dest(sassDistribution.path));
});

// /**
//  * Lint for JS files.
//  */
// gulp.task('js-lint', () => {
//     return gulp.src(args.path || './template/components/*/*/scripts/*.js')
//         .pipe(jshint())
//         .pipe(jshint.reporter('jshint-stylish'));
// });

// /**
//  * Lint for JSON files.
//  */
// gulp.task('json-lint', () => {
//     return gulp.src(['./template/configs/*.json', './template/components/*/*/*.json'])
//         .pipe(jsonlint())
//         .pipe(jsonlint.reporter('jshint-stylish'));
// });

// /**
//  * Lint for SASS files.
//  */
// gulp.task('sass-lint', () => {
//     return gulp.src(args.path || './web/src/styles/*/*.scss')
//         .pipe(sassLint(sassLintOptions))
//         .pipe(sassLint.format())
//         .pipe(sassLint.failOnError());
// });

// /**
//  * Lint for HTML files.
//  */
// gulp.task('html-lint', () => {
//     return gulp.src(args.path || './template/components/*/*/*.twig')
//         .pipe(htmlLint(htmlLintOptions))
//         .pipe(htmlLint.format())
//         .pipe(htmlLint.failOnError());
// });

// /**
//  * Lint for PHP files.
//  */
// gulp.task('php-lint', () => {
//     return gulp.src(['template/components/*/*/*.php', 'template/includes/**/*.php'])
//         .pipe(phplint('', phpOptions))
//         .pipe(phplint.reporter(jshint));
// });

// /**
//  * Run server for project.
//  */
// gulp.task('serve', () => {
//     connect.server({base: '../../'}, () => {
//     /*browserSync({
//      proxy: '127.0.0.1:8000'
//      });*/
// });
// });

/**
 * Browser sync task
 */
gulp.task('sync', () => {
    /*browserSync.reload();*/
});

/**
 * Watcher for sass, js and twig files
 */
gulp.task('watch', () => {
    // gulp.watch('./template/components/*/*/scripts/*.js', ['sync']);
    // gulp.watch('./template/components/*/*/*.twig', ['sync']);
    gulp.watch('./web/src/styles/*/*.scss', ['sass', 'sync']);
});

gulp.task('default', ['sass']);
// gulp.task('pre-commit', ['js-lint', 'php-lint', 'html-lint', 'sass-lint']);
