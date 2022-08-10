<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    protected $table = 'categories';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'popular',
        // 'image',
        'meta_title',
        'meta_descrip',
        'meta_keywords',
    ];


    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
