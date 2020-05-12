@extends('main')
@section('registerCustomer')
    <div class="block-header">
        <h2>Please Register Seller Info</h2>
    </div>

    <form class="seller-form" >
        {{csrf_field()}}
        <div class="row">
            <div class="col-xs-12">
                <input style="max-width: 500px;" class="form-control seller-name" type="text" name="seller-name" placeholder="Seller Name" required onkeypress="return AvoidSpace(event)">
            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <input style="max-width: 500px;"  class="form-control seller-address" type="text" name="seller-address" placeholder="Seller Address" required >
            </div>
        </div>

        <div>
            <br>
            <a class="btn btn-success reg-seller"  name="reg-seller" > Register Seller </a>

        </div>
    </form>

@endSection


@section('impScript')
    <script>
        //SPace avoid for customer name
        function AvoidSpace(event) {
            var k = event ? event.which : window.event.keyCode;
            if (k == 32) return false;
        }

        //SPace avoid for customer name ended

        $(".reg-seller").click(function () {


            var sellerName = $(".seller-name").val();
            var sellerAddress = $(".seller-address").val();

            if(sellerName== "" || sellerAddress ==""){
                Swal.fire({
                    type: 'error',
                    title: 'Please fill all input',


                })
            }else {

                var sellerData = $('form').serialize();

                //sending data via ajax

                $.ajax({
                    type:'post',
                    url:'/registerSeller',
                    data:sellerData,
                    success:function (response) {


                        if(response== "1"){
                            // Making input field null after insetting data
                            $(".seller-name").val("");
                            $(".seller-address").val("");
                            Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: 'Seller Registered Successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }else {
                            Swal.fire({
                                type: 'error',
                                title: 'This name already taken'
                            })
                        }



                    }
                })
            }

        })



    </script>
@endSection

