@extends('admin.layout')
@section('panel-content')
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white fs-5">افزودن نقش به کاربر</div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($roles as $role)
                        <li class="list-group-item">
                            <input class="form-check-input me-2" type="checkbox"
                                   {{ $user->roles->contains($role) ? 'checked' : '' }}
                                   name="roles[]" value="{{ $role->name }}"
                                   id="{{ 'role' . $role->id }}">
                            <label class="form-check-label" for="{{ 'role' . $role->id }}">
                                {{ $role->persian_name }}
                            </label>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted py-4">
                            نقشی وجود ندارد!
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white fs-5">افزودن دسترسی به کاربر</div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($permissions as $permission)
                        <li class="list-group-item">
                            <input class="form-check-input me-2" type="checkbox"
                                   {{ $user->permissions->contains($permission) ? 'checked' : '' }}
                                   name="permissions[]" value="{{ $permission->name }}"
                                   id="{{ 'permission' . $permission->id }}">
                            <label class="form-check-label" for="{{ 'permission' . $permission->id }}">
                                {{ $permission->persian_name }}
                            </label>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted py-4">
                            دسترسی وجود ندارد!
                        </li>
                    @endforelse
                </ul>

                <button type="submit" class="btn btn-warning mt-3 px-4">ذخیره</button>
            </div>
        </div>
    </form>
@endsection
