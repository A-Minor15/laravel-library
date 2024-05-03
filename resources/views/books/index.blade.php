@extends('layouts.app')

@section('Title', 'Book')

@section('content')

    <h3>Add new book</h3>
    <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control w-100" value="{{ old('title') }}" autofocus>
            @error('title')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="year_published" class="form-label">Year Published</label>
                    <input type="number" max-length="4" name="year_published" id="year_published" class="form-control" placeholder="YYYY" value="{{ old('year_published') }}">
                    @error('year_published')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col">
                    <label for="author_id" class="form-label">Author</label>
                    <select name="author_id" id="author_id" class="form-select">
                        <option>ANONYMOUS</option>
                        @forelse ($all_authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="cover-photo" class="form-label">Cover Photo <span class="fst-italic">(optional)</span></label>
            <div class="row justify-content-center">
                <div class="col">
                    <input type="file" name="cover_photo" id="cover_photo" class="form-control" aria-describedly="cover-info">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-plus me-1"></i>Add</button>
                </div>
                <div class="form-text" id="cover-info">
                    Acceptable formats: jpeg, jpg, png, gif only <br>
                    Maximum file size: 1048KB
                </div>
            </div>
            @error('cover_photo')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>
    </form>

    <hr class="my-5">

    <h3>Lists of books</h3>
    <ul class="list-group">
        @forelse($all_books as $book)
            <li class="list-group-item">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('book.show') }}">
                            {{ $book->title }}
                        </a>
                    </div>
                    <div class="col text-end">
                        <a href="" class="btn btn-outline-warning btn-sm border-0"><i class="fa-solid fa-file-pen"></i></a>
                        <a href="" class="btn btn-outline-danger btn-sm border-0"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </div>
            </li>
        @empty
            <h4 class="text-center">No books yet</h4>
        @endforelse
    </ul>
@endsection
