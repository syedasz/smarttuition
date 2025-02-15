@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create a New Tuition Post</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tuitions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fee" class="form-label">Tuition Fee (RM)</label>
            <input type="number" name="fee" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" class="form-control" required>
                <option value="Primary">Primary</option>
                <option value="Lower Secondary">Lower Secondary</option>
                <option value="Upper Secondary">Upper Secondary</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="max_students" class="form-label">Max Students</label>
            <input type="number" name="max_students" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Tuition</button>
    </form>
</div>
@endsection