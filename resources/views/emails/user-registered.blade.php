<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 my-8">
    <!-- Header -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">خوش آمدید! 🎉</h1>
        <p class="text-gray-600">سلام {{ $user->name }}</p>
    </div>

    <!-- Info Table -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <div class="mb-4">
            <p class="text-sm text-gray-600">ایمیل</p>
            <p class="font-semibold text-gray-800">{{ $user->email }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">تاریخ عضویت</p>
            <p class="font-semibold text-gray-800">{{ verta($user->created_at)->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <!-- Button -->
    <a href="{{ url('/') }}" class="block text-center bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition mb-6">
        ورود به سایت
    </a>

    <!-- Footer -->
    <p class="text-center text-sm text-gray-600">
        با احترام،<br>
        تیم {{ config('app.name') }}
    </p>
</div>
</body>
</html>
