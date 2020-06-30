<?php namespace App\Controllers;
use App\Models\PizzaModel;
class DashboardPizza extends BaseController
{
	public function index()
	{	
		$pizzas = new PizzaModel();
		$data['listPizza'] = $pizzas->findAll();
		return view('index',$data);
	}

	public function addPizza(){
		helper(['form']);
		$data = [];
		if($this->request->getMethod() == "post"){
			$rules = [
				'name'=>'required',
				'price'=>'required',
				'ingredients'=>'required'
			];
		    if(!$this->validate($rules)){
				$data['validation'] = $this->validator;
				return redirect()->to("/dashboard");
			}
			else{			
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


	public function editPizza($id)
	{
		$pizzas = new PizzaModel();
		$data['listPizza'] = $pizzas->find($id);
		return view('index',$data);
	}


	public function updatePizza(){
		$pizzas = new PizzaModel();
		$pizzas->update($_POST['id'], $_POST);
		return redirect()->to('/dashboard');
	}

	public function deletePizza($id){
		$pizzas = new PizzaModel();
		$pizzas->find($id);
		$delete = $pizzas->delete($id);
		return redirect()->to("/dashboard");
	}
}
