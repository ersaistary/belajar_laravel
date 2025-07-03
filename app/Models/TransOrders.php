<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransOrders extends Model
{
    protected $fillable= [
        'id_customer',
        'order_end_date',
        'status',
        'order_code',
        'order_pay',
        'order_change',
        'total'
    ];

    public function details(){
        return $this->hasMany(TransDetails::class, 'id_trans');
    }

    public function customer(){
        return $this->belongsTo(Customers::class, 'id_customer', 'id');
    }

    public function getStatusTextAttribute(){
        switch($this->status){
            case '1':
                return "Sudah Bayar";
                break;
            default:
                return "Baru";
                break;
        }
    }
}
