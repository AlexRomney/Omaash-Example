module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                bungee: ['Bungee', 'Arial Black', 'Arial', 'ui-sans-serif', 'system-ui'],
                source: ['Source Sans Pro', 'Verdana', 'ui-serif', 'system-ui'],
            },
            fontSize: {
                'xxs': '.625rem',
            },
            colors: {
                'darkBlue': '#192650',
                'lightBlue': '#3A5DA8',
                'darkGray': '#8D8D8D',
                'medGray': '#EEEEEE',
                'lightGray': '#F8F8F8',
                // Pokemon Brand
                'pokemon-yellow': '#ffcb05',
                // Social
                'youtube': '#FF0000',
                'instagram': '#8a3ab9',
                'tiktok': '#ff0050',
                'twitter': '#00acee',
                'shirts': '#3d4246',
                'patreon': '#f96854',
                'paypal:': '#00457C',
                'venmo': '#008CFF',
                'cashapp': '#00D632',
            },
            backgroundImage: theme => ({
                'pokemon': "url('/images/backgrounds/pokemon-pattern.jpg')",
                'auth': "url('/images/backgrounds/auth-hero.jpg')",
                'home': "url('/images/backgrounds/home-hero.jpg')",
                'middleman': "url('/images/backgrounds/middleman-hero.jpg')",
                'videos': "url('/images/backgrounds/videos-hero.jpg')",
                'contact': "url('/images/backgrounds/contact-me-hero.jpg')",
                'faq': "url('/images/backgrounds/faq-bg.jpg')",
                'profile': "url('/images/backgrounds/profile-hero.jpg')",
                'avatar-selection': "url('/images/backgrounds/avatar-selection.jpg')",
                'admin': "url('/images/backgrounds/admin-hero.jpg')",
                'pokemon-cards': "url('/images/backgrounds/pokemon-cards.jpg')",
                // Card Backgrounds
                'type-bug': "url('/images/backgrounds/card/type/bug.png')",
                'type-dark': "url('/images/backgrounds/card/type/dark.png')",
                'type-dragon': "url('/images/backgrounds/card/type/dragon.png')",
                'type-electric': "url('/images/backgrounds/card/type/electric.png')",
                'type-fairy': "url('/images/backgrounds/card/type/fairy.png')",
                'type-fighting': "url('/images/backgrounds/card/type/fighting.png')",
                'type-fire': "url('/images/backgrounds/card/type/fire.png')",
                'type-flying': "url('/images/backgrounds/card/type/flying.png')",
                'type-ghost': "url('/images/backgrounds/card/type/ghost.png')",
                'type-grass': "url('/images/backgrounds/card/type/grass.png')",
                'type-ground': "url('/images/backgrounds/card/type/ground.png')",
                'type-ice': "url('/images/backgrounds/card/type/ice.png')",
                'type-normal': "url('/images/backgrounds/card/type/normal.png')",
                'type-poison': "url('/images/backgrounds/card/type/poison.png')",
                'type-psychic': "url('/images/backgrounds/card/type/psychic.png')",
                'type-rock': "url('/images/backgrounds/card/type/rock.png')",
                'type-steel': "url('/images/backgrounds/card/type/steel.png')",
                'type-water': "url('/images/backgrounds/card/type/water.png')",
                // Card Textures
                'texture-bug': "url('/images/backgrounds/card/texture/bug.jpg')",
                'texture-dark': "url('/images/backgrounds/card/texture/dark.jpg')",
                'texture-dragon': "url('/images/backgrounds/card/texture/dragon.jpg')",
                'texture-electric': "url('/images/backgrounds/card/texture/electric.jpg')",
                'texture-fairy': "url('/images/backgrounds/card/texture/fairy.jpg')",
                'texture-fighting': "url('/images/backgrounds/card/texture/fighting.jpg')",
                'texture-fire': "url('/images/backgrounds/card/texture/fire.jpg')",
                'texture-flying': "url('/images/backgrounds/card/texture/flying.jpg')",
                'texture-ghost': "url('/images/backgrounds/card/texture/ghost.jpg')",
                'texture-grass': "url('/images/backgrounds/card/texture/grass.jpg')",
                'texture-ground': "url('/images/backgrounds/card/texture/ground.jpg')",
                'texture-ice': "url('/images/backgrounds/card/texture/ice.jpg')",
                'texture-normal': "url('/images/backgrounds/card/texture/normal.jpg')",
                'texture-poison': "url('/images/backgrounds/card/texture/poison.jpg')",
                'texture-psychic': "url('/images/backgrounds/card/texture/psychic.jpg')",
                'texture-rock': "url('/images/backgrounds/card/texture/rock.jpg')",
                'texture-steel': "url('/images/backgrounds/card/texture/steel.jpg')",
                'texture-water': "url('/images/backgrounds/card/texture/water.jpg')",
            }),
            minHeight: {
                '16': '4rem',
                '20': '5rem',
                '24': '6rem',
                '32': '8rem',
                '40': '10rem',
                '48': '12rem',
                '56': '14rem',
                '64': '16rem',
                '96': '24rem',
            },
            height: {
                '104': '28rem',
                '112': '32rem',
                '120': '36rem'
            },
            margin: {
                '4px': '4px',
                '-6px': '-6px',
            },
            zIndex: {
                '60': '60',
                '70': '70',
                '80': '80',
                '90': '90',
                '100': '100',
            },
            borderWidth: {
                '16': '16px'
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/aspect-ratio'), require('@tailwindcss/line-clamp')],
};
