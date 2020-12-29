@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Add -->

                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.create') @lang('site.categories')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('partials._errors')
                        <form action="{{route('dashboard.categories.store')}}" method="post">

                            {{csrf_field()}}
                            {{method_field('post')}}
                            <div class="card-body">
                            @foreach(config('translatable.locales') as $locale)

                                    <div class="form-group">
                                        <label>@lang('site.'.$locale.'.name')</label>
                                        <input type="text"  name="{{ $locale }}[name]" class="form-control"
                                               value="{{old($locale.'.name')}}  " >
                                    </div>

                            @endforeach
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
