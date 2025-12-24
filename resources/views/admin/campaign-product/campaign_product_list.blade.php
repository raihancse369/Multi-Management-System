@extends('layouts.admin') 
@section('admin_content')

<div class="content-page">
    <div class="content">
        <div class="container">

            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb pull-right">
                        <li class="active"><a href="{{ route('campaign.index') }}">Campaign</a></li>
                    </ol>
                </div>
            </div>

            <!-- Campaign Products Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row mb-2">

                            </div><br/>
                        </div>

                        <div class="panel-body">

                            <!-- Debug dump for products array -->
                            {{-- Uncomment below for debugging --}}
                            {{-- <pre>{{ print_r($products->toArray(), true) }}</pre> --}}

                            <table class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th># SL</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Code</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td><img src="{{ asset('uploads/product/' . $row->thumbnail) }}" height="32" width="32" alt="{{ $row->name }}"></td>
                                            <td>{{ $row->code }}</td>
                                            <td>{{ $row->price }}</td>
                                            <td>
                                                <a href="{{ route('campaign.product.remove', $row->id) }}" 
                                                   class="btn btn-danger btn-sm" 
                                                   id="delete"><i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No products found in this campaign.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container -->
    </div> <!-- content -->

    <footer class="footer text-right">{{ date('Y') }} © R@ih@n</footer>
</div>

<script src="{{ asset('admin/js/jquery.min.js') }}"></script>

@endsection
