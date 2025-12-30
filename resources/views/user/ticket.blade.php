@extends('layouts.app')

@section('content')

{{-- 🔷 Banner --}}
<div class="page-banner bg-img bg-img-parallax overlay-dark d-flex align-items-center justify-content-center"
     style="background-image: url('{{ asset('/web/assets/img/smoke.jpg') }}'); min-height: 220px; background-size: cover;">
  <div class="text-center text-white">
      <h1 class="font-weight-bold mb-2">Support Tickets 🎫</h1>
      <p class="text-light">Manage your support requests and responses</p>
  </div>
</div>

{{-- 🔶 Main Content --}}
<div class="container py-5">
  <div class="row">
    {{-- Sidebar --}}
    <div class="col-md-4 mb-4">
        @include('user.sidebar')
    </div>

    {{-- Ticket List --}}
    <div class="col-md-8">
      <div class="card border-0 shadow-sm rounded">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="text-primary font-weight-bold mb-0"><i class="fa fa-life-ring mr-2"></i> Your Support Tickets</h5>
            <a href="{{ route('new.ticket') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Open Ticket
            </a>
        </div>

        <div class="card-body">
          {{-- Flash Messages --}}
          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fa fa-check-circle"></i> {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          {{-- Ticket Table --}}
          @if($ticket->count() > 0)
            <div class="table-responsive">
              <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="thead-light">
                  <tr>
                    <th>Date</th>
                    <th>Service</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($ticket as $row)
                    <tr>
                      <td>{{ date('d M, Y', strtotime($row->date)) }}</td>
                      <td><span class="text-dark">{{ $row->service }}</span></td>
                      <td>{{ Str::limit($row->subject, 40) }}</td>
                      <td>
                        @if($row->status == 0)
                          <span class="badge badge-danger px-3 py-1">Pending</span>
                        @elseif($row->status == 1)
                          <span class="badge badge-success px-3 py-1">Replied</span>
                        @elseif($row->status == 2)
                          <span class="badge badge-info px-3 py-1">Closed</span>
                        @endif
                      </td>
                      <td class="text-center">
                        <a href="{{ route('show.ticket', $row->id) }}" 
                           class="btn btn-sm btn-outline-info">
                           <i class="fa fa-eye"></i> View
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            {{-- Empty State --}}
            <div class="text-center py-5 text-muted">
              <i class="fa fa-life-ring fa-3x mb-3 text-primary"></i>
              <h5 class="font-weight-bold">No tickets yet</h5>
              <p class="small">You haven’t opened any support requests.</p>
              <a href="{{ route('new.ticket') }}" class="btn btn-primary btn-sm mt-2">
                  <i class="fa fa-plus-circle"></i> Open a Ticket
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

{{-- 🔹 Custom Styles --}}
<style>
  .card {
      border-radius: .5rem;
  }
  .table {
      background-color: #fff;
  }
  .table thead th {
      font-weight: 600;
      color: #495057;
      background-color: #f8f9fa;
  }
  .badge {
      font-size: 0.85rem;
  }
  .btn-outline-info:hover {
      background-color: #17a2b8;
      color: #fff;
  }
  .alert {
      border-radius: .4rem;
      font-size: 0.9rem;
  }
</style>

@endsection
