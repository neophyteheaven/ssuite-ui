/**
 * s-suite shared Tailwind preset.
 *
 * The brand scale is the canonical suite token set. Each colour resolves to a
 * CSS variable with a sensible default, so every app uses identical utility
 * names (bg-brand-600, text-brand-500, …) and themes itself by either:
 *   - overriding --color-brand-N in its own :root (recommended), or
 *   - keeping the default below.
 *
 * This mirrors the format already shipped across the apps (var(--color-brand-N,
 * #fallback)), so adopting the preset is a drop-in: delete the per-app inline
 * brand block and point tailwind.config at this preset.
 *
 * Usage in an app's tailwind.config.js:
 *   presets: [require('./vendor/neophyteheaven/ssuite-ui/tailwind-preset')],
 *   content: [ ...app globs..., './vendor/neophyteheaven/ssuite-ui/resources/views/**\/*.blade.php' ],
 */
const DEFAULTS = {
    50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc', 400: '#818cf8',
    500: '#6366f1', 600: '#4f46e5', 700: '#4338ca', 800: '#3730a3', 900: '#312e81',
};

const brand = {};
Object.keys(DEFAULTS).forEach((s) => {
    brand[s] = `var(--color-brand-${s}, ${DEFAULTS[s]})`;
});

// Resolve shared plugins from the CONSUMING app's node_modules (this preset is a
// symlinked path package with no node_modules of its own).
function appPlugin(mod) {
    return require(require.resolve(mod, { paths: [process.cwd(), __dirname] }));
}

module.exports = {
    theme: {
        extend: {
            colors: { brand },
        },
    },
    plugins: [
        appPlugin('@tailwindcss/forms'),
    ],
    // Compile utility classes used inside the package's own components.
    content: [
        './vendor/neophyteheaven/ssuite-ui/resources/views/**/*.blade.php',
    ],
};
