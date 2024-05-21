<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class GalleryPaginatedModel extends Model
{

    protected $table = 'gallery';
    protected $primaryKey = 'id';
    // protected $allowedFields = ['user', 'proffession'];

    
}