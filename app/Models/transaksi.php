<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected $fillable = [
        'id',
        'tanggal_transaksi',
        'nama_kasir',
        'diskon',
        'email_pembeli',
        'created_at',
        'updated_at'
    ];

    // Relasi ke DetailTransaksi
    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'id_product'); // Asumsi id_product adalah foreign key
    // }

    public function get_transaksi(){
        //get all transaksi
        $sql = $this->select(
                            "transaksis.*", 
                            "products.title as title", 
                            "category_product.product_category_name as product_category_name", 
                            "products.price as price", 
                            "products.stock as stock",
                            "detail_transaksi.id_product as id_product", 
                            "detail_transaksi.jumlah_pembelian as jumlah_pembelian"
                        )
                        ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksis.id')
                        ->join('products', 'products.id', '=', 'detail_transaksi.id_product')
                        ->join('category_product', 'category_product.id', '=', 'products.product_category_id');
        return $sql;
    }   

    // public function get_category_product(){
    //     $sql = DB::table ('category_product')->select('*');
        
    //     return $sql;
    // }
}