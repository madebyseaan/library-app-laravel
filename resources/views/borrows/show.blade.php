@extends('layouts.app')

@section('title', 'Borrow Record Details - Library App')

@section('content')
<div class="card">
    <h2>Borrow Record Details</h2>

    <div class="book-info">
        <div class="book-info-item">
            <strong>Book Title</strong>
            <span>
                <a href="{{ route('books.show', $record->book) }}" style="color: #3498db; text-decoration: none;">
                    {{ $record->book->title }}
                </a>
            </span>
        </div>
        <div class="book-info-item">
            <strong>Author</strong>
            <span>{{ $record->book->author }}</span>
        </div>
        <div class="book-info-item">
            <strong>Borrower Name</strong>
            <span>{{ $record->borrower_name }}</span>
        </div>
        <div class="book-info-item">
            <strong>Borrower Email</strong>
            <span>{{ $record->borrower_email }}</span>
        </div>
        <div class="book-info-item">
            <strong>Borrowed Date</strong>
            <span>{{ $record->borrowed_at->format('M d, Y H:i') }}</span>
        </div>
        <div class="book-info-item">
            <strong>Due Date</strong>
            <span>{{ $record->due_date->format('M d, Y') }}</span>
        </div>
        <div class="book-info-item">
            <strong>Returned Date</strong>
            <span>{{ $record->returned_at ? $record->returned_at->format('M d, Y H:i') : 'Not returned yet' }}</span>
        </div>
        <div class="book-info-item">
            <strong>Status</strong>
            <span>
                @if($record->isReturned())
                    <span class="badge badge-success">Returned</span>
                @elseif($record->isOverdue())
                    <span class="badge badge-danger">Overdue</span>
                @else
                    <span class="badge badge-warning">Borrowed</span>
                @endif
            </span>
        </div>
    </div>

    <div style="margin-top: 2rem; display: flex; gap: 1rem;">
        @if(!$record->isReturned())
            <form action="{{ route('borrows.return', $record) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Return Book</button>
            </form>
        @endif
        <a href="{{ route('borrows.index') }}" class="btn btn-secondary">Back to Records</a>
    </div>
</div>
@endsection
