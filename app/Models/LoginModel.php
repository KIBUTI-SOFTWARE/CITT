<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $conn;
    protected $table = 'user';
    protected $membersTable = 'members';
    protected $OTPtable = 'OTP';

    public function __construct(ConnectionInterface &$conn)
    {
        $this->conn =& $conn;
    }

    public function getUser($data)
    {
        return $this->conn->table($this->table)
                            ->where('email' , $data)
                            ->orWhere('phone', $data)
                            ->get()
                            ->getRowArray();
    }

    public function getMember($data)
    {
        return $this->conn->table($this->membersTable)
                            ->where('email' , $data)
                            ->orWhere('phone', $data)
                            ->get()
                            ->getRowArray();
    }

    public function getOTP($sent_to, $OTP)
    {
        return $this->conn->table($this->OTPtable)
                            ->where(['sent_to' => $sent_to, 'OTP' => $OTP, 'deleted_flag' => 0])
                            ->get()
                            ->getRowArray();
    }

    public function hasPhoneExceededOTPLimit($phone)
    {
        return $this->conn->table($this->OTPtable)
                            ->where(['sent_to' => $phone, 'deleted_flag' => 0])
                            ->get()
                            ->getResult('array');
    }

    public function sentOTP($data)
    {
        $this->conn->table($this->OTPtable)
                    ->insert($data);
        return true;
    }

    
    // protected $table = $this->table;
    // protected $primaryKey = 'id';

    // protected $returnType = 'array';
    // protected $usesoftDeletes = true;

    // protected $allowedFields = ['user_id, username, school_id, personal_info, password, abstraction_level, role_id'];

    // protected $useTimestamps = true;
    // protected $createdField = 'created_on ';
    // protected $updatedField = 'updated_on';
    // protected $deletedField = 'deleted_on';

    // protected $validationRules = [];
    // protected $validationMessages = [];
    // protected $skipValidation = false;

    
}