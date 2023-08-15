<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anfiniti_login extends Model
{
    protected $table = 'anfiniti_login';
    protected $fillable = ['username', 'password'];

    public function session()
    {
        return $this->hasMany(AnfinitiSession::class, 'login_id');
    }

    public function dataweb()
    {
        return $this->hasMany(AnfinitiDataweb::class, 'login_id');
    }
}