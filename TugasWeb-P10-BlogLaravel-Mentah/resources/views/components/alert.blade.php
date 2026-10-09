{{-- REQ 4: komponen #1 — <x-alert type="success|error">Pesan</x-alert> --}}
@props(['type' => 'success'])

@php
  $styles = [
    'success' => 'bg-emerald-100 text-emerald-900',
    'error'   => 'bg-red-100 text-red-900',
  ];
  $icons = ['success' => '✓', 'error' => '!'];
@endphp

<div role="alert" {{ $attributes->class([
    'mb-8 flex items-start gap-3 border-2 border-ink px-4 py-3 text-sm font-medium shadow-[4px_4px_0_0_#1f1a17]',
    $styles[$type] ?? $styles['success'],
]) }}>
  <span class="flex h-5 w-5 shrink-0 items-center justify-center border-2 border-ink bg-white text-xs font-black">{{ $icons[$type] ?? $icons['success'] }}</span>
  <div>{{ $slot }}</div>
</div>
