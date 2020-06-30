<?php namespace App\Models;

use CodeIgniter\Model;

class PizzModel extends Model
{
    protected $table      = 'pizza';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = ['name','ingredients','price'];

    public function createPizza($PizzaInformation){
        $this->insert([
            'name' => $PizzaInformation['name'],
            'price' => $PizzaInformation['price'],
            'ingredients' => $PizzaInformation['ingredients'],
        ]); 
    }
}