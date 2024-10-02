<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * 
     * 
     * @return View
     */
    public function index(): View
    {
        // Mengambil data transaksi dan menggunakan paginate
        $transaksis = Transaksi::latest()->paginate(10); // Menggunakan model Transaksi secara langsung
        
        // Mengirim variabel yang benar ke view
        return view('transaksi.index', compact('transaksis')); // Pastikan menggunakan 'transaksis'
    }
}
