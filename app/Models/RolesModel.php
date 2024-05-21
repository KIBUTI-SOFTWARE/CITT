<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class RolesModel extends Model
{
    protected $conn;
    protected $table = 'role';

    public function __construct(ConnectionInterface &$conn)
    {
        $this->conn =& $conn;
    }

    public function addRole($data)
    {
        $this->conn->table($this->table)
                    ->insert($data);
        return true;
    }

    public function getRoles()
    {
        return $this->conn->table($this->table)
                    ->where(['status' => 1, 'deleted_flag' => 0])
                    ->get()
                    ->getResult('array');
    }

    public function getRole($id)
    {
        return $this->conn->table($this->table)
                    ->where(['role_id' => $id])
                    ->get()
                    ->getResult('array');
    }

    public function isRoleExisting($name)
    {
        
        return $this->conn->table($this->table)
                    ->where(['role_name' => $name])
                    ->get()
                    ->getRow();
    }


    public function updateRole($data, $id)
    {
        return $this->conn->table($this->table)
                            ->update($data, ['role_id' => $id]);
    }

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