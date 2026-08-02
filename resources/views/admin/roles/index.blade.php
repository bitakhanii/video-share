@extends('admin.layout')
@section('panel-content')

    <div class="card">
        <div class="card border-0 mb-4">
            <div class="card-header bg-primary text-white fs-4">افزودن نقش جدید</div>
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <label for="name">نام نقش</label>
                        @if($errors->has('name'))
                            <small class="form-text text-danger me-2">{{ $errors->first('name') }}</small>
                        @endif
                        <input class="form-control" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="persian_name">نام فارسی نقش</label>
                        @if($errors->has('persian_name'))
                            <small class="form-text text-danger me-2">{{ $errors->first('persian_name') }}</small>
                        @endif
                        <input class="form-control" name="persian_name" value="{{ old('persian_name') }}">
                    </div>

                    <button type="submit" class="btn btn-danger">ذخیره نقش</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card" style="margin-top: 20px;">
        <div class="card border-0 mb-4">
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
