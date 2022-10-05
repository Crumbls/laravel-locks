<?php

namespace Crumbls\Lock\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelUnlocked
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @param  Illuminate\Database\Eloquent\Model $entity
	 * @return void
	 */
	public function __construct(public Model $entity) {}
}