@extends('layout')
@section('title' , 'آپلود فایل')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card shadow-sm">
                    <div class="card-header">
                        آپلود فایل
                    </div>
                    <div class="card-body">

                        <x-validation-errors></x-validation-errors>

                        <form action="{{ route('files.upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="customFile" class="form-label">فایل خود را انتخاب کنید</label>
                                <input type="file" name="file" class="form-control" id="customFile">
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="is-private" name="is-private">
                                <label class="form-check-label" for="is-private">به صورت خصوصی آپلود شود</label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">آپلود فایل</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
