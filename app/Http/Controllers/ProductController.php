<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::all();
        return view('producto.index', compact('productos'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $file = request()->file('imagen');
        $obj = Cloudinary::upload($file->getRealPath(), ['folder' => 'products']);
        $public_id = $obj->getPublicId();
        $url = $obj->getSecurePath();

        Product::create([
            "nombre" => $request->nombre,
            "url" => $url,
            "public_id" => $public_id,
            "descripcion" => $request->descripcion
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        $producto = Product::find($id);
        $url = $producto->url;
        $public_id = $producto->public_id;

        if($request->hasFile('imagen')){
            Cloudinary::destroy($public_id);
            $file = request()->file('imagen');
            $obj = Cloudinary::upload($file->getRealPath(),['folder'=>'products']);
            $url = $obj->getSecurePath();
            $public_id = $obj->getPublicId();
        }

        $producto->update([
            "nombre"=>$request->nombre,
            "descripcion"=>$request->descripcion,
            "url"=>$url,
            "public_id"=>$public_id
        ]);
        return back();
    }

    public function destroy($id)
    {
        $producto = Product::find($id);
        $public_id = $producto->public_id;
        Cloudinary::destroy($public_id);
        Product::destroy($id);
        return back();
    }
}
