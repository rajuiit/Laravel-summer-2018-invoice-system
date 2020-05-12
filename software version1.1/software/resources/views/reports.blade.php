@extends('main')
@section('productList')

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                         Reports of last years
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
                <div class="body">
                    <a href="/reportsController/{{$year}}" class="btn btn-primary">{{$year}}</a>
                    <a href="/reportsController/{{$year-1}}" class="btn btn-primary">{{$year-1}}</a>
                    <a href="/reportsController/{{$year-2}}" class="btn btn-primary">{{$year-2}}</a>
                    <a href="/reportsController/{{$year-3}}" class="btn btn-primary">{{$year-3}}</a>
                    <a href="/reportsController/{{$currentYear}}" class="btn btn-danger pull-right"> Back to {{$currentYear}}</a>

                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover  ">
                            <thead>
                            <tr>
                                <th>Month Name</th>
                                <th>Sold</th>
                                <th>Brought</th>
                                <th>Cost</th>
                                <th>Profit/loss   ( ' - ' sign mean loss ) </th>
                            </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody class="month-list">

                               @if($jan)
                                   <tr >
                                       <td>January</td>
                                       <td>{{$janSold}}</td>
                                       <td>{{$janBrought}}</td>
                                       <td>{{$totalCost}}</td>
                                       <td>{{$janProf}}</td>
                                   </tr>
                               @endif

                               @if($feb)
                                   <tr>
                                    <td>February</td>
                                       <td>{{$febSold}}</td>
                                       <td>{{$febBrought}}</td>
                                       <td>{{$totalCostFeb}}</td>
                                       <td>{{$febProf}}</td>
                                </tr>
                               @endif

                               @if($mar)
                                   <tr>
                                       <td>March</td>
                                       <td>{{$marchSold}}</td>
                                       <td>{{$marchBrought}}</td>
                                       <td>{{$totalCostMarch}}</td>
                                       <td>{{$marchProf}}</td>
                                   </tr>
                               @endif

                               @if($apr)
                                   <tr>
                                       <td>April</td>
                                       <td>{{$aprSold}}</td>
                                       <td>{{$aprBrought}}</td>
                                       <td>{{$totalCostApr}}</td>
                                       <td>{{$aprProf}}</td>
                                   </tr>
                               @endif

                               @if($may)
                                   <tr>
                                       <td>May</td>
                                       <td>{{$maySold}}</td>
                                       <td>{{$mayBrought}}</td>
                                       <td>{{$totalCostMay}}</td>
                                       <td>{{$mayProf}}</td>
                                   </tr>
                               @endif
                               @if($jun)
                                   <tr>
                                       <td>Jun</td>
                                       <td>{{$junSold}}</td>
                                       <td>{{$junBrought}}</td>
                                       <td>{{$totalCostJun}}</td>
                                       <td>{{$junProf}}</td>
                                   </tr>
                               @endif
                               @if($jul)
                                   <tr disabled="true">
                                       <td>July</td>
                                       <td>{{$julSold}}</td>
                                       <td>{{$julBrought}}</td>
                                       <td>{{$totalCostJul}}</td>
                                       <td>{{$julProf}}</td>
                                   </tr>
                               @endif
                               @if($aug)
                                   <tr>
                                       <td>August</td>
                                       <td>{{$augSold}}</td>
                                       <td>{{$augBrought}}</td>
                                       <td>{{$totalCostAug}}</td>
                                       <td>{{$augProf}}</td>
                                   </tr>
                               @endif
                               @if($sep)
                                   <tr>
                                       <td>September</td>
                                       <td>{{$sepSold}}</td>
                                       <td>{{$sepBrought}}</td>
                                       <td>{{$totalCostSep}}</td>
                                       <td>{{$sepProf}}</td>
                                   </tr>
                               @endif
                               @if($oct)
                                   <tr>
                                       <td>October</td>
                                       <td>{{$octSold}}</td>
                                       <td>{{$octBrought}}</td>
                                       <td>{{$totalCostOct}}</td>
                                       <td>{{$octProf}}</td>
                                   </tr>
                               @endif

                               @if($nov)
                                   <tr>
                                       <td>November</td>
                                       <td>{{$novSold}}</td>
                                       <td>{{$novBrought}}</td>
                                       <td>{{$totalCostNov}}</td>
                                       <td>{{$novProf}}</td>
                                   </tr>
                               @endif
                               @if($dec)
                                   <tr>
                                       <td>December</td>
                                       <td>{{$decSold}}</td>
                                       <td>{{$decBrought}}</td>
                                       <td>{{$totalCostDec}}</td>
                                       <td>{{$decProf}}</td>
                                   </tr>
                               @endif

                               <tr style="color: red">
                                   <td><b>Yearly Reasult :</b></td>
                                   <td><b>{{$yearSold}}</b></td>
                                   <td><b>{{$yearBrought}}</b></td>
                                   <td><b>{{$yearlyCost}}</b></td>
                                   <td><b>{{$yearProf}}</b></td>
                               </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->

@endSection

@section('impScript')

    <script>

   function  detailsSelectYear() {
       var year = $( ".detailsSelectYear option:selected" ).val();

       $.ajax({

           type:'get',
           url:'/fetchYear/'+year+' ',
           success:function (response) {
               $(".month-list").html(response);

           }


       })
   }





    </script>

@endsection
