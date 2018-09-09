<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $content = [];
        $i = 0;
        foreach ($this->tasks as $projectName => $items) {
          $content[$i]['project_name'] = $projectName;
          $j = 0;
          foreach ($items as $devName => $tasks) {
            $content[$i]['users'][$j]['user_name'] = $devName;            
            
            $tasksCollection = collect($tasks)->map(function($item){
              $value = [];
              $value['id']                   = $item['id'];
              $value['task_name']            = $item['task_name'];
              $value['task_desc']            = $item['task_desc'];
              $value['task_status_formated'] = $item['task_status_formated'];
              return array_values($value);
            })->toArray();

            $tableBuilder = new \MaddHatter\MarkdownTable\Builder();
            $tableBuilder->headers(['Task ID','Task', 'Description', 'Status'])
            ->align(['L','L', 'L','C'])
            ->rows($tasksCollection);
            
            $content[$i]['users'][$j]['tasks'] = $tableBuilder->render();   
            $j++;
          }
          $i++;          
        }
        return $this->subject('Daily Projects status.')
                    ->markdown('email.daily_status')
                    ->with('content',  $content);
    }
}
