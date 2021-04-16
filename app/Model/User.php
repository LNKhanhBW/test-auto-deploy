<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'password', 'created_by', 'updated_by', 'deleted_by',
    ];

    public function createUser($data) {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = bcrypt($data['password']);
        return $this->save();
    }
}
