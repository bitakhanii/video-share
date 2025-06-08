@extends('layout')
@section('title', 'مقاله')
@section('content')

    <div class="justify-content-center">
        <div class="mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $topic->title }}</div>
                    <div class="card-body">
                        <p class="card-text">{{ $topic->text }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $topic->created_at }} توسط {{ $topic->user->name }}
                    </div>
                </div>
            </div>

            @foreach($topic->replies as $reply)
                <div class="col-md-8 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{ $reply->text }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            {{ $reply->created_at }} توسط {{ $reply->user->name }}
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-8">
                <form class="mt-5" action="{{ route('topic_reply.store', $topic) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name='text' class="form-control"
                                  placeholder="متن پیام خود را وارد کنید... "
                                  id="exampleFormControlTextarea1" rows="6"></textarea>
                    </div>
                    <button class="btn btn-primary">ارسال</button>
                </form>
            </div>
        </div>

    </div>

@endsection


