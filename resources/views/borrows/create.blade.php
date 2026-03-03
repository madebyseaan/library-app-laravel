@extends('layouts.app')

@section('title', 'Borrow Book - Library App')

@section('content')
<div class="card">
    <h2>Borrow Book: {{ $book->title }}</h2>

    <div class="book-info" style="margin-bottom: 2rem;">
        <div class="book-info-item">
            <strong>Author</strong>
            <span>{{ $book->author }}</span>
        </div>
        <div class="book-info-item">
            <strong>ISBN</strong>
            <span>{{ $book->isbn }}</span>
        </div>
        <div class="book-info-item">
            <strong>Available Copies</strong>
            <span>{{ $book->available_quantity }} / {{ $book->quantity }}</span>
        </div>
    </div>

    <form action="{{ route('borrows.store', $book) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="borrower_name">Your Name *</label>
            <input type="text" id="borrower_name" name="borrower_name" value="{{ old('borrower_name') }}" required>
            @error('borrower_name')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="borrower_email">Your Email *</label>
            <input type="email" id="borrower_email" name="borrower_email" value="{{ old('borrower_email') }}" required>
            @error('borrower_email')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="due_date">Due Date *</label>
            <input type="date" id="due_date" name="due_date" value="{{ old('due_date', now()->addWeeks(2)->format('Y-m-d')) }}" min="{{ now()->addDay()->format('Y-m-d') }}" required>
            <span style="font-size: 0.875rem; color: #7f8c8d;">Default: 2 weeks from today</span>
            @error('due_date')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Confirm Borrow</button>
            <a href="{{ route('books.show', $book) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
