<?php
	/**
	 * Created by PhpStorm.
	 * User: MMHaq
	 * Date: 30/01/2019
	 * Time: 5:13 PM
	 */
	
	namespace App\BaseClasses;
	
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Support\Facades\Schema;
	
	
	class BaseMigration extends Migration {
	
		public function commonColumns($table){
			$table->unsignedBigInteger('added_by');
			$table->softDeletes();
			$table->timestamps();
		}
		
	}