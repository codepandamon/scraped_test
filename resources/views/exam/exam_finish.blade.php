@extends('admin.admin_master')
@section('index')
<div class="content-wrapper wrapper hold-transition dark-skin sidebar-mini theme-primary">
    <div class="container-full">

        <!-- Main content -->
        <section class="content ">
            <div class="row">
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                            <h3>{{(Session::get('results'))}}</h3>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>




@endsection