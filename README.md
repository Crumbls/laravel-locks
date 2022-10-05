# Laravel Locks
This is a very quick and dirty package to provide a similar tool to WordPress' post locks.

We have had entities that are being edited by more than one user at one time, which made users overwrite eachother
in real time.  This gives us a very basic implementation to add traits to check if a model is currently locked,
and to be able to lock or unlock it.

This is a brand-new package, so I haven't developed it out much beyond our needs.  If there is something missing that 
you'd like to see, message me on twitter @chasecmiller and we will see if we can make it happen.  I started to put 
together a facade, but have no need for it yet.

## Limitations
Down the road, we will work this out if there is the need for it.
- User's must use numeric IDs.
- Models must use numeric IDs.  

## Installation

`composer install crumbls/laravel-locks`

Add the \Crumbls\Lock\Traits\HasLock trait to your model.

To check if a model is locked:

`$model->isLocked()`

To check if a model is unlocked:

`$model->isUnlocked()`

To lock a model:

`$model->lock()->create()`
or
`\Lock::lock($model)`

To unlock a model:

`$model->lock()->delete()`
or
`\Lock::unlock($model)`

You may also listen to the \Crumbls\Lock\Events\ModelLocked and \Crumbls\Lock|events\ModelUnlocked events to know when a
model becomes locked or unlocked.  They both pass one reference, being the model affected.

## Filament
We love using Filament.  You can add a boolean column to the model for lock.id to see if an item is locked.  I will be
developing this out quite a bit in the next few weeks.

## Summary

This package really wasn't put together for public usage, but I was asked to release it.  If there are any issues,
let me know and I'll try to slate some time to fix it.