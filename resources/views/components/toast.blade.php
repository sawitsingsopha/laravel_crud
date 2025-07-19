@props(['type' => 'info', 'title' => '', 'message' => ''])

<?php
$colors = [
'success' => 'border-success-500 bg-success-50 text-success-500 dark:border-success-500/30 dark:bg-success-500/75',
'error' => 'border-error-500 bg-error-50 text-error-500 dark:border-error-500/30 dark:bg-error-500/75',
'warning' => 'border-warning-500 bg-warning-50 text-warning-500 dark:border-warning-500/30 dark:bg-warning-500/75',
'info' => 'border-blue-light-500 bg-blue-light-50 text-blue-light-500 dark:border-blue-light-500/30 dark:bg-blue-light-500/75',
];

$icons = [
'success' => '<svg class="fill-current" width="24" height="24" viewBox="0 0 24 24">
    <path d="M12 1.9C6.4 1.9 1.9 6.4 1.9 12s4.5 10.1 10.1 10.1S22.1 17.6 22.1 12 17.6 1.9 12 1.9zm3.6 8.8-3.8 3.8c-.3.3-.7.3-1 0l-1.6-1.6a.7.7 0 1 1 1-1l1 1 3.3-3.3a.7.7 0 0 1 1 1z" /></svg>',
'error' => '<svg class="fill-current" width="24" height="24" viewBox="0 0 24 24">
    <path d="M12 1.9C6.4 1.9 1.9 6.4 1.9 12s4.5 10.1 10.1 10.1 10.1-4.5 10.1-10.1S17.6 1.9 12 1.9zm1 14.6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm0-9.9v6.7a1 1 0 1 1-2 0V6.6a1 1 0 1 1 2 0z" /></svg>',
'warning' => '<svg class="fill-current" width="24" height="24" viewBox="0 0 24 24">
    <path d="M12 1.9C6.4 1.9 1.9 6.4 1.9 12s4.5 10.1 10.1 10.1S22.1 17.6 22.1 12 17.6 1.9 12 1.9zm0 15.5a1.2 1.2 0 1 1 0-2.4 1.2 1.2 0 0 1 0 2.4zm1-4.8h-2V7.2h2v5.4z" /></svg>',
'info' => '<svg class="fill-current" width="24" height="24" viewBox="0 0 24 24">
    <path d="M12 1.9C6.4 1.9 1.9 6.4 1.9 12s4.5 10.1 10.1 10.1S22.1 17.6 22.1 12 17.6 1.9 12 1.9zm1 14.5a1 1 0 1 1-2 0v-5a1 1 0 1 1 2 0v5zm0-7a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" /></svg>',
];
?>

<div class="rounded-xl p-4 shadow-md {{ $colors[$type] ?? $colors['info'] }}">
    <div class="flex items-start gap-3">
        <div class="mt-0.5">{!! $icons[$type] ?? '' !!}</div>
        <div class="flex-1">
            <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white">
                {{ $title }}
            </h4>
            <p class="text-sm text-gray-600 dark:text-gray-300">
                {{ $message }}
            </p>
        </div>
        <button onclick="this.closest('div.rounded-xl').remove()" class="ml-2 text-lg font-bold leading-none">&times;</button>
    </div>
</div>

