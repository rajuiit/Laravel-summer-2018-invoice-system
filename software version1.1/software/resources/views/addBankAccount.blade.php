@extends('main')
@section('bank')
    <div class="block-header">
        <h2>Please Register Bank Info</h2>
    </div>

    <form class="cus-form bank-form" method="post" action="/addAcName">
        {{csrf_field()}}
        <div class="row">


            <div class="col-xs-12">
                <select name="bank-name" class="form-control bankName" >
                    <option value=" ">Select Bank Name</option>
                    @foreach($bankName as $var)
                    <option value="{{$var->bankName}}">{{$var->bankName}}</option>
                    @endforeach

                </select>
            </div>

            <br>
            <br>
<div class="col-xs-12">
                <input class="form-control acName" type="text" name="ac-name" placeholder="Bank Name" required onkeypress="return AvoidSpace(event)">
            </div>
            <br>
            <br>

        </div>

        <div>
            <br>
           <a class="btn btn-success reg-ac"> Add Account </a>
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

        $(".reg-ac").click(function () {

            var bankName = $( ".bankName option:selected" ).val();
            var acName = $(".acName").val();

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
                    url:'/addAcName',
                    data:bankData,
                    success:function (response) {

                        if(response== "1"){
                            // Making input field null after insetting data
                            $(".acName").val("");
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
                                title: 'Sorry! Ac name already registered.'
                            })
                        }



                    }
                })


            }



        })



        ///Code for form validation





    </script>
@endSection


