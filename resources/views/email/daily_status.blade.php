<p>Hello Sir, Good Evening ... here is the list of tasks team members worked on today.</p>

<table style="{{ $css['table'] }}">
  <thead>
    <tr>
      <th style="{{ $css['th'] }}" width="10%">Project</th>
      <th style="{{ $css['th'] }}" width="10%">Developer</th>
      <th style="{{ $css['th'] }}" width="20%">Task</th>
      <th style="{{ $css['th'] }}" width="45%">Description</th>
      <th style="{{ $css['th'] }}" width="10%">Status</th>
      <th style="{{ $css['th'] }}" width="5%">Progress</th>
    </tr>
  </thead>
    <tbody>
      @foreach($tasks as $task)
      <tr style="{{ ($task['completion_precentage'] == 100 && $task['task_status'] == 'done') ? $css['green_color'] : '' }}">
        <td style="{{ $css['td'] }}">{{ $task['project_name'] }}</td>
        <td style="{{ $css['td'] }}">{{ $task['assigned_to'] }}</td>
        <td style="{{ $css['td'] }}">{{ $task['task_name'] }}</td>
        <td style="{{ $css['td'] }}">{!! App\Helpers\Tracker::format($task['task_desc']) !!}</td>
        <td style="{{ $css['td'] }}">{{ $task['task_status_formated'] }}</td>
        <td style="{{ $css['td'] }}">{{ $task['completion_precentage'] }}%</td>
      </tr>
      @endforeach
    </tbody>
</table>
<br>
Thanks,<br>
Jagroop Singh