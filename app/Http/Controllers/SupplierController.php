<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * 
     * 
     * @return View
     */
    public function index() : View
    {
   
        $supplier = new Supplier;
        
   
        $suppliers = $supplier->get_supplier()
                            ->latest()
                            ->paginate(10);
        
        
        return view('supplier.index', compact('suppliers'));
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
        $supplier_model = new supplier;
        $supplier = $supplier_model->get_supplier()->where("supplier.id", $id)->firstOrFail();

        //render view with product
        return view('supplier.show', compact('supplier'));
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
      $supplier_model = new Supplier;
      $data['supplier'] = $supplier_model->get_supplier()->where("supplier.id", $id)->firstOrFail();
      
      $supplier_model = new Supplier;


      $data['suppliers_'] = $supplier_model->get_supplier()->get();

      //render View with product
      return view('supplier.edit', compact('data'));
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
            'supplier_name'         => 'required|min:5',
            'address_supp'          => 'required|min:5',
            'phone_supp'            => 'required|numeric',
            'pic_name'              => 'required|min:5',
            'phone'                 => 'required|numeric',
            'address'               => 'required|min:5'
        ]);
        
                // Ambil supplier berdasarkan ID
        $supplier = Supplier::findOrFail($id);
        
        // Update data supplier
        $supplier->supplier_name = $request->supplier_name;
        $supplier->address_supp = $request->address_supp;
        $supplier->phone_supp = $request->phone_supp;
        $supplier->pic_name = $request->pic_name;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        
        // Simpan perubahan
        $supplier->save();

        // Redirect ke index
        return redirect()->route('suppliers.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $supplier_model = new Supplier;
        $supplier = $supplier_model->get_supplier()->where("supplier.id", $id)->firstOrFail();

        //delete product
        $supplier->delete();

        //redirect to index
        return redirect()->route('suppliers.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}


