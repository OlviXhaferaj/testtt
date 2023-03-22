@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View all events</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  

    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
</head>

<body>
    <div class=" container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>All Events</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('users.create') }}">Create Event</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="container mt-5">
            <h2 class="mb-4">Users Yajra Datatable</h2>
            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>eventType</th>
                        <th>epoce</th>
                        <th>year</th>
                        <th>month</th>
                        <th>day</th>
                        <th>Event Date</th>
                        <th>image</th>
                        <th>description</th>
                        <th>action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="//cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.js"></script>

    <script type="text/javascript">

$(function () {

    var table = $('.yajra-datatable').DataTable({
        responsive: true,
        paging: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('events.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'eventType', name: 'eventType'},
            {data: 'epoce', name: 'epoce'},
            {data: 'year', name: 'year'},
            {data: 'month', name: 'month'},
            {data: 'day', name: 'day'},
            {data: 'event_trigger_date', name: 'Event Date'},
            {data: 'image', name: 'image', 
                render: function( data, type, full, meta ) {
                    return "<img src=\"/images/" + data + "\" height=\"100%\" width=\"100%\"  alt='Image'/>";
                }},

            {data: 'description', name: 'description'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
});
</script>
    
</body>



</html>
@endsection