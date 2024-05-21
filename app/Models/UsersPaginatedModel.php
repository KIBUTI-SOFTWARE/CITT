<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UsersPaginatedModel extends Model
{

    protected $table = 'user';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['user_id', 'firstname', 'lastname', 'email', 'phone', 'status', 'deleted_flag'];

    
}