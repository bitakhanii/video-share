<x-mail::message>
# احراز هویت دومرحله‌ای

کد فعالسازی احراز هویت دومرحله‌ای شما به شرح زیر می‌باشد:

<x-mail::button :url="''">
    {{ $code }}
</x-mail::button>

کد را در باکس مربوطه قرار دهید.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
