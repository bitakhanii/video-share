@extends('layout')

@section('title' , 'Send SMS')


@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <x-validation-errors></x-validation-errors>
                    <form action="{{ route('notification.sms.send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user">@lang('notification.users')</label>
                            <select name="user" class="form-control" id="user">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="text">@lang('notification.sms_text')</label>
                            <textarea name="text" rows="4" class="form-control">{{ old('text') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-info">{{ __('notification.send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
