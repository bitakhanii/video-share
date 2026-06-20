@extends('layout')

@section('content')

    <div class="row">
        <!-- Watch -->
        <div class="col-md-8">
            <div id="watch">

                <!-- Video Player -->
                @include('videos.show.video-player')

                <div class="video-share">
                    @include('videos.show.likes')

                    <!-- // Social -->
                    @include('videos.show.social')
                </div>
                <!-- // video-share -->
                <!-- // Video Player -->

                <!-- Chanels Item -->
                @include('videos.show.owner')
                <!-- // Chanels Item -->

                <!-- Comments -->
                @include('videos.show.comments')
                <!-- // Comments -->

            </div>
            <!-- // watch -->
        </div>
        <!-- // col-md-8 -->
        <!-- // Watch -->

        <!-- Related Posts-->
        @include('videos.show.related')
        <!-- // col-md-4 -->
        <!-- // Related Posts -->
    </div>

@endsection
