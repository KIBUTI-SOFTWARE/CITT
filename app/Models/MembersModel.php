<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class MembersModel extends Model
{
    protected $conn;
    protected $table = 'members';

    public function __construct(ConnectionInterface &$conn)
    {
        $this->conn =& $conn;
    }

    public function addMember($data)
    {
        $this->conn->table($this->table)
                    ->insert($data);
        return true;
    }

    public function getMembers()
    {
        return $this->conn->table($this->table)
                    ->where(['status' => 1, 'deleted_flag' => 0])
                    ->get()
                    ->getResult('array');
    }

    public function updateMember($data, $id)
    {
        return $this->conn->table($this->table)
                            ->update($data, ['member_id' => $id]);
    }
    
    public function updateMemberPhoto($data, $id)
    {
        return $this->conn->table($this->table)
                            ->update($data, ['member_id' => $id]);
    }


    public function getMember($id)
    {
        return $this->conn->table($this->table)
                    ->where(['member_id' => $id])
                    ->get()
                    ->getResult('array');
    }

    public function getMemberDetails($member_id)
    {
        return $this->conn->table($this->table)
                    ->where(['member_id' => $member_id])
                    ->get()
                    ->getRowArray(0);
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