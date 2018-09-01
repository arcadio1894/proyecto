<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
