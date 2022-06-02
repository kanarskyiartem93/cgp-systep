@extends('adminlte::page')
@section('content_header')
    <div class="d-inline-block">
        <h1>Company</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-5">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Edit company</h3>
                </div>
                <form action="{{route('admin.company.update', $company->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            @error('name')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="name">Name of company</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter Name of company" value="{{$company->name}}">
                            @error('name')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @error('address')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="address">Address of company</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="Enter address of client" value="{{$company->address}}">
                            @error('address')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @error('city')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city"
                                   placeholder="Enter city of company" value="{{$company->city}}">
                            @error('city')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @error('country')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country"
                                   placeholder="Enter country of company" value="{{$company->country}}">
                            @error('country')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @error('phone')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   placeholder="Enter phone of company" value="{{$company->phone}}">
                            @error('phone')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                            <p style="display:block; text-align:right" class="text-secondary" id="restriction">Required
                                format is + and from 10 to 12 digits</p>
                        </div>
                        <div class="form-group">
                            @error('clients')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="clients">Clients</label>
                            <select name="clients[]" class="select2" multiple="multiple"
                                    data-placeholder="Select a clients" style="width: 100%;">
                                @foreach($clients as $client)
                                    @if(is_array($company->clients->pluck('id')->toArray()) && in_array($client->id, $company->clients->pluck('id')->toArray()))
                                        <option
                                            selected
                                            value="{{$client->id}}">{{$client->first_name}} {{$client->last_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('clients')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <input type="hidden" name="company_id" value="{{$company->id}}">
                        </div>
                        <div class="form-group" style="display: inline-block">
                            <p><b>Created at: </b>{{$company->created_at}}</p>
                            <p><b>Updated at: </b>{{$company->updated_at}}</p>
                        </div>
                    </div>
                    <div class="form-group w-50">
                        <input type="hidden" name="company" value="{{$company->id}}">
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
                        url: '{{route('clientIndexForm')}}',
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
                                        text: item.first_name + ' ' + item.last_name,
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
