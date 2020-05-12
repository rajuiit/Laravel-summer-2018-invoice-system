@extends('main')
@section('cartButton')
    <a role="button" class="cart-btn" data-toggle="modal" data-target=".bs-example-modal-lg">
        <input class="returnsVoucherNo" type="hidden" name="returnsVoucherNo" value="{{$voucherNo}}">
        <i style="margin-top: 5px; font-size: 16px;" class="fa fa-shopping-cart"></i>
        <span class="label-count"></span>
    </a>

@endSection
@section('return')

    <!-- #START# cart  modal -->
    <input type="hidden" class="hidden" value="{{$totalBill}}">

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Basic Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">

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
                                    <tbody class="cart-data">
                                    <tr>
                                        <th scope="row">1</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                             <!--       <img disabled="true" src="../images/loader.gif"> -->

                                    </tbody>
                                </table>

                                <!-- cart button group started -->
                                <div class="cart-btn-group">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <a  class="btn btn-danger btn-block cancel">Discard</a>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <a disabled="true" class="btn btn-success btn-block save-disable">Save Changes</a>
                                            <a class="btn btn-success btn-block save-changes">Save Changes</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- cart button group ended -->

                            </div>
                        </div>
                    </div>
                </div>

                <!-- #END# Basic Table -->


            </div>
        </div>
    </div>
    <!-- #END# cart  modal -->

    <div class="block-header">
        <h2>Return Product</h2>
    </div>


    <div class="selling-form">
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <!-- Plug in is from here -->
                <div id="outer-wrap">

                    <!-- Navigation -->
                    <nav class="mainNav">
                        @foreach($brand as $var)
                            <ul>
                                <li class="selected"><a href="#"><h5 style="text-transform: uppercase">{{$var->brandName}}</h5></a>
                                    <i class=""> </i><ul>

                                        <li><a href="#">Button</a>
                                            <ul>
                                                @foreach($model as $varTwo)
                                                    @if($var->brandName == $varTwo->brand and $varTwo->type=='button')
                                                        <li style="padding:5px; "><form class="{{$varTwo->modelName}}" method="post">{{csrf_field()}} <a> {{$varTwo->modelName}} <input value="{{$varTwo->modelName}}" type="hidden" name="modelName">  <input type="hidden" name="date" value="{{$showingDate}}">   <input type="number" name="quantity" min="0" /> <input name="voucherNo" type="hidden" value="{{$voucherNo}}"/> <span class="btn btn-warning btn-xs pull-right data-send" onclick="form('{{$varTwo->modelName}}')" ><i  class="fa fa-arrow-right"></i></span></span> </a></form></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="#">Screen Touch</a>
                                            <ul>
                                                @foreach($model as $varTwo)
                                                    @if($var->brandName == $varTwo->brand and $varTwo->type=='touch')
                                                        <li style="padding:5px; "><form class="{{$varTwo->modelName}}" method="post">{{csrf_field()}} <a> {{$varTwo->modelName}} <input value="{{$varTwo->modelName}}" type="hidden" name="modelName">  <input type="hidden" name="date" value="{{$showingDate}}"> <input type="number" name="quantity" min="0" /> <input name="voucherNo" type="hidden" value="{{$voucherNo}}"/> <span class="btn btn-warning btn-xs pull-right data-send " onclick="form('{{$varTwo->modelName}}')" ><i  class="fa fa-arrow-right"></i></span></span> </a></form></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @endforeach

                    </nav>

                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <form class="editingCartForm" action="/saveChanges"  method="post"  >
                    {{csrf_field()}}
                    <div class="selling-right-side">
                        <div class="selling-date">
                            <p>Selling Date</p>
                            <input name="date" readonly   class="form-control" value="{{$date}}" >
                        </div>
                        <br>
                        <p>Selected Customer </p>
                        <select disabled onchange="nameTracker()"  name="customerName" class="form-control cus-name-select"  >
                            <option> Select Customer</option>
                            @foreach($customer as $varThree)
                                <option {{ ( $varThree->name == $customerName ) ? 'selected' : '' }} value="{{$varThree->name}}">{{$varThree->name}}</option>
                            @endforeach
                            <!-- This hidden input is only for fetching selected customer info while page loading ) It is allowed only for this page -->
                            <input name="selected-customer" class="selectedCustomer" type="hidden" value="{{$customerName}}">
                        </select>
                    </div>

                    <br>
                    <p>Voucher No</p>
                    <div class="Boucher-field">
                        <input readonly name="voucherNo" type="text" class="form-control voucherNo" placeholder="Boucher No" value="{{$voucherNo}}">
                    </div>


                    <br>
                    <p>Voucher Discount</p>
                    <div class="dismiss-spin">
                        <input name="voucherDiscount" type="number" class="form-control boucher-discount" placeholder="Boucher Discount %" min="0" value="{{$voucherDiscount}}"  >
                    </div>


                    <br>
                    <p>Paid Before</p>
                    <div class="dismiss-spin">
                        <input disabled name="" type="number" class="form-control  payment-given" placeholder="Payment Taking" min="0" value="{{$payment}}" >
                    </div>

                    <br>
                    <p>Payment</p>
                    <div class="dismiss-spin">
                        <input name="payment" type="number" class="form-control payment-taking " placeholder="Payment Taking" min="0" value="0" >
                    </div>





                    <br>
                    <div class="result">
                        <div class="priceDewResult">

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="btn btn-default fa fa-eye btn-block"> Check Profite</a>
                            </div>

                        </div>
                        <!--
                                           <div class="sell-btn-group">
                                               <br>
                                               <br>
                                               <br>
                                               <br>
                                               <br>
                                               <div class="row">
                                                   <div class="col-xs-12">
                                                       <input  type="submit" class="btn btn-success btn-block" value="Done">
                                                   </div>
                                                   <br>
                                                   <br>

                                                   <div class="col-xs-12">
                                                       <input type="button" class="btn btn-danger btn-block" value="Cancel">
                                                   </div>
                                               </div>
                                           </div> -->
                    </div>
                  <!--   <input type="submit" value="Go"> -->
                </form>
            </div>
        </div>


    </div>


