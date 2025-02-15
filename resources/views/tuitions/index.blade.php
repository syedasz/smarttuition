@extends('layouts.app')

@section('title', 'Tuition Listings')

@section('content')
<div class="container">
    <h2>Available Tuitions</h2>

    <!-- Search & Filter Form -->
    <form action="{{ route('tuitions.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by subject, category, or tutor" value="{{ request('search') }}">

        <select name="category" class="form-select me-2">
            <option value="all">All Categories</option>
            <option value="Primary" {{ request('category') == 'Primary' ? 'selected' : '' }}>Primary</option>
            <option value="Lower Secondary" {{ request('category') == 'Lower Secondary' ? 'selected' : '' }}>Lower Secondary</option>
            <option value="Upper Secondary" {{ request('category') == 'Upper Secondary' ? 'selected' : '' }}>Upper Secondary</option>
        </select>

        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Show "Add New Tuition" button only for tutors -->
    @if(auth()->check() && auth()->user()->is_tutor)
        <a href="{{ route('tuitions.create') }}" class="btn btn-primary mb-3">Add New Tuition</a>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Fee</th>
                <th>Category</th>
                <th>Max Students</th>
                <th>Tutor</th>
                <th>Photo</th>
                @auth
                    <th>Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($tuitions as $tuition)
                <tr>
                    <td>{{ $tuition->subject }}</td>
                    <td>{{ $tuition->fee }}</td>
                    <td>{{ $tuition->category }}</td>
                    <td>{{ $tuition->max_students }}</td>
                    <td>{{ $tuition->tutor->name ?? 'N/A' }}</td>
                    <td>
                        @if($tuition->image_url)
                            <img src="{{ asset('storage/' . $tuition->image_url) }}" alt="Tutor Photo" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td> <a href="{{ route('tuitions.show', $tuition->id) }}" class="btn btn-info">View</a> </td>
                    @auth
                        @if(auth()->user()->id === $tuition->tutor_id)
                            <td>
                               
                                <a href="{{ route('tuitions.edit', $tuition->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('tuitions.destroy', $tuition->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        @endif
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
    {{ $tuitions->appends(request()->query())->links() }}
    </div>
</div>
@endsection