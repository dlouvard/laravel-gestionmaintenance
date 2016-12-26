@if(maintenance_status())
    <div class="row login">
        <div class="col-sm-6 col-sm-offset-3 col-xs-12">
            <section class="card clearfix padding-10">
                {!!  maintenance_title()!!}
                <h5 class="text-center">{{maintenance()}}</h5>
            </section>
        </div>
    </div>
@endif