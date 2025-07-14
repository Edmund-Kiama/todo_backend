<h2>Hello {{ $task->user->name }},</h2>

<p>You have been assigned a new task:</p>

<ul>
  <li><strong>Title:</strong> {{ $task->title }}</li>
  <li><strong>Deadline:</strong> {{ $task->deadline }}</li>
  <li><strong>Status:</strong> {{ $task->status }}</li>
</ul>

<p>Please log in to your dashboard to view the task.</p>
