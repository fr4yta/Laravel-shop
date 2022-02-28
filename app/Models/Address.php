<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city',
        'zip_code',
        'street',
        'street_no',
        'home_no',
        'user_id'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
