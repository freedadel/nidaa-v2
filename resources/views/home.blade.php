@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>الرئيسية</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">الرئسيسة</a></li>
                    <li class="breadcrumb-item active">البوابة</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$ads2_count}}</h3>
                    <p>وفرة</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">
                    More info <i class="fas fa-bullhorn"></i>
                </a> -->
            </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$ads1_count}}</h3>
                <p>حوجة</p>
            </div>
            <div class="icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a> -->
        </div>
    </div>
    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>مكتملة</p>
            </div>
            <div class="icon">
                <i class="fas fa-check"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a> -->
        </div>
    </div>
    
  

  
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>في الانتظار</p>
            </div>
            <div class="icon">
                <i class="fas fa-tasks"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a> -->
        </div>
    </div>


</div>


<div class="row">
 

    <div class=" col-md-12">
        <!-- LINE CHART -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">النداءات هذا الشهر</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="lineChart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>


<div class="row">
    <div class=" col-md-6">

        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">وفرة</h3>
                <div class="card-tools">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>الوفرة</th>
                        <th>منذ</th>
                        <th style="width: 40px">تاريخ</th>
                        <th style="width: 40px">محتوى</th>
                        <th style="width: 40px">النوع</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($ads1 as $index => $ad)
    
                      <tr>
                        <td>
                            {{ $index+1}}
                     </td>
                        <td>
                            @if(!empty($ad->state_id)){{\Illuminate\Support\Str::limit($ad->state->name,
                            30, $end='...')}} -
                            @endif{{\Illuminate\Support\Str::limit($ad->area, 50, $end='...')}}
                            <br></td>
                        <td>{{$ad->created_at->diffForHumans()}}</td>
                        <td>{{\Illuminate\Support\Str::limit($ad->created_at,
                            50, $end='...')}}</td>
                        
                        <td>
                            {{\Illuminate\Support\Str::limit($ad->details,
                                50, $end='...')}}
                        </td>
    
                           
                        <td><span class="badge {{$ad->htype_id==1?"bg-danger":"bg-success"}}">{{$ad->htype_id==1?"حوجة":"وفرة"}}</span></td>
                    </tr>
                                     @endforeach
    
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                The footer of the card
              </div>
        </div>
    </div>
<div class=" col-md-6">

    <div class="card card-outline card-danger">
        <div class="card-header">
            <h3 class="card-title">اخر حوجات</h3>
            <div class="card-tools">
              <!-- Buttons, labels, and many other things can be placed here! -->
              <!-- Here is a label for example -->
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>الحوجة</th>
                    <th>منذ</th>
                    <th style="width: 40px">تاريخ</th>
                    <th style="width: 40px">محتوى</th>
                    <th style="width: 40px">النوع</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($ads2 as $index => $ad)

                  <tr>
                    <td>
                        {{ $index+1}}
                 </td>
                    <td>
                        @if(!empty($ad->state_id)){{\Illuminate\Support\Str::limit($ad->state->name,
                        30, $end='...')}} -
                        @endif{{\Illuminate\Support\Str::limit($ad->area, 50, $end='...')}}
                        <br></td>
                    <td>{{$ad->created_at->diffForHumans()}}</td>
                    <td>{{\Illuminate\Support\Str::limit($ad->created_at,
                        50, $end='...')}}</td>
                    
                    <td>
                        {{\Illuminate\Support\Str::limit($ad->details,
                            50, $end='...')}}
                    </td>

                       
                    <td><span class="badge {{$ad->htype_id==1?"bg-danger":"bg-success"}}">{{$ad->htype_id==1?"حوجة":"وفرة"}}</span></td>
                  </tr>
                                 @endforeach

                </tbody>
              </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            The footer of the card
          </div>
    </div>
