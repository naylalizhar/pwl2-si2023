<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;

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


}