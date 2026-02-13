<?php

namespace TheAbhishekIN\LivewireToast;

use Livewire\Component;
use TheAbhishekIN\LivewireToast\Components\ToastContainer;

class Toast
{
    /**
     * @param  array<string, mixed>  $options
     */
    public static function dispatch(Component $component, string $title, array $options = []): void
    {
        $component->dispatch('toast', array_merge(['title' => $title], $options))
            ->to(ToastContainer::class);
    }

    public static function success(Component $component, string $title, array $options = []): void
    {
        self::dispatch($component, $title, array_merge($options, ['type' => 'success']));
    }

    public static function error(Component $component, string $title, array $options = []): void
    {
        self::dispatch($component, $title, array_merge($options, ['type' => 'error']));
    }

    public static function info(Component $component, string $title, array $options = []): void
    {
        self::dispatch($component, $title, array_merge($options, ['type' => 'info']));
    }

    public static function warning(Component $component, string $title, array $options = []): void
    {
        self::dispatch($component, $title, array_merge($options, ['type' => 'warning']));
    }

    public static function loading(Component $component, string $title, array $options = []): void
    {
        self::dispatch($component, $title, array_merge($options, ['type' => 'loading']));
    }
}
