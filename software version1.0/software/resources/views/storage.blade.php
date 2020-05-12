@extends('main')
@section('productList')

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Product List
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Type</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Type</th>
                                <th>Quantity</th>
                            </tr>
                            </tfoot>
                            <tbody class="storage-list">

                            @foreach($list as $var)

                                <tr>
                                    <td>{{$var->brand}}</td>
                                    <td>{{$var->modelName}}</td>
                                    <td>{{$var->type}}</td>
                                    <td>{{$var->quantity}}</td>

                                </tr>

                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->

@endSection

