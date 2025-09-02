<?php

namespace App\Listeners;

use App\Events\TaskEventCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class RealTaskApiListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskEventCreated $event)
    {
        $data = $event->taskData;

        Http::post(url('/api/tasks'), $data);
    }
  
}
