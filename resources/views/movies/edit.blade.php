@extends('layouts.master')
@section('title', 'Edit Movie')
@section('content')
    <h2>Update New Movie</h2>
    {{-- proses update dan delete data --}}
    <form action="{{ route('movies.update', ['movie' => $movie->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        {{-- form kelengkapan update data : --}}
        {{-- 1. line 6 form action = route blablabla --}}
        {{-- 2. line 8 @method('PATCH') --}}
        {{-- 3. method HTML (line 6) = POST, method laravel = PATCH --}}
        {{-- 4. kalo error, run di terminal "php artisan cache:clear". lalu coba jalankan kembali.--}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title') ?? $movie->title }}">
                    {{-- "??" = null coalescing --}}
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="genre">Genre</label>
                <input type="text" class="form-control @error('genre') is-invalid @enderror" name="genre"
                    id="genre" value="{{ old('genre') ?? $movie->genre }}">
                @error('genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                rows="3">{{ old('description') ?? $movie->description }}
 </textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title">Year</label>
                <input type="number" class="form-control @error('year') is-invalid @enderror" name="year" id="year"
                    min="1900" max="2099" value="{{ old('year') ?? $movie->year }}">
                @error('year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="genre">Rating</label>
                <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror"
                    name="rating" id="rating" min="1" max="10"
                    value="{{ old('rating') ?? $movie->rating }}">
                @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
    </form>
@endsection
