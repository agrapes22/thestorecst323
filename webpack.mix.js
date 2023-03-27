let mix = require('laravel-mix');

mix
	.postCss('resources/assets/bootstrap/css/bootstrap.min.css', 'public/assets/css/bootstrap.min.css')
	.postCss('resources/assets/css/Navbar-With-Button-icons.css', 'public/assets/css/Navbar-With-Button-icons.css')
	.js('resources/assets/bootstrap/js/bootstrap.min.js', 'public/assets/js/bootstrap.min.js');