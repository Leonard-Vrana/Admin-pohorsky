let mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");

mix.js("resources/js/app.js", "/js/app.js")
    .postCss("resources/css/app.css", "/css/app.css", [
        tailwindcss("tailwind.config.js"),
    ])
    .copyDirectory("resources/images/", "public/images")
    .setPublicPath("public");
