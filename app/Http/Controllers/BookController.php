<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function index(Request $r) {
    $q = Book::query();

    if ($search = $r->query('q')) {
        $q->where(function($w) use ($search) {
            $w->where('title','like',"%$search%")
              ->orWhere('author','like',"%$search%");
        });
    }

    // default 24 item/halaman agar pas grid 4x6
    $perPage = (int) $r->query('per_page', 24);
    if ($perPage <= 0) $perPage = 24;

    $p = $q->orderBy('created_at','desc')->paginate($perPage);

    // kirim shape konsisten (FE membaca dari data.meta)
    return response()->json([
        'data' => $p->items(),
        'meta' => [
            'current_page' => $p->currentPage(),
            'last_page'    => $p->lastPage(),
            'per_page'     => $p->perPage(),
            'total'        => $p->total(),
        ],
    ]);
}


    public function store(Request $r) {
        try {
            $data = $r->validate([
                'title'  => 'required',
                'author' => 'required',
                'isbn'   => 'required|unique:books,isbn',
                'year'   => 'nullable|integer',
                'stock'  => 'integer|min:0',
                'cover'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $path = null;
            if ($r->hasFile('cover')) {
                $path = $r->file('cover')->store('covers', 'public');
            }

            $book = Book::create([
                'title'      => $data['title'],
                'author'     => $data['author'],
                'isbn'       => $data['isbn'],
                'year'       => $data['year'] ?? null,
                'stock'      => $data['stock'] ?? 0,
                'cover_path' => $path,
            ]);

            return response()->json($book->fresh(), 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function show(Book $book) { return $book; }

    public function update(Request $r, Book $book) {
        try {
            $data = $r->validate([
                'title'  => 'required',
                'author' => 'required',
                // penting: abaikan id buku yg sedang di-update agar tidak bentrok dgn dirinya sendiri
                'isbn'   => 'required|unique:books,isbn,'.$book->id,
                'year'   => 'nullable|integer',
                'stock'  => 'integer|min:0',
                'cover'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            if ($r->hasFile('cover')) {
                if ($book->cover_path && $book->cover_path !== 'covers/default.jpg' && Storage::disk('public')->exists($book->cover_path)) {
                    Storage::disk('public')->delete($book->cover_path);
                }
                $book->cover_path = $r->file('cover')->store('covers','public');
            }

            $book->fill([
                'title' => $data['title'],
                'author'=> $data['author'],
                'isbn'  => $data['isbn'],
                'year'  => $data['year'] ?? null,
                'stock' => $data['stock'] ?? 0,
            ])->save();

            return response()->json($book->fresh());
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function destroy(Book $book) {
        if ($book->cover_path && $book->cover_path !== 'covers/default.jpg' && Storage::disk('public')->exists($book->cover_path)) {
            Storage::disk('public')->delete($book->cover_path);
        }
        $book->delete();
        return response()->noContent();
    }
}
