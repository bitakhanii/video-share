@extends('layout')

@section('title', 'پیام')

@section('content')

    <div class="justify-content-center">
        <div class="mt-5">
            <div class="col-md-8">
                <div class="card">
                    @if(auth()->user()->isAdmin())
                        <div class="card-header">
                            {{ $ticket->title }}
                            @if($ticket->isClosed())
                                <span class="btn btn-danger float-right btn-sm">بسته شده</span>
                            @else
                                <a class="btn btn-danger float-right btn-sm"
                                   href="{{ route('tickets.close', $ticket) }}">بستن</a>
                            @endif
                        </div>
                    @endif

                    <div class="card-body">
                        <p class="card-text">{{ $ticket->content }}</p>
                        @if($ticket->file_path)
                            <a href="{{ $ticket->getFile() }}">دانلود پیوست</a>
                        @endif
                    </div>
                    <div class="card-footer text-muted">
                        {{ $ticket->created_at . ' توسط ' . $ticket->user->name }}
                    </div>
                </div>
            </div>

            @if($ticket->replies)
                @foreach($ticket->replies as $reply)
                    <div class="col-md-8 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">{{ $reply->content }}</p>
                            </div>
                            <div class="card-footer text-muted">
                                {{ $reply->created_at . ' توسط ' . $reply->repliable->name }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @if(!$ticket->isClosed())
                <div class="col-md-8">
                    <form class="mt-5" action="{{ route('reply.store', $ticket) }}" method="post">
                        @csrf
                        <div class="form-group">
                        <textarea name='content' class="form-control"
                                  placeholder="متن پیام خود را وارد کنید... "
                                  id="exampleFormControlTextarea1" rows="6"></textarea>
                        </div>
                        <button class="btn btn-primary">ارسال</button>
                    </form>
                </div>
            @endif

        </div>

    </div>

@endsection


