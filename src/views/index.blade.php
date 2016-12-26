@extends('layouts.simple')
@section('content')
    <div class=" margin-bottom-10 text-right">
        <a class="btn btn-primary"
           href="{{action('\Dlouvard\LaravelGestionmaintenance\GestionMaintenanceController@create')}}"><i
                    class="fa fa-plus"></i> Créer une maintenance</a>
    </div>
    <section class="clearfix" id="widget-grid">
        <div class="jarviswidget @if(maintenance_status()) jarviswidget-color-red @else jarviswidget-color-bluemega @endif"
             id="wid-id-0">
            <header>
                <h2>Maintenances</h2>
            </header>
            <div role="content">
                <div class="widget-body no-padding ">
                    {!! Form::hidden('csrf_token',csrf_token()) !!}
                    <table id="dt_basic"
                           class="table table-striped table-bordered table-hover dataTable"
                           width="100%">
                        <thead>
                        <tr role="row">
                            <th>Status</th>
                            <th data-class="expand">{{trad('Nom')}}</th>
                            <th>{{trad("Début")}}</th>
                            <th>{{trad("Fin")}}</th>
                            <th>Créateur</th>
                            <th>{{trad("Créer le")}}</th>
                            <th data-hide="phone" class="nofullscrenn"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($maintenances as $v)
                            <tr>
                                <td>{!! status($v->status) !!}</td>
                                <td>
                                    <a href="{{action('\Dlouvard\LaravelGestionmaintenance\GestionMaintenanceController@edit',$v->id)}}">{{$v->title}}</a>
                                </td>
                                <td>{{$v->begin_all}}</td>
                                <td>{{$v->end_all}}</td>
                                <td>{{$v->user->fullname}}</td>
                                <td>{{$v->updated_at}}</td>
                                <td class="hidden-xs">
                                    <a class="btn btn-danger btndangerwhite btn-xs" data-method="delete"
                                       data-confirm="{{trad('Etes vous sur de vouloir supprimer cette maintenance ?')}}"
                                       href="{{action('\Dlouvard\LaravelGestionmaintenance\GestionMaintenanceController@destroy',$v->id)}}"><i
                                                class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@stop
@section('script')
    <script src="/vendor/maintenances/laravel_form.js"></script>
@endsection

