@extends('main')
@section('registerCustomer')
    <div class="block-header">
        <h2>Pay form</h2>
    </div>

    <form class=" pay-for" style="max-width: 450px;" action="paid" method="post" >
        {{csrf_field()}}
        <div class="row">
            <div class="col-xs-12">
                <input  class="form-control name" type="text" name="name" placeholder="Sallary" required value="{{$info->name}}" >

            </div>

            <br>
            <br>

            <div class="col-xs-12">
                <select class="form-control " name="type">
                    <option value="pass">Passed (Target)</option>
                    <option value="failed">Not passed (Target)</option>
                </select>
                <span>Passed (Target) marketer will get bonus</span>
            </div>

            <br>
            <br>
            <br>

            <div class="col-xs-12">
                <input readonly  class="form-control totalSallary" type="number" name="totalSallary" placeholder="Sallary" required value="{{$info->sallary}}" >
            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <input readonly  class="form-control cell" type="hidden" name="cell" placeholder="Sallary" required value="{{$info->contact}}" >
            </div>
            <br>
            <br>

            <div class="col-xs-12">
                <select class="form-control " name="process">
                    <option value="timely">Timely</option>
                    <option value="advance">Advance</option>
                </select>
            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <select class="form-control " name="month">
                    <option value="jan">Jan</option>
                    <option value="feb">Feb</option>
                    <option value="mar">Mar</option>
                    <option value="apr">Apr</option>
                    <option value="jun">Jun</option>
                    <option value="jul">Jul</option>
                    <option value="aug">Aug</option>
                    <option value="sep">Sep</option>
                    <option value="oct">Oct</option>
                    <option value="nov">Nov</option>
                    <option value="dec">Dec</option>

                </select>

            </div>
            <br>
            <br>
            <div class="col-xs-12">
                <select class="form-control " name="year">
                    <option value="2019">{{$year}}</option>

                </select>
            </div>

            <div class="col-xs-12">
                <input  class="form-control sallary" type="number" name="sallary" placeholder="Sallary" required >
            </div>
            <br>


        </div>

        <div>
            <br>
            <a class="btn btn-success reg-cost"  name="reg-cus" >  Pay </a>
            {{--<input type="submit" name="" value="sunnn">--}}

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

            var sallary = $(".sallary").val();


            if( sallary=="" ){
                Swal.fire({
                    type: 'error',
                    title: 'Please fill all inputs'
                })
            }else {
                var costData = $('form').serialize();

                //sending data via ajax

                $.ajax({
                    type:'post',
                    url:'mPaid',
                    data:costData,
                    success:function (response) {

                        // Making input field null after insetting data
                        $(".reason").val("");
                        $(".cost").val("");

                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Paid successfully !',
                            showConfirmButton: false,
                            timer: 1500
                        })


                    }
                })
            }


        })



    </script>
@endSection

