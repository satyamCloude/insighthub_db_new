<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AppEvents implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $user_id;
  public $message;

  public function __construct($user_id,$message)
  {
      $this->user_id = $user_id;
      $this->message = $message;
  }

  public function broadcastOn()
  {
      return ['cloud-techtiq-' . $this->user_id];
  }

  public function broadcastAs()
  {
      return 'app-event';
  }
}
