@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa fa-th-large"></i>
                                @lang('site.categories')
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @foreach ($categories as $category)
                                <div id="accordion">
                                    <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                            </h4>
                                        </div>
                                        <div id="{{ str_replace(' ', '-', $category->name) }}" class="card-collapse collapse">
                                            <div class="card-body">
                                                @if ($category->products->count() > 0)

                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>@lang('site.name')</th>
                                                            <th>@lang('site.stock')</th>
                                                            <th>@lang('site.price')</th>
                                                            <th>@lang('site.create')</th>
                                                        </tr>

                                                        @foreach ($category->products as $product)
                                                            <tr>
                                                                <td>{{ $product->name }}</td>
                                                                <td><span class="{{$product->stock == 0 ? 'btn btn-sm btn-danger' : '' }}">{{ $product->stock == 0 ? 'فارغ' : $product->stock  }}</span></td>
                                                                <td>{{ number_format($product->sale_price,2) }}</td>
                                                                <td>
                                                                    <a href=""
                                                                       id="product-{{ $product->id }}"
                                                                       data-name="{{ $product->name }}"
                                                                       data-id="{{ $product->id }}"
                                                                       data-price="{{ $product->sale_price }}"
                                                                       class="btn {{ $product->stock == 0 ? 'btn-default disabled' : in_array($product->id, $order->product->pluck('id')->toArray()) ? 'btn-default disabled' : 'btn-success add-product-btn' }} btn-sm">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table><!-- end of table -->

                                                @else
                                                    <h5>@lang('site.no_records')</h5>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>



                <!-- Add -->

                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-shopping-basket"></i>
                                @lang('site.orders')
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="{{ route('dashboard.clients.orders.update', ['order' => $order->id, 'client' => $client->id]) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('put') }}

                                @include('partials._errors')

                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody class="order-list">
                                    @foreach($order->product as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td><input type="number" name="products[{{ $product->id }}][quantity]" data-price="{{ number_format($product->sale_price, 2) }}" class="form-control input-sm product-quantity" min="1" value="{{ $product->pivot->quantity }}"></td>
                                            <td class="product-price">{{ number_format($product->sale_price * $product->pivot->quantity, 2) }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm remove-product-btn" data-id="{{ $product->id }}"><span class="fa fa-trash"></span></button>
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                                <h4>@lang('site.total') : <span class="total-price">0</span></h4>
                                <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('site.edit_order')</button>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <!-- end Add  -->

                @if ($client->orders->count() > 0)


                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa fa-th-large"></i>
                                    @lang('site.previous_orders')
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @foreach ($orders as $order)
                                    <div id="accordion">
                                        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a data-toggle="collapse" href="#x">{{ $order->created_at->toFormattedDateString() }}</a>
                                                </h4>
                                            </div>
                                            <div id="x" class="card-collapse collapse">
                                                <div class="card-body">

                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>@lang('site.name')</th>
                                                        </tr>

                                                        @foreach ($order->product as $products )
                                                            <tr>
                                                                <td>{{ $products->name }}</td>

                                                            </tr>
                                                        @endforeach

                                                    </table><!-- end of table -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>



                    {{ $orders->links() }}

                @endif

            </div>
        </div>
    </section>


@endsection
