<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900" x-data="{ sidebarOpen: false }">
        @php
            $notificationState = session('success') ? 'success' : (session('error') ? 'error' : null);
            $notificationMessage = session('success') ?? session('error');
        @endphp
        <div class="flex h-screen overflow-hidden">
            @include('layouts.sidebar')

            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
                @include('layouts.topbar')

                <main class="w-full h-full p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <div id="delete-confirmation-modal" class="fixed inset-0 z-[90] hidden">
            <div class="absolute inset-0 bg-slate-950/45 backdrop-blur-[2px]" data-modal-close="confirm"></div>
            <div class="relative flex min-h-screen items-center justify-center p-4">
                <div class="w-full max-w-md rounded-[28px] border border-slate-200 bg-white p-7 shadow-[0_32px_80px_-32px_rgba(15,23,42,0.42)]">
                    <div class="mb-6 flex items-start gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-red-500 ring-1 ring-red-100">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-red-500">Aksi Penting</p>
                            <h3 class="mt-2 text-2xl font-semibold tracking-tight text-slate-900">Konfirmasi</h3>
                            <p id="delete-confirmation-message" class="mt-2 text-sm leading-6 text-slate-500">Apakah Anda yakin ingin menghapus data ini?</p>
                        </div>
                    </div>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <button type="button" id="delete-confirmation-cancel" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900">
                            Tidak
                        </button>
                        <button type="button" id="delete-confirmation-submit" class="inline-flex items-center justify-center rounded-2xl bg-red-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-red-600/20 transition hover:bg-red-700">
                            Iya
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if($notificationState && $notificationMessage)
            <div
                id="action-feedback-modal"
                class="fixed inset-0 z-[95] hidden"
                data-state="{{ $notificationState }}"
                data-message="{{ $notificationMessage }}"
            >
                <div class="absolute inset-0 bg-slate-950/45 backdrop-blur-[2px]" data-modal-close="feedback"></div>
                <div class="relative flex min-h-screen items-center justify-center p-4">
                    <div class="w-full max-w-md rounded-[28px] border border-slate-200 bg-white p-7 shadow-[0_32px_80px_-32px_rgba(15,23,42,0.42)]">
                        <div class="flex flex-col items-center text-center">
                            <div id="action-feedback-icon" class="flex h-20 w-20 items-center justify-center rounded-full"></div>
                            <h3 id="action-feedback-title" class="mt-5 text-3xl font-semibold tracking-tight text-slate-900"></h3>
                            <p id="action-feedback-message" class="mt-3 max-w-sm text-sm leading-6 text-slate-500"></p>
                        </div>

                        <div class="mt-8">
                            <button type="button" id="action-feedback-close" class="inline-flex w-full items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold text-white transition">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <script>
            (() => {
                const body = document.body;
                const confirmModal = document.getElementById('delete-confirmation-modal');
                const confirmMessage = document.getElementById('delete-confirmation-message');
                const confirmCancelButton = document.getElementById('delete-confirmation-cancel');
                const confirmSubmitButton = document.getElementById('delete-confirmation-submit');
                const feedbackModal = document.getElementById('action-feedback-modal');
                const feedbackIcon = document.getElementById('action-feedback-icon');
                const feedbackTitle = document.getElementById('action-feedback-title');
                const feedbackMessage = document.getElementById('action-feedback-message');
                const feedbackCloseButton = document.getElementById('action-feedback-close');
                let pendingDeleteForm = null;
                let openModalCount = 0;

                const lockScroll = () => {
                    openModalCount += 1;
                    body.style.overflow = 'hidden';
                };

                const unlockScroll = () => {
                    openModalCount = Math.max(0, openModalCount - 1);
                    if (openModalCount === 0) {
                        body.style.overflow = '';
                    }
                };

                const showModal = (modal) => {
                    if (!modal || !modal.classList.contains('hidden')) {
                        return;
                    }

                    modal.classList.remove('hidden');
                    lockScroll();
                };

                const hideModal = (modal) => {
                    if (!modal || modal.classList.contains('hidden')) {
                        return;
                    }

                    modal.classList.add('hidden');
                    unlockScroll();
                };

                window.openDeleteConfirmation = (form, message = 'Apakah Anda yakin ingin menghapus data ini?') => {
                    pendingDeleteForm = form;
                    if (confirmMessage) {
                        confirmMessage.textContent = message;
                    }
                    showModal(confirmModal);
                };

                const closeDeleteConfirmation = () => {
                    pendingDeleteForm = null;
                    hideModal(confirmModal);
                };

                const submitPendingDelete = () => {
                    if (!pendingDeleteForm) {
                        return;
                    }

                    const form = pendingDeleteForm;
                    pendingDeleteForm = null;
                    hideModal(confirmModal);
                    form.submit();
                };

                const setupFeedbackModal = () => {
                    if (!feedbackModal || !feedbackIcon || !feedbackTitle || !feedbackMessage || !feedbackCloseButton) {
                        return;
                    }

                    const isSuccess = feedbackModal.dataset.state === 'success';
                    feedbackTitle.textContent = isSuccess ? 'Berhasil!' : 'Gagal!';
                    feedbackMessage.textContent = isSuccess
                        ? (feedbackModal.dataset.message || 'Data berhasil dihapus.')
                        : (feedbackModal.dataset.message || 'Data gagal dihapus. Silakan coba lagi.');

                    feedbackIcon.className = isSuccess
                        ? 'flex h-20 w-20 items-center justify-center rounded-full bg-green-50 text-green-600 ring-8 ring-green-50/80'
                        : 'flex h-20 w-20 items-center justify-center rounded-full bg-red-50 text-red-600 ring-8 ring-red-50/80';

                    feedbackIcon.innerHTML = isSuccess
                        ? `<svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 13 4 4L19 7"/></svg>`
                        : `<svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12"/></svg>`;

                    feedbackCloseButton.textContent = isSuccess ? 'Kembali' : 'Tutup';
                    feedbackCloseButton.className = isSuccess
                        ? 'inline-flex w-full items-center justify-center rounded-2xl bg-green-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-green-700'
                        : 'inline-flex w-full items-center justify-center rounded-2xl bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700';

                    showModal(feedbackModal);
                };

                document.addEventListener('submit', (event) => {
                    const form = event.target;
                    if (!(form instanceof HTMLFormElement) || form.dataset.confirmDelete !== 'true') {
                        return;
                    }

                    event.preventDefault();
                    window.openDeleteConfirmation(
                        form,
                        form.dataset.confirmMessage || 'Apakah Anda yakin ingin menghapus data ini?'
                    );
                });

                document.addEventListener('click', (event) => {
                    const target = event.target.closest('[data-modal-close]');
                    if (!target) {
                        return;
                    }

                    if (target.dataset.modalClose === 'confirm') {
                        closeDeleteConfirmation();
                    }

                    if (target.dataset.modalClose === 'feedback') {
                        hideModal(feedbackModal);
                    }
                });

                confirmCancelButton?.addEventListener('click', closeDeleteConfirmation);
                confirmSubmitButton?.addEventListener('click', submitPendingDelete);
                feedbackCloseButton?.addEventListener('click', () => hideModal(feedbackModal));

                document.addEventListener('keydown', (event) => {
                    if (event.key !== 'Escape') {
                        return;
                    }

                    if (confirmModal && !confirmModal.classList.contains('hidden')) {
                        closeDeleteConfirmation();
                    }

                    if (feedbackModal && !feedbackModal.classList.contains('hidden')) {
                        hideModal(feedbackModal);
                    }
                });

                setupFeedbackModal();
            })();
        </script>
        @stack('scripts')
    </body>
</html>
