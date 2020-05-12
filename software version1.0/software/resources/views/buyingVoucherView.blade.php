@extends('main')
@section('boucher')


    <!-- Lists Table -->
    <span><a class="btn btn-success" onclick="printData()"> <i class="fa fa-print"></i> Print Invoice </a></span>
    <br>
    <br>
    <div id="printTable" >
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Invoice No : {{$voucherInfo->voucherNo}}
                    </h2>

                </div>

                <div class="body ">

                    <div class="table-responsive">
                        <table width="100%s" border="1" cellpadding="3" class="table table-bordered table-striped table-hover dataTable ">
                            <div class="well">
                                <h3>Prodip Enterprize</h3>
                                <br>
                                <p><b>Seller Name : {{$voucherInfo->sellerName}}</b></p>
                                <p>Invoice No       : {{$voucherInfo->voucherNo}} </p>
                                <p>Delivery Date    : {{$voucherInfo->date}}</p>
                                <p>Invoice Discount : {{$voucherInfo->voucherDiscount}} %</p>
                                <p>Total Bill       : {{$voucherInfo->myBill}} TK</p>
                                <p>Paid             : {{$voucherInfo->payment}} TK</p>

                            </div>

                            <thead>

                            <tr style="text-align: left">
                                <th>Brand</th>
                                <th>Model Name</th>
                                <th>Type</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr style="text-align: left">
                                <th>Brand</th>
                                <th>Model Name</th>
                                <th>Type</th>
                                <th>Quantity</th>
                            </tr>
                            </tfoot>
                            <tbody class="voucherData">
                            @foreach($voucherDetailsInfo as $var)
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

