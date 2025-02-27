<x-mail::message>
# ورود بدون رمز عبور

برای وارد شدن به سایت، لطفا روی دکمه‌ی زیر کلیک کنید.

<x-mail::button :url="$link">
ورود
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
