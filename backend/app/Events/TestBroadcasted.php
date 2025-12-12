<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestBroadcasted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public string $message)
    {
    }

    /**
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('public'),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'status' => 'ok',
            'message' => $this->message,
            'time' => now()->toIso8601String(),
        ];
    }

    public function broadcastAs(): string
    {
        return 'testBroadcasted';
    }
}
