@extends ('main')
@section('dashboard')

<div class="block-header">
    <h2>DASHBOARD</h2>
</div>

<!-- Widgets -->
<div class="row clearfix">
    <div class="well">
        <h4>Todays Analysis ({{$today}})</h4>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">Brought</div>
                <div class="number count-to" data-from="0" data-to="{{$todaysBrought}}" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">credit_card</i>
            </div>
            <div class="content">
                <div class="text">Sold</div>
                <div class="number count-to" data-from="0" data-to="{{$todaysSold}}" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">money</i>
            </div>
            <div class="content">
                <div class="text">Profit</div>
                <div class="number count-to" data-from="0" data-to="{{$todaysProfite}}" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">mobile_friendly</i>
            </div>
            <div class="content">
                <div class="text">Total Product</div>
                <div class="number count-to" data-from="0" data-to="{{$todaysQuantity}}" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->

<div class="row clearfix">
    <div class="well">
        <div class="row">
            <div class="col-xs-3">
                <select  class="form-control selectYear" name="year" onchange="manual()">
                    <option>Year</option>
                    <option value="{{$year}}">{{$year}}</option>
                    <option value="{{$year-1}}">{{$year-1}}</option>
                    <option value="{{$year-2}}">{{$year-2}}</option>
                    <option value="{{$year-3}}">{{$year-3}}</option>
                </select>
            </div>
            <div class="col-xs-3">

                <select class="form-control selectMonth"  name="month" onchange="manual()">
                    <option value="">Month</option>
                    <option value="Jan">January</option>
                    <option value="Feb">February</option>
                    <option value="Mar">March</option>
                    <option value="Apr">April</option>
                    <option value="May">May</option>
                    <option value="Jun">Jun</option>
                    <option value="Jul">July</option>
                    <option value="Aug">August</option>
                    <option value="Sep">September</option>
                    <option value="Oct">October</option>
                    <option value="Nov">November</option>
                    <option value="Dec">December</option>
                </select>
            </div>
            <div class="col-xs-3">
                <select class="form-control selectDay" onchange="manual()" >
                    <option>Day</option>
                    <option value="fullMonth">Full Month</option>

                @for($var=0 ; $var<=30; $var++)
                       <option value="{{$var+1}}">{{$var+1}}</option>
                     @endfor
                </select>
            </div>

            <div class="col-xs-3">
                <a class="btn btn-info manualDetails btn-block">Click for Details</a>
            </div>


        </div>




    </div>


 <div class="manualData">
     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
         <div class="info-box bg-pink hover-expand-effect">
             <div class="icon">
                 <i class="material-icons">playlist_add_check</i>
             </div>
             <div class="content">
                 <div class="text">Brought </div>
                 <div class="number " >0</div>
             </div>
         </div>
     </div>
     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
         <div class="info-box bg-cyan hover-expand-effect">
             <div class="icon">
                 <i class="material-icons">credit_card</i>
             </div>
             <div class="content">
                 <div class="text">Sold</div>
                 <div class="number " >0</div>
             </div>
         </div>
     </div>
     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
         <div class="info-box bg-light-green hover-expand-effect">
             <div class="icon">
                 <i class="material-icons">money</i>
             </div>
             <div class="content">
                 <div class="text">Profit</div>
                 <div class="number " >0</div>
             </div>
         </div>
     </div>
     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
         <div class="info-box bg-orange hover-expand-effect">
             <div class="icon">
                 <i class="material-icons">mobile_friendly</i>
             </div>
             <div class="content">
                 <div class="text">Total Product</div>
                 <div class="number " >0</div>
             </div>
         </div>
     </div>

 </div>



</div>
<!-- #END# Widgets -->





