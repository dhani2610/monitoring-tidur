@component('mail::message')
{{-- # Introduction --}}

Berhasil Mendapatkan Token.

Token Change Password Anda : {{ $token }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
