{{-- REQ 4: komponen #2 — <x-card :title="..." :href="..." :image="...">isi</x-card> --}}
@props(['title', 'href' => null, 'image' => null])

<article {{ $attributes->class(['flex flex-col overflow-hidden border-2 border-ink bg-white shadow-[5px_5px_0_0_#1f1a17] transition hover:-translate-y-0.5 hover:shadow-[7px_7px_0_0_#ef3b2d]']) }}>
  @if ($image)
    <img src="{{ $image }}" alt="{{ $title }}" class="h-40 w-full border-b-2 border-ink object-cover">
  @else
    <div class="h-2 bg-ember"></div>
  @endif

  <div class="flex flex-1 flex-col p-5">
    <h2 class="mb-3 font-serif text-xl font-extrabold leading-snug">
      @if ($href)
        <a href="{{ $href }}" class="hover:text-ember">{{ $title }}</a>
      @else
        {{ $title }}
      @endif
    </h2>

    {{ $slot }}
  </div>
</article>
