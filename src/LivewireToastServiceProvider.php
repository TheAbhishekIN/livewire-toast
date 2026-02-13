<?php

namespace TheAbhishekIN\LivewireToast;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireToastServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/toast.php', 'livewire-toast');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-toast');

        Livewire::component('toast-container', Components\ToastContainer::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/toast.php' => config_path('livewire-toast.php'),
            ], 'livewire-toast-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-toast'),
            ], 'livewire-toast-views');
        }
    }
}
