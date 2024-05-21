<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ReportsPaginatedModel extends Model
{

    protected $table = 'reports';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['user', 'proffession'];

    
}