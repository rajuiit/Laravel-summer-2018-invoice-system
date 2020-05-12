@extends('main')
@section('boucher')


    <span><a class="btn btn-success" onclick="printData()"> <i class="fa fa-print"></i> Print Records </a></span>
    <br>
    <br>
    <div id="printTable" >
        <!-- Lists Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">

                        <h2>
                             History of {{ $date }}
                        </h2>

                    </div>

                    <div class="body ">

                        <div class="table-responsive">
                            <table width="100%s" border="1" cellpadding="3" class="table table-bordered table-striped table-hover dataTable ">
                                <h5 class="text-center well">Selling History</h5>
                                <thead>

                                <tr style="text-align: left">
                                    <th>Voucher No</th>
                                    <th>Brand</th>
                                    <th>Model Name</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr style="text-align: left">
                                    <th>Total</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>{{$quantityData}}</th>
                                    <th>{{$price}}</th>
                                </tr>
                                </tfoot>
                                <tbody class="voucherData">
                               @foreach ($data as $var)

                                <tr>
                                    <td>{{$var->voucherNo}}</td>
                                    <td>{{$var->brand}}</td>
                                    <td>{{$var->modelName}}</td>
                                    <td>{{$var->type}}</td>
                                    <td>{{$var->quantity}}</td>
                                    <td>{{$var->sellingPrice}}</td>

                                </tr>

                                @endforeach

                                </tbody>

                            </table>
                        </div>

                        <!-- Buying History -->

                        <div class="table-responsive">
                            <table width="100%s" border="1" cellpadding="3" class="table table-bordered table-striped table-hover dataTable ">
                                <h5 class="text-center well">Buying History</h5>
                                <thead>

                                <tr style="text-align: left">
                                    <th>Voucher No</th>
                                    <th>Brand</th>
                                    <th>Model Name</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr style="text-align: left">
                                    <th>Total</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>{{$bquantityData}}</th>
                                    <th>{{$bprice}}</th>
                                </tr>
                                </tfoot>
                                <tbody class="voucherData">
                                @foreach ($bdata as $var)

                                    <tr>
                                        <td>{{$var->voucherno}}</td>
                                        <td>{{$var->brand}}</td>
                                        <td>{{$var->modelName}}</td>
                                        <td>{{$var->type}}</td>
                                        <td>{{$var->quantity}}</td>
                                        <td>{{$var->myBill}}</td>

                                    </tr>

                                @endforeach

                                </tbody>

                            </table>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>





@endSection


@section('sellScript')

    <script>
        //Code for print button
        function printData()
        {
            var divToPrint=document.getElementById("printTable");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }


    </script>

@endsection
