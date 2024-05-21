<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CategoriesModel extends Model
{
    protected $conn;
    protected $table = 'category';

    public function __construct(ConnectionInterface &$conn)
    {
        $this->conn =& $conn;
    }

    public function addCategory($data)
    {
        $this->conn->table($this->table)
                    ->insert($data);
        return true;
    }

    public function getCategories()
    {
        return $this->conn->table($this->table)
                    ->where(['status' => 1, 'deleted_flag' => 0])
                    ->get()
                    ->getResult('array');
    }

    public function updateCategory($data, $id)
    {
        return $this->conn->table($this->table)
                            ->update($data, ['category_id' => $id]);
    }


    public function getCategory($id)
    {
        return $this->conn->table($this->table)
                    ->where(['category_id' => $id])
                    ->get()
                    ->getResult('array');
    }

    // public function isMemberExisting($name, $branch_id)
    // {
        
    //     return $this->conn->table($this->table)
    //                 ->where(['branch_id' => $branch_id, 'name' => $name])
    //                 ->get()
    //                 ->getRow();
    // }
    
    // protected $table = $this->table;
    // protected $primaryKey = 'id';

    // protected $returnType = 'array';
    // protected $usesoftDeletes = true;

    // protected $allowedFields = ['role_id, name'];

    // protected $useTimestamps = true;
    // protected $createdField = 'created_on ';
    // protected $updatedField = 'updated_on';
    // protected $deletedField = 'deleted_on';

    // protected $validationRules = [];
    // protected $validationMessages = [];
    // protected $skipValidation = false;

    
}