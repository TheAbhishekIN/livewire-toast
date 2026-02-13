document.addEventListener('alpine:init', () => {
    if (Alpine.data('toastItem')) return;
    Alpine.data('toastItem', (toast) => ({
        id: toast.id,
        title: toast.title || '',
        description: toast.description ?? null,
        type: toast.type || 'default',
        duration: toast.duration || 4000,
        dismissible: toast.dismissible ?? true,
        action: toast.action ?? null,
        cancel: toast.cancel ?? null,
        visible: true,
        expand: window.LivewireToastExpand ?? false,
        timer: null,

        startTimer() {
            if (this.type === 'loading' || this.duration === 0) return;
            this.timer = setTimeout(() => this.dismiss(), this.duration);
        },

        pauseTimer() {
            if (this.timer) clearTimeout(this.timer);
        },

        resumeTimer() {
            if (this.type === 'loading' || this.duration === 0) return;
            this.timer = setTimeout(() => this.dismiss(), this.duration);
        },

        dismiss() {
            if (this.timer) clearTimeout(this.timer);
            this.visible = false;
            this.$wire?.call('dismiss', this.id);
        },

        handleAction() {
            if (this.action?.url) window.location.href = this.action.url;
            if (this.action?.event) window.dispatchEvent(new CustomEvent(this.action.event, { detail: { id: this.id, title: this.title } }));
            this.dismiss();
        },

        handleCancel() {
            if (this.cancel?.event) window.dispatchEvent(new CustomEvent(this.cancel.event, { detail: { id: this.id, title: this.title } }));
            this.dismiss();
        },
    }));
});
