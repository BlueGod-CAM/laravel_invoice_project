@extends("layouts.index")

@section("content")
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-text fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">

                            <div class='huge'>{{$item}}</div>
                            <div>Items</div>
                        </div>
                    </div>
                </div>
                <a href="/item">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class='huge'>{{$categories}}</div>
                            <div>Category</div>
                        </div>
                    </div>
                </div>
                <a href="/category">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class='huge'>{{$customers}}</div>
                            <div> Customer</div>
                        </div>
                    </div>
                </div>
                <a href="/customer">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">

                            <div class='huge'>{{$total}}</div>
                            <div>Total(USD)</div>
                        </div>
                    </div>
                </div>
                <a href="/invoice">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-blue">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class='huge'>{{$riel}}</div>
                            <div>Riel</div>
                        </div>
                    </div>
                </div>
                <a href="/invoice">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-usd fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class='huge'>{{$usd}}</div>
                            <div> USD</div>
                        </div>
                    </div>
                </div>
                <a href="/invoice">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div >
        <div id="columnchart_material" ></div>
        <div id="piechart" style="width: 100%;height: 600px;"></div>
        <div id="table_div"></div>
        <div id="columnchart_material_profit" ></div>
    </div>
@endsection
@section("script")
    <script type="text/javascript" src="{{asset("https://www.gstatic.com/charts/loader.js")}}"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Item', 'Quantity'],
                @foreach($items as $item)
                    ['{{$item->item->name}}', {{$item->where("item_id",$item->item_id)->sum("quantity")}}],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Item and Amount of sell',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Item', 'Sale(USD)'],
                @foreach($items as $item)
                    ['{{$item->item->name}}', {{$item->where("item_id",$item->item_id)->sum("total")}}],
                @endforeach
            ]);

            var options = {
                title: 'Sale Per Item(USD)'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['table']});
        google.charts.setOnLoadCallback(drawTable);

        function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Name');
            data.addColumn('number', 'Buy(USD)');
            data.addColumn("number","Buy(Riel)");
            data.addColumn("number","Total(USD)");
            data.addColumn("number","Total(Riel)");
            data.addRows([
                @foreach($invoices as $invoice)
                    ['{{$invoice->user->name ?? 'No Data'}} ',
                    {{$invoice->where("customer_id",$invoice->customer_id)->where("currency","usd")->sum("total")}},
                    {{$invoice->where("customer_id",$invoice->customer_id)->where("currency","riel")->sum("total")}},
                    {{$invoice->where("customer_id",$invoice->customer_id)->where("currency","usd")->sum("total")}}+({{$invoice->where("customer_id",$invoice->customer_id)->where("currency","riel")->sum("total")}}/4100),
                    {{$invoice->where("customer_id",$invoice->customer_id)->where("currency","riel")->sum("total")}}+({{$invoice->where("customer_id",$invoice->customer_id)->where("currency","usd")->sum("total")}}*4100)
                ],
                @endforeach
            ]);

            var table = new google.visualization.Table(document.getElementById('table_div'));

            table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Name', 'Sale Price', 'Buy Price', 'Profit'],
                @foreach($profits as $profit)
                ['{{$profit->item->name}}',{{($profit->item->sale_price)*($profit->quantity)}},{{($profit->item->purchase_price)*($profit->quantity)}},
                    {{(($profit->item->sale_price)*($profit->quantity))-(($profit->item->purchase_price)*($profit->quantity))}}],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales and Profit',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material_profit'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@endsection
