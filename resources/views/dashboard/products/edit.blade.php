@extends('layouts.dashboard.app')

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Add -->

                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.edit') @lang('site.products')</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('partials._errors')
                        <form action="{{route('dashboard.products.update',$product->id)}}" method="post" enctype="multipart/form-data" >

                            {{csrf_field()}}
                            {{method_field('put')}}

                            <div class="form-group">
                                <label>@lang('site.categories')</label>
                                <select name="category_id" class="form-control">

                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach( $categories as  $categroey)
                                        <option value="{{$categroey->id}}" {{$product->category_id == $categroey->id ? 'selected' : ''}}>{{$categroey->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="card-body">
                                @foreach(config('translatable.locales') as $locale)

                                    <div class="form-group">
                                        <label>@lang('site.'.$locale.'.name')</label>
                                        <input type="text"  name="{{ $locale }}[name]" class="form-control"
                                               value="{{($product->name)}}  " >
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.'.$locale.'.description')</label>
                                        <textarea  name="{{ $locale }}[description]" class="form-control ckeditor" >{{$product->description}}</textarea>
                                    </div>

                                @endforeach

                                <div class="form-group">
                                    <label>@lang('site.image')</label>
                                    <input type="file"  name="image" class="form-control image">
                                </div>

                                <div class="form-group">

                                    <img src="{{$product->image_path}}" style="width: 50px;" class="img-thumbnail image-preview">
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.purchase_price')</label>
                                    <input type="number"  name="purchase_price" step="0.01" class="form-control" value="{{$product->purchase_price}}" >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.sale_price')</label>
                                    <input type="number"  name="sale_price" step="0.01" class="form-control" value="{{$product->sale_price}}" >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.stock')</label>
                                    <input type="number"  name="stock" class="form-control"  value="{{$product->stock}}">
                                </div>

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
