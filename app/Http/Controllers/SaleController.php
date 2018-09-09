<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sale;
use App\SaleDetail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    public function getProfile(){
        return view('prueba.profile');
    }

    public function profile(Request $request){
        // Crear fecha con la zona horaria ingresada

        $date = Carbon::now();
        //var_dump($date->format('d-m-Y'));
        $date2 = Carbon::now('America/Lima');
        $dateparsed = Carbon::parse($date,'America/Lima');
        //var_dump($date2);
        //var_dump($dateparsed->age);
        $fechaAdd = $dateparsed->addYears(3);
        //var_dump($fechaAdd);
        $fechaSub = $dateparsed->subMonths(3);
        //var_dump($fechaSub);

        $year = 2014;
        $month = 12;
        $day = 15;
        $hour = 9;
        $minute = 24;
        $seconds = 19;

        $dateCreated = Carbon::create($year, $month, $day, $hour, $minute, $seconds, 'Europe/London' );
        $dateCreated2 = Carbon::create($year, $month, $day, $hour, $minute, $seconds, 'America/Lima' );

       /* print_r($dateCreated);
        print_r($dateCreated2);*/

        $dateParseCreated = Carbon::parse($dateCreated, 'America/Lima');
        //print_r($dateParseCreated);

        $dateCreateFormat = Carbon::createFromFormat('Y-m-d', $request->get('fecha'), 'America/Lima');
        //var_dump($dateCreateFormat);

        $user = User::find(1);
        $dt = Carbon::parse($user->created_at);

        // El mensaje sale en español
        var_dump($dt->diffForHumans());

        dd($request);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sale.index');
    }

    public function create()
    {
        $products = Product::all();

        return view('sale.create')->with(compact('products'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $products = json_decode($request->get('productos'));

        $type_doc = $request->get('type_doc');
        $date_sale = $request->get('fecha');
        $comment = $request->get('comentario');

        $usuario = Auth::user()->id;

        // TODO: Usar validator
        if ( ! $date_sale)
            return response()->json(['error'=>true, 'message'=>'Ingrese fecha']);

        if ( ! $type_doc )
            return response()->json(['error'=>true, 'message'=>'Seleccione un tipo de documento']);

        // Iniciamos la transaccion
        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'user_id' => $usuario,
                'state' => 'R',
                'type_doc' => $type_doc,
                'sale_date' => $date_sale,
                'comment' => $comment
            ]);

            foreach ( $products as $product ){
                // Lanzar una excepcion cuando no exista el producto
                $productReal = Product::where('id', $product->id)->first();

                if(!$productReal )
                    throw new \Exception('El producto '. $product->name . " no se encuentra en la base de datos");

                if ( $productReal->stock < $product->quantity )
                    throw new \Exception('El producto '. $product->name . " no cuenta con stock suficiente.");
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'price_unit' => $product->price,
                    'quantity' => $product->quantity
                ]);

                $productReal->stock = $productReal->stock - $product->quantity;
                $productReal->save();
            }

            DB::commit();

            return response()->json(['error'=>false, 'message' => 'Compra realizada exitosamente']);

        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>true, 'message'=> $e->getMessage()]);
        }



    }

    public function reportPDF(Request $request){
        $fechaI = $request->get('fechaI');
        $fechaF = $request->get('fechaF');


        $sales = Sale::whereBetween('sale_date', [$fechaI, $fechaF])->with('details')->with('user')->get();
        //dd($sales);
        $vista = view('report.pdfSales', compact('sales', 'fechaI', 'fechaF'))->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($vista);
        //return $pdf->download();
        return $pdf->stream();
    }

    public function reportEXCEL(Request $request){
        $fechaI = $request->get('fechaI');
        $fechaF = $request->get('fechaF');

        $sales = Sale::whereBetween('sale_date', [$fechaI, $fechaF])->with('details')->with('user')->get();
        //dd($sales);
        $vista = view('report.pdfSales', compact('sales', 'fechaI', 'fechaF'))->render();

        Excel::create('New file', function($excel) use ($vista, $sales, $fechaI, $fechaF) {

            $excel->sheet('New sheet', function($sheet) use ($vista, $sales, $fechaI, $fechaF) {

                $sheet->loadView( 'report.excelSales' )->with('sales',$sales)
                    ->with('fechaI',$fechaI)->with('fechaF',$fechaF);
                $sheet->setOrientation('landscape');

            });

        })->export('xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
