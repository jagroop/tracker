<p>Hi, Good Evening ... below tasks have invalid inputs ( completion percentage , work hours ) . Please cross check.</p>
<br>
<h3>Tasks</h3>
<br>
<table style="{{ $css['table'] }}">
  <thead>
    <tr>
      <th style="{{ $css['th'] }}" width="20%">Project</th>
      <th style="{{ $css['th'] }}" width="10%">Developer</th>
      <th style="{{ $css['th'] }}" width="20%">Task</th>
      <th style="{{ $css['th'] }}" width="10%">Status</th>
      <th style="{{ $css['th'] }}" width="15%">Work Hours</th>
      <th style="{{ $css['th'] }}" width="15%">Billing Hours</th>
      <th style="{{ $css['th'] }}" width="10%">Progress</th>
    </tr>
  </thead>
    <tbody>
      @foreach($tasks as $task)
      <tr>
        <td style="{{ $css['td'] }}">{{ $task['project_name'] }}</td>
        <td style="{{ $css['td'] }}">{{ $task['assigned_to'] }}</td>
        <td style="{{ $css['td'] }}">{{ $task['task_name'] }}</td>
        <td style="{{ $css['td'] }}">{{ $task['task_status_formated'] }}</td>
        <td style="{{ $css['td'] }}">{{ $task['work_hours'] }}</td>
        <td style="{{ $css['td'] }}">{{ $task['billing_hours'] }}</td>
        <td style="{{ $css['td'] }}">{{ $task['completion_precentage'] }}%</td>
      </tr>
      @endforeach
    </tbody>
</table>
<br>
<br>
Thanks,<br>
Jagroop Singh