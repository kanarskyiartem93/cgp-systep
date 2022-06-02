@extends('adminlte::page')
@section('content_header')
    <div class="d-inline-block">
        <h1>Companies</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-5">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Create company</h3>
                </div>
                <form action="{{route('admin.company.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            @error('name')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="name">Name of company</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter Name of company" value="{{old('name')}}">
                            @error('name')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            @error('address')<i class="text-gray far fa-times-circle"></i>@enderror
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="Enter address of client" value="{{old('address')}}">
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
                                   placeholder="Enter city of company" value="{{old('city')}}">
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
                                   placeholder="Enter country of company" value="{{old('country')}}">
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
                                   placeholder="Enter phone of company" value="{{old('phone')}}">
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
                            </select>
                            @error('clients')
                            <div class="text-danger text-left">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
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
