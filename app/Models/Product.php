<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'vendor_id',
        'original_price',
        'selling_price',
        'slug',
        'image_path',
        'quantity',
        'description',
        'delivery_cost',
        'tax',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];


    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
