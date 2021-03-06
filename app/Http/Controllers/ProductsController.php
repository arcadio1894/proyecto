<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;


class ProductsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Incorrecto
        //$products = Product::all();

        // Correcto
        //$products = Product::paginate(10,['id', 'name', 'description', 'price', 'money', 'color', 'image']);

        // Otro incorrecto
        //$products = Product::paginate(10);

        // EAGER LOADING
        $products = Product::with([
            'brand' => function($query) {
                $query->select('id', 'name');
            },
            'category' => function($query) {
                $query->select('id', 'name');
            }
        ])->paginate(10);

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
            'image' => 'required|image'

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
            'image.required' => 'El campo imagen es requerido',
            'image.image' => 'El archivo debe ser una imagen',
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

            $extension = $request->file('image')->getClientOriginalExtension();
            $image_name = $product->id . "." . $extension;

            $img = Image::make($request->file('image'))
                ->resize(150,150)
                ->save('images/'.$image_name);
            $product->image = $image_name;

            $product->save();
        }

        return response()->json($validator->messages(), 200);
    }

    public function getProducts()
    {
        $products = Product::get(['name']);
        $data['products'] = $products;
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit($id)
    {
        // Incorrecto
        //$product = Product::with('brand')->with('category')->find($id);
        $product = Product::with([
            'brand' => function($query) {
                $query->select('id', 'name');
            },
            'category' => function($query) {
                $query->select('id', 'name');
            }
        ])->find($id, ['id', 'name']);
        //dd($product);
        $brands = Brand::all();
        $categories = Category::all();

        return view('product.edit')->with(compact('product', 'brands', 'categories'));
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
            'state' => 'required|max:1|min:0',
            'stock' => 'required|numeric|min:1',
            'marca' => 'required|exists:brands,id',
            'categoria' => 'required|exists:categories,id',
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
            'state.min' => 'El estado es incorrecto',
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
            $product->stock = $request->get('stock');
            $product->brand_id = $request->get('marca');
            $product->category_id = $request->get('categoria');

            $product->save();
        }

        return response()->json($validator->messages(), 200);
    }

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

    public function getPriceById($id){
        $product = Product::find($id);
        //return $product->price;
        return $product;
    }

    public function reportPDF(){
        $products = Product::with('category')->with('brand')->get();
        //dd($products[0]->brand->name);
        $vista = view('report.pdfProducts', compact('products'))->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($vista);
        return $pdf->stream();
    }

    public function reportEXCEL(){
        $products = Product::with('category')->with('brand')->get();
        $date = Carbon::now();


        Excel::create('Productos', function ($excel) use ($products, $date){
            $excel->sheet('Listado', function ($sheet) use ($products, $date){
                //dd($products);

                $data = [];
                $sheet->mergeCells('A1:I1');
                $sheet->getDefaultStyle()
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
                array_push($data, ['REPORTE DE PRODUCTOS AL '.$date->format('d-m-Y')]);
                array_push($data, ['']);
                array_push($data, ['ID Producto','Nombre','Descripción','Precio','Moneda','Color','Categoría','Marca','Stock']);

                foreach ($products as $product){
                    if (!isset($product->category->name))
                        $categoria = 'Sin categoría';
                    else
                        $categoria = $product->category->name;

                    if (!isset($product->brand->name))
                        $marca = 'Sin marca';
                    else
                        $marca = $product->brand->name;
                    array_push($data, [$product->id, $product->name, $product->description, $product->price, $product->money, $product->color, $categoria, $marca, $product->stock]);
                }

                $sheet->cells('A1:I1', function($cells) {
                    $cells->setBackground('#3A5AE4');

                    $cells->setFont(array(
                        'family'     => 'Arial',
                        'size'       => '16',
                        'bold'       =>  true
                    ));

                });


                $countProducts = count($products)+3;

                for ($i = 3; $i<=$countProducts; ++$i){
                    $sheet->cells('A'.$i.':I'.$i, function($cells) {
                        $cells->setBackground('#20E329');

                        $cells->setFont(array(
                            'family'     => 'Arial',
                            'size'       => '14',
                            'bold'       =>  true
                        ));

                        $cells->setBorder('thin', 'thin', 'thin', 'thin');

                    });
                }


                $sheet->cells('A4:I'.$countProducts, function($cells) {
                    $cells->setBackground('#D1F13B');

                    $cells->setFont(array(
                        'family'     => 'calibri',
                        'size'       => '12'
                    ));

                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->setAutoSize(true);

                $sheet->setWidth('C', 60);
                $sheet->setWidth('E', 20);



                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->export('xlsx');
    }
}
