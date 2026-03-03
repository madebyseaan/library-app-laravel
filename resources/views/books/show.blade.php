@extends('layouts.app')

@section('title', $book->title . ' - Library App')

@section('content')
<div class="card">
    <div class="header-actions">
        <h2>{{ $book->title }}</h2>
        <div style="display: flex; gap: 0.5rem;">
            @if($book->isAvailable())
                <a href="{{ route('borrows.create', $book) }}" class="btn btn-success">Borrow This Book</a>
            @endif
            <a href="{{ route('books.edit', $book) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this book?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <div class="book-info">
        <div class="book-info-item">
            <strong>Author</strong>
            <span>{{ $book->author }}</span>
        </div>
        <div class="book-info-item">
            <strong>ISBN</strong>
            <span>{{ $book->isbn }}</span>
        </div>
        <div class="book-info-item">
            <strong>Published Year</strong>
            <span>{{ $book->published_year ?? 'N/A' }}</span>
        </div>
        <div class="book-info-item">
            <strong>Status</strong>
            <span>
                @if($book->isAvailable())
                    <span class="badge badge-success">Available</span>
                @else
                    <span class="badge badge-danger">Not Available</span>
                @endif
            </span>
        </div>
        <div class="book-info-item">
            <strong>Total Quantity</strong>
            <span>{{ $book->quantity }}</span>
        </div>
        <div class="book-info-item">
            <strong>Available Quantity</strong>
            <span>{{ $book->available_quantity }}</span>
        </div>
    </div>

    <h3 style="margin-top: 2rem; margin-bottom: 1rem; color: #2c3e50;">Borrow History</h3>

    @if($book->borrowRecords->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Borrower Name</th>
                    <th>Borrower Email</th>
                    <th>Borrowed Date</th>
                    <th>Due Date</th>
                    <th>Returned Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($book->borrowRecords as $record)
                    <tr>
                        <td>{{ $record->borrower_name }}</td>
                        <td>{{ $record->borrower_email }}</td>
                        <td>{{ $record->borrowed_at->format('M d, Y') }}</td>
                        <td>{{ $record->due_date->format('M d, Y') }}</td>
                        <td>{{ $record->returned_at ? $record->returned_at->format('M d, Y') : '-' }}</td>
                        <td>
                            @if($record->isReturned())
                                <span class="badge badge-success">Returned</span>
                            @elseif($record->isOverdue())
                                <span class="badge badge-danger">Overdue</span>
                            @else
                                <span class="badge badge-warning">Borrowed</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #7f8c8d; padding: 2rem;">
            This book has never been borrowed.
        </p>
    @endif

    <div style="margin-top: 2rem;">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to Books</a>
    </div>
</div>
@endsection
