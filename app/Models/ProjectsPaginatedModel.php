<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ProjectsPaginatedModel extends Model
{

    protected $table = 'project';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['user', 'proffession'];

    
}