<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->paginate(20);
        return view('books.index', compact('books'));
    }

    public function createWithId()
    {
        return view('books.create-id');
    }

    public function storeWithId(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'image|max:3024|nullable', //3MB
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $coverPath = $request->file('cover')?->store('covers', 'public') ?? null;
        $book = Book::make($request->only([
            'title',
            'publisher_id',
            'author_id',
            'category_id',
        ]));
        $book->cover = $coverPath;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    public function createWithSelect()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create-select', compact('publishers', 'authors', 'categories'));
    }

    public function storeWithSelect(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'image|max:3024|nullable', //3MB
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $coverPath = $request->file('cover')?->store('covers', 'public') ?? null;
        $book = Book::make($request->only([
            'title',
            'publisher_id',
            'author_id',
            'category_id',
        ]));
        $book->cover = $coverPath;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    public function edit(Book $book)
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('books.edit', compact('book', 'publishers', 'authors', 'categories'));
    }

    public function show(Book $book)
    {
        // Carregando autor, editora e categoria do livro com eager loading
        $book->load(['author', 'publisher', 'category']);

        $users = User::all();

        return view('books.show', compact('book', 'users'));
    }


    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'image|max:3024|nullable', //3MB
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $coverPath = $request->file('cover')?->store('covers', 'public') ?? null;
        $book->cover = $coverPath;
        $book->update($request->only([
            'title',
            'publisher_id',
            'author_id',
            'category_id',
        ]));

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
    }

    public function destroy(Book $book)
    {
        if(Storage::disk('public')->fileExists($book->cover))
            Storage::disk('public')->delete($book->cover);

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livro apagado com sucesso.');
    }
}
