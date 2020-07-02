<?php namespace App\Controllers;
use App\Models\UserModel;
class Users extends BaseController
{
	public function registerAccount(){
        helper(['form']);
        $data = [];
        if($this->request->getMethod() =="post"){
            $rules = [
                'email' =>'required|valid_email',
                'password'=>'required',
                'address'=>'required'
			];
			//insert into database
            $pizzas = new UserModel();
            $newData = [
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
                'address' => $this->request->getVar('address'),
                'role' => $this->request->getVar('role'),
            ];

            $pizzas->insert($newData);
            $session = session();
            $session->setFlashdata('success','Register Successful');
            return redirect()->to('/');
        }
        return view('auths/register');

    }
    
    	// function for logout
		public function logout()
		{
			session()->destroy();
			return redirect()->to('/');
		}
}
	

