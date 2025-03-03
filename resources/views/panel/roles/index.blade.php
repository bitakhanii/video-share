@extends('panel.layout')
@section('panel-content')

    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white fs-4">افزودن نقش جدید</div>
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <label for="name">نام نقش</label>
                        <input class="form-control" name="name" value="{{ old('name') }}">
                        @if($errors->has('name'))
                            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="persian_name">نام فارسی نقش</label>
                        <input class="form-control" name="persian_name" value="{{ old('persian_name') }}">
                        @if($errors->has('persian_name'))
                            <small class="form-text text-danger">{{ $errors->first('persian_name') }}</small>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-danger">ذخیره نقش</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8" style="margin-top: 20px;">
        <div class="card">
            <div class="card-header bg-primary text-white fs-4">لیست نقش‌ها</div>
            <div class="card-body">
                <table class="table table-striped table-bordered text-end">
                    <thead class="table-dark">
                    <tr>
                        <th>نام نقش</th>
                        <th>نام فارسی نقش</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->persian_name }}</td>
                            <td>
                                <a href="{{ route('roles.edit', $role) }}" class="text-primary">ویرایش</a> |
                                <a href="#" class="text-danger">حذف</a>
                            </td>
                        </tr>
                    @empty
                        <p>نقشی وجود ندارد!</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
