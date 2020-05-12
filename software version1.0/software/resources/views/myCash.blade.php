@extends('main')

@section('sell')
    <div class="cashDiv well">
        <div class="row">
            <div class="col-xs-4">
                <h4 class="alert alert-warning">Get: {{$get}} Tk</h4>
            </div>
            <div class="col-xs-4">
                <h4 class="alert alert-success">cash: {{$recent}} Tk</h4>

            </div>
            <div class="col-xs-4">
                <h4 class="alert alert-danger">Due on market: {{$myDue}}  Tk</h4>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <form class="myForm">
                {{csrf_field()}}

                <div class="selectAccount well">
                    <p>Please first select Bank name and then selet ac</p>
                    <select name="bankName" onchange="bankSystem()" class="selectBank form-control" style="max-width: 300px">
                        <option>Select Bank</option>
                        @foreach($bankInfo as $var)
                            <option>{{$var->bankName}}</option>
                        @endforeach
                    </select>
                    <br>
                    <select name="acName" class="selectAc form-control" style="max-width: 300px;">
                        <option value="0">Select Account</option>

                    </select>
                    <br>
                    <input placeholder="amount" class="form-control amount" name="amount" type="number" style="max-width: 300px;">
                    <br>

                    <a class="btn btn-success sendToBank"> Send to Bank</a>
                    <br>
                    <a class="btn btn-danger withDrawFromBank"> withdraw from Bank</a>

                </div>
            </form>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="bankTotak well text-center " style="color: #2b982b;">
                <i style="font-size: 60px;" class="fa fa-money-bill-alt"></i>
                <h4>Total amount (Bank) : {{$total}}</h4>
            </div>
        </div>
    </div>


@endSection

@section('impScript')
    <script>

        $(window).load(function () {
            $(".sendToBank, .withDrawFromBank").css({
                'display':'none'
            })
        })



        function bankSystem() {

          var bankName = $( ".selectBank" ).val();


          //After selecting bank all account under this bankname will be shown into second combo box

          $.ajax({

              type:'get',
              url:'/acName/'+bankName+' ',
              success:function (response) {
                  $(".selectAc").html(response);
               }
          })

            $(".sendToBank, .withDrawFromBank").css({
                'display':'block',
                'max-width':'300px'
            })


        }

        $(".sendToBank").click(function () {

            var bankName = $(".selectBank").val();
            var acName = $(".selectAc").val();
            var amount = $(".amount").val();


             $.ajax({
                 type: 'get',
                 url:'/sendToBank/'+bankName+'/'+acName+'/'+amount+'  ',
                 success:function (response) {

                         Swal.fire({
                             position: 'top-end',
                             type: 'success',
                             title: 'Amount Added to '+bankName+' successfully !',
                             showConfirmButton: false,
                             timer: 1500
                         })

                     $(".amount").val("");
                     window.location = "/myCash";

                 }

             })
        })

        $(".withDrawFromBank").click(function () {

            var bankName = $(".selectBank").val();
            var acName = $(".selectAc").val();
            var amount = $(".amount").val();

            $.ajax({
                type: 'get',
                url:'/wthdrawFromBank/'+bankName+'/'+acName+'/'+amount+'  ',
                success:function (response) {

                   if(response=="0"){
                       Swal.fire({
                           type: 'error',
                           title: 'You dont have enough balance'
                       })
                   }else {

                       Swal.fire({
                           position: 'top-end',
                           type: 'success',
                           title: 'Amount withdrawn from '+bankName+' successfully !',
                           showConfirmButton: false,
                           timer: 1500
                       })


                   }

                    $(".amount").val("");
                    window.location = "/myCash";

                }

            })
        })



    </script>
@endSection
