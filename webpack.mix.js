const mix = require("laravel-mix");

mix.js("resources/js/app.js", "dist/dist/js")
   .sass("resources/sass/app.scss", "dist/dist/css");