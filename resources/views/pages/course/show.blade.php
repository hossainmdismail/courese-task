@extends('layout.app')

@section('content')
    <div class="container">
        <div class="mb-4">
            <a href="{{ route('course') }}" class="btn btn-sm btn-outline-secondary">⬅️ Back to Courses</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">{{ $course->title }}</h2>
                <p class="text-muted mb-1">{{ ucfirst($course->level) }}</p>
                <p class="mb-3">{{ $course->description }}</p>

                {{-- @if ($course->video_url)
                    <div class="mb-3">
                        <iframe width="100%" height="100" src="{{ $course->video_url }}" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                @endif --}}

                @if ($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail"
                        class="img-fluid rounded shadow-sm" style="max-width: 300px;">
                @endif
            </div>
        </div>

        <h4 class="mb-3">📦 Modules</h4>

        @forelse($course->modules as $module)
            <div class="card mb-3">
                <div class="card-header fw-bold">{{ $module->title }}</div>
                <div class="card-body">
                    @foreach ($module->contents as $content)
                        <div class="mb-3">
                            <span class="badge bg-secondary mb-1">{{ ucfirst($content->type) }}</span>

                            @if ($content->type === 'text')
                                <p>{{ $content->value }}</p>
                            @elseif ($content->type === 'image')
                                <img src="{{ $content->value }}" alt="Image" class="img-fluid rounded">
                            @elseif ($content->type === 'video')
                                {{-- <div class="ratio ratio-16x9">
                                    <iframe src="{{ $content->value }}" frameborder="0" allowfullscreen></iframe>
                                </div> --}}
                                <a href="{{ $content->value }}" target="_blank" class="btn btn-sm btn-outline-info">🎞️ Open
                                    Video </a>
                            @elseif ($content->type === 'link')
                                <a href="{{ $content->value }}" target="_blank" class="btn btn-sm btn-outline-info">🔗 Open
                                    Link</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p>No modules found.</p>
        @endforelse
    </div>
@endsection
