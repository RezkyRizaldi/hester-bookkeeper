<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var array<int, string>
     */
    protected $fillable = ['brand_id', 'color_id', 'size_id', 'code', 'name', 'capital', 'price'];

    /**
     * @var array<int, string>
     */
    protected $appends = ['exists_size'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'deleted_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];

    protected function existsSize(): Attribute
    {
        return new Attribute(
            get: fn () => explode(',', $this->size),
        );
    }

    public function scopeSearch(Builder $query, ?string $request): Builder
    {
        return $query->when($request, fn (Builder $query) => $query->where('name', 'like', "%$request%")
            ->orWhereHas('brand', fn (Builder $query) => $query->where('name', 'like', "%$request%")));
    }

    public function scopeSort(Builder $query, ?string $request): Builder
    {
        if ($request === 'asc') {
            return $query->whereHas('brand', fn (Builder $query) => $query->latest('name'));
        } elseif ($request === 'desc') {
            return $query->whereHas('brand', fn (Builder $query) => $query->oldest('name'));
        } else {
            return $query;
        }
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(Size::class);
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    public function expenditures(): HasMany
    {
        return $this->hasMany(Expenditure::class);
    }

    public function goods(): HasMany
    {
        return $this->hasMany(Goods::class);
    }
}
