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
                            Boucher List
                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>Voucher No</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Voucher No</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($sellingVouchers as $var)
                                <tr>
                                    <td>{{$var->customerName}}</td>
                                    <td>{{$var->voucherNo}}</td>
                                    <td><a class="btn btn-primary">Edit</a></td>
                                    <td><a class="btn btn-danger">Delete</a></td>

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
