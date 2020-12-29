@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Add -->

                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.create') @lang('site.users')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('partials._errors')
                        <form action="{{route('dashboard.users.store')}}" method="post" enctype="multipart/form-data">

                            {{csrf_field()}}
                            {{method_field('post')}}

                            <div class="card-body">
                                <div class="form-group">
                                    <label>@lang('site.first_name')</label>
                                    <input type="text"  name="first_name" class="form-control" value="{{old('first_name')}}"  placeholder="@lang('site.first_name')" >
                                </div>
                                <div class="form-group">
                                    <label>@lang('site.last_name')</label>
                                    <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}" placeholder="@lang('site.last_name')">
                                </div>
                                <div class="form-group">
                                    <label>@lang('site.email')</label>
                                    <input type="email"  name="email" class="form-control" value="{{old('email')}}" placeholder="@lang('site.email')">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.image')</label>
                                    <input type="file"  name="image" class="form-control image">
                                </div>

                                <div class="form-group">
                                  <img src="{{asset('uploads/user_images/default.png')}}" style="width: 50px;" class="img-thumbnail image-preview">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.password')</label>
                                    <input type="password"  name="password" class="form-control"  placeholder="@lang('site.password')">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.password_confirmation')</label>
                                    <input type="password"  name="password_confirmation" class="form-control"  placeholder="@lang('site.password_confirmation')">
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
                                                    <label ><input type="checkbox" name="permissions[]" value="{{$model.'-'.$map}}">@lang('site.'.$map)</label>
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
                                <button type="submit"  class="btn btn-success btn-block">@lang('site.create')</button>
                            </div>
                        </form>
                    </div>

                </div>



            </div>
        </div>
    </section>


@endsection
