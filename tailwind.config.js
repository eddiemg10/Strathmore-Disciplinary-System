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
                "red-strath": "#A11111",
            },

            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
                nunito: ["Nunito"],
            },

            screens: {
                xmd: "1110px",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
