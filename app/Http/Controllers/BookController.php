<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    private $book;
    private $author;

    public function __construct(Book $book, Author $author) {
        $this->book = $book;
        $this->author = $author;
    }

    public function index() {
        $all_authors = $this->author->get();
        $all_books = $this->book->get();

        return view('books.index')
            ->with('all_books', $all_books)
            ->with('all_authors', $all_authors);
    }

    public function store(Request $request) {
        $request->validate([
            'title'             => 'required|min:1|max:50',
            'year_published'    => 'required|digits:4|integer|between:1800,2100',
            'cover_photo'             => 'mimes:jpg,jpeg,png,gif|max:1048'
        ],[
            'between' => 'The year published must be between 1800 - 2100'
        ]);

        $this->book->title = $request->title;
        $this->book->year_published = $request->year_published;
        $this->book->author_id = $request->author_id;
        if($request->cover_photo) {
            $this->book->cover_photo = $this->saveCover($request);
        }
        $this->book->save();

        return redirect()->back();
    }

    public function saveCover($request) {
        $cover_name = time(). "." . $request->cover_photo->extension();

        $request->cover_photo->storeAs('//public/build/images/', $cover_name);

        return $cover_name;
    }

    public function show() {
        return view('books.show');
    }
}
