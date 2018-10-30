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
<hr>
<h3>All running Projects Status</h3>
<br>
<table style="{{ $css['table'] }}">
  <thead>
    <tr>
      <th style="{{ $css['th'] }}" width="10%">Project</th>
      <th style="{{ $css['th'] }}" width="10%">Status</th>
      <th style="{{ $css['th'] }}" width="10%">Total Billing Hours</th>
      <th style="{{ $css['th'] }}" width="10%">Today Billing Hours</th>
      <th style="{{ $css['th'] }}" width="10%">Total Work Hours</th>
      <th style="{{ $css['th'] }}" width="10%">Today Work Hours</th>
    </tr>
  </thead>
    <tbody>
      @foreach($stats as $stat)
      <tr style="{{ ($stat['work_hours_today'] <= 0) ? $css['red_color'] : '' }}">
        <td style="{{ $css['td'] }}">{{ $stat['name'] }}</td>
        <td style="{{ $css['td'] }}">{{ $stat['status'] }}</td>
        <td style="{{ $css['td'] }}">{{ $stat['billing_hours'] }}</td>
        <td style="{{ $css['td'] }}">{{ $stat['billing_hours_today'] }}</td>
        <td style="{{ $css['td'] }}">{{ $stat['work_hours'] }}</td>
        <td style="{{ $css['td'] }}">{{ $stat['work_hours_today'] }}</td>
      </tr>
      @endforeach
    </tbody>
</table>
<br>
<p><strong>Note:</strong> Total <u>Billing and Work Hours</u> will be counted from 30-Oct-2018</p>
<br>
Thanks,<br>
Jagroop Singh