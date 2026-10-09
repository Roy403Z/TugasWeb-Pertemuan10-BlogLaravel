@extends('layouts.app')

@section('title', 'Tulis Catatan')

@section('content')
  <p class="text-xs font-bold uppercase tracking-[0.2em] text-ember">Catatan baru</p>
  <h1 class="mb-8 mt-1 font-serif text-4xl font-black">Tulis Catatan Laravel</h1>

  {{-- REQ 7: @csrf wajib di semua form; enctype untuk upload gambar --}}
  <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data"
        class="max-w-2xl border-2 border-ink bg-white p-6 shadow-[6px_6px_0_0_#1f1a17] sm:p-8">
    @csrf
    @include('posts._form')
  </form>
@endsection
