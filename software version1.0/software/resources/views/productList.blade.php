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
                                <th>type</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Available</th>
                                <th>Buying Price</th>
                                <th>Selling Price</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody class="product-list">

                            @foreach($list as $var)

                                <tr>
                                    <td>{{$var->brand}}</td>
                                    <td>{{$var->modelName}}</td>
                                    <td>{{$var->type}}</td>
                                    <td>{{$var->buyingPrice}}</td>
                                    <td>{{$var->sellingPrice}}</td>
                                    <td onclick="deleteModel('{{$var->modelName}}')" class="btn btn-danger btn-xs">Delete</td>

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

@section('impScript')

    <script>

        function deleteModel(modelName) {

            Swal.fire({
                title: 'Are you sure, You want to delete it?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    $.ajax({

                        type: 'get',
                        url: 'deleteProduct/' + modelName + ' ',
                        success: function (response) {
                            if (response == '1') {
                                fetchAfterDeleteProductList();
                            }
                        }
                    })


                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })


        }



            function fetchAfterDeleteProductList(){
                $.ajax({
                    type:'get',
                    url:'/fetchAfterDeleteProductList',
                    success:function (response) {
                  //      alert('sdf');
                       // $(".product-list").html(response);
                        window.location = "/productList";

                    }
                })
            }







    </script>

@endsection
