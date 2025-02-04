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
                'sm': '358px',
                'md': '768px',
                'lg': '1024px',
                'xl': '1180px',
                '2xl': '1410px',
            },
            colors: {
                'white': '#E8EDFF',
                'primary': '#298AFF',
                'secondary': '#212E5A',
                'secondary-light': '#C7D3FF',
                'secondary-sidebar': '#1A2446',
                'secondary-sidebar-light': '#27376C',
                'background': '#141B35',
                'orange': '#FF9429',
            },
        },
    },

    plugins: [forms],
};
