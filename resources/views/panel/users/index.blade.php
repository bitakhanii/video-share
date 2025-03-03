@extends('panel.layout')
@section('panel-content')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white fs-4">لیست کاربران</div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered text-end">
                            <thead class="table-dark">
                            <tr>
                                <th>نام</th>
                                <th>ایمیل</th>
                                <th>نقش‌ها</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge bg-secondary">{{ $role->persian_name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user) }}" class="text-primary">ویرایش</a> |
                                        <a href="#" class="text-danger">حذف</a>
                                    </td>
                                </tr>
                            @empty
                                <p>کاربری وجود ندارد!</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

@endsection
