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
		src: 'src/js',
		dest: `${theme_assets}/js`
	},
}

const scripts = [
	'main',
	'main-admin'
];

scripts.forEach(scriptName => {
	js(
		`${routes.js.src}/${scriptName}.js`,
		`${routes.js.dest}/${scriptName}.js`
	)
	.babel(
		`${routes.js.dest}/${scriptName}.js`,
		`${routes.js.dest}/${scriptName}.babel.js`
	)
	.minify(`${routes.js.dest}/${scriptName}.babel.js`);
})

sass(routes.sass.src, routes.sass.dest, {
	sassOptions: {
		outputStyle: 'compressed',
	}
});
