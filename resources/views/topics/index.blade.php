@extends('layout')
@section('title', 'تاپیک')
@section('content')

    <div class="justify-content-center">
        <div class="col-md-8">
            @foreach($topics as $topic)
                <div class="mt-5">
                    <div class="card">
                        <div class="card-header">
                            ارسال شده توسط {{ $topic->user->name }} در {{ (new
                            \Hekmatinasser\Verta\Verta())->format($topic->created_at) }}
                        </div>
                        <div class="card-body">
                            <article>
                                <a href="{{ route('topics.show', $topic) }}">
                                    <h6>{{ $topic->title }}</h6>
                                </a>
                            </article>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection


