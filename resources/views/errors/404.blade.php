{{--<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Error 404</title>
    <link rel="stylesheet" href="{{asset('template/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template/assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />

</head>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <h1>404</h1>

                <div class="card-body">
                    Lo sentimos no podemos encontrar la página especificada.
                </div>
            </div>
        </div>
    </div>
</body>
</html>--}}

@extends('layouts.app')

@section('breadcrumbs')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Inicio</a>
            </li>

            <li>
                <a href="#">Página de inicio</a>
            </li>
        </ul><!-- /.breadcrumb -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
@endsection


{{--@extends('errors::layout')

@section('title', 'Error 404')

    <h1>404</h1>

@section('message', 'Lo sentimos no podemos encontrar la página especificada.')--}}

