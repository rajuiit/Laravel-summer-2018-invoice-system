@extends('main')
@section('registerCustomer')
    <div class="block-header">
        <h2>Please Register Customer Info</h2>
    </div>

    <form class="cus-form"   >
        {{csrf_field()}}
        <div class="row">
            <div class="col-xs-12">
                <input class="form-control reason" type="text" name="reason" placeholder="Cost reason" required onkeypress="return AvoidSpace(event)">
            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <input  class="form-control cost" type="number" name="cost" placeholder="Amount" required >
            </div>
            <br>
            <br>

        </div>

        <div>
            <br>
            <a class="btn btn-success reg-cost"  name="reg-cus" > + Add cost </a>
            <a class="btn btn-success view-cost" href="/costLists"  >  View cost </a>

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

        $(".reg-cost").click(function () {

            var reason = $(".reason").val();
            var cost = $(".cost").val();


            if(reason=="" || cost=="" ){
                Swal.fire({
                    type: 'error',
                    title: 'Please fill all inputs'
                })
            }else {
                var costData = $('form').serialize();

                //sending data via ajax

                $.ajax({
                    type:'post',
                    url:'insertCost',
                    data:costData,
                    success:function (response) {

                            // Making input field null after insetting data
                            $(".reason").val("");
                            $(".cost").val("");

                            Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: 'Cost added successfully !',
                                showConfirmButton: false,
                                timer: 1500
                            })


                    }
                })
            }


        })



    </script>
@endSection

