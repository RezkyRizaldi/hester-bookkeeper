<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $fillable = ['product_id', 'incoming', 'outgoing', 'stock'];

    /**
     * @var array<int, string>
     */
    protected $appends = ['date'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'deleted_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];

    protected function date(): Attribute
    {
        return new Attribute(
            get: fn () => Carbon::parse($this->created_at)->translatedFormat('l, d F Y'),
        );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
