@extends('adminlte::page')

@section('content_header')
    <div class="d-inline-block">
        <h1>Clients</h1>
    </div>
    <div class="d-inline-block float-right">
                <a href="{{route('admin.client.create')}}" type="button" class="btn btn-block btn-secondary">
        Add client
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Client list</h1>
                </div>
                <div class="mt-3 ml-3" style="width: 95%">
                    <table id="myTable" class="table table-striped m-3">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        const clientsUrl = '{{ route('admin.client.index') }}';
        $(document).ready(function () {
            $('#myTable').DataTable(
                {
                    processing: true,
                    serverSide: true,
                    ajax: clientsUrl,
                    columns: [
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'email', name: 'email'},
                        {data: 'phone', name: 'phone'},
                        {data: 'address', name: 'address'},
                        {
                            data: function (row) {
                                return '<a href="' + clientsUrl + '/' + row.id + '/edit">' +
                                    '<i class="text-gray fas fa-pencil-alt"></i>' +
                                    '</a>' +
                                   '<form action="' + clientsUrl +'/' + row.id + '" method="POST">' +
                                    '    @csrf'+
                                     '   @method("DELETE")'+
                                       ' <button class="btn btn-sm" title="Delete"><i class="text-gray fas fa-trash"></button>'+
                                    '</form>'
                            }, name: 'action', orderable: false, searchable: false
                        },
                    ],

                }
            );
        });
    </script>
@stop
