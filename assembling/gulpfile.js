// Base
const path              = require('path');
const gulp              = require('gulp');
const notify            = require('gulp-notify');
const plumber           = require('gulp-plumber');

// General
const concat            = require('gulp-concat');
const sourcemaps        = require('gulp-sourcemaps');

// Scripts
const webpack           = require('webpack')
const webpackStream     = require('webpack-stream');

// Styles
const sass              = require('gulp-sass');
const autoprefixer      = require('gulp-autoprefixer');
const cssbeautify 		= require('gulp-cssbeautify');

// Images
const tinypng 			= require('gulp-tinypng-compress');
const svgSprite 		= require('gulp-svg-sprites');
const replace 			= require('gulp-replace');
const cheerio 			= require('gulp-cheerio');
const base64 			= require('gulp-base64');
const webp 				= require('gulp-webp');

// Paths
const paths = {
    build:  path.join(__dirname, '.'),
    node:   path.join(__dirname, 'node_modules'),
    src: {
        self:       path.join(__dirname, 'src'),
        js:         'src/js/',
        sass:       'src/scss/',
        images:     'src/images/',
    },
    static: {
        self:       'static/',
        js:         'static/js/',
        css:        'static/css/',
        images:     'static/images/',
    },
    html: './'
}

gulp.task('js', function() {
    gulp.src(path.join(paths.src.self, "js", "index.js"))
        .pipe(webpackStream({
            mode: "development",
            entry: {
                main: ['babel-polyfill', path.join(paths.src.self, "js", "index.js")]
			},
			output: {
                path: paths.build,
                publicPath: "/",
                filename: "static/js/[name].bundle.js",
                library: "[name]"
            },
            module: {
                rules: [
                    {
                        test: /\.(js|jsx)$/,
                        exclude: /node_modules/,
                        use: {
							loader: 'babel-loader',
							options: {
							  presets: ['@babel/preset-env'],
							  plugins: ['@babel/plugin-proposal-class-properties']
							}
						}
                    },
                ]
            },
            resolve: {
                extensions: ["*", ".js", ".jsx"],
                modules: [
                    paths.node,
                    paths.src.self,
                ],
                alias: {
                    'jquery': paths.node + '/jquery/dist/jquery.js',
                    js: path.resolve(__dirname, 'src/js/'),
                    common: path.resolve(__dirname, 'src/js/components/common'),
                    pages: path.resolve(__dirname, 'src/js/components/pages')
                }
            },
            optimization: {
                splitChunks: {
                    cacheGroups: {
                        commons: {
                            test: /[\\/](node_modules|vendors)[\\/]/,
                            name: "vendors",
                            chunks: "all"
                        }
                    }
                }
            },
            plugins: [
                new webpack.ProvidePlugin({
                    $: "jquery",
                    jQuery: "jquery",
                })
            ]
        }))
        .pipe(gulp.dest(paths.build));
});

gulp.task('js-build', function() {
    gulp.src(path.join(paths.src.self, "js", "index.js"))
		.pipe(webpackStream({
			mode: "production",
			entry: {
				main: ['babel-polyfill', path.join(paths.src.self, "js", "index.js")]
			},
			module: {
				rules: [
					{
						test: /\.(js|jsx)$/,
						exclude: /node_modules/,
						use: {
							loader: 'babel-loader',
							options: {
							  presets: ['@babel/preset-env'],
							  plugins: ['@babel/plugin-proposal-class-properties']
							}
						}
					},
				]
			},
			resolve: {
				extensions: ["*", ".js", ".jsx"],
				modules: [
					paths.node,
					paths.src.self,
				],
				alias: {
					'jquery': paths.node + '/jquery/dist/jquery.js',
                    js: path.resolve(__dirname, 'src/js/'),
                    common: path.resolve(__dirname, 'src/js/components/common'),
                    pages: path.resolve(__dirname, 'src/js/components/pages')
				}
			},
			output: {
				path: paths.build,
				publicPath: "/",
				filename: "static/js/[name].bundle.js",
				library: "[name]"
			},
			optimization: {
				splitChunks: {
					cacheGroups: {
						commons: {
							test: /[\\/](node_modules|vendors)[\\/]/,
							name: "vendors",
							chunks: "all"
						}
					}
				}
			},
			plugins: [
				new webpack.ProvidePlugin({
					$: "jquery",
                    jQuery: "jquery",
                    // "window.$": "jquery",
					// "window.jQuery": "jquery"
				})
			]
		}))
		.pipe(gulp.dest(paths.build));
});
  
