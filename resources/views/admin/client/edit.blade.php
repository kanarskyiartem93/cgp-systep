@extends('adminlte::page')
@section('content_header')
    <div class="d-inline-block">
        <h1>Clients</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-5">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Edit client</h3>
                </div>
                <form action="{{route('admin.client.update', $client->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            @error('first_name')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name"
                                   placeholder="Enter First Name of client" value="{{$client->first_name}}">
                            @error('first_name')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @error('last_name')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name"
                                   placeholder="Enter Last Name of client" value="{{$client->last_name}}">
                            @error('last_name')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @error('email')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="Enter email of client" value="{{$client->email}}">
                            @error('email')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @error('phone')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   placeholder="Enter phone of client" value="{{$client->phone}}">
                            @error('phone')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                            <p style="display:block; text-align:right" class="text-secondary" id="restriction">Required
                                format is + and from 10 to 12 digits</p>
                        </div>
                        <div class="form-group">
                            @error('address')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="Enter address of client" value="{{$client->address}}">
                            @error('address')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @error('companies')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="companies">Companies</label>
                            <select name="companies[]" class="select2" multiple="multiple"
                                    data-placeholder="Select a companies" style="width: 100%;">
                                @foreach($companies as $company)
                                    @if(is_array($client->companies->pluck('id')->toArray()) && in_array($company->id, $client->companies->pluck('id')->toArray()))
                                        <option
                                            selected
                                            value="{{$company->id}}">{{$company->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('companies')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group" style="display: inline-block">
                            <p><b>Created at: </b>{{$client->created_at}}</p>
                            <p><b>Updated at: </b>{{$client->updated_at}}</p>
                        </div>
                    </div>
                    <div class="form-group w-50">
                        <input type="hidden" name="client_id" value="{{$client->id}}">
                    </div>
                    <div class="card-footer text-right">
                        <button type="reset" class="col-4 btn border border-secondary">Cancel</button>
                        <button type="submit" class="col-4 btn btn-secondary border border-secondary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                    ajax: {
                        url: '{{route('companyIndexForm')}}',
                        type: 'GET',
                        DataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term
                            }
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data.data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                    },
                    allowClear: true,
                }
            );
        });
    </script>
@stop
