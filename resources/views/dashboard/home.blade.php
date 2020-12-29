@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    {{-- box categories--}}
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $categories_count }}</h3>
                            <p>@lang('site.categories')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">@lang('site.read')<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    {{-- box products--}}
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $products_count }}</h3>

                            <p>@lang('site.products')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">@lang('site.read') <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    {{--box clients--}}
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $clients_count }}</h3>

                            <p>@lang('site.clients')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('dashboard.clients.index') }}" class="small-box-footer">@lang('site.read')<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    {{--box users--}}
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $users_count }}</h3>

                            <p>@lang('site.users')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">@lang('site.read')<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- end Small boxes (Stat box) -->
            <div class="col-md-6">
            <div class="card card-solid">
                <div class="card-header bg-gradient-blue">
                    <h3 class="card-title text-bold">@lang('site.Sales_Graph')</h3>
                    <div class="card-tools">
                        <button type="button" class="btn bg-blue btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-blue btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                </div>

                <div class="card-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div>
                <!-- /.box-body -->
            </div>
            </div>
        </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>

    //line chart
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
                @foreach ($sales_data as $data)
            {
                ym: "{{ $data->year }}-{{ $data->month }}", sum: "{{ $data->sum }}"
            },
            @endforeach
        ],
        xkey: 'ym',
        ykeys: ['sum'],
        labels: ['@lang('site.total')'],
        lineWidth: 2,
        hideHover: 'auto',
        gridStrokeWidth: 0.4,
        pointSize: 4,
        gridTextFamily: 'Open Sans',
        gridTextSize: 10
    });

</script>
@endpush