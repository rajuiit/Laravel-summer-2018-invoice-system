@extends('main')
@section('bank')
    <div class="block-header">
        <h2>Please Register Bank Info</h2>
    </div>

    <form class="cus-form bank-form" method="post" action="/registerBank">
        {{csrf_field()}}
        <div class="row">
            <div class="col-xs-12">
                <input class="form-control bankName" type="text" name="bank-name" placeholder="Bank Name" required onkeypress="return AvoidSpace(event)">
            </div>
            <br>
            <br>

        </div>

        <div>
            <br>
          <a class="btn btn-success reg-bank"  name="reg-bank"> Register Bank Name</a>

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

        $(".reg-bank").click(function () {

            var bankName = $('.bankName').val();
            var acName = $(".accountName").val();

            if(bankName== "" || acName ==""){
                Swal.fire({
                    type: 'error',
                    title: 'Please Insert Bank Name & AC Name'

                })
            }else {

                var bankData = $('form').serialize();

                //sending data via ajax
                $.ajax({
                    type:'post',
                    url:'/registerBank',
                    data:bankData,
                    success:function (response) {

                        if(response== "1"){
                            // Making input field null after insetting data
                            $(".bankName").val("");
                            $(".accountName").val("");
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
                                title: 'Sorry! Bank name already registered.'
                            })
                        }



                    }
                })


            }



        })



        ///Code for form validation





    </script>
@endSection


