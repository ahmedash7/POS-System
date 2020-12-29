@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Add -->

                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.create') @lang('site.clients')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('partials._errors')
                        <form action="{{route('dashboard.clients.store')}}" method="post" enctype="multipart/form-data">

                            {{csrf_field()}}
                            {{method_field('post')}}

                            <div class="card-body">

                                <div class="form-group">
                                    <label>@lang('site.name')</label>
                                    <input type="text"  name="name" class="form-control" value="{{old('name')}}"  placeholder="@lang('site.name')" >
                                </div>

                                @for($i=0;$i<2;$i++)
                                    <div class="form-group">
                                        <label>@lang('site.phone')</label>
                                        <input type="text"  name="phone[]" class="form-control"  placeholder="@lang('site.phone')" >
                                    </div>

                                    @endfor

                                <div class="form-group">
                                    <label>@lang('site.address')</label>
                                    <textarea name="address" class="form-control" ></textarea>
                                </div>

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
