@extends('main')
@section('productList')

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Costs List
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
                                <th>Reason</th>
                                <th>cause</th>
                                <th>date</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Reason</th>
                                <th>cause</th>
                                <th>date</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody class="seller-list">

                            @foreach($cost as $var)

                                <tr>
                                    <td>{{$var->reason}}</td>
                                    <td>{{$var->cost}}</td>
                                    <td>{{$var->date}}</td>
                                    <td onclick="deleteSeller('{{$var->id}}')" class="btn btn-danger btn-xs">Delete</td>

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

        function deleteSeller($id) {


            Swal.fire({
                title: 'Are you sure, You want to delete?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {


                    $.ajax({
                        type: 'get',
                        url: 'deleteCost/' + $id + ' ',
                        success: function (response) {
                            if (response == '1') {
                                fetchAfterDeleteSeller();
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



        function fetchAfterDeleteSeller(){
            $.ajax({
                type:'get',
                url:'/fetchAfterDeleteSeller',
                success:function (response) {

                    //  $(".seller-list").html(response);
                    window.location = "costLists";

                }
            })
        }




    </script>

@endsection
