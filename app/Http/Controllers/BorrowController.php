<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowRecord;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of borrow records.
     */
    public function index()
    {
        $borrowRecords = BorrowRecord::with('book')
            ->orderBy('borrowed_at', 'desc')
            ->paginate(15);

        return view('borrows.index', compact('borrowRecords'));
    }

    /**
     * Show the form for borrowing a book.
     */
    public function create(Book $book)
    {
        if (!$book->isAvailable()) {
            return redirect()->route('books.show', $book)
                ->with('error', 'This book is not available for borrowing.');
        }

        return view('borrows.create', compact('book'));
    }

    /**
     * Store a newly created borrow record.
     */
    public function store(Request $request, Book $book)
    {
        if (!$book->isAvailable()) {
            return redirect()->route('books.show', $book)
                ->with('error', 'This book is not available for borrowing.');
        }

        $validated = $request->validate([
            'borrower_name' => 'required|string|max:255',
            'borrower_email' => 'required|email|max:255',
            'due_date' => 'required|date|after:today',
        ]);

        $validated['book_id'] = $book->id;
        $validated['borrowed_at'] = now();

        BorrowRecord::create($validated);

        // Decrease available quantity
        $book->decrement('available_quantity');

        return redirect()->route('books.show', $book)
            ->with('success', 'Book borrowed successfully!');
    }

    /**
     * Return a borrowed book.
     */
    public function return(BorrowRecord $borrowRecord)
    {
        if ($borrowRecord->isReturned()) {
            return redirect()->back()
                ->with('error', 'This book has already been returned.');
        }

        $borrowRecord->update(['returned_at' => now()]);

        // Increase available quantity
        $borrowRecord->book->increment('available_quantity');

        return redirect()->route('borrows.index')
            ->with('success', 'Book returned successfully!');
    }

    /**
     * Display the specified borrow record.
     */
    public function show(BorrowRecord $borrowRecord)
    {
        $borrowRecord->load('book');
        
        return view('borrows.show', compact('borrowRecord'));
    }
}
