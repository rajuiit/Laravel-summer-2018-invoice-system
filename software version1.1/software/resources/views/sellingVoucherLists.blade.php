@extends('main')
@section('boucher')
    <div class="block-header">
        <h2>

        </h2>
    </div>

    <!-- Lists Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Boucher List
                    </h2>

                </div>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Voucher No</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Customer Name</th>
                                <th>Voucher No</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody class="voucherData">
                            @foreach($sellingVouchers as $var)
                                <tr>
                                    <td>{{$var->customerName}} </td>
                                    <td>{{$var->voucherNo}}</td>
                                    <td>{{$var->date}}</td>
                                    <td >
                                        <a href="/sellingVoucherView/{{$var->voucherNo}}" class="btn btn-success">View</a>
                                        {{--<a href="/returnPage/{{$var->voucherNo}}" class="btn btn-primary return" >Edit<a>--}}
                                        <a onclick="deletingIdPass('{{$var->voucherNo}}')" class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Modal view  -->
    <div class="modal fade sellingViewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>BRAND</th>
                            <th>MODEL</th>
                            <th>TYPE</th>
                            <th>QUANTITY</th>
                            <th>PRICE</th>
                        </tr>
                        </thead>
                        <tbody class="viewing-data">


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- #END# view  modal -->



@endSection


@section('sellScript')

    <script>



        function deletingIdPass(voucherId) {

            Swal.fire({
                title: 'Are you sure,You want to delete this?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type:'get',
                        url:'deleteVoucher/'+voucherId+' ',
                        success:function (response) {
                            if(response == '1'){
                                fetchDataAfterDelete();
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



            function fetchDataAfterDelete(){
               $.ajax({
                   type:'get',
                   url:'/fetchDataAfterDelete',
                   success:function (response) {
                     //$(".voucherData").html(response);

                       //Routing to dahsboard
                       window.location = "sellingVoucherListsPage";
                   }
               })

           }

        }
    </script>

@endsection
