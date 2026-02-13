@php
    $visibleCount = config('livewire-toast.expand', false) ? count($toasts) : min(count($toasts), config('livewire-toast.visible_toasts', 3));
    $visibleToasts = array_slice($toasts, 0, $visibleCount);
    $positionClasses = match (config('livewire-toast.position', 'bottom-right')) {
        'top-left' => 'top-0 left-0 items-start justify-start',
        'top-center' => 'top-0 left-1/2 -translate-x-1/2 items-start justify-center',
        'top-right' => 'top-0 right-0 items-start justify-end',
        'bottom-left' => 'bottom-0 left-0 items-end justify-start',
        'bottom-center' => 'bottom-0 left-1/2 -translate-x-1/2 items-end justify-center',
        default => 'bottom-0 right-0 items-end justify-end',
    };
    $typeBorderClasses = [
        'success' => 'border-green-200 dark:border-green-900/50',
        'error' => 'border-red-200 dark:border-red-900/50',
        'warning' => 'border-amber-200 dark:border-amber-900/50',
        'info' => 'border-blue-200 dark:border-blue-900/50',
        'loading' => 'border-gray-200 dark:border-gray-800',
        'default' => 'border-gray-200 dark:border-gray-800',
    ];
@endphp
<div
    class="fixed z-[9999] flex flex-col gap-[14px] p-8 max-h-[100vh] overflow-hidden pointer-events-none {{ $positionClasses }}"
    role="region"
    aria-label="{{ config('livewire-toast.container_aria_label', 'Notifications') }}"
>
    @foreach ($visibleToasts as $toast)
        <div
            x-data="toastItem(@js($toast))"
            x-init="startTimer()"
            x-show="visible"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            @mouseenter="expand && pauseTimer()"
            @mouseleave="expand && resumeTimer()"
            class="pointer-events-auto w-full max-w-[356px] min-w-[300px] flex items-start gap-3 rounded-lg border bg-white text-gray-900 shadow-lg ring-1 ring-black/5 dark:bg-gray-800 dark:text-gray-100 dark:ring-white/10 p-4 {{ config('livewire-toast.rich_colors', true) ? ($typeBorderClasses[$toast['type'] ?? 'default'] ?? $typeBorderClasses['default']) : 'border-gray-200 dark:border-gray-700' }}"
        >
            @if(($toast['type'] ?? 'default') === 'loading')
                <div class="shrink-0 mt-0.5">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            @elseif(($toast['type'] ?? 'default') === 'success')
                <svg class="h-5 w-5 shrink-0 mt-0.5 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
            @elseif(($toast['type'] ?? 'default') === 'error')
                <svg class="h-5 w-5 shrink-0 mt-0.5 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                </svg>
            @elseif(($toast['type'] ?? 'default') === 'warning')
                <svg class="h-5 w-5 shrink-0 mt-0.5 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
            @elseif(($toast['type'] ?? 'default') === 'info')
                <svg class="h-5 w-5 shrink-0 mt-0.5 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                </svg>
            @endif
            <div class="flex-1 min-w-0 grid gap-1">
                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100" x-text="title"></p>
                <p x-show="description" class="text-sm text-gray-600 dark:text-gray-300" x-text="description"></p>
                <div x-show="action || cancel" class="mt-2 flex gap-2 flex-wrap">
                    <template x-if="action">
                        <button
                            type="button"
                            @click="handleAction()"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium bg-gray-900 text-white hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-gray-200 h-8 px-3"
                        >
                            <span x-text="action?.label || 'Action'"></span>
                        </button>
                    </template>
                    <template x-if="cancel">
                        <button
                            type="button"
                            @click="handleCancel()"
                            class="inline-flex items-center justify-center rounded-md text-sm font-medium border border-gray-300 bg-white text-gray-900 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 h-8 px-3"
                        >
                            <span x-text="cancel?.label || 'Cancel'"></span>
                        </button>
                    </template>
                </div>
            </div>
            @if(($toast['closeButton'] ?? config('livewire-toast.close_button', false)) || ($toast['dismissible'] ?? config('livewire-toast.dismissible', true)))
                <button
                    type="button"
                    @click="dismiss()"
                    class="shrink-0 rounded-md p-1 -m-1 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 dark:focus:ring-offset-gray-800 dark:focus:ring-gray-500"
                >
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </button>
            @endif
        </div>
    @endforeach
</div>
