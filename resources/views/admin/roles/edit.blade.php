@extends('admin.layout')
@section('panel-content')

    <div class="card">
        <div class="card border-0 mb-4">
            <div class="card-header bg-primary text-white fs-4">ویرایش نقش {{ $role->persian_name }}</div>
            <div class="card-body">
                <form action="{{ route('roles.update', $role) }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <label for="name">نام نقش</label>
                        @if($errors->has('name'))
                            <small class="form-text text-danger me-2">{{ $errors->first('name') }}</small>
                        @endif
                        <input class="form-control" name="name" value="{{ old('name', $role->name) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="persian_name">نام فارسی نقش</label>
                        @if($errors->has('persian_name'))
                            <small class="form-text text-danger me-2">{{ $errors->first('persian_name') }}</small>
                        @endif
                        <input class="form-control" name="persian_name"
                               value="{{ old('persian_name', $role->persian_name) }}">
                    </div>

                    <div class="card" style="margin-top: 50px;">
                        <div class="card border-0 mb-4">
                            <div class="card-header bg-primary text-white">افزودن دسترسی به نقش</div>
                            <div class="card-body">
                                @csrf
                                <ul class="list-group">
                                    @forelse($permissions as $permission)
                                        <li class="list-group-item">
                                            <input type="checkbox" class="form-check-input me-2"
                                                   {{ $role->permissions->contains($permission) ? 'checked' : '' }} name="permissions[]"
                                                   value="{{ $permission->name }}"
                                                   id="{{ 'permission'.$permission->id }}">
                                            <label
                                                for="{{ 'permission'.$permission->id }}">{{ $permission->persian_name }}</label>
                                        </li>
                                    @empty
                                        <p>دسترسی وجود ندارد!</p>
                                    @endforelse
                                </ul>
                                <button type="submit" class="btn btn-warning mt-3">ذخیره</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
