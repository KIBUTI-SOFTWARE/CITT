<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CategoriesPaginatedModel extends Model
{

    protected $table = 'category';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['user', 'proffession'];

    
}