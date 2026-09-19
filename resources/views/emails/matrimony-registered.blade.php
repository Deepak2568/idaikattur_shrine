<x-mail::message>
# New matrimony registration

A new member registered on Sacred Heart Matrimony.

**Name:** {{ trim($customer->fname.' '.$customer->lname) }}  
**Email:** {{ $customer->email }}  
**Mobile:** {{ $customer->phone }}  
**Address:** {{ collect([$customer->address, $customer->city, $customer->state])->filter()->implode(', ') ?: '—' }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
