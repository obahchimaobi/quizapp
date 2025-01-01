import preset from './vendor/filament/support/tailwind.config.preset'
import defaultTheme from 'tailwindcss/defaultTheme';

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/views/Livewire/**/*.blade.php',
        'node_modules/preline/dist/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                grotesk: ["Host Grotesk", "serif"],
            },
        },
    },

    plugins: [
        require('preline/plugin'),
    ],
}
