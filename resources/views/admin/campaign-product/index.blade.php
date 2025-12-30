@extends('layouts.admin') 
@section('admin_content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb pull-right">
                        <li class="active"><a href="{{ route('campaign.product.list',$campaign_id) }}">All Products For Campaign</a></li>
                    </ol>
                </div>
            </div>

            <!-- Blog Post Management -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <!-- Panel Header -->
                        <div class="panel-heading">
                            <div class="row mb-2">

                            </div><br/>
                        </div>

                        <!-- Table -->
                        <div class="panel-body">
                            <table class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th># SL</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Code</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @foreach($product as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td><img src="{{ asset('uploads/product/'.$row->thumbnail) }}" height="32" width="32"></td>
                                                <td>{{ $row->code }}</td>
                                                <td>{{ $row->category_name }}</td>
                                                <td>{{ $row->brand_name }}</td>
                                                <td>{{ $row->discount_price }}</td>
                                                <td>
                                                    @if(in_array($row->id, $existingProducts))
                                                        <button class="btn btn-secondary btn-sm" disabled><i class="fa fa-check"></i></button>
                                                    @else
                                                        <a href="{{ route('add.product.to.campaign', [$row->id, $campaign_id]) }}" class="btn btn-success btn-sm">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container -->
    </div>
    <!-- content -->



    <footer class="footer text-right">{{ date('Y') }} © R@ih@n</footer>
</div>

<!-- Scripts -->
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>


@endsection
