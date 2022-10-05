<?php

namespace Crumbls\Lock\Models;

use App\Jobs\BuildReport;
use App\Models\User;
use Crumbls\Lock\Events\ModelLocked;
use Crumbls\Lock\Events\ModelUnlocked;
use Illuminate\Database\Eloquent\Model;

/**
 * Our lock model.
 */
class Lock extends Model {
	/**
	 *
	 */
	public static function boot() {
		parent::boot();
		static::saving(function($entity) {
			if (!$entity->user && $user = \Auth::user()) {
				$entity->user()->associate($user);
			}
		});
		static::created(function($entity) {
			ModelLocked::dispatch($entity->model);
		});
		static::deleted(function($entity) {
			ModelUnlocked::dispatch($entity->model);
		});
	}

	public function model() {
		return $this->morphTo();
	}

	public function user() {
		return $this->belongsTo(User::class);
	}
}
