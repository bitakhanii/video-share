@php $likeable = $like->likeable @endphp

<p style="background-color: #35c6ea;">Hi {{ $likeable->user->name }}</p>
@if(class_basename($likeable) == 'Video')
    Your {{ class_basename($likeable) }} with title {{ $likeable->name }} was
    @if($like->vote == 1) Liked @else Disliked @endif !
@else
    Your {{ class_basename($likeable) }} on video {{ $likeable->video->name }} was
    @if($like->vote == 1) Liked @else Disliked @endif !
@endif
