@component('mail::message')

# Hello {{ $name }}!

We've received a reply to your inquiry **"{{ $subject }}"**

---

{{ $message }}

---

@component('mail::button', ['url' => config('app.url')])
Visit Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team

@endcomponent
