@extends('panel.layout')
@section('panel-content')
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="card">
                            <div class="card-header bg-primary text-white fs-5">افزودن نقش به کاربر</div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @forelse($roles as $role)
                                        <li class="list-group-item">
                                            <input type="checkbox" class="form-check-input ms-2" {{ $user->roles->contains($role) ? 'checked' : '' }} name="roles[]"
                                                   value="{{ $role->name }}" id="{{ 'role' . $role->id }}">
                                            <label for="{{ 'role' . $role->id }}">{{ $role->persian_name }}</label>
                                        </li>
                                    @empty
                                        <p>نقشی وجود ندارد!</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8" style="margin-top: 20px;">
                    <div class="row">
                        <div class="card">
                            <div class="card-header bg-primary text-white">افزودن دسترسی به کاربر</div>
                            <div class="card-body">
                                @csrf
                                <ul class="list-group">
                                    @forelse($permissions as $permission)
                                        <li class="list-group-item">
                                            <input type="checkbox" class="form-check-input ms-2" {{ $user->permissions->contains($permission) ? 'checked' : '' }} name="permissions[]"
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
                </div>
            </div>
        </div>
    </form>
@endsection
