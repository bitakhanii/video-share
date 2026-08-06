@extends('layout')

@section('title', 'جزئیات تیکت')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                {{-- Ticket --}}
                <div class="card shadow-lg border-0 rounded-4 mb-4">

                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">

                        <div>
                            <h4 class="mb-0">{{ $ticket->title }}</h4>
                        </div>

                        @auth('admin')
                            @if($ticket->isClosed())
                                <span class="badge bg-danger fs-6">
                                بسته شده
                            </span>
                            @else
                                <a href="{{ route('tickets.close', $ticket) }}"
                                   class="btn btn-sm btn-outline-light">
                                    بستن تیکت
                                </a>
                            @endif
                        @endauth

                    </div>

                    <div class="card-body">

                        <p class="mb-4" style="white-space: pre-line">
                            {{ $ticket->content }}
                        </p>

                        @if($ticket->file_path)
                            <a href="{{ $ticket->getFile() }}"
                               class="btn btn-outline-primary btn-sm">
                                📎 دانلود فایل پیوست
                            </a>
                        @endif

                    </div>

                    <div class="card-footer bg-light text-muted small d-flex justify-content-between">

                    <span>
                        ارسال توسط
                        <strong>{{ $ticket->user->name }}</strong>
                    </span>

                        <span>
                        {{ $ticket->created_at }}
                    </span>

                    </div>

                </div>

                {{-- Replies --}}
                @foreach($ticket->replies as $reply)

                    <div class="card border-0 shadow-sm mb-3">

                        <div class="card-body">

                            <p class="mb-0" style="white-space: pre-line">
                                {{ $reply->content }}
                            </p>

                        </div>

                        <div class="card-footer bg-white text-muted small d-flex justify-content-between">

                        <span>

                            @if($reply->repliable_type === \App\Models\Admin::class)
                                <span class="badge bg-primary me-2">
                                    مدیر
                                </span>
                            @else
                                <span class="badge bg-secondary me-2">
                                    کاربر
                                </span>
                            @endif

                            {{ $reply->repliable->name }}

                        </span>

                            <span>
                            {{ $reply->created_at }}
                        </span>

                        </div>

                    </div>

                @endforeach

                {{-- Reply Form --}}
                @unless($ticket->isClosed())

                    <div class="card shadow border-0 rounded-4 mt-5">

                        <div class="card-header bg-dark text-white">
                            پاسخ به تیکت
                        </div>

                        <div class="card-body">

                            <x-validation-errors></x-validation-errors>

                            <form action="{{ route('reply.store', $ticket) }}"
                                  method="POST">

                                @csrf

                                <div class="mb-3">

                                <textarea
                                    class="form-control"
                                    name="content"
                                    rows="6"
                                    placeholder="پاسخ خود را بنویسید..."></textarea>

                                </div>

                                <div class="d-grid">

                                    <button class="btn btn-dark btn-lg">
                                        ارسال پاسخ
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                @else

                    <div class="alert alert-danger text-center shadow-sm mt-4">
                        این تیکت بسته شده است و امکان ارسال پاسخ وجود ندارد.
                    </div>

                @endunless

            </div>

        </div>

    </div>

@endsection
