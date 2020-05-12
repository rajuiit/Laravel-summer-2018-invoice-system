@extends('main')
@section('registerCustomer')
    <div class="block-header">
        <h2>Pay sallery</h2>
    </div>

    <form class="cus-form worker-reg-form" method="post"  >
        {{csrf_field()}}
        <div class="row">
            <div class="col-xs-12">
                <input class="form-control marketerName" type="text" name="name" placeholder="Marketer name" required onkeypress="return AvoidSpace(event)">
            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <input  class="form-control marketerContact" type="number" name="contact" placeholder="Contact no" required >
            </div>
            <br>
            <br>

            <div class="col-xs-12">
                <input  class="form-control marketerSallery" type="number" name="sallary" placeholder="Sallary" required >
            </div>
            <br>
            <br>

        </div>

        <div>
            <br>
            <a class="btn btn-success pay"  name="reg-cus" > + Save marketer details </a>
            <a class="btn btn-success " href="/marketerList"  name="reg-cus" > Marketer list </a>

            {{--<input class="btn btn-success pay" type="submit"  name="reg-cus" > + Save worker details </input>--}}

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

        $(".pay").click(function () {

            var name = $(".marketerName").val();
            var contact = $(".marketerContact").val();
            var sallary = $(".marketerSallery").val();




            if(name=="" || contact=="" || sallary=="" ){
                Swal.fire({
                    type: 'error',
                    title: 'Please fill all inputs'
                })
            }else {
                var costData = $('form').serialize();

                //sending data via ajax

                $.ajax({
                    type:'post',
                    url:'registerMarketer',
                    data:costData,
                    success:function (response) {

                        // Making input field null after insetting data
                        $(".workerName").val("");
                        $(".workerContact").val("");
                        $(".workerSallery").val("");

                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Worker added successfully !',
                            showConfirmButton: false,
                            timer: 1500
                        })


                    }
                })
            }


        })



    </script>
@endSection

