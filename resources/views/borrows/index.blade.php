@extends('layouts.app')

@section('title', 'Borrow Records - Library App')

@section('content')
<div class="card">
    <h2>Borrow Records</h2>

    @if($borrowRecords->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Borrower Name</th>
                    <th>Borrower Email</th>
                    <th>Borrowed Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowRecords as $record)
                    <tr>
                        <td>
                            <a href="{{ route('books.show', $record->book) }}" style="color: #3498db; text-decoration: none;">
                                <strong>{{ $record->book->title }}</strong>
                            </a>
                        </td>
                        <td>{{ $record->borrower_name }}</td>
                        <td>{{ $record->borrower_email }}</td>
                        <td>{{ $record->borrowed_at->format('M d, Y') }}</td>
                        <td>{{ $record->due_date->format('M d, Y') }}</td>
                        <td>
                            @if($record->isReturned())
                                <span class="badge badge-success">Returned</span>
                            @elseif($record->isOverdue())
                                <span class="badge badge-danger">Overdue</span>
                            @else
                                <span class="badge badge-warning">Borrowed</span>
                            @endif
                        </td>
                        <td>
                            @if(!$record->isReturned())
                                <form action="{{ route('borrows.return', $record) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                                        Return Book
                                    </button>
                                </form>
                            @else
                                <span style="color: #7f8c8d; font-size: 0.875rem;">
                                    Returned {{ $record->returned_at->format('M d, Y') }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $borrowRecords->links() }}
        </div>
    @else
        <p style="text-align: center; color: #7f8c8d; padding: 2rem;">
            No borrow records yet. <a href="{{ route('books.index') }}">Browse books to borrow!</a>
        </p>
    @endif
</div>
@endsection
