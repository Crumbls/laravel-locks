<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function getTable() : string {
		return with(new \Crumbls\Lock\Models\Lock())->getTable();
	}
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$table = $this->getTable();

		if (Schema::hasTable($table)) {
			return;
		}

		Schema::create($table, function (Blueprint $table) {
			$table->id();
			$table->morphs('model');
			$table->foreignIdFor(\App\Models\User::class);
			$table->dateTime('created_at')->default(null);
			$table->dateTime('updated_at')->default(null);
		});


		Schema::table($table, function (Blueprint $table) {
			$table->foreign('user_id')->references('id')->on(with(new \App\Models\User())->getTable());
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$table = $this->getTable();
		if (!Schema::hasTable($table)) {
			return;
		}
		Schema::drop($this->getTable());
	}
};