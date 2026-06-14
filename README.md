# ssuite-ui

Shared UI kit for the **s-suite**. Built once here, consumed by every SaaS app — so components, the brand token scale, and the product registry stop being copied into 14 repos and drifting.

What it provides:

1. **Tailwind preset** (`tailwind-preset.js`) — the canonical brand token scale (`--color-brand-50…900`, themed per SaaS via CSS variables), shared theme, plugins, and content globs.
2. **Blade component library** (`resources/views/components/`) — `x-app-icon`, `x-breadcrumbs`, `x-card`, `x-button`, `x-input` / `x-select` (TomSelect), `x-modal`, `x-empty-state`, `x-password-strength`, `x-mail.layout`, and the table toolbar. Registered under the default namespace (so existing `<x-…>` references keep working) and under `ssuite::`.
3. **Base CSS** (`resources/css/base.css`) — default brand variables an app overrides to theme itself.
4. **Product registry** (`config/suite.php`) — the single source of truth for every product's icon (`svg` + `fill` + `viewBox`), name and colour.

## Install (per app)

`composer.json` (production uses the GitHub VCS repo; local dev uses a path repo):

```json
"repositories": [
    { "type": "vcs", "url": "git@github.com:neophyteheaven/ssuite-ui.git" }
],
"require": { "neophyteheaven/ssuite-ui": "^0.1" }
```

`tailwind.config.js`:

```js
module.exports = {
  presets: [require('./vendor/neophyteheaven/ssuite-ui/tailwind-preset')],
  content: [
    './resources/views/**/*.blade.php',
    './vendor/neophyteheaven/ssuite-ui/resources/views/**/*.blade.php',
  ],
};
```

Then **delete the per-app copies** (`config/suite.php`, the duplicated components, the TomSelect partial) — the package versions take over by fall-through.

## Versioning

Semver. **A breaking component change requires an ADR** in `docs/adr/` and a major bump. Treat this like any shared-shell change — list affected apps and coordinate per AGENTS.md.
