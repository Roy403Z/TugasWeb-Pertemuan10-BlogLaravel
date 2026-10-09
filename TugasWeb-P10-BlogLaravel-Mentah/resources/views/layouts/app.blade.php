<!doctype html>
{{-- ==================================================================
     REQ 3: Blade layout master — halaman lain memakai @extends('layouts.app')
            dan mengisi @section('content').
     Styling: Tailwind CDN (tanpa build step) dengan tema TERANG "editorial":
     kertas krem, tinta hitam, aksen merah Laravel, heading serif.
     darkMode: 'class' dipakai supaya class dark: bawaan pagination tidak
     ikut aktif saat OS pengguna memakai mode gelap.
     ================================================================== --}}
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Catatan Laravel') · Catatan Laravel</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,800;9..144,900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            serif: ['Fraunces', 'Georgia', 'serif'],
            sans:  ['Inter', 'system-ui', 'sans-serif'],
          },
          colors: {
            paper: '#faf6ef',
            ink:   '#1f1a17',
            ember: '#ef3b2d',
          },
        },
      },
    }
  </script>
</head>
<body class="min-h-screen bg-paper font-sans text-ink antialiased">
  <header class="border-b-2 border-ink bg-white">
    <div class="h-2 bg-ember"></div>
    <div class="mx-auto flex max-w-5xl flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
      <a href="{{ route('posts.index') }}" class="block">
        <span class="font-serif text-2xl font-black tracking-tight">Catatan <span class="text-ember">Laravel</span></span>
        <span class="block text-[11px] font-semibold uppercase tracking-[0.2em] text-stone-500">Blog belajar framework PHP</span>
      </a>

      <nav class="flex items-center gap-6 text-sm font-semibold">
        <a href="{{ route('posts.index') }}"
           class="border-b-2 pb-0.5 hover:border-ember {{ request()->routeIs('posts.index') ? 'border-ember' : 'border-transparent' }}">Semua Catatan</a>
        <a href="{{ route('posts.trash') }}"
           class="border-b-2 pb-0.5 hover:border-ember {{ request()->routeIs('posts.trash') ? 'border-ember' : 'border-transparent' }}">Tempat Sampah</a>
        <a href="{{ route('posts.create') }}"
           class="border-2 border-ink bg-ember px-4 py-2 text-white shadow-[3px_3px_0_0_#1f1a17] transition hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-[2px_2px_0_0_#1f1a17]">+ Tulis Catatan</a>
      </nav>
    </div>
  </header>

  <main class="mx-auto max-w-5xl px-6 py-12">
    {{-- REQ 6: flash message sukses / gagal, ditampilkan lewat komponen <x-alert> --}}
    @if (session('success'))
      <x-alert type="success">{{ session('success') }}</x-alert>
    @endif
    @if (session('error'))
      <x-alert type="error">{{ session('error') }}</x-alert>
    @endif
    @if ($errors->any())
      <x-alert type="error">Periksa kembali isian form — ada {{ $errors->count() }} kesalahan.</x-alert>
    @endif

    @yield('content')
  </main>

  <footer class="border-t-2 border-ink bg-white">
    <div class="mx-auto max-w-5xl px-6 py-6 text-center text-xs text-stone-500">
      Tugas Rutin 10 — Catatan Laravel (Blog CRUD) · Pemrograman Web · Hardiman G. Hutauruk
    </div>
  </footer>
</body>
</html>
