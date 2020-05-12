@extends('main')
@section('registerCustomer')
    <div class="block-header">
        <h2>Please Register Customer Info</h2>
    </div>

    <form class="cus-form" >
        {{csrf_field()}}
        <div class="row">
            <div class="col-xs-12">
                <input class="form-control cus-name" type="text" name="cus-name" placeholder="Customer Name" required onkeypress="return AvoidSpace(event)">
            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <input  class="form-control cus-address" type="text" name="cus-address" placeholder="Customer Address" required >
            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <input  class="form-control cus-address mobile" type="number" name="mobile-no" placeholder="Mobile No" required >
            </div>
        </div>

        <div>
            <br>
            <a class="btn btn-success reg-cus"  name="reg-cus" > Register Custgomer </a>

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

        $(".reg-cus").click(function () {

            var cusName = $(".cus-name").val();
            var cusAddress = $(".cus-address").val();
            var mobileNo = $(".mobile").val();

            if(cusName=="" || cusAddress=="" || mobileNo=='' ){
                Swal.fire({
                    type: 'error',
                    title: 'Please fill all inputs'
                })
            }else {
                var customerData = $('form').serialize();

                //sending data via ajax

                $.ajax({
                    type:'post',
                    url:'registerCustomer',
                    data:customerData,
                    success:function (response) {

                        if(response== "1"){
                            // Making input field null after insetting data
                            $(".cus-name").val("");
                            $(".cus-address").val("");

                            Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: 'Customer Registered Successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }else {
                            Swal.fire({
                                type: 'error',
                                title: 'This customer name or phone no already taken'
                            })
                        }


                    }
                })
            }


        })



    </script>
@endSection

