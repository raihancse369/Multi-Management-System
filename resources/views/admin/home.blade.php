@extends('layouts.admin')
@section('admin_content')

@php 
    $complete_order = DB::table('orders')->where('status',1)->count();
    $new_order = DB::table('orders')->where('status',0)->count();

    $data = DB::table('reviews')
            ->leftJoin('users', 'reviews.user_id', '=', 'users.id')
            ->leftJoin('products', 'reviews.product_id', '=', 'products.id')
            ->select(
                'reviews.id',
                'reviews.review',
                'reviews.rating',
                'reviews.review_date',
                'users.name as user_name',
                'products.name as product_name',
                'products.thumbnail as product_image'
            )
            ->orderBy('reviews.id', 'DESC')
            ->get();

@endphp
                  
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Welcome !</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">{{ auth()->user()->name }}</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>

            <!--Widget-4 -->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <span class="mini-stat-icon bg-success"><i class="fa fa-usd"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter">{{ $totalsale }}</span>
                            Total Sales
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <span class="mini-stat-icon bg-purple"><i class="fa fa-shopping-cart"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter">{{ $totalProduct }}</span>
                            Total Products
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <span class="mini-stat-icon bg-primary"><i class="fa fa-group"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter">{{ $totalEmployee }}</span>
                            Total Employees
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow">
                        <span class="mini-stat-icon bg-info"><i class="fa fa-newspaper-o"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter">{{ $totalPost }}</span>
                            Total Posts
                        </div>
                    </div>
                </div>
            </div> <!-- End row-->

            <div class="row text-center">
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="panel panel-border panel-purple widget-s-1">
                        <div class="panel-heading"> </div>
                        <div class="panel-body">
                        <div class="h2 text-purple">{{ $complete_order }}</div>
                        <span class="text-muted">Total Revenue</span>
                        <div class="text-right">
                          <i class="ion-social-usd fa-2x text-purple"></i>
                        </div>
                    </div>
                    </div>
                </div>
                        
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="panel panel-border panel-primary widget-s-1">
                        <div class="panel-heading"> </div>
                        <div class="panel-body">
                        <div class="h2 text-primary">{{ $new_order }}</div>
                        <span class="text-muted">New Orders</span>
                        <div class="text-right">
                          <i class="ion-ios7-cart fa-2x text-primary"></i>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="panel panel-border panel-pink widget-s-1">
                        <div class="panel-heading"> </div>
                        <div class="panel-body">
                        <div class="h2 text-pink">{{ $totalEmployeesalary }} </div>
                        <span class="text-muted">Total Employee Salary</span>
                        <div class="text-right">
                          <i class="ion-android-contacts fa-2x text-pink"></i>
                        </div>
                    </div>
                    </div>
                </div>
                        
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="panel panel-border panel-pink widget-s-1">
                        <div class="panel-heading"> </div>
                        <div class="panel-body">
                        <div class="h2 text-pink">{{ $totalExpense }} </div>
                        <span class="text-muted">Total Expenses</span>
                        <div class="text-right">
                          <i class="ion-ios7-calculator fa-2x text-pink"></i>
                        </div>
                    </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <!-- INBOX -->
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-success px-4">
                                <i class="fa fa-user-plus mr-1"></i> Registered Users
                            </button>
                        </div>
                        <div class="panel-body">
                            <div class="inbox-widget nicescroll mx-box">
                                @foreach($user as $row)
                                    <a href="#">
                                        <div class="inbox-item d-flex align-items-center">
                                            <div class="inbox-item-img me-3">
                                                <img src="{{ $row->photo ? asset('uploads/user/' . $row->photo) : asset('uploads/default.png') }}" class="img-circle" alt="User Photo" width="45" height="45">
                                            </div>
                                            <div>
                                                <p class="inbox-item-author mb-1 fw-bold">
                                                    {{ $row->user_name ?? $row->name }}
                                                </p>
                                                <p class="inbox-item-text">{{ $row->email }}</p>

                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-purple">
                                <i class="fa fa-shopping-cart"></i> Product Review
                            </button>
                        </div>
                        <div class="panel-body">
                            <div class="inbox-widget nicescroll mx-box">
                                @foreach($data as $row)
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="{{ asset('uploads/product/'.$row->product_image) }}" class="img-circle" alt=""></div>
                                        <p class="inbox-item-author">{{ $row->user_name }}</p>
                                        <p class="inbox-item-text">{{ $row->review }}</p>
                                        <p class="inbox-item-date">{{ $row->review_date }}</p>
                                    </div>
                                </a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-primary">
                                <i class="fa fa-comments-o"></i> Contact Messages
                            </button>
                        </div>
                        <div class="panel-body">
                            <div class="inbox-widget nicescroll mx-box">
                                @foreach($contact as $row)
                                    <a href="#">
                                        <div class="inbox-item d-flex align-items-center">
                                            <div class="inbox-item-img me-3">
                                                <img src="{{ asset('uploads/user/' . ($row->photo ?? 'default.png')) }}" class="img-circle" alt="User Photo" width="45" height="45">
                                            </div>
                                            <div>
                                                <p class="inbox-item-author mb-1 fw-bold">
                                                    {{ $row->user_name ?? $row->name }}
                                                </p>
                                                <p class="inbox-item-text mb-1 text-muted">
                                                    {{ Str::limit($row->message, 60, '...') }}
                                                </p>
                                                <p class="inbox-item-date small text-secondary">
                                                    {{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- end row -->

        </div> <!-- container -->
                   
    </div> <!-- content -->

    <footer class="footer text-right">
        {{ date('Y') }} © R@ih@n
    </footer>

</div>

@endsection
