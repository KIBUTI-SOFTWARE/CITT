<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $conn;
    protected $table = 'user';

    public function __construct(ConnectionInterface &$conn)
    {
        $this->conn =& $conn;
    }

    public function addUser($data)
    {
        $this->conn->table($this->table)
                    ->insert($data);
        return true;
    }

    public function isUserWithEmailExisting($email)
    {       
        return $this->conn->table($this->table)
                    ->where(['email' => $email, 'status = 0', 'deleted_flag = 1'])
                    ->get()
                    ->getRow();
    }

    public function isUserWithPhoneExisting($phone)
    {     
        return $this->conn->table($this->table)
                    ->where(['phone' => $phone, 'status = 0', 'deleted_flag = 1'])
                    ->get()
                    ->getRow();
    }

    public function isAnotherUserWithEmailExisting($email, $id)
    {       
        return $this->conn->table($this->table)
                    ->notLike(['user_id' => $id])
                    ->where(['email' => $email])
                    ->get()
                    ->getRow();
    }

    public function isAnotherUserWithPhoneExisting($phone, $id)
    {     
        return $this->conn->table($this->table)
                    ->notLike(['user_id' => $id])
                    ->where(['phone' => $phone])
                    ->get()
                    ->getRow();
    }

    public function getUsers($user_level)
    {
        if ($user_level == 1) {
            return $this->conn->table($this->table)
                    ->get()
                    ->getResult('array');
        } else {
            return $this->conn->table($this->table)
                    ->where(['deleted_flag' => 0, 'level > ' => 1])
                    ->get()
                    ->getResult('array');
        }
    }

    public function getUser($user_id)
    {
            return $this->conn->table($this->table)
                    ->where(['user_id' => $user_id])
                    ->get()
                    ->getRowArray();
    }

    public function updateUser($data, $id)
    {
        return $this->conn->table($this->table)
                            ->update($data, ['user_id' => $id]);
    }

    // protected $table = 'message';
    // protected $primaryKey = 'id';

    // protected $returnType = 'array';
    // protected $usesoftDeletes = true;

    // protected $allowedFields = ['message_id, name, email, phone, message'];

    // protected $useTimestamps = true;
    // protected $createdField = 'created_on ';
    // protected $updatedField = 'updated_on';
    // protected $deletedField = 'deleted_on';

    // protected $validationRules = [];
    // protected $validationMessages = [];
    // protected $skipValidation = false;

    
}