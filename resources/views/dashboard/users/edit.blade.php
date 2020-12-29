@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Add -->

                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.edit') @lang('site.users')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('partials._errors')
                        <form action="{{route('dashboard.users.update',$user->id)}}" method="post" enctype="multipart/form-data">

                            {{csrf_field()}}
                            {{method_field('put')}}

                            <div class="card-body">
                                <div class="form-group">
                                    <label>@lang('site.first_name')</label>
                                    <input type="text"  name="first_name" class="form-control" value="{{$user->first_name }}"  placeholder="@lang('site.first_name')" >
                                </div>
                                <div class="form-group">
                                    <label>@lang('site.last_name')</label>
                                    <input type="text" name="last_name" class="form-control" value="{{$user->last_name }}" placeholder="@lang('site.last_name')">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.email')</label>
                                    <input type="email"  name="email" class="form-control" value="{{$user->email}}" placeholder="@lang('site.email')">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.image')</label>
                                    <input type="file"  name="image" class="form-control image">
                                </div>

                                <div class="form-group">

                                    <img src="{{$user->image_path}}" style="width: 50px;" class="img-thumbnail image-preview">
                                </div>

                                <div class="form-group">
                                    <!-- Custom Tabs -->
                                    <div class="card">
                                        <div class="card-header d-flex p-0">
                                            <h3 class="card-title p-3 text-bold text-danger"><i class="fa fa-cogs text-success" aria-hidden="true"></i>  @lang('site.permissions')</h3>
                                            @php

                                                    $models  = ['users','categories','products','clients','orders'];
                                                    $maps    =    ['create','read','update','delete'];

                                            @endphp

                                            <ul class="nav nav-pills ml-auto p-2">

                                                @foreach($models as $index =>$model)

                                                    <li class="nav-item"><a class="nav-link{{$index == 0 ? ' active' : ''}}" href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a></li>

                                                @endforeach


                                            </ul>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="tab-content">
                                                @foreach($models as $index =>$model)
                                                    <div class="tab-pane {{$index == 0? ' active' : ''}}" id="{{$model}}">

                                                        @foreach($maps as $map )
                                                            <label ><input type="checkbox" name="permissions[]" {{$user->hasPermission($model.'-'.$map) ? 'checked' : ''}} value="{{$model.'-'.$map}}">@lang('site.'.$map)</label>
                                                        @endforeach
                                                    </div>
                                                @endforeach

                                            </div>
                                            <!-- /.tab-content -->
                                        </div><!-- /.card-body -->
                                    </div>
                                </div>
                                <!-- ./card -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit"  class="btn btn-success btn-block">@lang('site.edit')</button>
                            </div>
                        </form>
                    </div>

                </div>



            </div>
        </div>
    </section>


@endsection
