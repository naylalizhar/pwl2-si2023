<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    
    protected $table = 'transaksi'; 

    
    public function get_transaksi()
    {
        return $this->select("transaksi.*"); 
    }
}
