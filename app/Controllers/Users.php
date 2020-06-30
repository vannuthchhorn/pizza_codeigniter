<?php namespace App\Controllers;
use App\Models\UserModel;
class Users extends BaseController
{
	// set login
	public function login()
	{
		helper(['form']);
		$data = [];
		
		if($this->request->getMethod() == "post"){
			$rules = [
				'email' => 'required|valid_email',
				'password' => 'required|validatUser[email,password]'
			];
			$errors = [
				'password' => [
					'validatUser' => 'You don\'t have account yet!! Please Register Now'
				]
			];

			if(!$this->validate($rules,$errors)){
				$data['validation'] = $this->validator;
			}else{
				$pizza = new UserModel();
				$user = $pizza->where('email',$this->request->getVar('email'))
							  ->first();
				$user = $pizza->where('password',$this->request->getVar('password'))
							  ->first();
				$this->setUserSession($user);
				// direct to rout dashboard
				return redirect()->to('dashboard');
			}
		}
		return view('auths/login',$data);
	}

	public function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'email' => $user['email'],
			'password' => $user['password'],
			'address' => $user['address'],
			'role' => $user['role'],
		];

		session()->set($data);
		return true;
	}	


	// for register account
	public function registerAccount()
	{
		helper(['form']);

		$data = [];

		if($this->request->getMethod() == "post"){
			$rules = [
				'email' => 'required|valid_email',
				'password' => 'required',
				'address' => 'required',
			];
			if(!$this->validate($rules)){
				$data['validation'] = $this->validator;
			}else{
				$pizza = new UserModel();

				$newData = [
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'address' => $this->request->getVar('address'),
					'role' => $this->request->getVar('role'),
				];

				$pizza->save($newData);
				$session = session();
				$session->setFlashdata('success','Register Successful');
				return redirect()->to('/');
			}

		}

		return view('auths/register',$data);
	}

	public function logout(){
		session()->destroy();
		return redirect()->to('/');
	}

}
