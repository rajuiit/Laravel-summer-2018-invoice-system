@extends('main')
@section('cartButton')
    <a role="button" class="buy-cart-btn" data-toggle="modal" data-target=".bs-example-modal-lg">
        <i style="margin-top: 5px; font-size: 16px;" class="fa fa-shopping-cart"></i>
        <span class="label-count"></span>
    </a>


@endSection
@section('buy')
    <!-- #START# cart  modal -->

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
                                    </tr>
                                    </thead>
                                    <tbody class="cart-data">


                                    <tr>
                                        <th scope="row">1</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    </tbody>
                                </table>

                                <!-- cart button group started -->
                                <div class="cart-btn-group">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <a class="btn btn-danger btn-block cancel">Cancel Delivery</a>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <a  class="btn btn-success btn-block deliver">Deliver Now</a>
                                            <a disabled="true" class="btn btn-success btn-block deliver-disable">Deliver Now</a>
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
        <h2>Buy Now</h2>
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
                                                        <li style="padding:5px; "><form class="{{$varTwo->modelName}}" method="post">{{csrf_field()}} <a> {{$varTwo->modelName}} <input value="{{$varTwo->modelName}}" type="hidden" name="modelName">  <input type="hidden" name="date" value="{{$showingDate}}">  <input type="number" name="quantity" min="0" /> <input name="voucherNo" type="hidden" value="{{$nextVoucherNo}}"/> <span class="btn btn-warning btn-xs pull-right data-send" onclick="form('{{$varTwo->modelName}}')" ><i  class="fa fa-arrow-right"></i></span></span> </a></form></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="#">Screen Touch</a>
                                            <ul>
                                                @foreach($model as $varTwo)
                                                    @if($var->brandName == $varTwo->brand and $varTwo->type=='screentouch')
                                                        <li style="padding:5px; "><form class="{{$varTwo->modelName}}" method="post">{{csrf_field()}} <a> {{$varTwo->modelName}} <input value="{{$varTwo->modelName}}" type="hidden" name="modelName">  <input type="hidden" name="date" value="{{$showingDate}}"> <input type="number" name="quantity" min="0" /> <input name="voucherNo" type="hidden" value="{{$nextVoucherNo}}"/> <span class="btn btn-warning btn-xs pull-right data-send " onclick="form('{{$varTwo->modelName}}')" ><i  class="fa fa-arrow-right"></i></span></span> </a></form></li>
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
                <form class="deliverForm"  method="post"  >
                    {{csrf_field()}}
                    <div class="selling-right-side">
                        <div class="selling-date">
                            <p>Selling Date</p>
                            <input name="date" readonly  class="form-control" value="{{$showingDate}}" >
                        </div>
                        <br>
                        <p>Select Customer </p>
                        <select onchange="nameTracker()"  name="sellerName" class="form-control cus-name-select"  >
                            <option> Select Seller</option>
                            @foreach($seller as $varThree)
                                <option   value="{{$varThree->name}}">{{$varThree->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                    <p>Invoice No</p>
                    <div class="Boucher-field">
                        <input name="voucherNo" type="text" class="form-control voucherNo" placeholder="Boucher No" value="{{$nextVoucherNo}}">
                    </div>


                    <br>
                    <p>Voucher Discount</p>
                    <div class="dismiss-spin">
                        <input name="voucherDiscount" type="number" class="form-control boucher-discount" placeholder="Boucher Discount %" min="0" value="0"  >
                    </div>

                    <br>
                    <p>Seller's Invoice No</p>
                    <div class="dismiss-spin">
                        <input name="sellersVoucherNo" type="text" class="form-control boucher-discount" placeholder="Boucher Discount %" min="0" value="0"  >
                    </div>

                    <br>
                    <p>My Bill</p>
                    <div class="dismiss-spin">
                        <input name="myBill" type="number" class="form-control myBill" placeholder="" min="0" value="0">
                    </div>


                    <br>
                    <p>Payment</p>
                    <div class="dismiss-spin">
                        <input name="payment" type="number" class="form-control payment-taking" placeholder="Payment Taking" min="0" value="0">
                    </div>





                    <br>
                    <div class="result">
                        <div class="priceDewResult">

                        </div>
                        <!--
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="btn btn-default fa fa-eye btn-block"> Check Profite</a>
                            </div>

                        </div>
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
                    <!--  <input type="submit" value="Go"> -->
                </form>
            </div>
        </div>


    </div>


@endSection

@section('sellScript')
    <script>

        $(window).load(function () {
            $('.deliver-disable').css({
                'display':'block'
            })
            $('.deliver').css({
                'display':'none'
            })
        })
        //taking laravel's value $varTwo->modelName as an paramiter  inside java script function ---------------
        //NCTB we can use laravel value in javascript variable as we want ....

        function form(modelName) {
            var formClass = modelName ;
            var allData = $("."+formClass).serialize();
            //  alert(allData);
            $.ajax({
                type:'post',
                url:'/addToBuyingCart',
                data:allData,
                success:function (response) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Product Added!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })


        }

        $(".buy-cart-btn").click(function () {
            // fetching carts data

            $.ajax({
                type:'get',
                url:'/buyingCartDataFetch',
                success:function (response) {
                    $(".cart-data").html(response);

                }
            })

        })


        //Sending customer name via ajax for taking his prev info (prev due , bill etc)
        function nameTracker() {

            //validating deliver button

                $('.deliver-disable').css({
                    'display':'none'
                })
                $('.deliver').css({
                    'display':'block'
                })


            var name = $( ".cus-name-select option:selected" ).val();


            //Making discount and payment 0 for accurate value
            $(".boucher-discount").val('0');
            $(".payment-taking").val('0');
            var myBill = $(".myBill").val();


            //sending name via ajax$

            $.ajax({
                type:'get',
                url:'/sellerInfoTracking/'+name+'/'+myBill+' ',
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


            //Making discount and payment 0 for accurate value
            $(".boucher-discount").val('0');
            $(".payment-taking").val('0');

            //   alert(paying);
            //  alert(name);
            $.ajax({
                type:'get',
                url:'/cusInfoTracking/'+name+' ',
                success:function (response) {
                    $(".priceDewResult").html(response);
                }
            })
        })


        $(".payment-taking, .myBill").keyup(function () {
            //how much taka client paying to us it is here ...............
            var name = $( ".cus-name-select option:selected" ).val();
         //   var discount = $(".boucher-discount").val();
            var paying = $(".payment-taking").val();
            var myBill = $(".myBill").val();

            if(paying > myBill){
                $(".payment-taking").val('0');

            }


            $.ajax({
                type:'get',
                url:'/buyingDiscountCounter/'+name+'/'+paying+'/'+myBill+' ',
                success:function (response) {
                    var a = response;
                    if(a=='0'){
                        $(".payment-taking").val('0');
                    }else {
                        $(".total-slog").html(a + " tk");
                    }

                }
            })
        })


        //Code for cheking profite


        $(".fa-eye").click(function () {
            var discount = $(".boucher-discount").val();
            $.ajax({
                type:'get',
                url:'/checkProfite/'+discount+' ',
                success:function (response) {
                    if(response>= 0){
                        alert("Profite " + response +" Taka");
                    }else if(response <= 0){

                        alert("Loss " + -(response) +" Taka");
                    }
                    else if(response == "NAN"){
                        alert("Your cart is empty");
                    }
                }
            })
        })

        function cartDelete(a) {
            alert(a);
        }


        //Code for deliver Button --------------------------------------------------------------------


        $(".deliver").click(function () {

            var allData = $(".deliverForm").serialize();



            $.ajax({
                type:'post',
                url:'/buyingDeliver',
                data:allData,
                success:function (response) {
                    if(response == "1"){
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Purchased Successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.location = "/";
                    }else {

                        swal({
                            type: 'error',
                            title: 'Ooops !! No Product To deliver.',
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



    </script>
@endSection
