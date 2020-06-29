<?php namespace App\Models;

use CodeIgniter\Model;
    class UserModel extends Model{
        protected $table = 'user';
        protected $allowedFields = ['email','password','address'];
        protected $beforeInsert = ['beforeInsert'];

        protected function beforeInsert(array $data){
            $data = $this->passwordHash($data);
            return $data;
        }

        protected function passwordHash(array $data){
            if (isset($data['data']))
                $data['data']['password'] = password_hash($data['data']['password']. PASSWORD_DEFAULT);
            
                return $data;
        
        }
    }