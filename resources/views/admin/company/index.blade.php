@extends('adminlte::page')

@section('content_header')
    <div class="d-inline-block">
        <h1>Companies</h1>
    </div>
    <div class="d-inline-block float-right">
                <a href="{{route('admin.company.create')}}" type="button" class="btn btn-block btn-secondary">
        Add company
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Company list</h1>
                </div>
                <div class="mt-3 ml-3" style="width: 95%">
                    <table id="myTable" class="table table-striped m-3">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Phone</th>
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
        const companyUrl = '{{ route('admin.company.index') }}';
        $(document).ready(function () {
            $('#myTable').DataTable(
                {
                    processing: true,
                    serverSide: true,
                    ajax: companyUrl,
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'address', name: 'address'},
                        {data: 'city', name: 'city'},
                        {data: 'country', name: 'country'},
                        {data: 'phone', name: 'phone'},
                        {
                            data: function (row) {
                                return '<a href="' + companyUrl + '/' + row.id + '/edit">' +
                                    '<i class="text-gray fas fa-pencil-alt"></i>' +
                                    '</a>' +
                                   '<form action="' + companyUrl +'/' + row.id + '" method="POST">' +
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
