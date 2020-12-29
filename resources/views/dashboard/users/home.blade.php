@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">




                    <div class="col-12">
                        <div class="card">
                            <p class="card-title text-bold" style="margin-bottom:0px; ">@lang('site.users')<span class="badge bg-teal">{{$users->total()}}</span></p>

                            <div class="card-header">


                                <form action="{{route('dashboard.users.index')}}" method="get">

                                    <div class="row">
                                        <div class="col-md-3">

                                            <input type="text" id="myInput" name="search" class="form-control" placeholder="بحث" value="{{request()->search}}">
                                        </div>

                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>@lang('site.search')</button>
                                            @if(auth()->user()->hasPermission('users-create'))
                                                <a href="{{route('dashboard.users.create')}}" class="btn btn-primary"> <i class="fa fa-user-plus"></i> @lang('site.create')</a>
                                            @else
                                                <a class="btn btn-primary disabled"> <i class="fa fa-user-plus"></i> @lang('site.create')</a>
                                            @endif
                                        </div>
                                    </div>



                                </form>
                            </div>
                        @if($users->count() > 0 )
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.id')</th>
                                        <th>@lang('site.first_name')</th>
                                        <th>@lang('site.last_name')</th>
                                        <th>@lang('site.email')</th>
                                        <th>@lang('site.image')</th>
                                        <th>@lang('site.action') </th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    @foreach($users as $index=>$user)
                                        <tr>
                                            <td>{{ $index + 1  }}</td>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{$user->last_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td><img src="{{$user->image_path}}" style="width: 50px;" class="img-thumbnail"></td>

                                            <td>
                                                @if(auth()->user()->hasPermission('users-update'))
                                                    <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                                @else
                                                    <button class="btn btn-info btn-sm disabled">@lang('site.edit')</button>
                                                @endif

                                                @if(auth()->user()->hasPermission('users-delete'))
                                                    <form  action="{{route('dashboard.users.destroy',$user->id)}}" method="post" style="display:inline-block" >
                                                        {{csrf_field()}}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="delete btn btn-danger btn-sm "><i class="fa fa-trash"></i></button>
                                                    </form>
                                                    @else
                                                    <button class="btn btn-danger btn-sm disabled">@lang('site.delete')</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{ $users->appends(request()->query())->links() }}

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>


                    @else

                    <p class="alert alert-danger btn-block text-center text-bold">@lang('site.no_data_found')</p>

                    @endif

            </div>
        </div>
    </section>


    <script>






    </script>



@endsection
