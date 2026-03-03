@extends('layouts.app')

@section('title', 'Books - Library App')

@section('content')
<div class="card">
    <div class="header-actions">
        <h2>All Books</h2>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
    </div>

    <form action="{{ route('books.index') }}" method="GET" class="search-box">
        <input type="text" name="search" placeholder="Search by title, author, or ISBN..." value="{{ $search ?? '' }}">
        <button type="submit" class="btn btn-primary">Search</button>
        @if($search)
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Clear</a>
        @endif
    </form>

    @if($books->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Published Year</th>
                    <th>Available / Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td><strong>{{ $book->title }}</strong></td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->published_year ?? 'N/A' }}</td>
                        <td>{{ $book->available_quantity }} / {{ $book->quantity }}</td>
                        <td>
                            @if($book->isAvailable())
                                <span class="badge badge-success">Available</span>
                            @else
                                <span class="badge badge-danger">Not Available</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('books.show', $book) }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $books->links() }}
        </div>
    @else
        <p style="text-align: center; color: #7f8c8d; padding: 2rem;">
            @if($search)
                No books found matching "{{ $search }}".
            @else
                No books in the library yet. <a href="{{ route('books.create') }}">Add the first book!</a>
            @endif
        </p>
    @endif
</div>
@endsection
