<?php namespace App\Controllers;
use App\Models\UserModel;

class Users extends BaseController
{
	public function index()
	{
        $data = [];
        helper(['form']);
		echo view('auths/login', $data);
    }

    public function btnCreateAccount()
    {
        $data = [];
        helper(['form']);

        if($this->request->getMethod() == 'post')
        {
            // let's do validatio here
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'address' => 'required|min_length[50]|max_length[200]',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            }else{
                // store user in database
                $model = new UserModel();
                $newData = [
                    'email' => $this->request('email'),
                    'password' => $this->request('password'),
                    'address' => $this->request('address')
                ];

                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Successful Registration');
                return redirect()->to('/');
            }
        }

        return view('auths/register', $data);
    }

    public function btnSigninAccount()
    {
        $data = [];
        helper(['form']);
        return view('auths/login', $data);
    }

    public function logined()
    {
        return view('index');
    }
}