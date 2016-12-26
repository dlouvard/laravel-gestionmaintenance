@extends('layouts.simple')
@section('content')
    <div class=" margin-bottom-10">
        <div class=" text-right">
            <a class="btn btn-primary" href="{{action('\Dlouvard\LaravelGestionmaintenance\GestionMaintenanceController@index')}}"><i
                        class="fa fa-reply"></i> {{trad('Retour')}}</a>

        </div>
    </div>
    <section class="clearfix" id="widget-grid">
        <div class="jarviswidget jarviswidget-color-bluemega" id="wid-id-0">
            <header>
                <h2>{{trad("Editer cette nouvelle maintenance")}}</h2>
            </header>
            <div role="content">
                <div class="widget-body ">
                    <div class="col-sm-10 col-sm-offset-1">
                        {!! BootForm::open($maintenance,['class' => 'form-horizontal','id' => 'Form','method' => 'PUT','url' => action('\Dlouvard\LaravelGestionmaintenance\GestionMaintenanceController@update',$maintenance->id)]) !!}
                        @include('vendor.maintenances._form')
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

