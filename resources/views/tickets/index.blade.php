@extends('layout')

@section('title', 'تیکت‌ها')

@section('content')

    <div class="container py-5">

        <div class="card shadow-lg border-0 rounded-4">

            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                <h4 class="mb-0">📩 تیکت‌ها</h4>

                @auth
                    <a href="{{ route('tickets.create') }}" class="btn btn-light btn-sm">
                        + ثبت تیکت جدید
                    </a>
                @endauth
            </div>

            <div class="card-body p-0">

                @if($tickets->isEmpty())

                    <div class="text-center py-5">
                        <h5 class="text-muted mb-3">هنوز هیچ تیکتی ثبت نشده است.</h5>

                        @auth
                            <a href="{{ route('tickets.create') }}" class="btn btn-dark">
                                ثبت اولین تیکت
                            </a>
                        @endauth
                    </div>

                @else

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                            <tr>
                                <th>عنوان</th>

                                @auth('admin')
                                    <th>کاربر</th>
                                @endauth

                                <th>اولویت</th>
                                <th>بخش</th>
                                <th>وضعیت</th>
                                <th>تاریخ ثبت</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($tickets as $ticket)

                                <tr>

                                    <td>
                                        <a href="{{ route('tickets.show', $ticket) }}"
                                           class="fw-semibold text-decoration-none">
                                            {{ $ticket->title }}
                                        </a>
                                    </td>

                                    @auth('admin')
                                        <td>{{ $ticket->user->email }}</td>
                                    @endauth

                                    <td>
                                        @if($ticket->priority == 2)
                                            <span class="badge bg-danger">
                                            {{ $ticket->priority_title }}
                                        </span>
                                        @elseif($ticket->priority == 1)
                                            <span class="badge bg-warning text-dark">
                                            {{ $ticket->priority_title }}
                                        </span>
                                        @else
                                            <span class="badge bg-success">
                                            {{ $ticket->priority_title }}
                                        </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($ticket->department == 0)
                                            <span class="badge bg-primary">
                                                فنی
                                            </span>
                                        @elseif($ticket->department == 1)
                                            <span class="badge bg-success">
                                                مالی
                                            </span>
                                        @else
                                            <span class="badge bg-info text-dark">
                                                پشتیبانی
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($ticket->status == 0)
                                            <span class="badge bg-secondary">
                                            {{ $ticket->status_title }}
                                        </span>
                                        @elseif($ticket->status == 1)
                                            <span class="badge bg-primary">
                                            {{ $ticket->status_title }}
                                        </span>
                                        @else
                                            <span class="badge bg-success">
                                            {{ $ticket->status_title }}
                                        </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $ticket->created_at  }}
                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>
                    </div>

                @endif

            </div>

        </div>

    </div>

@endsection
