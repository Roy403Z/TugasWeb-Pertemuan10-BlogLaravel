@extends('layouts.app')

@section('title', $post->title)

@section('content')
  <a href="{{ route('posts.index') }}" class="text-sm font-bold hover:text-ember">&larr; Semua catatan</a>

  <article class="mt-6 max-w-3xl border-2 border-ink bg-white p-6 shadow-[6px_6px_0_0_#1f1a17] sm:p-10">
    @if ($post->image_url)
      <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="mb-8 max-h-96 w-full border-2 border-ink object-cover">
    @endif

    <p class="text-xs font-bold uppercase tracking-[0.2em] text-ember">Catatan Laravel</p>
    <h1 class="mt-2 font-serif text-4xl font-black leading-tight">{{ $post->title }}</h1>
    <p class="mt-3 text-sm text-stone-500">
      Diterbitkan {{ $post->created_at->translatedFormat('l, d F Y') }}
      @if ($post->updated_at->gt($post->created_at))
        · diperbarui {{ $post->updated_at->diffForHumans() }}
      @endif
    </p>

    {{-- {{ }} otomatis di-escape (anti XSS); nl2br + e() menjaga baris baru tetap aman --}}
    <div class="mt-8 border-t-2 border-ink pt-8 text-lg leading-8 text-stone-800
                first-letter:float-left first-letter:mr-3 first-letter:font-serif first-letter:text-6xl first-letter:font-black first-letter:leading-[0.9] first-letter:text-ember">{!! nl2br(e($post->content)) !!}</div>

    <div class="mt-10 flex gap-3 border-t-2 border-ink pt-6">
      <a href="{{ route('posts.edit', $post) }}"
         class="border-2 border-ink bg-white px-5 py-2 text-sm font-bold hover:bg-stone-100">Edit</a>

      <form method="POST" action="{{ route('posts.destroy', $post) }}"
            onsubmit="return confirm('Pindahkan catatan ini ke tempat sampah?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="border-2 border-red-600 bg-white px-5 py-2 text-sm font-bold text-red-600 hover:bg-red-600 hover:text-white">
          Hapus
        </button>
      </form>
    </div>
  </article>
@endsection
