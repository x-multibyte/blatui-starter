<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Livewire\Blaze\Blaze;
use TailwindMerge\Contracts\TailwindMergeContract;
use TailwindMerge\TailwindMerge;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TailwindMergeContract::class, fn () => TailwindMerge::factory()
            ->withConfiguration(config('tailwind-merge', []))
            ->withCache(Cache::memo())
            ->make());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blaze::optimize()->in(resource_path('views/components/ui'));
    }
}
