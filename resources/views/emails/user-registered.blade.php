<x-mail::message>
# Introduction

### Hello {{ $name }}

User Registered!

<x-mail::button :url="''">
OK!
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
