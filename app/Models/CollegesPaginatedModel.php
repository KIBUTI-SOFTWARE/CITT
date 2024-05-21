<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CollegesPaginatedModel extends Model
{

    protected $table = 'colleges';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['user', 'proffession'];

    
}