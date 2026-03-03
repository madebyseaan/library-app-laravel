@extends('layouts.app')

@section('title', 'Edit Book - Library App')

@section('content')
<div class="card">
    <h2>Edit Book: {{ $book->title }}</h2>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required>
            @error('title')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Author *</label>
            <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>
            @error('author')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="isbn">ISBN *</label>
            <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}" required>
            @error('isbn')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="published_year">Published Year</label>
            <input type="number" id="published_year" name="published_year" value="{{ old('published_year', $book->published_year) }}" min="1000" max="{{ date('Y') + 1 }}">
            @error('published_year')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Quantity *</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="1" required>
            <span style="font-size: 0.875rem; color: #7f8c8d;">Current: {{ $book->quantity }}, Available: {{ $book->available_quantity }}</span>
            @error('quantity')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Update Book</button>
            <a href="{{ route('books.show', $book) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
