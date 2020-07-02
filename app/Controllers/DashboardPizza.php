<?php namespace App\Controllers;
use App\Models\PizzaModel;
class DashboardPizza extends BaseController
{
	public function Login()
	{
		helper(['form']);
		$data = [];

		if($this->request->getMethod() == "post")
		{
			$rules = [
				'email' => 'required|valid_email',
				'password' => 'required|validatUser[email,password]'
			];
			$errors = [
				'password' => [
					'validatUser' => 'You don\'t have account yet!! Please Register'
				]
			];

			if(!$this->validate($rules,$errors))
			{
				$data['validation'] = $this->validator;
			}else{
				$pizzas = new UserModel();
				$user = $pizzas->where('email',$this->request->getVar('email'))
							  ->first();
				$user = $pizzas->where('password',$this->request->getVar('password'))
							  ->first();
				$this->setUserSession($user);
				// direct to rout dashboard
				return redirect()->to('dashboard');
			}
		}
		return view('auths/login', $data);
	}
	
	public function listOfPizza()
	{	
		$pizzas = new PizzaModel();
		// $pizzas->insert($data);
		$data['pizzaData'] = $pizzas->findAll();
		return view('index',$data);
	}
	

	// function for add pizza to the list
	public function addPizza()
	{
		helper(['form']);
		$data = [];
		if($this->request->getMethod() == "post")
		{
			$rules = [
				'name'=>'required',
				'price'=>'required',
				'ingredients'=>'required'
			];
		    if(!$this->validate($rules)){
				$data['validation'] = $this->validator;
				return redirect()->to("/dashboard");
			}else{			
				$pizzas = new PizzaModel();
				$pizzaData = array(
					'name'=>$this->request->getVar('name'),
					'price'=>$this->request->getVar('price'),
					'ingredients'=>$this->request->getVar('ingredients'),
				);
				$pizzas->addPizza($pizzaData);
				return redirect()->to("/dashboard");
			}
	    }	
		return view('index',$data);
	}

	// function for edit pizza
	public function editPizza($id)
	{
		$pizzas = new PizzaModel();
		$data['listPizza'] = $pizzas->find($id);

		
		return view('index',$data);
	}

	//function for update pizza
	public function updatePizza()
	{
		$pizzas = new PizzaModel();
		$pizzas->update($_POST['id'], $_POST);

		helper(['form']);
		$data = [];
		if($this->request->getMethod() == "post")
		{
			$rules = [
				'name'=>'required',
				'price'=>'required',
				'ingredients'=>'required'
			];
		    if(!$this->validate($rules)){
				$data['validation'] = $this->validator;
				return redirect()->to("/dashboard");
			}else{			
				$pizzas = new PizzaModel();
				$pizzaData = array(
					'name'=>$this->request->getVar('name'),
					'price'=>$this->request->getVar('price'),
					'ingredients'=>$this->request->getVar('ingredients'),
				);
				$pizzas->addPizza($pizzaData);
				return redirect()->to("/dashboard");
			}
	    }	
		return redirect()->to('/dashboard');
	}

   //delete pizzas
   
	public function deletePizza($id)
	{	
		$pizzas = new PizzaModel();
		$pizzas->delete($id);
		return redirect()->to('/pizzas');
	}
}

