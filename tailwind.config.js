import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode:'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                royalblue: {
                100: '#3f62ba',
                200: '#3858a7',
                300: '#324e94',
                400: '#2c4482',
                },
            },
        },
    },

    daisyui: {
    themes: ['light'],
  },

    plugins: [forms, require("daisyui")],
};
