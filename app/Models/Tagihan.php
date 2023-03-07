<?php

namespace App\Models;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\TagihanDetail;
// use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tagihan extends Model
{
    use HasFactory;
    // use HasFormatRupiah;
    protected $guarded = [];
    protected $dates = ['tanggal_tagihan','tanggal_jatuh_tempo'];
    protected $with = ['user', 'siswa', 'tagihanDetail'];
    protected $append = ['total_tagihan'];



    protected function totalTagihan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->tagihanDetail()->sum('jumlah_biaya'),
        );
    }


    /**
     * Get the user that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,);
    }

    /**
     * Get the siswa that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }


      // mengambil user_id otomatis dengan event
    protected static function booted()
    {
        static::creating(function($tagihan){

            $tagihan->user_id = auth()->user()->id;
        });

        static::updating(function($tagihan){

            $tagihan->user_id = auth()->user()->id;
        });
    }


    public function tagihanDetail(): HasMany
    {
        return $this->hasMany(TagihanDetail::class);
    }

    /**
     * Get all of the pembayaran for the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembayaran(): HasMany

    {
        return $this->hasMany(Pembayaran::class);
    }

}
