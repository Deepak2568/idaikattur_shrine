<x-mail::message>
# New contact form message

Someone submitted the Sacred Heart Shrine contact form.

**Name:** {{ $contact->user_name }}  
**Email:** {{ $contact->email }}  
**Phone:** {{ $contact->phone }}  
**Subject:** {{ $contact->subject }}

**Message:**

{{ $contact->message }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
