<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class MembersPaginatedModel extends Model
{

    protected $table = 'members';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['user', 'proffession'];

    
}