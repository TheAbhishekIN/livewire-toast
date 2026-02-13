<?php

namespace TheAbhishekIN\LivewireToast\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class ToastContainer extends Component
{
    public array $toasts = [];

    public function getListeners(): array
    {
        return [
            'toast' => 'handleToast',
        ];
    }

    #[On('toast')]
    public function handleToast(array|string ...$params): void
    {
        $payload = $this->normalizePayload($params);
        if (empty($payload['title'] ?? null)) {
            return;
        }

        if (isset($payload['body']) && ! isset($payload['description'])) {
            $payload['description'] = $payload['body'];
            unset($payload['body']);
        }

        $this->toasts[] = array_merge([
            'id' => uniqid('toast-', true),
            'title' => '',
            'description' => null,
            'type' => 'default',
            'duration' => config('livewire-toast.duration', 4000),
            'dismissible' => config('livewire-toast.dismissible', true),
            'closeButton' => config('livewire-toast.close_button', false),
            'action' => null,
            'cancel' => null,
        ], $payload);
    }

    /**
     * @param  array<int, mixed>  $params
     * @return array<string, mixed>
     */
    private function normalizePayload(array $params): array
    {
        if (count($params) === 1) {
            $first = $params[0];
            if (is_array($first)) {
                return $first;
            }
            if (is_string($first)) {
                return ['title' => $first];
            }
        }

        $result = [];
        $keys = ['title', 'description', 'type', 'duration', 'dismissible', 'closeButton', 'action', 'cancel', 'id'];
        foreach ($params as $i => $value) {
            $key = $keys[$i] ?? 'title';
            $result[$key] = $value;
        }

        return $result;
    }

    public function dismiss(string $id): void
    {
        $this->toasts = array_values(array_filter($this->toasts, fn (array $t) => ($t['id'] ?? '') !== $id));
    }

    public function render()
    {
        return view('livewire-toast::toast-container');
    }
}
