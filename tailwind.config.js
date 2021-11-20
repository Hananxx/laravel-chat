const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                blueGray: colors.blueGray,
                orange: colors.orange,
                purple: {
                    '450' : '#9c80ee'
                },
                primary: '#9c80ee',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            height: {
                'screen-1/2': '50vh',
                'screen-3/4': '75vh',
                'screen-4/5': '80vh',
            },
            width: {
                'screen-9/10': '90vw',

            },
            dropShadow: {
                'purple': '0px 1px 2px rgba(156,128,238,0.32)',
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
