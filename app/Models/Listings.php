<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listings extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'title',
        'description',
        'salary',
        'tags',
        'company',
        'address',
        'city',
        'state',
        'phone',
        'email',
        'requirements',
        'benefits',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
