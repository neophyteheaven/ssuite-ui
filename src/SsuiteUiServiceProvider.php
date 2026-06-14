<?php

namespace OneOrZero\SsuiteUi;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Registers the shared s-suite UI kit:
 *  - the canonical product registry (config/suite.php) as the single source,
 *  - the Blade component library under both the default namespace (so existing
 *    `<x-app-icon>`, `<x-card>`, `<x-breadcrumbs>`, `<x-mail.layout>` … keep
 *    working once an app deletes its local copy) and a `ssuite::` namespace.
 *
 * An app's own component still wins if present, so propagation is delete-then-
 * fall-through: remove the per-app copy and the package version takes over.
 */
class SsuiteUiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Single source of truth for product display metadata (svg / fill /
        // viewBox / name / colour). mergeConfigFrom only fills the 'suite' key
        // when the app has none — i.e. after the per-app copy is removed.
        $this->mergeConfigFrom(__DIR__ . '/../config/suite.php', 'suite');
    }

    public function boot(): void
    {
        // Namespaced access: <x-ssuite::card>, view('ssuite::...').
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ssuite');

        // Default-namespace anonymous components: <x-card>, <x-app-icon>,
        // <x-breadcrumbs>, <x-empty-state>, <x-mail.layout> … resolve here when
        // the app has no local copy of its own.
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views/components');

        $this->publishes([
            __DIR__ . '/../config/suite.php' => config_path('suite.php'),
        ], 'ssuite-ui-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/ssuite'),
        ], 'ssuite-ui-views');
    }
}