{{--<div class="row clearfix">--}}

    {{--<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">--}}
        {{--<div class="card">--}}
            {{--<div class="header">--}}
                {{--<div class="row clearfix">--}}
                    {{--<div class="col-xs-12 col-sm-6">--}}
                        {{--<h2>Status</h2>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-12 col-sm-6 align-right">--}}
                        {{--<div class="switch panel-switch-btn">--}}
                            {{--<span class="m-r-10 font-12">REAL TIME</span>--}}
                            {{--<label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<ul class="header-dropdown m-r--5">--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">--}}
                            {{--<i class="material-icons">more_vert</i>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu pull-right">--}}
                            {{--<li><a href="javascript:void(0);">Action</a></li>--}}
                            {{--<li><a href="javascript:void(0);">Another action</a></li>--}}
                            {{--<li><a href="javascript:void(0);">Something else here</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
            {{--<div class="body">--}}
                {{--<div id="real_time_chart" class="dashboard-flot-chart"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}



    {{--<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">--}}
        {{--<div class="card">--}}
            {{--<div class="header">--}}
                {{--<h2>Customer's Demand</h2>--}}
            {{--</div>--}}
            {{--<div class="body">--}}
                {{--<div id="donut_chart" class="dashboard-donut-chart"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


{{--</div>--}}


<br>

<!-- Task Info -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
        <div class="header">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-6">
                    <h2>Reports</h2>
                </div>
                <div class="col-xs-12 col-sm-6 align-right">
                    <ul class="nav nav-tabs" role="tab">
                        <li role="presentation" class="active"><a href="#sell" aria-controls="home" role="tab" data-toggle="tab">Sell Reports</a></li>
                        <li role="presentation"><a href="#buy" aria-controls="profile" role="tab" data-toggle="tab">Buy Reports</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="body">
            <div class="contentWrap ">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="sell">
                        <div class="chartWrap">
                            <div class="wel">
                                <select class="reportsYear" onchange="monthlyReports()">
                                    <option>Select Year</option>
                                    <option value="{{$year}}">{{$year}}</option>
                                    <option value="{{$year-1}}">{{$year-1}}</option>
                                    <option value="{{$year-2}}">{{$year-2}}</option>
                                    <option value="{{$year-3}}">{{$year-3}}</option>
                                </select>
                                <a href="/reportsController/{{$year}}" class="btn btn-primary btn-sm"> Report Details</a>

                            </div>
                            <table class="chartTable barchartContent">
                                <tr>
                                    <th  class="chartTableBars"><div  style="height: {{$jan/2000}}px;" class="chartPingBar chartGreen"><p>{{$jan}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$feb/2000}}px;" class="chartPingBar chartGreen"><p>{{$feb}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$mar/2000}}px;" class="chartPingBar chartGreen"><p>{{$mar}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$apr/2000}}px;" class="chartPingBar chartGreen"><p>{{$apr}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$may/2000}}px;" class="chartPingBar chartGreen"><p>{{$may}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$jun/2000}}px;" class="chartPingBar chartGreen"><p>{{$jun}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$jul/2000}}px;" class="chartPingBar chartGreen"><p>{{$jul}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$aug/2000}}px;" class="chartPingBar chartGreen"><p>{{$aug}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$sep/2000}}px;" class="chartPingBar chartGreen"><p>{{$sep}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$oct/2000}}px;" class="chartPingBar chartGreen"><p>{{$oct}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$nov/2000}}px;" class="chartPingBar chartRed"><p>{{$nov}}</p></div></th>
                                    <th  class="chartTableBars"><div style="height: {{$dec/2000}}px;" class="chartPingBar chartGreen"><p>{{$dec}}</p></div></th>
                                </tr>
                                <tr>
                                    <th class="chartTableBottomTimeUnits">jan</th>
                                    <th class="chartTableBottomTimeUnits">feb</th>
                                    <th class="chartTableBottomTimeUnits">mar</th>
                                    <th class="chartTableBottomTimeUnits">apr</th>
                                    <th class="chartTableBottomTimeUnits">may</th>
                                    <th class="chartTableBottomTimeUnits">jun</th>
                                    <th class="chartTableBottomTimeUnits">jul</th>
                                    <th class="chartTableBottomTimeUnits">aug</th>
                                    <th class="chartTableBottomTimeUnits">sep</th>
                                    <th class="chartTableBottomTimeUnits">oct</th>
                                    <th class="chartTableBottomTimeUnits">nov</th>
                                    <th class="chartTableBottomTimeUnits">dec</th>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="buy">
                        <select class="reportsBuyingYear" onchange="monthlyBuyingReports()">
                            <option value="0">Select Year</option>
                            <option value="{{$year}}">{{$year}}</option>
                            <option value="{{$year-1}}">{{$year-1}}</option>
                            <option value="{{$year-2}}">{{$year-2}}</option>
                            <option value="{{$year-3}}">{{$year-3}}</option>
                        </select>

                        <a href="/reportsController/{{$year}}" class="btn btn-primary btn-sm"> Report Details</a>
                        <table class="chartTable barchartContentTwo">
                            <tr>
                                <th  class="chartTableBars"><div  style="height: {{$janBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$janBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$febBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$febBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$marBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$marBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$aprBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$aprBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$mayBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$mayBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$junBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$junBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$julBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$julBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$augBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$augBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$sepBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$sepBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$octBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$octBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$novBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$novBrought}}</p></div></th>
                                <th  class="chartTableBars"><div style="height: {{$decBrought/2000}}px;" class="chartPingBar chartRed"><p>{{$decBrought}}</p></div></th>
                            </tr>
                            <tr>
                                <th class="chartTableBottomTimeUnits">jan</th>
                                <th class="chartTableBottomTimeUnits">feb</th>
                                <th class="chartTableBottomTimeUnits">mar</th>
                                <th class="chartTableBottomTimeUnits">apr</th>
                                <th class="chartTableBottomTimeUnits">may</th>
                                <th class="chartTableBottomTimeUnits">jun</th>
                                <th class="chartTableBottomTimeUnits">jul</th>
                                <th class="chartTableBottomTimeUnits">aug</th>
                                <th class="chartTableBottomTimeUnits">sep</th>
                                <th class="chartTableBottomTimeUnits">oct</th>
                                <th class="chartTableBottomTimeUnits">nov</th>
                                <th class="chartTableBottomTimeUnits">dec</th>
                            </tr>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- #END# Task Info -->

<br>
<br>
<br>

<div class="row clearfix ">
    <!-- Visitors -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
        <div class="card">
            <div class="header">
                <h2>
                    Product Alerts
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body" style="height: 250px; overflow: scroll;">

                @foreach($lessProducts as $var)
                    <div class="alert bg-teal">
                        <small>{{$var->brand}} is only {{$var->quantity}} pitch remaining</small>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- #END# Visitors -->
    <!-- Latest Social Trends -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body bg-cyan " style="height: 312px;">
                <div class="m-b--35 font-bold">Top Sold</div>
                <ul class="dashboard-stat-list">
                    <table class="table table-sell" >
                        <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Quan</th>
                        </tr>
                        </thead>

                            <tbody>
                            @foreach($maxSellingProduct as $var)

                                <tr>
                                <td>{{$var->brand}}</td>
                                <td>{{$var->modelName}}</td>
                                <td>{{$var->quantity}}</td>
                            </tr>
                                @endforeach

                            </tbody>

                    </table>


                </ul>
            </div>
        </div>
    </div>
    <!-- #END# Latest Social Trends -->
    <!-- Answered Tickets -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body bg-teal" style="height: 312px;">
                <div class="font-bold m-b--35">Top Buyer</div>
                <br>
                <br>
                <table class="table table-sell" >
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Taken Product</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($topClient as $var)

                        <tr>
                            <td>{{$var->name}}</td>
                            <td>{{$var->quantity}}</td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- #END# Answered Tickets -->





    </div>

</div>


<div>

    <!-- Nav tabs -->


    <!-- Tab panes -->


</div>

    <!--Modal for maunal check details bytton -->
<!-- Large modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

        <p onclick="printData()" class="alert alert-info"> <a class="btn btn-default" > Print</a></p>
        <div id="printTable" class="body table-responsive">

            <table width="100%s" border="1" cellpadding="3" class="table table-bordered table-striped table-hover dataTable ">
                <thead>
                <tr class="">
                    <th>VOUCHER</th>
                    <th>BRAND</th>
                    <th>MODEL</th>
                    <th>TYPE</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                </tr>
                </thead>
                <tbody class="table-data">

                <!--       <img disabled="true" src="../images/loader.gif"> -->

            </tbody>
            </table>


        </div>

        </div>
    </div>
</div>



@endsection



@section('impScript')

    <script>

        //Script for pie chart



        $(".manualDetails").click(function () {
            var year = $( ".selectYear option:selected" ).val();
            var month = $( ".selectMonth option:selected" ).val();
            var day = $( ".selectDay option:selected" ).val();



       /*     $.ajax({

                type:'get',
                url:'/manualDetails/'+year+'/'+month+'/'+day+' ',
                success:function (response) {
                    $(".table-data").html(response);

                }


            }) */

       window.location = '/manualDetails/'+year+'/'+month+'/'+day+' ';



        })

        function manual() {
            var year = $( ".selectYear option:selected" ).val();
            var month = $( ".selectMonth option:selected" ).val();
            var day = $( ".selectDay option:selected" ).val();



            $.ajax({

                type:'get',
                url:'/manualSearch/'+year+'/'+month+'/'+day+' ',
                success:function (response) {
                   $(".manualData").html(response);

                }


            })

        }

        function monthlyReports() {
            var year = $( ".reportsYear option:selected" ).val();

            $.ajax({

                type:'get',
                url:'/yearlyReports/'+year+' ',
                success:function (response) {
                   $(".barchartContent").html(response);

                }


            })

        }

    function monthlyBuyingReports() {
            var year = $( ".reportsBuyingYear option:selected" ).val();


            $.ajax({

                type:'get',
                url:'/monthlyBuyingReports/'+year+' ',
                success:function (response) {
                   $(".barchartContentTwo").html(response);

                }


            })

        }


        //Code for print button
        function printData()
        {
            var divToPrint=document.getElementById("printTable");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }


    </script>

@endsection

