@extends('layout')

@section('title', 'فایلها')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-11 mt-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-folder2-open me-2"></i>
                        فایل‌های من
                        <span class="badge bg-secondary ms-2">{{ $files->count() }}</span>
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4">پیش‌نمایش</th>
                            <th scope="col">نام فایل</th>
                            <th scope="col">نوع فایل</th>
                            <th scope="col">حجم فایل</th>
                            <th scope="col">زمان فایل</th>
                            <th scope="col">سطح دسترسی</th>
                            <th scope="col" class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($files as $file)
                            @php
                                $extension = strtolower(pathinfo($file->name, PATHINFO_EXTENSION));
                                $imageExtensions = ['jpg', 'jpeg', 'png'];
                                $videoExtensions = ['mp4', 'mov', 'mkv'];
                                $archiveExtensions = ['zip', 'rar'];
                                $fileUrl = route('files.download', $file);
                            @endphp
                            <tr>
                                <td class="ps-4" style="width: 80px;">
                                    <div
                                        class="rounded overflow-hidden bg-light d-flex align-items-center justify-content-center"
                                        style="width: 56px; height: 56px;">

                                        @if(in_array($extension, $imageExtensions))
                                            <img src="{{ $fileUrl }}" alt="{{ $file->name }}"
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        @elseif(in_array($extension, $videoExtensions))
                                            <video muted preload="metadata"
                                                   style="width: 100%; height: 100%; object-fit: cover;">
                                                <source src="{{ $fileUrl }}#t=0.1">
                                            </video>
                                        @elseif(in_array($extension, $archiveExtensions))
                                            <i class="bi bi-file-zip-fill fs-3 text-warning"></i>
                                        @else
                                            <i class="bi bi-file-earmark-fill fs-3 text-secondary"></i>
                                        @endif

                                    </div>
                                </td>
                                <td>
                                    <span class="fw-medium">{{ $file->name }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $file->type }}</span>
                                </td>
                                <td class="text-nowrap">{{ number_format($file->size / (1024 * 1024), 2) }} مگابایت</td>
                                <td>
                                    @if($file->time)
                                        {{ $file->time }} ثانیه
                                    @else
                                        <span class="text-muted">ندارد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($file->is_private)
                                        <span class="badge bg-danger-subtle text-danger-emphasis">
                                            <i class="bi bi-lock-fill"></i> خصوصی
                                        </span>
                                    @else
                                        <span class="badge bg-success-subtle text-success-emphasis">
                                            <i class="bi bi-unlock-fill"></i> عمومی
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center text-nowrap">
                                    @if(auth()->user()->hasRole('admin') || !$file->is_private)
                                        <a href="{{ route('files.download', $file) }}"
                                           class="btn btn-primary btn-sm"
                                           title="دانلود">
                                            <i class="bi bi-download"></i>
                                        </a>
                                        <a href="{{ route('files.delete', $file) }}"
                                           class="btn btn-outline-danger btn-sm ms-2"
                                           title="حذف"
                                           onclick="return confirm('از حذف این فایل مطمئنی؟')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    هنوز فایلی آپلود نشده
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <a href="{{ route('files.create') }}" class="btn btn-primary">آپلود فایل</a>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