gulp.task('sass', function () {
    // Libs
	gulp.src([
		path.join(paths.node,       "slick-carousel/slick/slick.css"),
		path.join(paths.src.sass,   "vendors/*.+(scss|sass|css)"),
	])
	.pipe(plumber({ errorHandler: notify.onError("<%= error.message %>") }))
	.pipe(sass({outputStyle: "compressed"}).on("error", sass.logError))
	.pipe(autoprefixer("last 2 version"))
	.pipe(concat("vendors.min.css"))
	.pipe(gulp.dest(paths.static.css))


    // Styles
    gulp.src(path.join(paths.src.sass, "main.scss"))
    .pipe(plumber({ errorHandler: notify.onError("<%= error.message %>") }))
    .pipe(sourcemaps.init())
    .pipe(sass().on("error", sass.logError))
    .pipe(base64({
        baseDir: '/static/test',
        extensions: ['svg', 'png', /\.jpg#datauri$/i],
        exclude: [/\.server\.(com|net)\/dynamic\//, '--live.jpg'],
        maxImageSize: 32 * 1024, // bytes 
        debug: false
    }))
	.pipe(sourcemaps.write("./", { sourceRoot: "/src/scss" }))
    .pipe(gulp.dest(paths.static.css))
});

gulp.task('sass-build', function () {
    // Styles
    gulp.src(path.join(paths.src.sass, "main.scss"))
    .pipe(plumber({ errorHandler: notify.onError("<%= error.message %>") }))
    .pipe(sass({outputStyle: "compressed"}).on("error", sass.logError))
    .pipe(gulp.dest(paths.static.css))
});

gulp.task('tinypng', function () {
	gulp.src(paths.src.images + '/*.{png,jpg,jpeg}')
	// .pipe(tinypng({
	// 	key: 'odthLyLlVCQlfl9KLbpWcDBGEAqaBK8T',
	// 	sigFile: paths.static.images + '/.tinypng-sigs'
	// }))
	.pipe(gulp.dest(paths.static.images))
});

gulp.task('svg', function () {
	gulp
		.src(paths.src.images + '/*.svg')
		.pipe(cheerio({
            run: function ($) {
                $('[fill]').removeAttr('fill');
                $('[style]').removeAttr('style');
            },
			parserOptions: { xmlMode: true }
        }))
        .pipe(replace('&gt;', '>'))
        .pipe(
            svgSprite({
                mode: "symbols",
                preview: false,
                selector: "%f",
                svg: {
                symbols: 'sprite.svg' 
            },
            transformData: function (data, config) {
                for(var i in data.svg) {
                    var result = data.svg[i].data.match(/path id="([a-z]+)"/ig );
                    if (null !== result) {
                        for(var j in result) {
                            var regexp = /\"([a-z]+)\"/i;
                            var matches = regexp.exec(result[j]);
                            matches[0] = matches[0].replace(/\"/g, '');

                            var k = 0;

                            var regexp = new RegExp('(path id\=\"|xlink\:href\=\"#)('+matches[0]+'){1}', 'g');
                            data.svg[i].data = data.svg[i].data.replace(regexp, function(str, p1, p2, offset, s)
                                {
                                    return p1 + "" + i + "" + j + "" + p2;
                                });
                        }
                    }
                }
                return data;
            },
        }
        ))
        .pipe(replace('NaN ', '-'))
        .pipe(gulp.dest(paths.static.images))
});

gulp.task('static-svg', function () {
	gulp
		.src(paths.src.images + '/static/*.svg')
        .pipe(replace('&gt;', '>'))
        .pipe(
            svgSprite({
                mode: "symbols",
                preview: false,
                selector: "%f",
                svg: {
                symbols: 'static-sprite.svg' 
            },
            transformData: function (data, config) {
                for(var i in data.svg) {
                    var result = data.svg[i].data.match(/path id="([a-z]+)"/ig );
                    if (null !== result) {
                        for(var j in result) {
                            var regexp = /\"([a-z]+)\"/i;
                            var matches = regexp.exec(result[j]);
                            matches[0] = matches[0].replace(/\"/g, '');

                            var k = 0;

                            var regexp = new RegExp('(path id\=\"|xlink\:href\=\"#)('+matches[0]+'){1}', 'g');
                            data.svg[i].data = data.svg[i].data.replace(regexp, function(str, p1, p2, offset, s)
                                {
                                    return p1 + "" + i + "" + j + "" + p2;
                                });
                        }
                    }
                }
                return data;
            },
        }
        ))
        .pipe(replace('NaN ', '-'))
        .pipe(gulp.dest(paths.static.images))
});

gulp.task('webpTask', function () {
	gulp.src(paths.src.images + '/webp/*.{png,jpg,jpeg}')
	.pipe(webp())
	.pipe(gulp.dest(paths.static.images))
});

gulp.task('watch', function () {
	gulp.watch(path.join(paths.src.js,      "**/*.+(js|ts)"), ["js"]);
	gulp.watch(path.join(paths.src.sass,    "**/*.+(scss|sass)"), ["sass"]);
	
	gulp.watch([paths.src.images + '/*.{png,jpg,jpeg}'], ['tinypng']);
	gulp.watch([paths.src.images + '/webp/*.{png,jpg,jpeg}'], ['webpTask']);
	gulp.watch([paths.src.images + '/*.svg'], ['svg']);
	gulp.watch([paths.src.images + '/static/*.svg'], ['static-svg']);
});


gulp.task('default', ['watch', 'js', 'sass', 'tinypng', 'webpTask', 'svg', 'static-svg']);
gulp.task('build', ['js-build', 'sass-build']);