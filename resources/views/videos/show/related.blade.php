<div class="col-md-4">
    @if($video->category)
        <x-related-videos :video="$video"></x-related-videos>
    @endif
</div>
