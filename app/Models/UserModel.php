<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'user';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
 	protected $allowedFields = ['name', 'password'];
    // ...
    protected array $user = [
        'id'        => 'int',
        'name' => 'array',
        'password'   => 'array',
    ];
}