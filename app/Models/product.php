<?php

namespace App\Models;

use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
     * 
     * @var array
     */
    protected $fillable = [
        'product_category_id',
        'id_supplier',
        'image',
        'title',
        'description',
        'price',
        'stock',
    ];

    public function get_product(){
        //get all products
        $sql = $this->select("products.*", "category_product.product_category_name as product_category_name")
                    ->join('category_product', 'category_product.id', '=', 'products.product_category_id'); //join

        return $sql;
    }

    public function get_category_product(){
        //getallprpduct
        $sql = DB::table('category_product')->select('*');

        return $sql;
    }
    public $timestamps = true;

    public static function storeProduct($request, $image)
    {
        //simpan product baru
        return self::create([
            'product_category_id'   => $request->product_category_id,
            'id_supplier'           => $request->id_supplier,
            'image'                 => $image->hashName(),
            'title'                 => $request->title,
            'description'           => $request->description,
            'price'                 => $request->price,
            'stock'                 => $request->stock,
        ]);
    }
}