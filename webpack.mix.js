const mix = require('laravel-mix');
mix.js('resources/js/laravel-gin.js', 'public/js')
    .postCss('resources/css/laravel-gin.css', 'public/css', [
    require('tailwindcss'),
  ])
