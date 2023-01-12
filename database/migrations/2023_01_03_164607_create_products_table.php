<?php

use App\Models\Brand;
use App\Models\Color;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Brand::class);
            $table->foreignIdFor(Color::class);
            $table->string('code')->unique()->nullable();
            $table->string('name');
            $table->integer('capital');
            $table->integer('price');
            $table->string('size');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
