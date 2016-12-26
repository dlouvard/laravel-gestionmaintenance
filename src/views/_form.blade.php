<div class="form-group form-checkbox"><label for="maintenance_activ"
                                             class="col-sm-3 control-label ">Activer?</label>
    <div class="col-sm-9">
        @if(!$maintenance->id)
            {!! Form::checkbox('status',1,null,['class' => 'form-control activer']) !!}
        @else
            {!! Form::checkbox('status',1,null,['class' => 'form-control ']) !!}

        @endif
    </div>
</div>
{!! BootForm::text('title','Titre',null,['required','placeholder' => 'Nom donnée à cette maintenance']) !!}
<div class="form-group form-text"><label for="maintenance_begin" class="col-sm-3 control-label">Date
        Début</label>
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-4"> {!! Form::text('begin',null ,['class' => 'begin form-control','required','placeholder' => 'dd/mm/YYYY']) !!}</div>
            <div class="col-sm-4"> {!! Form::text('begin_clock',null,['class' => 'clock form-control','required','placeholder' => 'H:i']) !!}</div>
        </div>
    </div>
</div>
<div class="form-group form-text"><label for="maintenance_end" class="col-sm-3 control-label">Date
        Fin</label>
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-4"> {!! Form::text('end',null,['class' => 'end form-control','required','placeholder' => 'dd/mm/YYYY']) !!}</div>
            <div class="col-sm-4"> {!! Form::text('end_clock',null,['class' => 'clock2 form-control','required','placeholder' => 'H:i']) !!}</div>
        </div>
    </div>
</div>
{!! BootForm::textarea('body','Texte explicatif',null,['rows' => 3,'placeholder' => 'Expliquez en quelques mots le but de cette maintenance','required']) !!}

<div class="text-center margin-bottom-10">
    {!! BootForm::submit('Valider') !!}
</div>
@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.begin').datepicker(
                    {
                        "dateFormat": 'dd/mm/yy',
                        onClose: function (selectedDate) {
                            $(".end").datepicker("option", "minDate", selectedDate);
                        }
                    }
            );

            $('.end').datepicker(
                    {
                        "dateFormat": 'dd/mm/yy',
                        onClose: function (selectedDate) {
                            $(".begin").datepicker("option", "maxDate", selectedDate);
                        }
                    }
            );
           
            $('#Form').validate();
            $('.clock').clockpicker({
                placement: 'middle',
                donetext: 'Valider'
            });
            $('.clock2').clockpicker({
                placement: 'middle',
                donetext: 'Valider'
            });

        });

    </script>
@endsection