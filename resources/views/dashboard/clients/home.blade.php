@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <p class="card-title text-bold" style="margin-bottom:0px; ">@lang('site.clients')<span class="badge bg-teal">{{$clients->total()}}</span></p>

                            <div class="card-header">


                                <form action="{{route('dashboard.clients.index')}}" method="get">

                                    <div class="row">
                                        <div class="col-md-3">

                                            <input type="text" id="myInput" name="search" class="form-control" placeholder="بحث" value="{{request()->search}}">
                                        </div>

                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>@lang('site.search')</button>
                                            @if(auth()->user()->hasPermission('clients-create'))
                                                <a href="{{route('dashboard.clients.create')}}" class="btn btn-primary"> <i class="fa fa-client-plus"></i> @lang('site.create')</a>
                                            @else
                                                <a class="btn btn-primary disabled"> <i class="fa fa-client-plus"></i> @lang('site.create')</a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @if($clients->count() > 0 )
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.id')</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.phone')</th>
                                        <th>@lang('site.address')</th>
                                        <th>@lang('site.add_order')</th>
                                        <th>@lang('site.action') </th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    @foreach($clients as $index=>$client)
                                        <tr>
                                            <td>{{ $index + 1  }}</td>
                                            <td>{{$client->name}}</td>
                                            <td>{{ is_array($client->phone) ? implode($client->phone, '-') : $client->phone}}</td>
                                            <td>{{$client->address}}</td>
                                            <td>
                                                @if(auth()->user()->hasPermission('orders-create'))
                                                <a href="{{route('dashboard.clients.orders.create',$client->id)}}" class="btn btn-success btn-sm">@lang('site.add_order')</a>
                                                @else
                                                    <a href="#" class="btn btn-success btn-sm disabled">@lang('site.add_order')</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(auth()->user()->hasPermission('clients-update'))
                                                    <a href="{{route('dashboard.clients.edit',$client->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                                @else
                                                    <button class="btn btn-info btn-sm disabled">@lang('site.edit')</button>
                                                @endif

                                                @if(auth()->user()->hasPermission('clients-delete'))
                                                    <form  action="{{route('dashboard.clients.destroy',$client->id)}}" method="post" style="display:inline-block" >
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

                                {{ $clients->appends(request()->query())->links() }}

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
