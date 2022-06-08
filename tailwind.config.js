const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                "blue-strath": "#00447D",
            },

            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
                nunito: ["Nunito"],
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
