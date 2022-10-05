<?php

namespace Crumbls\Lock;

use Crumbls\Lock\Traits\HasLock;
use Illuminate\Database\Eloquent\Model;

class Lock {
	/**
	 * Detect if a model has the HasLocks trait.
	 * Not efficient.
	 * @param Model $entity
	 * @return bool
	 */
	protected static function modelHasLocks(Model $entity) : bool {
		return in_array(HasLock::class, class_uses($entity));
	}

	/**
	 * Lock a model
	 * @param Model $entity
	 * @return bool
	 */
	public static function lock(Model $entity) : bool {
		if (!static::modelHasLocks($entity)) {
			return false;
		}
		if ($entity->isLocked()) {
			$entity->lock->updated_at = now();
			$entity->lock->save();
			return true;
		}
		$entity->lock()->create();
		return true;
	}

	/**
	 * Unlock a model
	 * @param Model $entity
	 * @return bool
	 */
	public static function unlock(Model $entity) : bool {
		if (!static::modelHasLocks($entity)) {
			return false;
		}
		if ($entity->isLocked()) {
			$entity->lock()->delete();
			return true;
		}
		return false;
	}
}