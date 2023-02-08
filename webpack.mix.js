const mix = require('laravel-mix');
mix.options({
	manifest: false,
	postCss: [
		require('autoprefixer')({
			options: {
				browsers: [
					'last 6 versions',
				]
			}
		}),
		require('cssnano')({
			preset: ['default', {
				discardComments: { removeAll: true }
			}],
			sourceMap: false
		}),
	],
	clearConsole: false
});

const {
	setPublicPath,
	js,
	babel,
	minify,
	sass
} = mix;

const theme_assets = 'themes/redwerk/assets';
setPublicPath(theme_assets);

const routes = {
	img: {
		src: 'src/img/**/*',
		watch: 'src/img/**/*.svg',
		dest: `${theme_assets}/img/`
	},
	sass: {
		watch: 'src/sass/**/*.sass',
		src: 'src/sass/main.sass',
		dest: `${theme_assets}/css/`
	},
	js: {
		watch: 'src/js/*.js',
		main: {
			src: 'src/js/main.js',
			dest: `${theme_assets}/js/main.js`
		},
		babel: {
			src: `${theme_assets}/js/main.js`,
			dest: `${theme_assets}/js/main.babel.js`
		},
		minify: {
			src: `${theme_assets}/js/main.babel.js`
		}
	},
}

js(routes.js.main.src, routes.js.main.dest);
babel(routes.js.babel.src, routes.js.babel.dest);
minify(routes.js.minify.src);

sass(routes.sass.src, routes.sass.dest, {
	sassOptions: {
		outputStyle: 'compressed',
	}
});
