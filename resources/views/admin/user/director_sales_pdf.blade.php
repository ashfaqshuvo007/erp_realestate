<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <!-- Bootstrap Core Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    {{--pdf style--}}
    <link rel="stylesheet" href="{{ asset('public/asset/css/pdf.css') }}">


    <title>{{ $extra['module_name']  }}</title>
</head>
<body>

@php

if($director->share === null){
    $share = 0;
    $director_share = 0;
    $agent_share = 0;

}else{
    if($director->agent_share === null){
        $director_share = $director->share;
        $agent_share = 0;
        $share = $director->share;
    }else{
       $director_share = $director->share - $director->agent_share;
       $agent_share = $director->agent_share;
       $share = $director->share;
    }

}
@endphp


<section class="content">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="bb-1 margin-bottom-10">
            <div class="header">
                <p>{{ $extra['current_date_time']  }}</p>
                <h1 class="text-center"><?php echo Config::get('settings.company_name'); ?></h1>
                <p class="text-center"><?php echo Config::get('settings.address_1'); ?></p>
            </div>
        </div>
        <div class="module_name">
            <p>Module Name : {{ $extra['module_name']  }}</p>
        </div>
        <div class="director_details">
            <h3>Sales List For : <span>{{ $director->name}}</span> <small class="text-warning">Total Commision: {{ ($share)}}&nbsp;% &nbsp;Director Share: {{$director_share }}&nbsp;% &nbsp; Agent Share: {{$agent_share }} %</small></h3>
        </div>
        <div class="card">
            <div class="header">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table  table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th scope="col" class="text-center">Product</th>
                                        <th scope="col" class="text-center">Product Branch</th>
                                        <th scope="col" class="text-center">Sell Date</th>
                                        <th scope="col" class="text-center">Net Sell Price</th>
                                        <th scope="col" class="text-center">Director Commision</th>
                                        <th scope="col" class="text-center">Agent Name</th>
                                        <th scope="col" class="text-center">Agent Commision</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;?>
                                    @foreach($director_sales as $d)
                                        @php
                                            $branch = App\Branch::where('id',$d->branch_id)->first();
                                            $employee = App\Employee::where('id', $d->employee_id)->first();
                                            $product_details = App\Product::where('id',$d->product_id)->first();
                                            $branch_name = is_null($branch) ? " " : $branch->name;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $d->product_id }}</td>
                                            <td class="text-center">{{ $branch_name }}</td>
                                            <td class="text-center">{{$d->sells_date}}</td>
                                            <td class="text-center">{{$product_details->net_sells_price}}</td>
                                            <td class="text-center">{{($product_details->net_sells_price)* ($director_share/100)}}</td>
                                            <td class="text-center">{{ $employee->name }}</td>
                                            <td class="text-center">{{($product_details->net_sells_price)* ($agent_share/100)}}</td>
                                        </tr>
                                <?php $i++;?>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Product</th>
                                        <th>Product Branch</th>
                                        <th>Sell Date</th>
                                        <th>Net Sell Price</th>
                                        <th>Director Commision</th>
                                        <th>Agent Name</th>
                                        <th>Agent Commision</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Inline Layout | With Floating Label -->
</section>

</body>
</html>

