@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Tuition</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tuitions.update', $tuition->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ $tuition->subject }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fee</label>
            <input type="number" name="fee" class="form-control" value="{{ $tuition->fee }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-control" required>
                <option value="Primary" {{ $tuition->category == 'Primary' ? 'selected' : '' }}>Primary</option>
                <option value="Lower Secondary" {{ $tuition->category == 'Lower Secondary' ? 'selected' : '' }}>Lower Secondary</option>
                <option value="Upper Secondary" {{ $tuition->category == 'Upper Secondary' ? 'selected' : '' }}>Upper Secondary</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Max Students</label>
            <input type="number" name="max_students" class="form-control" value="{{ $tuition->max_students }}" required>
        </div>
        <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea id="editor" name="description" class="form-control">{{ $tuition->description }}</textarea>
</div>
    </div>
        <!-- Image Upload -->
        <div class="mb-3">
            <label class="form-label">Upload Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- Show existing image -->
        @if ($tuition->image_url)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $tuition->image_url) }}" alt="Tuition Image" class="img-thumbnail" width="200">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Update Tuition</button>
    </form>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            height: 200
        });
    </script>
@endsection