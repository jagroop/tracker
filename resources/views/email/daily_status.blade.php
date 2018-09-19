@component('mail::message')
## Hello Sir Good Evening here is the list of tasks team members worked on today
<br>
<br>
@component('mail::table')
{{ $table }}
@endcomponent
<br>
<br>
Thanks,<br>
Jagroop Singh
@endcomponent