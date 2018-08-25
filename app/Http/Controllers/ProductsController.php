<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('product.create')->with(compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $rules = array(
            'nombre' => 'required|min:6|unique:products,name',
            'descripcion' => 'required|max:255',
            'precio' => 'required|max:5000|numeric',
            'moneda' => 'required|size:3',
            'color' => 'required',
            'stock' => 'required|numeric|min:1',
            'marca' => 'required|exists:brands,id',
            'categoria' => 'required|exists:categories,id',

        );

        $messages = array(
            'nombre.required' => 'El campo nombre es requerido',
            'nombre.min' => 'Minimo 6 caracteres en el nombre',
            'nombre.unique' => 'Debe ser unico el nombre',
            'descripcion.required' => 'El campo descripcion es requerido',
            'descripcion.max' => 'Maximo 10 caracteres en la descripcion',
            'precio.required' => 'El campo precio es requerido',
            'precio.max' => 'El precio maximo 5000 unidades',
            'precio.numeric' => 'El precio solo debe tener numeros',
            'moneda.required' => 'El campo moneda es requerido',
            'moneda.size' => 'La moneda solo debe tener 3 caracteres',
            'color.required' => 'El campo color es requerido',
            'stock.required' => 'El campo stock es requerido',
            'stock.numeric' => 'El campo stock no permite letras',
            'stock.min' => 'El minimo valor del stock es 1',
            'marca.required' => 'El campo marca es requerido',
            'marca.exists' => 'No existe una marca con este identificador',
            'categoria.required' => 'El campo categoria es requerido',
            'categoria.exists' => 'No existe una categoria con este identificador',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator){
           if (Auth::user()->role_id > 2) {
               $validator->errors()->add('role', 'NO tiene permisos para crear un producto');
           }
        });

        if (!$validator->fails()) {
            $product = Product::create([
                'name' => $request->get('nombre'),
                'description' => $request->get('descripcion'),
                'price' => $request->get('precio'),
                'money' => $request->get('moneda'),
                'color' => $request->get('color'),
                'comment' => '',
                'state' => 1,
                'stock' => $request->get('stock'),
                'brand_id' => $request->get('marca'),
                'category_id' => $request->get('categoria')
            ]);

            $product->save();
        }

        return response()->json($validator->messages(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Product $products)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit($id)
    {
        $product = Product::find($id);
        //dd($products);

        return view('product.edit')->with(compact('product'));
    }

    public function update(Request $request)
    {
        //dd($request);
        $rules = array(
            'nombre' => 'required|min:6',
            'descripcion' => 'required|max:255',
            'precio' => 'required|max:5000|numeric',
            'moneda' => 'required|size:3',
            'color' => 'required',
            'state' => 'required|max:1|min:0'
        );

        $messages = array(
            'nombre.required' => 'El campo nombre es requerido',
            'nombre.min' => 'Minimo 6 caracteres en el nombre',
            'descripcion.required' => 'El campo descripcion es requerido',
            'descripcion.max' => 'Maximo 10 caracteres en la descripcion',
            'precio.required' => 'El campo precio es requerido',
            'precio.max' => 'El precio maximo 5000 unidades',
            'precio.numeric' => 'El precio solo debe tener numeros',
            'moneda.required' => 'El campo moneda es requerido',
            'moneda.size' => 'La moneda solo debe tener 3 caracteres',
            'color.required' => 'El campo color es requerido',
            'state.required' =>'El campo estado es requerido',
            'state.max' =>'El estado es incorrecto',
            'state.min' => 'El estado es incorrecto'
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator){
            if (Auth::user()->role_id > 2) {
                $validator->errors()->add('role', 'NO tiene permisos para editar un producto');
            }
        });

        if (!$validator->fails()) {
            $product = Product::find($request->get('id'));
            $product->name = $request->get('nombre');
            $product->description = $request->get('descripcion');
            $product->price = $request->get('precio');
            $product->money = $request->get('moneda');
            $product->color = $request->get('color');
            $product->state = $request->get('state');
            $product->comment = $request->get('comentario');

            $product->save();
        }

        return response()->json($validator->messages(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Request $request)
    {
        $rules = array(
            'id' => 'exists:products',
        );

        $messages = array(
            'id.exists' => 'El id no existe en la base de datos',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator){
            if (Auth::user()->role_id > 2) {
                $validator->errors()->add('role', 'NO tiene permisos para eliminar un producto');
            }
        });

        if (!$validator->fails()) {
            $product = Product::find($request->get('id'));
            $product->delete();
        }

        //TODO: El producto no se podrá eliminar si esta en una compra o venta

        return response()->json($validator->messages(), 200);
    }
}