@endSection

@section('sellScript')


    <script>

        $(window).load(function () {
            $('.save-disable').css({
                'display':'block'
            })
            $('.save-changes').css({
                'display':'none'
            })
        })

        //taking laravel's value $varTwo->modelName as an paramiter  inside java script function ---------------
        //NCTB we can use laravel value in javascript variable as we want ....

        function form(modelName) {
            $('.save-disable').css({
                'display':'none'
            })
            $('.save-changes').css({
                'display':'block'
            })



            var formClass = modelName ;
            var allData = $("."+formClass).serialize();


            $.ajax({
                type:'post',
                url:'/addIntoReturn',
                data:allData,
                success:function (response) {


                    if(response=='1'){
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Product Added!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else {
                        swal({
                            type: 'error',
                            title: 'Ooops !! Not available in storage.',
                        })
                    }
                }
            })


        }

        //This cart button wll gather all data with previous data


        $(".cart-btn").click(function () {


            var voucherNo = $(".returnsVoucherNo").val();
            //  var path = window.location.href;


            $.ajax({
                type:'get',
                url:'/returnCartDataFetch/'+voucherNo+'',
                success:function (response) {
                    $(".cart-data").html(response);
                }
            })

        })


        //Sending customer name via ajax for taking his prev info (prev due , bill etc)
        function nameTracker() {



            var name = $( ".cus-name-select option:selected" ).val();

            //Changing attribute of save changes button


            //Making discount and payment 0 for accurate value
            $(".boucher-discount").val('0');
            $(".payment-taking").val('0');

            //sending name via ajax$

            $.ajax({
                type:'get',
                url:'/cusInfoTrackingForReturn/'+name+' ',
                success:function (response) {
                    $(".priceDewResult").html(response);
                }
            })
        }

        /*
           $(".payment-taking").keyup(function () {
               //how much taka client paying to us it is here ...............
               var name = $( ".cus-name-select option:selected" ).val();
               var paying = $(".payment-taking").val();

            //   alert(paying);
             //  alert(name);
               $.ajax({
                   type:'get',
                   url:'/dueCounter/'+paying+'/'+name+' ',
                   success:function (response) {
                      $(".still-due-qota").html(response);

                   }
               })
           })  */




        //This is for when user will add more after choosing customer then it will happen

        $(".data-send").click(function () {
            //how much taka client paying to us it is here ...............
            var name = $( ".cus-name-select option:selected" ).val();
            var voucherNo = $(".returnsVoucherNo").val();
            var $payment = $(".payment-given").val();



            //Changing attribute of save changes button
            $(".save-changes").removeAttr('disabled');

            //Making discount and payment 0 for accurate value
            $(".boucher-discount").val('0');
            $(".payment-taking").val('0');

            var discount = $(".boucher-discount").val();
            var paying = $(".payment-taking").val();
            var totalBill = $(".hidden").val();

            if(paying==''){
                $(".payment-taking").val(0);
            }

            if(discount==''){
                $(".boucher-discount").val(0);
            }

            //  alert(name);
            $.ajax({
                type:'get',
                url:'/cusInfoTrackingAfterClickingDataSend/'+name+'/ '+voucherNo+'/'+$payment+'/'+paying+'/'+discount+'/'+totalBill+' ',
                success:function (response) {
                    $(".priceDewResult").html(response);
                }
            })
        })


        //As doucment.ready did not working so i used alternative way

        //As in this page user want to show data of due when page will be loaded ......
        $(window).load(function(){
            var name = $(".selectedCustomer").val();


            //sending name via ajax$

            $.ajax({
                type:'get',
                url:'/cusInfoTrackingForReturn/'+name+' ',
                success:function (response) {
                    $(".priceDewResult").html(response);
                }
            })
        });



        $(".boucher-discount, .payment-taking").keyup(function () {
            //how much taka client paying to us it is here ...............
            var name = $( ".cus-name-select option:selected" ).val();
            var discount = $(".boucher-discount").val();
            var paying = $(".payment-taking").val();
           var voucherNo = $(".voucherNo").val();


            if(paying==''){
                $(".payment-taking").val(0);
            }

            if(discount==''){
                $(".boucher-discount").val(0);
            }



            //Changing attribute of save changes button
            $(".save-changes").removeAttr('disabled');


            $.ajax({
                type:'get',
                url:'/discountCounterForReturn/'+name+'/'+paying+'/'+discount+'/'+voucherNo+' ',
                success:function (response) {
                    var a = response;
                    if(a=='0'){
                        $(".payment-taking").val(0);
                    }else {
                        $(".priceDewResult").html(response);
                    }

                }
            })
        });


        //Code for cheking profite


        $(".fa-eye").click(function () {
            var discount = $(".boucher-discount").val();
            $.ajax({
                type:'get',
                url:'/checkProfiteForReturn/'+discount+' ',
                success:function (response) {
                    if(response>= 0){
                        Swal.fire("Profite " + response +" Taka")

                    }else if(response <= 0){
                        Swal.fire("Loss " + -(response) +" Taka")
                    }
                    else if(response == "NAN"){
                        swal({
                            type: 'error',
                            title: 'Ooops !! Your Cart Is Empty.',
                        })
                    }
                }
            })
        })


        //Code for deliver Button --------------------------------------------------------------------


        $(".save-changes").click(function () {

            var allData = $(".editingCartForm").serialize();

            //alert(allData);

            $.ajax({
                type:'post',
                url:'/saveChanges',
                data:allData,
                success:function (response) {
                    if(response == "1"){
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Save Changes Successfully Saved!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.location = "/";
                    }else {

                        swal({
                            type: 'error',
                            title: 'Ooops !! You Did Not Select Product.',
                        })
                    }
                }
            })

        })

        //Code for cancel button of cart
        $(".cancel").click(function () {

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to cancel this!!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type:'get',
                        url:'/cancelDelivery',
                        success:function (response) {

                            //Routing to dahsboard
                            window.location = "/"
                        }
                    })

                    Swal.fire(
                        'Canceled!',
                        'Order Canceled.',
                        'success'
                    )
                }
            })



        })

        //Vlidating input not allowed for scrolling

        $('input').on('focus', function (e) {
            $(this).on('mousewheel.disableScroll', function (e) {
                e.preventDefault();
            })
        }).on('blur', function (e) {
            $(this).off('mousewheel.disableScroll')
        });


        //


    </script>
@endSection
