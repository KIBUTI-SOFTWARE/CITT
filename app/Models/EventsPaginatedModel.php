<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class EventsPaginatedModel extends Model
{

    protected $table = 'events';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['user', 'proffession'];

    
}