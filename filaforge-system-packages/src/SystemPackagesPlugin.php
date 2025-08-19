<?php

namespace Filaforge\SystemPackages;

use Filament\Contracts\Plugin as PluginContract;
use Filament\Panel;

class SystemPackagesPlugin implements PluginContract
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'system-packages';
    }

    public function register(Panel $panel): void
    {
        $panel->pages([
            \Filaforge\SystemPackages\Pages\SystemPackagesPage::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
