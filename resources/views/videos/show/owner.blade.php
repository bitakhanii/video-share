<div class="chanel-item d-flex align-items-center gap-3 py-3">
    <div class="chanel-thumb flex-shrink-0">
        <a href="#">
            <img src="{{ $video->owner_avatar }}" alt="" class="rounded-circle" style="width:56px; height:56px; object-fit:cover;">
        </a>
    </div>
    <div class="chanel-info flex-grow-1">
        <a class="title d-block fw-bold text-dark text-decoration-none" href="#">{{ $video->owner_name }}</a>
        <span class="subscribers text-muted small">436,414 اشتراک</span>
    </div>
    <a href="#" class="subscribe btn btn-danger rounded-pill px-4">اشتراک</a>
</div>
