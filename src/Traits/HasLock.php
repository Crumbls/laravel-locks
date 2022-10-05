<?php

namespace Crumbls\Lock\Traits;

use Crumbls\Lock\Models\Lock;

/**
 * Trait to give model locking to Laravel models.
 */
trait HasLock {

	/**
	 * Is this entity locked?
	 * @return bool
	 */
	public function isLocked() : bool {
		return $this->lock && $this->lock->exists;
	}

	/**
	 * Is this entity unlocked?
	 * @return bool
	 */
	public function isUnlocked() : bool {
		return !$this->isLocked();
	}

	/**
	 * Relationship for the lock.
	 * @return \Illuminate\Database\Eloquent\Relations\MorphOne
	 */
	public function lock() {
		return $this->morphOne(Lock::class, 'model');
	}
}