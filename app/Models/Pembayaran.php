<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $guarded = [''];
    protected $dates = ['tanggal_bayar'];
    protected $with = ['user', 'tagihan'];
    protected $append = ['total_pembayaran'];


    // protected function()

    /**
     * Get the tagihan that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Tagihan::class);
    }

       // mengambil user_id otomatis dengan event
       protected static function booted()
       {
           static::creating(function($pembayaran){

               $pembayaran->user_id = auth()->user()->id;
           });

           static::updating(function($pembayaran){

               $pembayaran->user_id = auth()->user()->id;
           });
       }

    //  relasi ke user_id
    /**
     * Get the user that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
