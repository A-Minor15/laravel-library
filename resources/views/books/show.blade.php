@extends('layouts.app')

@section('title', 'Book Preview')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-auto">
                    <h2>Book Preview</h2>
                </div>
                <div class="col"></div>
                <div class="col-auto">
                    <a href="{{ route('book.index') }}">
                        <button type="submit" class="btn btn-warning w-100">Back</button>
                    </a>
                </div>
                <div class="col-auto">
                    <a href="">
                        <button type="submit" class="btn btn-warning w-100">Edit this book</button>
                    </a>
                </div>
            </div>
            <div class="body">
                <div class="col-4">
                    <img src="{{ $book->cover_photo }}" alt="">
                </div>
                <div class="col">

                </div>
            </div>
        </div>
    </div>

@endsection
