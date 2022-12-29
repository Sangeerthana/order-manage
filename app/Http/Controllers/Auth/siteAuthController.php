<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class siteAuthController extends Controller {
	public function userRegister(Request $request) {
		$request->validate([
			'firstname' => 'required',
			'lastname' =>'required',
			'email' =>'required|unique:user,user_email',
			'contact' =>'required',
			'user_name' =>'required',
			'password' =>'required',
			'confirm_password' =>'required_with:password|same:password|min:6',
			'branch' =>'required',
			'role' =>'required'
		]);
		
		User:: create([
			'user_firstname'=>$request->firstname,
        	'user_lastname'=> $request->lastname,
        	'user_email'=> $request->email,
        	'user_contact'=> $request->contact,
        	'user_name'=> $request->user_name,
        	'user_password'=> Hash::make($request->password),
        	'user_branch'=> $request->branch,
        	'user_role'=> $request->role
		]);

		return response()
			->json([
				'message' => ['user create success ful..!']
			],200);
	}

	public function userAuth(Request $request) {
		$request->validate([
            'username' => 'required',
            'password' => 'required|min:6|max:32|string',
        ]);

		$getUser = User::whereUserName($request->username)
            ->first();

		if(empty($getUser)) {
			return Response()
				->json([
					'errors' => ['invalid User Name...!']
				], 422);
		}

		if(!Hash::check($request->password,$getUser->user_password)) {
            return Response()
                ->json([
                    'errors' => ['invalid password or user name']
                ], 422);
        } else {
			$role = $getUser->user_role;
			if($role == 1 ) {
				$message = [
					'This is admin page'
				];
			} else if($role == 2) {
				$message = [
					'This is staff page'
				];
			} else {
				$message = [
					'This is trainee page'
				];
			}
			return Response()
				->json([
					'message' => $message
				], 200);
		}
	}

	public function getUsers() {
		return User::all();
	}
}


