@extends('layouts.app')
@section('content')
	<div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <div class="quickview_body">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Quick View Modal Area End ****** -->

        <!-- ****** New Arrivals Area Start ****** -->
        <section class="new_arrivals_area section_padding_100_0 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_heading text-center">
                            <h2>ALL RESULT</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="karl-projects-menu mb-100">
                <div class="text-center portfolio-menu">
                    
                </div>
            </div>

            <div class="container">
                <div class="row karl-new-arrivals">
                    <!-- Single gallery Item Start -->
                    @foreach ($search as $key => $value)
                    <div class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig" data-wow-delay="0.2s">
                        <!-- Product Image -->
                        <div class="product-img">
                            <a href="{{url("productDetailid/{$value->id}-{$value->id_category}")}}"><img src="{{ asset($value -> image) }}" alt=""></a>
                            <!-- <div class="product-quicview">
                                <a href="#" data-toggle="modal" data-target="#quickview"><i class="fas fa-plus"></i></a>
                            </div> -->
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <h4 class="product-price">{{  number_format($value->price, 3)}}</h4>
                            <p>{{ $value->describe }}</p>
                            <!-- Add to Cart -->
                            <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
@endsection