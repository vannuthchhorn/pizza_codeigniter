<?php namespace App\Models;

use CodeIgniter\Model;

class PizzaModel extends Model
{
    protected $table      = 'pizza';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = ['name','ingredients','price'];

    public function addPizza($PizzaInformation){
        $this->insert([
            'name' => $PizzaInformation['name'],
            'price' => $PizzaInformation['price'],
            'ingredients' => $PizzaInformation['ingredients'],
        ]); 
    }
}