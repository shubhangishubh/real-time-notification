<?php

namespace App\Events;

use App\Models\RealTask;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskEventCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public RealTask $realTask;

    /**
     * Create a new event instance.
     */
    public function __construct(RealTask $realTask)
    {
        $this->realTask = $realTask;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        //return new PrivateChannel('tasks');
        return new PrivateChannel('tasks.'.$this->realTask->user_id);

    }

    public function broadcastAs(): string
    {
        return 'realTask.created';
    }

    public function broadcastWith(): array
    {
        return [
        'task_id' => $this->realTask->id,
        'title' => $this->realTask->title,
        'user_id' => $this->realTask->user_id,
        'status' => $this->realTask->status,
        'created_at' => optional($this->realTask->created_at)?->toISOString(),
        ];
    }
}
