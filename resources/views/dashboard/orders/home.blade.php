@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-6">
                    <div class="card">
                        <p class="card-title text-bold" style="margin-bottom:0px; ">@lang('site.orders')<span class="badge bg-teal">{{$orders->total()}}</span></p>

                        <div class="card-header">

                            <form action="{{route('dashboard.orders.index')}}" method="get">

                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" id="myInput" name="search" class="form-control" placeholder="بحث" value="{{request()->search}}">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>@lang('site.search')</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    @if($orders->count() > 0 )
                        <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-hover ">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.client_name')</th>
                                        <th class="text-success">@lang('site.price')</th>
                                        {{-- <th>@lang('site.status')</th>--}}
                                        <th>@lang('site.created_at')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->client->name }}</td>
                                            <td class="text-success">{{ number_format($order->total_price, 2) }}</td>
                                            {{--<td>--}}
                                            {{--<button--}}
                                            {{--data-status="@lang('site.' . $order->status)"--}}
                                            {{--data-url="{{ route('dashboard.orders.update_status', $order->id) }}"--}}
                                            {{--data-method="put"--}}
                                            {{--data-available-status='["@lang('site.processing')", "@lang('site.finished') "]'--}}
                                            {{--class="order-status-btn btn {{ $order->status == 'processing' ? 'btn-warning' : 'btn-success disabled' }} btn-sm"--}}
                                            {{-->--}}
                                            {{--@lang('site.' . $order->status)--}}
                                            {{--</button>--}}
                                            {{--</td>--}}
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm order-products"
                                                        data-url="{{route('dashboard.orders.products',$order->id)}}"
                                                        data-method="get"
                                                >
                                                    <i class="fa fa-list"></i>
                                                    @lang('site.show')
                                                </button>
                                                @if (auth()->user()->hasPermission('orders-update'))
                                                    <a href="{{ route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> @lang('site.edit')</a>
                                                @else
                                                    <a href="#" disabled class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                                @endif

                                                @if (auth()->user()->hasPermission('orders-delete'))
                                                    <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post" style="display: inline-block;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                                    </form>

                                                @else
                                                    <a href="#" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> @lang('site.delete')</a>
                                                @endif

                                            </td>

                                        </tr>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{ $orders->appends(request()->query())->links() }}

                            </div>
                            <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                @else
                    <div class="card-body">
                        <h3>@lang('site.no_records')</h3>
                    </div>
                @endif


            <!-- orders -->

                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-shopping-basket"></i>
                                @lang('site.orders')
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" >

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px">@lang('site.loading')</p>
                            </div>

                           <div id="order-product-list">


                           </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <!-- end orders  -->



            </div>
        </div>
    </section>

@endsection
