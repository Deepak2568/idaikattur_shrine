<x-mail::message>
# New donation interest

Someone shared interest in donating to Sacred Heart Shrine, Idaikattur.

**Name:** {{ $donation->name }}  
**Email:** {{ $donation->email }}  
**Phone:** {{ $donation->phone }}  
**Address:** {{ $donation->address ?: '—' }}  
**Amount (interest):** {{ $donation->amount !== null ? '₹'.number_format((float) $donation->amount, 2) : 'Not specified' }}  

**Message:**  
{{ $donation->message ?: '—' }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
