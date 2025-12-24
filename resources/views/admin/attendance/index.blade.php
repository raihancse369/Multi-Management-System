@extends('layouts.admin')
@section('admin_content')

<div class="content-page">
    <div class="content">
        <div class="container">

            <!-- Breadcrumb -->
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb pull-right">
                        <li class="active"><a href=""></a></li>
                    </ol>
                </div>
            </div>

            <!-- Attendance Management -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">

                        <!-- Panel Header -->
                        <div class="panel-heading">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                        Take Attendance <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div><br/>
                        </div>

                        <!-- Table -->
                        <div class="panel-body">
                            <table class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th># SL</th>
                                        <th>Date</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ✅ Create Attendance Modal -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Take Today's Attendance</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <form id="add_form">
                        @csrf
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee as $key => $row)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td><img src="{{ asset('uploads/employee/'.$row->image) }}" width="50" height="50" class="rounded-circle"></td>
                                    <td>
                                        <input type="hidden" name="user_id[]" value="{{ $row->id }}">
                                        <label><input type="radio" name="status[{{ $row->id }}]" value="Present" required> Present</label>
                                        <label class="ms-2"><input type="radio" name="status[{{ $row->id }}]" value="Absence" required> Absence</label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <input type="hidden" name="att_date" value="{{ date('Y-m-d') }}">
                        <input type="hidden" name="att_month" value="{{ date('F') }}">
                        <input type="hidden" name="att_year" value="{{ date('Y') }}">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary submit_button">
                                <span class="btn-text">Submit</span>
                                <span class="loading d-none"><i class="fa fa-spinner fa-spin"></i></span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ✅ Edit Modal -->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Attendance</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body" id="edit_part">Loading...</div>
            </div>
        </div>
    </div>

    <footer class="footer text-right">{{ date('Y') }} © R@ih@n</footer>
</div>

<script src="{{ asset('admin/js/jquery.min.js') }}"></script>

<script>
$(document).ready(function () {

    // 1️⃣ DataTable Init
    const table = $('.dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('attendance.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Disable ordering here
            { data: 'att_date', name: 'att_date' },
            { data: 'att_month', name: 'att_month' },
            { data: 'att_year', name: 'att_year' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    // 2️⃣ Add Attendance Submit
    $('#add_form').on('submit', function(e){
        e.preventDefault();
        const form = $(this);
        const btn = form.find('.submit_button');
        const loading = btn.find('.loading');
        const btnText = btn.find('.btn-text');

        btn.prop('disabled', true);
        loading.removeClass('d-none');
        btnText.addClass('d-none');

        $.ajax({
            url: "{{ route('store.attendance') }}",
            type: "POST",
            data: form.serialize(),
            success: function(res){
                toastr.success(res.message || 'Attendance Recorded Successfully!');
                $('#addModal').modal('hide');
                table.ajax.reload();
            },
            error: function(xhr){
                toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
            },
            complete: function(){
                btn.prop('disabled', false);
                loading.addClass('d-none');
                btnText.removeClass('d-none');
            }
        });
    });

    // 3️⃣ Load Edit Modal
    $('body').on('click','.editAttendance',function(){
        const date = $(this).data('date');
        $.ajax({
            url: "{{ url('admin/attendance/edit') }}/" + date,
            type: 'GET',
            success: function(data){
                $('#edit_part').html(data);
            }
        });
    });

    // 4️⃣ Delete Attendance
    $('body').on('click','.delete_attendance',function(e){
        e.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "This will delete all records for that date.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete)=>{
            if(willDelete){
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {_token: '{{ csrf_token() }}'},
                    success: function(res){
                        toastr.success(res.message);
                        table.ajax.reload();
                    },
                    error: function(){
                        toastr.error('Failed to delete attendance.');
                    }
                });
            }
        });
    });

});
</script>
@endsection
