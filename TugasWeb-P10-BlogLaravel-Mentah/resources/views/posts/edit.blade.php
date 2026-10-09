@extends('layouts.app')

@section('title', 'Edit Catatan')

@section('content')
  <p class="text-xs font-bold uppercase tracking-[0.2em] text-ember">Perbarui</p>
  <h1 class="mb-8 mt-1 font-serif text-4xl font-black">Edit Catatan</h1>

  {{-- REQ 7: @csrf + @method('PUT'). Route Model Binding: $post otomatis dari URL --}}
  <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data"
        class="max-w-2xl border-2 border-ink bg-white p-6 shadow-[6px_6px_0_0_#1f1a17] sm:p-8">
    @csrf
    @method('PUT')
    @include('posts._form')
  </form>
@endsection
