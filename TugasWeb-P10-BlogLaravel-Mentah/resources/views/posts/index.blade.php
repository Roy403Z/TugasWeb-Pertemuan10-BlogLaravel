@extends('layouts.app')

@section('title', 'Semua Catatan')

@section('content')
  <div class="mb-10 flex flex-col gap-5 border-b-2 border-ink pb-6 sm:flex-row sm:items-end sm:justify-between">
    <div>
      <p class="text-xs font-bold uppercase tracking-[0.2em] text-ember">Belajar Laravel</p>
      <h1 class="mt-1 font-serif text-4xl font-black">Semua Catatan</h1>
      <p class="mt-1 text-sm text-stone-500">{{ $posts->total() }} catatan ditemukan</p>
    </div>

    {{-- BONUS: pencarian (GET, jadi tidak perlu @csrf) --}}
    <form method="GET" action="{{ route('posts.index') }}" class="flex">
      <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari judul atau isi…"
             class="w-56 border-2 border-r-0 border-ink bg-white px-3 py-2 text-sm focus:outline-none focus:ring-4 focus:ring-ember/30 sm:w-64">
      <button class="border-2 border-ink bg-ink px-4 py-2 text-sm font-bold text-white hover:bg-ember">Cari</button>
    </form>
  </div>

  <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($posts as $post)
      <x-card :title="$post->title" :href="route('posts.show', $post)" :image="$post->image_url">
        <p class="mb-5 flex-1 text-sm leading-relaxed text-stone-600">{{ $post->excerpt }}</p>

        <div class="flex items-center justify-between border-t-2 border-dashed border-stone-300 pt-3 text-xs">
          <span class="font-semibold text-stone-500">{{ $post->created_at->translatedFormat('d M Y') }}</span>
          <div class="flex items-center gap-3 font-bold">
            <a href="{{ route('posts.edit', $post) }}" class="hover:text-ember hover:underline">Edit</a>

            {{-- REQ 7: @csrf + @method('DELETE') --}}
            <form method="POST" action="{{ route('posts.destroy', $post) }}"
                  onsubmit="return confirm('Pindahkan catatan ini ke tempat sampah?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline">Hapus</button>
            </form>
          </div>
        </div>
      </x-card>
    @empty
      <p class="col-span-full border-2 border-dashed border-ink bg-white p-10 text-center text-stone-600">
        Belum ada catatan{{ request('q') ? ' yang cocok dengan "'.e(request('q')).'"' : '' }}.
        <a href="{{ route('posts.create') }}" class="font-bold text-ember underline">Tulis catatan pertama</a>.
      </p>
    @endforelse
  </div>

  {{-- REQ 8: pagination --}}
  <div class="mt-10">
    {{ $posts->links() }}
  </div>
@endsection
