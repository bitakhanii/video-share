@extends('layout')

@section('title' , 'Send Email')


@section('content')

    <x-alerts></x-alerts>

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <x-validation-errors></x-validation-errors>
                    <form action="{{ route('notification.email.send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user">{{ __('notification.users') }}</label>
                            <select name="user" class="form-control" id="user">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="text">{{ __('notification.email_types') }}</label>
                            <select name="email_type" class="form-control" id="">
                                @foreach($emailTypes as $key => $emailType)
                                    <option value="{{ $key }}">{{ $emailType }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">{{ __('notification.send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
