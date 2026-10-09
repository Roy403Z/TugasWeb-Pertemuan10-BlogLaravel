@extends('layouts.app')

@section('title', 'Tempat Sampah')

@section('content')
  <p class="text-xs font-bold uppercase tracking-[0.2em] text-ember">Soft delete</p>
  <h1 class="mt-1 font-serif text-4xl font-black">Tempat Sampah</h1>
  <p class="mb-8 mt-1 text-sm text-stone-500">Catatan yang dihapus masih bisa dipulihkan dari sini.</p>

  <div class="space-y-4">
    @forelse ($posts as $post)
      <div class="flex flex-col gap-3 border-2 border-ink bg-white p-4 shadow-[4px_4px_0_0_#1f1a17] sm:flex-row sm:items-center sm:justify-between">
        <div>
          <p class="font-serif text-lg font-extrabold">{{ $post->title }}</p>
          <p class="text-xs text-stone-500">Dihapus {{ $post->deleted_at->diffForHumans() }}</p>
        </div>

        <div class="flex gap-3 text-sm font-bold">
          <form method="POST" action="{{ route('posts.restore', $post) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="border-2 border-ink bg-emerald-100 px-4 py-1.5 hover:bg-emerald-200">Pulihkan</button>
          </form>

          <form method="POST" action="{{ route('posts.force-delete', $post) }}"
                onsubmit="return confirm('Hapus permanen? Tindakan ini tidak bisa dibatalkan.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="border-2 border-red-600 px-4 py-1.5 text-red-600 hover:bg-red-600 hover:text-white">Hapus permanen</button>
          </form>
        </div>
      </div>
    @empty
      <p class="border-2 border-dashed border-ink bg-white p-10 text-center text-stone-600">
        Tempat sampah kosong.
      </p>
    @endforelse
  </div>

  <div class="mt-8">{{ $posts->links() }}</div>
@endsection
