@extends('main')
@section('productList')

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Bank Balance List
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
                                <th>Bank Name</th>
                                <th>Account No</th>
                                <th>Balance</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Bank Name</th>
                                <th>Account No</th>
                                <th>Balance</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>

                            <tbody class="">
                            @foreach($bankData as $var)

                                <tr>
                                    <td>{{$var->bankName}}</td>
                                    <td>{{$var->acName}}</td>
                                    <td>{{$var->balance}}</td>
                                    <td><a onclick="deleteBank('{{$var->bankName}}')" class="btn btn-danger" >Delete Bank </a> || <a onclick="deleteAc('{{$var->acName}}')" class="btn btn-danger">Delete Account</a></td>

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


        function deleteBank(bankName) {

            Swal.fire({
                title: 'Are you sure, You want to delete '+bankName+ '?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type: 'get',
                        url: 'deleteBank/' + bankName + ' ',
                        success: function (response) {
                           if(response==0){
                               swal({
                                   type: 'error',
                                   title: 'You can not delete as this bank is not empty !',
                               })
                           }else {

                               Swal.fire(
                                   'Deleted!',
                                   'Your bank has been deleted.',
                                   'success'
                               )

                               window.location="/bankList"
                           }
                        }
                    })

                }
            })



        }


        //Code for deleting account

        function deleteAc(acName) {

            Swal.fire({
                title: 'Are you sure, You want to delete '+acName+ '?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type: 'get',
                        url: 'deleteAc/' + acName + ' ',
                        success: function (response) {
                            if(response==0){
                                swal({
                                    type: 'error',
                                    title: 'You can not delete as this account is not empty !',
                                })
                            }else {

                                Swal.fire(
                                    'Deleted!',
                                    'Your account has been deleted.',
                                    'success'
                                )

                                window.location="/bankList"
                            }
                        }
                    })

                }
            })



        }










    </script>

@endsection
