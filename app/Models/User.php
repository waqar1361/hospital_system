<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
		use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'first_name',
			'last_name',
            'password',
			'date_birth',
			'address',
			'type',
			'salary',
			'email',
			'lic_no',
	    'added_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static function allUsers(){
    	$user = User::all();
    	return $user;
    }
    
    public static function paginatedUsers(){
    	$users = User::paginate(25);
    	return $users;
    }
    
    public static function getUser($id){
    	$user = User::where('id', $id)->first();
    	return $user ?? null;
    }
    
    public static function addUpdateUser($request, $id=0){
      $result = null;
    	if($id == 0){
      	$user = new self;
      }else{
      	$user = self::getUser($id);
      }
      if($user){
	      $user->first_name = $request['first_name'];
				$user->last_name = $request['last_name'];
				$user->date_birth = $request['date_birth'];
				$user->address = $request['address'];
				$user->type = $request['type'];
				if($request['password']){
					$user->password = Hash::make($request['password']);
				}
				$user->salary = $request['salary'];
				$user->email = $request['email'];
				$user->lic_no = $request['lic_no'];
				$user->added_by = Auth::id();
				$result = $user->save();
      }
      return $result;
    }
    
    public static function deleteUser($id){
    	$result = null;
    	if($id) {
		    $user   = self::getUser( $id );
		    $result = $user->delete();
	    }
	    return $result;
    }
    
    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
}
