<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $inventario = Inventario::all();
        return view('pagina.index', compact('inventario'));
    }

    public function productosCarrito(){
        return view('/pagina/carrito')->with('productosCarrito',\Cart::getContent());
    }

    public function agregarCarrito(Request $request){
        //dd($request->all());
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'description' => $request->description,
                'image' => $request->image,
            )
        ));
        return redirect('/prueba/producto');
    }

    public function quitarCarrito(Request $request){
        \Cart::remove($request->id);
        return redirect('/prueba/producto');
    }

    Public function incrementarCarrito(Request $request){
        \Cart::update($request->id, array(
            'quantity' => 1,
        ));
        return redirect('/prueba/producto');
    }

    Public function decrementarCarrito(Request $request){
        \Cart::update($request->id, array(
            'quantity' => -1,
        ));
        return redirect('/prueba/producto');
    }
}