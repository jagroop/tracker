<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helpers\Tracker;

class DailyStatus extends Mailable
{
    use Queueable, SerializesModels;

    private $tasks;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tasksCollection = $this->tasks->map(function($item){          
          $value = [];
          $value['project_name']         = $item['project_name'];
          $value['assigned_to']          = $item['assigned_to'];
          $value['task_name']            = Tracker::sanitizeKeyword($item['task_name'], $wordsLimit = 50);
          $value['task_desc']            = Tracker::sanitizeKeyword($item['task_desc'], $wordsLimit = 120);
          $value['task_status_formated'] = $item['task_status_formated'];
          return array_values($value);
        })->toArray();

        $tableBuilder = new \MaddHatter\MarkdownTable\Builder();
            $tableBuilder->headers(['Project Name', 'Developer', 'Task', 'Description', 'Status'])
            ->align(['C', 'L', 'L', 'L','C'])
            ->rows($tasksCollection);

        $table = $tableBuilder->render();

        return $this->subject('Daily Projects status.')
            ->markdown('email.daily_status')
            ->with('table',  $table);
    }
}
