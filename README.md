# Livewire Toast (Sonner-style)

A Sonner-style toast notification package for Laravel Livewire, built with Alpine.js. Inspired by [shadcn/ui Sonner](https://ui.shadcn.com/docs/components/sonner) and [emilkowalski/sonner](https://sonner.emilkowal.ski/).

## Features

- **Stackable toasts** with configurable visible count
- **Types**: default, success, error, warning, info, loading
- **Title + description** support
- **Action & cancel buttons** with URL or custom event dispatch
- **Position**: top-left, top-center, top-right, bottom-left, bottom-center, bottom-right
- **Expand on hover** (Sonner-style)
- **Auto-dismiss** with configurable duration
- **Rich colors** and dark mode support
- **Publishable config** for full customization

## Installation

```bash
composer require theabhishekin/livewire-toast
```

## Setup

1. Add the toast container to your layout (e.g. `resources/views/layouts/app.blade.php`):

```blade
@livewire('toast-container')
```

2. Import the toast JavaScript in your app's entry point (e.g. `resources/js/app.js`):

```js
import './bootstrap';
import '../../packages/livewire-toast/resources/js/toast'; // or the package path when published
```

3. Publish the config (optional):

```bash
php artisan vendor:publish --tag=livewire-toast-config
```

## Usage

### From a Livewire component

```php
// Simple toast
$this->dispatch('toast', [
    'title' => 'Event has been created.',
]);

// With description and type
$this->dispatch('toast', [
    'title' => 'Booking Updated',
    'description' => 'Your booking has been confirmed.',
    'type' => 'info', // default|success|error|warning|info|loading
]);

// With action button
$this->dispatch('toast', [
    'title' => 'Item deleted',
    'description' => 'You can undo this action.',
    'type' => 'success',
    'action' => [
        'label' => 'Undo',
        'url' => '/undo/123',
        // or: 'event' => 'toast-undo',
    ],
    'cancel' => [
        'label' => 'Dismiss',
    ],
]);

// Using the Toast helper
use TheAbhishekIN\LivewireToast\Toast;

Toast::info($this, 'Booking Updated', [
    'description' => 'Your booking has been confirmed.',
]);

Toast::success($this, 'Saved!');
Toast::error($this, 'Something went wrong.');
Toast::warning($this, 'Please review.');
Toast::loading($this, 'Processing...');
```

## Configuration

Edit `config/livewire-toast.php` after publishing:

| Key | Default | Description |
|-----|---------|-------------|
| `position` | `bottom-right` | Toast container position |
| `expand` | `false` | Expand all toasts on hover |
| `visible_toasts` | `3` | Max visible toasts when not expanded |
| `theme` | `light` | light / dark |
| `rich_colors` | `true` | Type-colored borders |
| `close_button` | `false` | Show close button on each toast |
| `offset` | `32` | Container offset (px) |
| `mobile_offset` | `16` | Mobile offset (px) |
| `gap` | `14` | Gap between toasts (px) |
| `duration` | `4000` | Auto-dismiss duration (ms), 0 = never |
| `dismissible` | `true` | Allow manual dismiss |
| `container_aria_label` | `Notifications` | Accessibility label |

## Positions

- `top-left`, `top-center`, `top-right`
- `bottom-left`, `bottom-center`, `bottom-right`

## Contributing

Contributions are welcome! Please feel free to submit a [Pull Request](https://github.com/TheAbhishekIN/livewire-toast/pulls).

## Issues

If you discover any bugs or have feature requests, please open an [issue](https://github.com/TheAbhishekIN/livewire-toast/issues) on GitHub.
