<?php
	
	namespace App\Http\Controllers;
	
	use App\CommonUtilities;
    use App\User;
    use App\Http\Requests\UserRequest;
    use Illuminate\Http\Request;
    
    class UserController extends Controller {
        
        public function __construct() {
            $this->middleware('admin');
        }
        
		public function viewAll() {
			try {
				$users = User::allUsers();
				return view( 'users.index' )->with( compact( 'users' ) );
			} catch ( \Exception $e ) {
				return $e->getMessage();
			}
		}
        
        public function createUser() {
            return view('users.create');
		}
		
		public function addUser( UserRequest $request ) {
			try {
				$result = User::addUpdateUser( $request );
				
				return CommonUtilities::resultResponse( $result );
			} catch ( \Exception $exception ) {
				return $exception->getMessage();
			}
		}
		
		public function updateUser( Request $request, $id ) {
			try {
				$result = User::addUpdateUser( $request, $id );
				
				return CommonUtilities::resultResponse( $result );
			} catch ( \Exception $exception ) {
				return $exception->getMessage();
			}
		}
		
		public function deleteUser( $id ) {
			try {
				$result = User::deleteUser( $id );
				
				return CommonUtilities::resultResponse( $result );
			} catch ( \Exception $e ) {
				return $e->getMessage();
			}
		}
		
		public function getUser( $id ) {
			try {
				$user = User::getUser( $id );
				return view('users.edit')->with(compact('user'));
			} catch ( \Exception $exception ) {
				return $exception->getMessage();
			}
		}
		
		
	}
