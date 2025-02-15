@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tuition Details</h2>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $tuition->subject }}</h3>
            <p><strong>Category:</strong> {{ $tuition->category }}</p>
            <p><strong>Fee:</strong> RM{{ $tuition->fee }}</p>
            <p><strong>Max Students:</strong> {{ $tuition->max_students }}</p>
            <td>{!! $tuition->description !!}</td>
            <p><strong>Posted by:</strong> {{ $tuition->tutor ? $tuition->tutor->name : 'Unknown Tutor' }}</p>
            <td>
    @if ($tuition->image_url)
        <img src="{{ asset('storage/' . $tuition->image_url) }}" alt="Tuition Image" width="100">
    @else
        No Image
    @endif
</td>
        </div>
    </div>

    <a href="{{ route('tuitions.index') }}" class="btn btn-primary mt-3">Back to Listings</a>
</div>
@endsection