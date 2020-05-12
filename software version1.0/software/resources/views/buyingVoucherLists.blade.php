@extends('main')
@section('boucher')
    <div class="block-header">
        <h2>

        </h2>
    </div>

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Purchased  Lists
                    </h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>Seller Name</th>
                                <th>Voucher No</th>
                                <th>Date</th>
                                <th>Actions</th>


                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Seller Name</th>
                                <th>Voucher No</th>
                                <th>Date</th>
                                <th>Actions</th>


                            </tr>
                            </tfoot>
                            <tbody class="voucherData">
                            @foreach($buyingVoucherLists as $var)
                                <tr>
                                    <td>{{$var->sellerName}}</td>
                                    <td>{{$var->voucherNo}}</td>
                                    <td>{{$var->date}}</td>
                                    <td ><a href="buyingVoucherView/{{$var->voucherNo}}" class="btn btn-success">View</a> <a onclick="buyingVoucherDelete('{{$var->voucherNo}}')" class="btn btn-danger">Delete</a></td>
                                    {{--<a href="returnBroughtProduct/{{$var->voucherNo}}" class="btn btn-primary">Edit</a>--}}

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection



@section('sellScript')

    <script>



        function buyingVoucherDelete(voucherId) {

            Swal.fire({
                title: 'Are you sure, you want to delete it?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type:'get',
                        url:'buyingVoucherDelete/'+voucherId+' ',
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
                    url:'/buyingVoucherFetchDataAfterDelete',
                    success:function (response) {


                       // $(".voucherData").html(response);
                        window.location = "BuyingVoucherListsPage";

                    }
                })

            }

        }
    </script>

@endsection
