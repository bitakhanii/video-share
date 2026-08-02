@extends('layout')

@section('content')

    <div class="container py-4">
        <div class="row gy-4">
            <!-- Watch -->
            <div class="col-lg-8">
                <div id="watch" class="card border-0 shadow-sm p-3 p-md-4">

                    <!-- Video Player -->
                    @include('videos.show.video-player')

                    <div
                        class="video-share d-flex flex-wrap align-items-center justify-content-between gap-3 py-3 border-top border-bottom my-3">
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
    </div>

@endsection
