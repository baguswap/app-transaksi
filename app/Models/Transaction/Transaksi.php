<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaksi';
    protected $connection = 'transaction';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'deskripsi', 'prioritas', 'tanggal', 'status'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'date',
    ];
}
