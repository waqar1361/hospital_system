<?php
	/**
	 * Created by PhpStorm.
	 * User: MMHaq
	 * Date: 30/01/2019
	 * Time: 3:52 PM
	 */
	
	namespace App;
	
	
	class CommonUtilities {
		public static function resultResponse($result){
			if($result){
				return response()->json($result, 200);
			}else{
				return response()->json($result, 500);
			}
		}
	}