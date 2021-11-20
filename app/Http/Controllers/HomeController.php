<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $barang = app('firebase.firestore')->database()->collection('Barang')->documents();
        $jumlah = count($barang->rows());
        $total = 0;

        foreach($barang as $b) {
            $total += $b->data()['jumlah'];
        }

        return view('home', compact(['jumlah', 'total']));
    }
}
