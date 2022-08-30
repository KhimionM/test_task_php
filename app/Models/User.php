<?php 
namespace App\Models;

class User extends Model
{
    protected $tablename = 'users';
    protected $id;
    protected $name;
    protected $age;
    protected $email;
    protected $phone;
    protected $gender;
    protected $fillable = [
        'name',
        'age',
        'email',
        'phone',
        'gender',
    ];
    public function __construct(){
        parent::__construct();
    }

    // GET METHODS
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getGender()
    {
        return $this->gender;
    }
    // SET METHODS
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setAge(int $age)
    {
        $this->age = $age;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }
    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    public function getOne(int $id)
    {
        return $this->run('SELECT * FROM ' . $this->tablename . ' WHERE id = ' . intval($id));
    }

}
