<?php

namespace App\Events;

use App\Models\Win;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FakeWinEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Win $win)
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('wins'),
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'win' => [
                'id' => $this->win->id,
                'amount' => $this->win->amount,
                'random_username' => $this->win->random_username,
                'bet_amount' => $this->win->bet_amount,
                'game_id' => $this->win->game_id,
                'game' => $this->win->game ? [
                    'id' => $this->win->game->id,
                    'name' => $this->win->game->name,
                    'image' => $this->win->game->image,
                ] : null,
                'created_at' => $this->win->created_at->toISOString(),
            ]
        ];
    }
}
