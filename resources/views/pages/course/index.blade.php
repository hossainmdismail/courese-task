@extends('layout.app')
@section('content')
    <div class="mb-3">
        <a href="{{ route('course.create') }}" class="btn btn-primary">Create Course</a>
    </div>

    <div class="row">
        @forelse($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if ($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" class="card-img-top"
                            alt="{{ $course->title }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                            <span class="text-muted">No Thumbnail</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-info mb-2 w-fit-content">{{ ucfirst($course->level) }}</span>
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text text-truncate">{{ $course->description }}</p>


                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary mt-auto">📖 View Course</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No courses found.</p>
        @endforelse
    </div>
@endsection
