<?php

namespace App\Models;
use App\Helpers;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spp extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $append = ['nama_spp_full'];

    protected function namaBiayaFull(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->tahun . ' - ' . $this->formatRupiah('nominal'),
        );
    }

      /**
     * Get the user that owns the Biaya
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class,'user_id');
    // }

    // mengambil user_id otomatis dengan event
    // protected static function booted(){
    //     static::creating(function($biaya){

    //         $biaya->user_id = auth()->user()->id;
    //     });

    //     static::updating(function($biaya){

    //         $biaya->user_id = auth()->user()->id;
    //     });
    // }
}
