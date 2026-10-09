{{-- Field form yang dipakai bersama oleh create & edit.
     REQ 5: pesan error per field (@error) + old input (old()). --}}
@php($editing = isset($post))

<div class="mb-6">
  <label for="title" class="mb-2 block text-sm font-bold uppercase tracking-wider">Judul</label>
  <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}"
         class="w-full border-2 bg-white px-3 py-2.5 focus:outline-none focus:ring-4 focus:ring-ember/30
                @error('title') border-red-600 @else border-ink @enderror">
  @error('title')
    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
  @enderror
</div>

<div class="mb-6">
  <label for="content" class="mb-2 block text-sm font-bold uppercase tracking-wider">Isi catatan</label>
  <textarea id="content" name="content" rows="10"
            class="w-full border-2 bg-white px-3 py-2.5 leading-relaxed focus:outline-none focus:ring-4 focus:ring-ember/30
                   @error('content') border-red-600 @else border-ink @enderror">{{ old('content', $post->content ?? '') }}</textarea>
  @error('content')
    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
  @enderror
</div>

<div class="mb-8">
  <label for="image" class="mb-2 block text-sm font-bold uppercase tracking-wider">
    Gambar <span class="font-normal normal-case tracking-normal text-stone-500">(opsional, maks. 2 MB)</span>
  </label>

  @if ($editing && $post->image_url)
    <img src="{{ $post->image_url }}" alt="Gambar saat ini" class="mb-3 h-32 border-2 border-ink object-cover">
    <p class="mb-2 text-xs text-stone-500">Pilih file baru untuk mengganti gambar di atas.</p>
  @endif

  <input type="file" id="image" name="image" accept="image/*"
         class="block w-full border-2 border-dashed border-ink bg-white p-3 text-sm file:mr-4 file:border-2 file:border-ink file:bg-paper file:px-4 file:py-1.5 file:font-semibold hover:file:bg-ember hover:file:text-white">
  @error('image')
    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
  @enderror
</div>

<div class="flex flex-wrap gap-3">
  <button type="submit"
          class="border-2 border-ink bg-ember px-6 py-2.5 font-bold text-white shadow-[4px_4px_0_0_#1f1a17] transition hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-[3px_3px_0_0_#1f1a17]">
    {{ $editing ? 'Simpan perubahan' : 'Terbitkan catatan' }}
  </button>
  <a href="{{ $editing ? route('posts.show', $post) : route('posts.index') }}"
     class="border-2 border-ink bg-white px-6 py-2.5 font-bold hover:bg-stone-100">Batal</a>
</div>
