<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('category.index')->with(compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'nombre' => 'required|min:6|unique:products,name',
            'descripcion' => 'required|max:255',

        );

        $messages = array(
            'nombre.required' => 'El campo nombre es requerido',
            'nombre.min' => 'Minimo 6 caracteres en el nombre',
            'nombre.unique' => 'Debe ser unico el nombre',
            'descripcion.required' => 'El campo descripcion es requerido',
            'descripcion.max' => 'Maximo 10 caracteres en la descripcion',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator){
            if (Auth::user()->role_id > 2) {
                $validator->errors()->add('role', 'NO tiene permisos para crear un producto');
            }
        });

        if (!$validator->fails()) {
            $category = Category::create([
                'name' => $request->get('nombre'),
                'description' => $request->get('descripcion')
            ]);

            $category->save();
        }

        return response()->json($validator->messages(), 200);
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        //dd($product);

        return view('category.edit')->with(compact('category'));

    }

    public function update(Request $request)
    {
        $rules = array(
            'nombre' => 'required|min:6|unique:products,name',
            'descripcion' => 'required|max:255',

        );

        $messages = array(
            'nombre.required' => 'El campo nombre es requerido',
            'nombre.min' => 'Minimo 6 caracteres en el nombre',
            'nombre.unique' => 'Debe ser unico el nombre',
            'descripcion.required' => 'El campo descripcion es requerido',
            'descripcion.max' => 'Maximo 10 caracteres en la descripcion',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator){
            if (Auth::user()->role_id > 2) {
                $validator->errors()->add('role', 'NO tiene permisos para crear un producto');
            }
        });

        if (!$validator->fails()) {
            $category = Category::find($request->get('id'));
            $category->name = $request->get('nombre');
            $category->description = $request->get('descripcion');

            $category->save();
        }

        return response()->json($validator->messages(), 200);
    }

    public function destroy(Request $request)
    {
        $rules = array(
            'id' => 'exists:categories',
        );

        $messages = array(
            'id.exists' => 'El id no existe en la base de datos',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator){
            if (Auth::user()->role_id > 2) {
                $validator->errors()->add('role', 'No tiene permisos para eliminar un producto');
            }
        });

        if (!$validator->fails()) {
            $category = category::find($request->get('id'));
            $category->delete();
        }

        //TODO: La categoria no se podrá eliminar si esta en un product

        return response()->json($validator->messages(), 200);
    }
}
