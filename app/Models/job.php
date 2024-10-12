<?php

namespace App\Models;

use Illuminate\Support\Number;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class job extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function JobCategory(){
       return $this->belongsTo(JobCategory::class);        
    }

    public function JobTypetime(){
        return $this->belongsTo(JobTypetime::class);
    }

    public function Application(){
        return $this->hasMany(JobApplication::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

}
