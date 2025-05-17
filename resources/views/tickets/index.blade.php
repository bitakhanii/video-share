@extends('layout')

@section('title', 'پیام ها')

@section('content')

    <div class="justify-content-center">
        <div class="mt-5">
            <table class="table table-bordered ">
                <thead>
                <tr>
                    <th>عنوان</th>
                    @auth('admin')
                        <th>کاربر</th>
                    @endauth
                    <th>اولویت</th>
                    <th>وضعیت</th>
                    <th>تاریخ ساخت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>
                            <a href="{{ route('tickets.show', $ticket) }}">{{ $ticket->title }}</a>
                        </td>
                        @auth('admin')
                            <td>{{ $ticket->user->email }}</td>
                        @endauth
                        <td>{{ $ticket->priority_title }}</td>
                        <td>{{ $ticket->status_title }}</td>
                        <td>{{ $ticket->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
