<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Terranet\Localizer\Models\Language;

class CreateLanguagesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('languages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('iso6391', 2)->unique();
			$table->char('locale', 5);
			$table->string('title', 30);
			$table->boolean('active')->default(1)->index();
			$table->boolean('is_default')->default(0)->index();
		});
		
		Language::unguard();
		Language::create(
		    ['id' => 1, 'title' => 'English', 'iso6391' => 'en', 'locale' => 'en_US', 'active' => true, 'is_default' => 1]
		);
		Language::reguard();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('languages');
	}

}
