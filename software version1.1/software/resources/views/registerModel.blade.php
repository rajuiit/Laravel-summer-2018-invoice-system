@extends('main')
@section('registerProduct')
    <div class="block-header">
        <h2>Please Register Product Info</h2>
    </div>

    <form class="product-form">
        {{csrf_field()}}

        <div class="row">
            <div class="col-xs-12">
                <select name="brand-name" class="form-control">
                    @foreach($allBrand as $var)
                        <option  value="{{$var->brandName}}">{{$var->brandName}}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <input  class="form-control model-name" type="text" name="model-name" placeholder="Model Name" required onkeypress="return AvoidSpace(event)" >
            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <select name="type" class="form-control">
                    <option class="touch" value="button">Button</option>
                    <option  class="button" value="screentouch">Screen Touch</option>
                </select>
            </div>
            <br>
            <br>

            <div class="col-xs-12">
                <input  class="form-control buying-price" type="number" name="buying-price" placeholder="Buying Price" required >
            </div>
            <br>
            <br>

            <div class="col-xs-12">
                <input  class="form-control selling-price" type="number" name="selling-price" placeholder="Selling Price" required >
            </div>
            <br>
        </div>

        <div>
            <br>
            <a class="reg-model btn btn-success">Register Model</a>
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

        $(".reg-model").click(function () {

            var modelName = $(".model-name").val();
            var buyingPrice =  $(".buying-price").val();
            var sellingPrice = $(".selling-price").val();

            if(modelName == "" || buyingPrice=="" || sellingPrice== ""){
                Swal.fire({
                    type: 'error',
                    title: 'Please fill all inputs'
                })
            }else {



                var modelData = $('form').serialize();
                //sending data via ajax

                $.ajax({
                    type:'post',
                    url:'registerModel',
                    data:modelData,
                    success:function (response) {

                     if(response == "1"){
                         // Making input field null after insetting data
                         $(".model-name").val("");
                         $(".buying-price").val("");
                         $(".selling-price").val("");

                         Swal.fire({
                             position: 'top-end',
                             type: 'success',
                             title: 'Model Registered Successfully!',
                             showConfirmButton: false,
                             timer: 1500
                         })


                     }else {
                         Swal.fire({
                             type: 'error',
                             title: 'This brand name already taken'
                         })
                     }

                    }
                })
            }

        })



    </script>
@endSection