</div>
</div>


        @endsection

        @push('page_scripts')
        <script>
            $(function () {
                /* ChartJS
                 * -------
                 * Here we will create a few charts using ChartJS
                 */

                //--------------
                //- AREA CHART -
                //--------------

                // Get context with jQuery - using jQuery's .get() method.
                // var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

                // var areaChartData = {
                //     labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                //     datasets: [
                //         {
                //             label: 'Digital Goods',
                //             backgroundColor: 'rgba(60,141,188,0.9)',
                //             borderColor: 'rgba(60,141,188,0.8)',
                //             pointRadius: false,
                //             pointColor: '#3b8bba',
                //             pointStrokeColor: 'rgba(60,141,188,1)',
                //             pointHighlightFill: '#fff',
                //             pointHighlightStroke: 'rgba(60,141,188,1)',
                //             data: [28, 48, 40]
                //         },
                //         {
                //             label: 'Electronics',
                //             backgroundColor: 'rgba(210, 214, 222, 1)',
                //             borderColor: 'rgba(210, 214, 222, 1)',
                //             pointRadius: false,
                //             pointColor: 'rgba(210, 214, 222, 1)',
                //             pointStrokeColor: '#c1c7d1',
                //             pointHighlightFill: '#fff',
                //             pointHighlightStroke: 'rgba(220,220,220,1)',
                //             data: [90, 59, 80, ]
                //         },
                //     ]
                // }

                var areaChartOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: false,
                            }
                        }]
                    }
                }

                // // This will get the first returned node in the jQuery collection.
                // new Chart(areaChartCanvas, {
                //     type: 'line',
                //     data: areaChartData,
                //     options: areaChartOptions
                // })

                //-------------
                //- LINE CHART -
                //--------------


                let data = [];
                $.ajax({url: "report", success: function(result){
                    data=result['data']
                    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
              

                var lineChart = new Chart(lineChartCanvas, {
                    type: 'line',
                    data: {
                        labels: data.map(o => o.date ),
                        datasets: [
                            {
                        label: "H",
                        fill: false,
                        borderColor: "rgba(59, 89, 152, 1)",
                        data: data.map(o => o.H)
                        },
                        {
                        label: "W",
                        fill: false,
                        borderColor: "rgba(59, 89, 152, 1)",
                        data: data.map(o => o.W)
                        }
                    
                    ],
                    },
                    options: {
                        scales: {
                        xAxes: [{
                            type: 'time',
                            time: {
                            unit: 'day'
                            }
                        }]
                        }
                    }})

                }});





            

                // //-------------
                // //- DONUT CHART -
                // //-------------
                // // Get context with jQuery - using jQuery's .get() method.
                // var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                // var donutData = {
                //     labels: [
                //         'Chrome',
                //         'IE',
                //         'FireFox',
                //         'Safari',
                //         'Opera',
                //         'Navigator',
                //     ],
                //     datasets: [
                //         {
                //             data: [700, 500, 400, 600, 300, 100],
                //             backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                //         }
                //     ]
                // }
                // var donutOptions = {
                //     maintainAspectRatio: false,
                //     responsive: true,
                // }
                // //Create pie or douhnut chart
                // // You can switch between pie and douhnut using the method below.
                // new Chart(donutChartCanvas, {
                //     type: 'doughnut',
                //     data: donutData,
                //     options: donutOptions
                // })

                // //-------------
                // //- PIE CHART -
                // //-------------
                // // Get context with jQuery - using jQuery's .get() method.
                // var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                // var pieData = donutData;
                // var pieOptions = {
                //     maintainAspectRatio: false,
                //     responsive: true,
                // }
                // //Create pie or douhnut chart
                // // You can switch between pie and douhnut using the method below.
                // new Chart(pieChartCanvas, {
                //     type: 'pie',
                //     data: pieData,
                //     options: pieOptions
                // })

                // //-------------
                // //- BAR CHART -
                // //-------------
                // var barChartCanvas = $('#barChart').get(0).getContext('2d')
                // var barChartData = $.extend(true, {}, areaChartData)
                // var temp0 = areaChartData.datasets[0]
                // var temp1 = areaChartData.datasets[1]
                // barChartData.datasets[0] = temp1
                // barChartData.datasets[1] = temp0

                // var barChartOptions = {
                //     responsive: true,
                //     maintainAspectRatio: false,
                //     datasetFill: false
                // }

                // new Chart(barChartCanvas, {
                //     type: 'bar',
                //     data: barChartData,
                //     options: barChartOptions
                // })

                // //---------------------
                // //- STACKED BAR CHART -
                // //---------------------
                // var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
                // var stackedBarChartData = $.extend(true, {}, barChartData)

                // var stackedBarChartOptions = {
                //     responsive: true,
                //     maintainAspectRatio: false,
                //     scales: {
                //         xAxes: [{
                //             stacked: true,
                //         }],
                //         yAxes: [{
                //             stacked: true
                //         }]
                //     }
                // }

                // new Chart(stackedBarChartCanvas, {
                //     type: 'bar',
                //     data: stackedBarChartData,
                //     options: stackedBarChartOptions
                // })
            })
        </script>
        @endpush