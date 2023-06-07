<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $dateFormat = 'Y-m-d H:i:s';

    public function GetAllData() {
        $Data = $this -> all();
        return $Data;
    }
}
