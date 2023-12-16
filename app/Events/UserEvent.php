<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private readonly ?int $userId,
        private readonly string $event,
        private readonly ?int $eventId = null,
        private readonly ?int $timestamp = null
    ) {}

    public function broadcastWith()
    {
        $user = auth()->user();
        return [
            'id' => $this->eventId ?? null,
            'event' => $this->event,
            'timestamp' => $this->timestamp ?? time(),
            'user' => [
                'id' => $user?->id,
                'name' => $user?->name,
                'avatar' => $user?->getAvatarUrl(),
            ],
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.'.$this->userId),
        ];
    }
}
