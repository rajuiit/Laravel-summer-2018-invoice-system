@extends('main')
@section('registerBrand')
    <div class="block-header">
        <h2>Please Register Brands</h2>
    </div>

    <form class="brand-form">
        {{csrf_field()}}
        <div class="row">
            <div class="col-xs-12">
                <input class="form-control brand-name" type="text" name="brand-name" placeholder="Brand name " required onkeypress="return AvoidSpace(event)">
            </div>
            <br>

        </div>

        <div>
            <br>
            <a class="reg-brand btn btn-success" >Register Brand</a>
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

        $(".reg-brand").click(function () {

            var brandName = $(".brand-name").val();

            if(brandName==""){
                Swal.fire({
                    type: 'error',
                    title: 'Please fill the input'
                })
            }else {


                var brandName = $('form').serialize();

                //sending data via ajax

                $.ajax({
                    type:'post',
                    url:'registerBrand',
                    data:brandName,
                    success:function (response) {
                          if(response=="1"){
                              // Making input field null after insetting data
                              $(".brand-name").val("");
                              Swal.fire({
                                  position: 'top-end',
                                  type: 'success',
                                  title: 'Brand Registered Successfully!',
                                  showConfirmButton: false,
                                  timer: 1500
                              })
                          }else{
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
