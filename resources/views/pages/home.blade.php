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
                            <div class="container">
                                <div class="row">
                                    @foreach ($product as $key => $value)
                                    <div class="col-12 col-lg-5">
                                        <div class="quickview_pro_img">
                                            <img src="{{$value->image}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="quickview_pro_des">
                                            <h4 class="title">{{$value -> name}}</h4>
                                            <div class="top_seller_product_rating mb-15">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <h5 class="price">{{$value -> price}} <!-- <span>$130</span> --></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                            <a href="#">View Full Product Details</a>
                                        </div>
                                        <!-- Add to Cart Form -->
                                       <form class="cart" method="post">
                                          
                                            <button type="submit" name="addtocart" value="5" class="cart-submit">Add to cart</button>
                                            <!-- Wishlist -->
                                            <div class="modal_pro_wishlist">
                                                <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                            </div>
                                            <!-- Compare -->
                                            <div class="modal_pro_compare">
                                                <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
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
                            <h2>New Arrivals</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="karl-projects-menu mb-100">
                <div class="text-center portfolio-menu">
                    @foreach ($category as $key => $value)
                    <button class="btn" data-filter=".women">{{$value->name_category}}</button>
                    @endforeach
                </div>
            </div>

            <div class="container">
                <div class="row karl-new-arrivals">
                    <!-- Single gallery Item Start -->
                    @foreach ($product as $key => $value)
                    <div class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig" data-wow-delay="0.2s">
                        <!-- Product Image -->
                        <div class="product-img">
                            <a href="{{url("productDetailid/{$value->id}-{$value->id_category}")}}"><img src="{{ $value -> image }}" alt=""></a>
                            <h5 class="title">{{$value -> name}}</h5>
                            <!-- <div class="product-quicview">
                                <a href="#" data-toggle="modal" data-target="#quickview"><i class="fas fa-plus"></i></a>
                            </div> -->
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <h4 class="product-price">{{  number_format($value->price, 3)." VND"}}</h4>
                            <p>{{ $value->describe }}</p>
                            <p>{{ $value->id }}</p>
                                <!-- Add to Cart -->
                            <form method="post" action="{{url("addToCart/{$value->id}")}}">
                                 {{ csrf_field() }}
                                <input type="hidden" name="product_id" value="{{$value->id}}">
                                <button type="submit" class="add-to-cart-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
@endsection
