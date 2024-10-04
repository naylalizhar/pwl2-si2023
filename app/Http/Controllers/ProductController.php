<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier; // Tambahkan ini jika Supplier ada di App\Models
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index() : View
    {
        $product = new Product;
        $products = $product->get_product()
                            ->latest()
                            ->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * create
     * 
     * @return View
     */
    public function create(): View
    {
        $product = new Product; // Ganti 'product' menjadi 'Product'
        $supplier = new Supplier; // Ganti 'supplier' menjadi 'Supplier'

        $data['categories'] = $product->get_category_product()->get();
        $data['suppliers'] = $supplier->get_supplier()->get();

        return view('products.create', compact('data'));
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return RedirectResponse
     * 
     */
    public function store(Request $request): RedirectResponse // Ubah 'request' menjadi 'Request'
    {
        $validatedData = $request->validate([
            'product_category_id'   => 'required|integer',
            'id_supplier'           => 'required|integer',
            'image'                 => 'required|image|mimes:jpeg,jpg,png|max:2048', // Perbaiki 'pmg' menjadi 'png'
            'title'                 => 'required|min:5',
            'description'           => 'required|min:10',
            'price'                 => 'required|numeric',
            'stock'                 => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/images'); // Simpan gambar ke folder penyimpanan

            // Create product
            Product::create([ // Ubah 'prduct' menjadi 'Product'
                'product_category_id'   => $request->product_category_id,
                'id_supplier'           => $request->id_supplier,
                'image'                 => $image->hashName(),
                'title'                 => $request->title,
                'description'           => $request->description,
                'price'                 => $request->price,
                'stock'                 => $request->stock,
            ]);

            return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }

        // Redirect to index
        return redirect()->route('products.index')->with(['error' => 'Failed to upload image']); // Ubah ',' menjadi '.'
    }

    /**
     * show
     * 
     * @param mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get product by ID
        $product_model = new product;
        $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        //render view with product
        return view('products.show', compact('product'));
    }
    /**
     * edit
     * 
     * @param mixed $id
     * @return View
     * 
     */
    public function edit(string $id): View
    {
      //get product by ID
      $product_model = new Product;
      $data['product'] = $product_model->get_product()->where("products.id", $id)->firstOrFail();
      
      $supplier_model = new Supplier;

      $data['categories'] = $product_model->get_category_product()->get();
      $data['suppliers_'] = $supplier_model->get_supplier()->get();

      //render View with product
      return view('products.edit', compact('data'));
    }
    /**
     * update
     * 
     * @param mixed $request
     * @param mixed $id
     * @return RedirectResponse
     */
    public function update(request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);
        
        //get prduct by ID
        $product_model = new product;
        $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        //check if image is upkoaded
        if ($request->hasFile('image')) {

            //uplad new image
            $image = $request->file('image');
            $image->storeAs('public/images', $image->hashName());

            //delete old image
            Storage::delete('public/images/'.$product->image);

            //update product with new image
            $product->update([
                'product_category_id'   => $request->product_category_id,
                'id_supplier'           => $request->id_supplier,
                'image'                 => $image->hashName(),
                'title'                 => $request->title,
                'description'           => $request->description,
                'price'                 => $request->price,
                'stock'                 => $request->stock,
            ]);
        } else {
            //update product withut image
            $product->update([
                'product_category_id'   => $request->product_category_id,
                'id_supplier'           => $request->id_supplier,
                'title'                 => $request->title,
                'description'           => $request->description,
                'price'                 => $request->price,
                'stock'                 => $request->stock,
            ]);
        }

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    /**
     * destroy
     * 
     * @param mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $product_model = new Product;
        $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        //delete image
        Storage::delete('public/images/'.$product->image);

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}