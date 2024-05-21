<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ReportsModel extends Model
{
    protected $conn;
    protected $table = 'reports';

    public function __construct(ConnectionInterface &$conn)
    {
        $this->conn =& $conn;
    }

    public function addReport($data)
    {
        $this->conn->table($this->table)
                    ->insert($data);
        return true;
    }

    public function getReports()
    {
        return $this->conn->table($this->table)
                    ->where(['deleted_flag' => 0])
                    ->get()
                    ->getResult('array');
    }

    public function getReport($id)
    {
        return $this->conn->table($this->table)
                    ->where(['report_id' => $id])
                    ->get()
                    ->getResult('array');
    }

    // public function isRoleExisting($name)
    // {
        
    //     return $this->conn->table($this->table)
    //                 ->where(['role_name' => $name])
    //                 ->get()
    //                 ->getRow();
    // }


    public function updateReport($data, $id)
    {
        return $this->conn->table($this->table)
                            ->update($data, ['report_id' => $id]);
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