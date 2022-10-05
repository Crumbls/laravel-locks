<?php

namespace Crumbls\Lock\Facades;

use Illuminate\Support\Facades\Facade;

class Lock extends Facade
{
	protected static function getFacadeAccessor()
	{
	return 'lock';
	}
}