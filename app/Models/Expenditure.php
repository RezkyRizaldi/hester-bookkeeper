<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenditure extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $fillable = ['product_id', 'type', 'amount', 'price', 'date'];

    /**
     * @var array<int, string>
     */
    protected $appends = ['formatted_date', 'total', 'translated_date'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'date' => 'datetime:d-m-Y',
        'deleted_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];

    protected function total(): Attribute
    {
        return new Attribute(
            get: fn () => $this->amount * $this->price,
        );
    }

    protected function translatedDate(): Attribute
    {
        return new Attribute(
            get: fn () => Carbon::parse($this->date)->translatedFormat('l, d F Y'),
        );
    }

    protected function formattedDate(): Attribute
    {
        return new Attribute(
            get: fn () => Carbon::parse($this->date)->format('Y-m-d'),
        );
    }

    public function scopeSearch(Builder $query, ?string $request): Builder
    {
        return $query->when($request, fn (Builder $query) => $query->whereHas('product', fn (Builder $query) => $query->where('name', 'like', "%$request%")));
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
