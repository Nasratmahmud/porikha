<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CoinBalance extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'transaction_type', 'total'];
    protected $casts = [
        'amount' => 'float',
    ];

    public function GetLastTransaction() {

        return $this->where( 'user_id', "=", Auth::user()->id )->latest()->first();
    }
}
