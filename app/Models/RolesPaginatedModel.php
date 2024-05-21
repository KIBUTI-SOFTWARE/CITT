<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class RolesPaginatedModel extends Model
{

    protected $table = 'role';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['user', 'proffession'];

    
}