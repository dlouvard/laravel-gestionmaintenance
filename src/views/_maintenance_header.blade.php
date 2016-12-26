@if(maintenance_status())
    <div class="project-context margin-top-5" style="height:30px">
        @if(maintenance_status() == 1)
            <span class="label txt-color-red font-sm"><i class="fa fa-warning fa-pulsate"></i> Attention maintenance en cours:<span
                        class="hidden-xs">{{maintenance_remaning('end')}}
                    Fin de maintenance</span></span>
        @elseif(maintenance_status() == 2)
            <span class="label txt-color-yellow  font-sm"><i class="fa fa-warning fa-pulsate"></i> Attention maintenance prévue:<span
                        class="hidden-xs">{{maintenance_remaning()}}
                    Maintenance</span></span>
        @endif
        @if(can('maintenance'))
            <span class="project-selector"><a
                        href="{{action('\Dlouvard\LaravelGestionmaintenance\GestionMaintenanceController@index')}}">{{maintenance()}}</a></span>
        @else
            <span class="project-selector">{{maintenance()}}</span>
        @endif
    </div>
@endif