@component('mail::message')

# Message Received!

Hello {{ $name }},

Thank you for reaching out to us! We've received your message with the subject **"{{ $subject }}"** and we're reviewing it carefully.

Our team will get back to you as soon as possible.

---

@component('mail::button', ['url' => config('app.url')])
Return to Our Website
@endcomponent

We appreciate your inquiry!<br>
{{ config('app.name') }} Team

@endcomponent
