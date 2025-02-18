import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            screens: {
                'sm': '365px',
                'md': '976px',
                'lg': '1024px',
                'xl': '1180px',
                '2xl': '1510px',
            },
            colors: {
                'white': '#E8EDFF',
                'primary': '#298AFF',
                'secondary': '#212E5A',
                'secondary-light': '#C7D3FF',
                'secondary-sidebar': '#1A2446',
                'secondary-sidebar-light': '#27376C',
                'secondary-sidebar-light-2': '#202C55',
                'background': '#141B35',
                'orange': '#FF9429',
                'green': '#5DDF59',
                'green-light': '#47F260',
                'secondary-sidebar-dark': '#171F3D',
                'secondary-sidebar-dark-1': '#1E2A52',
                'dark-text': '#1C4F8C',
                'dark-text-2': '#243267',
                'dark-text-3': '#1D2850',
                'blue_dark': '#222F5B',
                'blue_dark_2': '#3D57AA',
                'blue_light': '#4577E7',
                'red-primary': '#FF5353',
            },

        },
    },

    plugins: [forms],
};
