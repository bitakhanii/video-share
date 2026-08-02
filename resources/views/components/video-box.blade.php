<style>
    .video-title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-size: 0.95rem;
        line-height: 1.3;
    }
</style>

<!-- video-item -->
<div class="col-lg-2 col-md-4 col-sm-6 d-flex">
    <div class="card shadow-sm border-0 h-100 w-100">
        <div class="position-relative">
            <a href="{{ route('videos.show', $video->slug) }}" class="ratio ratio-16x9 d-block">
                <img src="{{ $video->video_thumbnail }}" alt="{{ $video->name }}" class="object-fit-cover rounded-top">
            </a>
            <span class="badge bg-dark bg-opacity-75 position-absolute bottom-0 end-0 m-2">
                {{ $video->length_in_human }}
            </span>
        </div>

        <div class="card-body d-flex flex-column p-2">
            <div class="d-flex justify-content-between align-items-start gap-1">
                <a href="{{ route('videos.show', $video->slug) }}" class="card-title video-title mb-1 text-decoration-none text-dark">
                    {{ $video->name }}
                </a>
                @can('update', $video)
                    <a href="{{ route('videos.edit', $video->slug) }}" class="text-secondary">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                @endcan
            </div>

            <a class="text-muted small text-decoration-none mb-2" href="#">
                {{ $video->owner_name }}
                <i class="fa fa-check-circle text-primary"></i>
            </a>

            <div class="mt-auto pt-1 small text-muted d-flex flex-wrap gap-2">
                <span><i class="fa fa-eye"></i> {{ number_format($video->views) }} بازدید</span>
                <span><i class="fa fa-clock-o"></i> {{ $video->created_at }}</span>
            </div>

            @if($video->category_name)
                <span class="badge bg-light text-dark border mt-2 align-self-start">
                    <i class="fa fa-tag"></i> {{ $video->category_name }}
                </span>
            @endif
        </div>
    </div>
</div>
