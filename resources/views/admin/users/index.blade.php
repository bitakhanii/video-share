@extends('admin.layout')
@section('panel-content')
    <div class="card">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                <span class="fs-5 fw-bold">لیست کاربران</span>
                <span class="badge bg-white text-primary">{{ $users->count() }} کاربر</span>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle text-end mb-0">
                        <thead class="table-dark">
                        <tr>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>نقش‌ها</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td class="text-muted">{{ $user->email }}</td>
                                <td>
                                    @forelse($user->roles as $role)
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis border me-1">
                                                {{ $role->persian_name }}
                                            </span>
                                    @empty
                                        <span class="text-muted small">بدون نقش</span>
                                    @endforelse
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('users.edit', $user) }}"
                                       class="btn btn-sm btn-outline-primary me-2">
                                        ویرایش
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger">
                                        حذف
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    کاربری وجود ندارد!
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="card-footer bg-white">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
