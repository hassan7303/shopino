<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\Product;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'slug',
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'parent_id' => 'integer',
        'slug' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
