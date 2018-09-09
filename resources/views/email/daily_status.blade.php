@component('mail::message')
@foreach($content as $project)
# Project Name : {{ $project['project_name'] }}

@foreach($project['users'] as $user)
Developer : {{ $user['user_name'] }}
@component('mail::table')
{{ $user['tasks'] }}
@endcomponent
@endforeach
<br>
<br>
@endforeach
Thanks,<br>
Jagroop Singh
@endcomponent