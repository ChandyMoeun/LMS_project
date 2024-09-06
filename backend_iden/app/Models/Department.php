<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function positions()
    {
        return $this->hasMany(Position::class, 'department_id');
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    
}
