@extends('layouts.app')

@section('title', 'Ubah Postingan')

@section('content')
    <h1>Ubah postingan</h1>
    <form method="POST" action="{{ url("posts/$post->id") }}" class="form-control">
        {{-- jangan lupa tambahkan method patch --}}
        @method("PATCH")
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="3">{{ $post->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    <form method="POST" action="{{ url("posts/$post->id") }}" >
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
@endsection
