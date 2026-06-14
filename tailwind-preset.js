/**
 * s-suite shared Tailwind preset.
 *
 * The brand colour scale is driven by CSS variables (--color-brand-50 … 900),
 * so every app uses the SAME utility names (bg-brand-600, text-brand-500, …)
 * while theming itself by defining those variables in its own base CSS. This is
 * the canonical token scale for the whole suite.
 *
 * Usage in an app's tailwind.config.js:
 *   presets: [require('./vendor/oneorzerotechnologies/ssuite-ui/tailwind-preset')],
 *   content: [ ...app globs..., './vendor/oneorzerotechnologies/ssuite-ui/resources/views/**\/*.blade.php' ],
 */
const brand = {};
[50, 100, 200, 300, 400, 500, 600, 700, 800, 900].forEach((s) => {
    brand[s] = `rgb(var(--color-brand-${s}) / <alpha-value>)`;
});

module.exports = {
    theme: {
        extend: {
            colors: { brand },
            fontFamily: {
                sans: ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
    // Ensure utility classes used inside the package's own components are
    // compiled into every app that consumes it.
    content: [
        './vendor/oneorzerotechnologies/ssuite-ui/resources/views/**/*.blade.php',
    ],
};
