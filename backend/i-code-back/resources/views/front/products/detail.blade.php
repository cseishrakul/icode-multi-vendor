<?php
use App\Models\Product;
use App\Models\ProductsFilter;
$productFilters = ProductsFilter::productFilters();
?>
@extends('front.layouts.layout')
@section('content')

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: inherit;
            top: -9999px;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Detail</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Home</a>
                    </li>

                    <li class="is-marked">
                        <a href="javascript::void()">Detail</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Single-Product-Full-Width-Page -->
    <div class="page-detail u-s-p-t-80">
        <div class="container">
            <!-- Product-Detail -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- Product-zoom-area -->
                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                        <a href="{{ asset('admin/photos/product_images/large/' . $productDetails['product_image']) }}">
                            <img src="{{ asset('admin/photos/product_images/large/' . $productDetails['product_image']) }}"
                                alt="" width="500" height="500" />
                        </a>
                    </div>
                    <div class="thumbnails" style="margin-top: 30px">
                        <a href="{{ asset('admin/photos/product_images/large/' . $productDetails['product_image']) }}"
                            data-standard="{{ asset('admin/photos/product_images/small/' . $productDetails['product_image']) }}">
                            <img width="120" height="120"
                                src="{{ asset('admin/photos/product_images/small/' . $productDetails['product_image']) }}"
                                alt="" />
                        </a>

                        @foreach ($productDetails['images'] as $image)
                            <a href="{{ asset('admin/photos/product_images/large/' . $image['image']) }}"
                                data-standard="{{ asset('admin/photos/product_images/small/' . $image['image']) }}">
                                <img width="120" height="120"
                                    src="{{ asset('admin/photos/product_images/small/' . $image['image']) }}"
                                    alt="" />
                            </a>
                        @endforeach
                    </div>
                    <!-- Product-zoom-area /- -->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- Product-details -->
                    <div class="all-information-wrapper">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success: </strong> <?php echo Session::get('success_message'); ?>

                                <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                    <span aria-hidden="true"> &times; </span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error: </strong> <?php echo Session::get('error_message'); ?>

                                <button class="close" type="button" data-dismiss='alert' aria-label="Close">
                                    <span aria-hidden="true"> &times; </span>
                                </button>
                            </div>
                        @endif
                        <div class="section-1-title-breadcrumb-rating">
                            <div class="product-title">
                                <h1>
                                    <a href="single-product.html">{{ $productDetails['product_name'] }}</a>
                                </h1>
                            </div>
                            <ul class="bread-crumb">
                                <li class="has-separator">
                                    <a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="has-separator">
                                    {{-- <i class="ion ion-md-home"></i> --}}
                                    <a href="{{ url('/') }}">{{ $productDetails['section']['name'] }}</a>
                                </li>
                                <?php echo $categoryDetails['breadcrumbs']; ?>
                            </ul>
                            <div class="product-rating">
                                <div title="{{$avgRating}} out of 5 - based on {{count($ratings)}}">
                                    <?php
                                    $star = 1;
                                    while ($star <= $avgStarRating){
                                    ?>
                                    <span style="color:gold;font-size:17px">&#9733;</span>
                                    <?php
                                    $star++;
                                        }
                                    ?>
                                    <span>({{ $avgRating }})</span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="section-2-short-description u-s-p-y-14">
                            <h6 class="information-heading u-s-m-b-8">Description:</h6>
                            <p>{{ $productDetails['description'] }}</p>
                        </div>
                        <div class="section-3-price-original-discount u-s-p-y-14">
                            <?php $getDiscountPrice = Product::discountPrice($productDetails['id']); ?>
                            <span class="getAttributePrice">
                                @if ($getDiscountPrice > 0)
                                    <div class="price">
                                        <h4>{{ $getDiscountPrice }} Tk.</h4>
                                    </div>
                                    <div class="original-price">
                                        <span>Original Price:</span>
                                        <span>{{ $productDetails['product_price'] }} Tk.</span>
                                    </div>
                                @else
                                    <div class="price">
                                        <h4>{{ $productDetails['product_price'] }}</h4>
                                    </div>
                                @endif
                            </span>
                            {{-- <div class="discount-price">
                                <span>Discount:</span>
                                <span>15%</span>
                            </div>
                            <div class="total-save">
                                <span>Save:</span>
                                <span>$20</span>
                            </div> --}}
                        </div>
                        <div class="section-4-sku-information u-s-p-y-14">
                            <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                            <div class="left">
                                <span>Product Code:</span>
                                <span>{{ $productDetails['product_code'] }}</span>
                            </div>
                            <div class="left">
                                <span>Product Color:</span>
                                <span>{{ $productDetails['product_color'] }}</span>
                            </div>
                            <div class="availability">
                                <span>Availability</span>
                                @if ($totalStock > 0)
                                    <span>In Stock</span>
                                @else
                                    <span style="color:red">Out of Stock</span>
                                @endif
                            </div>
                            @if ($totalStock > 0)
                                <div class="left">
                                    <span>Only:</span>
                                    <span>{{ $totalStock }} left</span>
                                </div>
                            @endif

                        </div>
                        @if (isset($productDetails['vendor']))
                            <div class="">
                                Sold By: <a href="/products/{{ $productDetails['vendor']['id'] }}}}"
                                    class="">{{ $productDetails['vendor']['vendorbusinessdetails']['shop_name'] }}</a>
                            </div>
                        @endif
                        <form action="{{ url('cart/add') }}" class="post-form" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                            <div class="section-5-product-variants u-s-p-y-14">
                                <h6 class="information-heading u-s-m-b-8">Product Variants:</h6>
                                {{-- <div class="color u-s-m-b-11">
                                <span>Available Color:</span>
                                <div class="color-variant select-box-wrapper">
                                    <select class="select-box product-color">
                                        <option value="1">Heather Grey</option>
                                        <option value="3">Black</option>
                                        <option value="5">White</option>
                                    </select>
                                </div>
                            </div> --}}

                                @if (count($groupProducts) > 0)
                                    <div class="">
                                        <div class="">
                                            <strong>Product Colors</strong>
                                        </div>
                                        <div style="margin-top:10px">
                                            @foreach ($groupProducts as $product)
                                                <a href="{{ url('product/' . $product['id']) }}" class="">
                                                    <img style="width:70px"
                                                        src="{{ asset('admin/photos/product_images/small/' . $product['product_image']) }}"
                                                        alt="">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="sizes u-s-m-b-11" style="margin-top:30px">
                                    <span>Available Size:</span>
                                    <div class="size-variant select-box-wrapper">
                                        <select name="size" id="getPrice" product-id="{{ $productDetails['id'] }}"
                                            class="select-box product-size" required>
                                            <option value="">Select Size</option>
                                            @foreach ($productDetails['attributes'] as $attribute)
                                                <option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                                {{-- <div class="quick-social-media-wrapper u-s-m-b-22">
                                    <span>Share:</span>
                                    <ul class="social-media-list">
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-google-plus-g"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-rss"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-pinterest"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div> --}}
                                <div class="quantity-wrapper u-s-m-b-22">
                                    <span>Quantity:</span>
                                    <div class="quantity">
                                        <input type="number" name="quantity" id="" class="quantity-text-field"
                                            value="1">
                                    </div>
                                </div>
                                <div>
                                    <button class="button button-outline-secondary" type="submit">Add to cart</button>
                                    <button class="button button-outline-secondary far fa-heart u-s-m-l-6"></button>
                                    <button class="button button-outline-secondary far fa-envelope u-s-m-l-6"></button>
                                </div>
                            </div>
                        </form>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <b>Delivery</b>
                                <input type="text" id="pincode" placeholder="Check Pincode" required
                                    class="form-control">
                                <button class="mt-2 button button-outline-secondary w-50" type="button"
                                    id="checkPincode">Go</button>
                            </div>
                        </div>
                    </div>
                    <!-- Product-details /- -->
                </div>
            </div>
            <!-- Product-Detail /- -->
            <!-- Detail-Tabs -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="detail-tabs-wrapper u-s-p-t-80">
                        <div class="detail-nav-wrapper u-s-m-b-30">
                            <ul class="nav single-product-nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#video">Product Video</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#detail">Product Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#review">Reviews
                                        ({{ count($ratings) }})</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <!-- Description-Tab -->
                            <div class="tab-pane fade active show" id="video">
                                <div class="description-whole-container">
                                    @if ($productDetails['product_video'])
                                        <video width="320" height="240" controls>
                                            <source
                                                src="{{ url('admin/videos/product_video/' . $productDetails['product_video']) }}"
                                                type="video/mp4">
                                        </video>
                                    @else
                                        Product Video Does Not Exists
                                    @endif
                                </div>
                            </div>
                            <!-- Description-Tab /- -->
                            <!-- Details-Tab -->
                            <div class="tab-pane fade" id="detail">
                                <div class="specification-whole-container">
                                    <div class="spec-table u-s-m-b-50">
                                        <h4 class="spec-heading">Product Details</h4>
                                        <table>
                                            @foreach ($productFilters as $filter)
                                                @if (isset($productDetails['category_id']))
                                                    <?php
                                                    $filterAvailable = ProductsFilter::filterAvailable($filter['id'], $productDetails['category_id']);
                                                    ?>
                                                    @if ($filterAvailable == 'Yes')
                                                        <tr>
                                                            <td>{{ $filter['filter_name'] }}</td>
                                                            <td>
                                                                @foreach ($filter['filter_values'] as $value)
                                                                    @if (
                                                                        !empty($productDetails[$filter['filter_column']]) &&
                                                                            $value['filter_value'] == $productDetails[$filter['filter_column']]
                                                                    )
                                                                        {{ ucwords($value['filter_value']) }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Specifications-Tab /- -->
                            <!-- Reviews-Tab -->
                            <div class="tab-pane fade" id="review">
                                <div class="review-whole-container">
                                    <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="total-score-wrapper">
                                                <h6 class="review-h6">Average Rating</h6>
                                                <div class="circle-wrapper">
                                                    <h1>{{ $avgRating }}</h1>
                                                </div>
                                                <h6 class="review-h6">Based on {{ count($ratings) }} Reviews</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="total-star-meter">
                                                <div class="star-wrapper">
                                                    <span>5 Stars</span>
                                                    <div class="star">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>({{$ratingFiveStarCount}})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>4 Stars</span>
                                                    <div class="star">
                                                        <span style='width:0px'></span>
                                                    </div>
                                                    <span>({{ $ratingFourStarCount }})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>3 Stars</span>
                                                    <div class="star">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>({{$ratingThreeStarCount}})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>2 Stars</span>
                                                    <div class="star">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>({{$ratingTwoStarCount}})</span>
                                                </div>
                                                <div class="star-wrapper">
                                                    <span>1 Star</span>
                                                    <div class="star">
                                                        <span style='width:0'></span>
                                                    </div>
                                                    <span>({{$ratingOneStarCount}})</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                                        <div class="col-lg-12">
                                            <form method="POST" action="{{ url('add-rating') }}" name="formRating"
                                                id="formRating">
                                                @csrf
                                                <input type="hidden" name="product_id"
                                                    value="{{ $productDetails['id'] }}">
                                                <div class="your-rating-wrapper">
                                                    <h6 class="review-h6">Your Review is matter.</h6>
                                                    <h6 class="review-h6">Have you used this product before?</h6>
                                                    <div class="rate">
                                                        <input style="display:none;" type="radio" id="star5"
                                                            name="rating" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input style="display:none;" type="radio" id="star4"
                                                            name="rating" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input style="display:none;" type="radio" id="star3"
                                                            name="rating" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input style="display:none;" type="radio" id="star2"
                                                            name="rating" value="2" />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input style="display:none;" type="radio" id="star1"
                                                            name="rating" value="1" />
                                                        <label for="star1" title="text">1 star</label>
                                                    </div>
                                                    <textarea name="review" class="text-area u-s-m-b-8" id="review-text-area" placeholder="Your Review" required></textarea>
                                                    <button type="submit" class="button button-outline-secondary">Submit
                                                        Review</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Get-Reviews -->
                                    <div class="get-reviews u-s-p-b-22">
                                        <!-- Review-Options -->
                                        <div class="review-options u-s-m-b-16">
                                            <div class="review-option-heading">
                                                <h6>Reviews
                                                    <span> ({{ count($ratings) }}) </span>
                                                </h6>
                                            </div>
                                            <div class="review-option-box">
                                                <div class="select-box-wrapper">
                                                    <label class="sr-only" for="review-sort">Review Sorter</label>
                                                    <select class="select-box" id="review-sort">
                                                        <option value="">Sort by: Best Rating</option>
                                                        <option value="">Sort by: Worst Rating</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Review-Options /- -->
                                        <!-- All-Reviews -->
                                        <div class="reviewers">
                                            @if (count($ratings) > 0)
                                                @foreach ($ratings as $rating)
                                                    <div class="review-data">
                                                        <div class="reviewer-name-and-date">
                                                            <h6 class="reviewer-name">{{ $rating['user']['name'] }}</h6>
                                                            <h6 class="review-posted-date">
                                                                {{ date('F j,Y,g:i a', strtotime($rating['created_at'])) }}
                                                            </h6>
                                                        </div>
                                                        <div class="reviewer-stars-title-body">
                                                            <div class="reviewer-stars">
                                                                <?php 
                                                                    $count = 0;
                                                                    while($count<$rating['rating']){    
                                                                ?>
                                                                <span style="color:gold">&#9733;</span>
                                                                <?php $count
                                                                ++;
                                                                    }
                                                                ?>
                                                            </div>
                                                            <p class="review-body">
                                                                {{ $rating['review'] }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <!-- All-Reviews /- -->

                                    </div>
                                    <!-- Get-Reviews /- -->
                                </div>
                            </div>
                            <!-- Reviews-Tab /- -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Detail-Tabs /- -->
            <!-- Different-Product-Section -->
            <div class="detail-different-product-section u-s-p-t-80">
                <!-- Similar-Products -->
                <section class="section-maker">
                    <div class="container">
                        <div class="sec-maker-header text-center">
                            <h3 class="sec-maker-h3">Similar Products</h3>
                        </div>
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($similarProduct as $product)
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link"
                                                href="{{ url('product/' . $product['id']) }}">
                                                <?php $product_image_path = 'admin/photos/product_images/small/' . $product['product_image']; ?>

                                                @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                    <img class="img-fluid" src="{{ asset($product_image_path) }}"
                                                        alt="Product">
                                                @else
                                                    <img class="img-fluid"
                                                        src="{{ asset('admin/photos/product_images/small/no-image.png') }}"
                                                        alt="Product">
                                                @endif
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick
                                                    Look</a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a
                                                            href="shop-v1-root-category.html">{{ $product['product_code'] }}</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="listing.html">{{ $product['product_color'] }}</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="listing.html">{{ $product['brand']['name'] }}</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="single-product.html">{{ $product['product_name'] }}</a>
                                                </h6>
                                                {{-- <div class="item-description">
                                                    <p>{{ $product['description'] }}
                                                    </p>
                                                </div> --}}
                                                {{-- <div class="item-stars">
                                                    <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                        <span style='width:67px'></span>
                                                    </div>
                                                    <span>(23)</span>
                                                </div> --}}
                                            </div>
                                            <?php $getDiscountPrice = Product::discountPrice($product['id']); ?>

                                            @if ($getDiscountPrice > 0)
                                                <div class="price-template">
                                                    <div class="item-new-price">
                                                        {{ $getDiscountPrice }} Tk
                                                    </div>
                                                    <div class="item-old-price">
                                                        {{ $product['product_price'] }} Tk
                                                    </div>
                                                </div>
                                            @else
                                                <div class="price-template">
                                                    <div class="item-new-price">
                                                        {{ $product['product_price'] }} Tk
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Similar-Products /- -->
                <!-- Recently-View-Products  -->
                <section class="section-maker">
                    <div class="container">
                        <div class="sec-maker-header text-center">
                            <h3 class="sec-maker-h3">Recently View</h3>
                        </div>
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($recentlyProducts as $product)
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link"
                                                href="{{ url('product/' . $product['id']) }}">
                                                <?php $product_image_path = 'admin/photos/product_images/small/' . $product['product_image']; ?>

                                                @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                    <img class="img-fluid" src="{{ asset($product_image_path) }}"
                                                        alt="Product">
                                                @else
                                                    <img class="img-fluid"
                                                        src="{{ asset('admin/photos/product_images/small/no-image.png') }}"
                                                        alt="Product">
                                                @endif
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick
                                                    Look</a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a
                                                            href="shop-v1-root-category.html">{{ $product['product_code'] }}</a>
                                                    </li>
                                                    <li class="has-separator">
                                                        <a href="listing.html">{{ $product['product_color'] }}</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="listing.html">{{ $product['brand']['name'] }}</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a href="single-product.html">{{ $product['product_name'] }}</a>
                                                </h6>
                                                {{-- <div class="item-description">
                                                    <p>{{ $product['description'] }}
                                                    </p>
                                                </div> --}}
                                                {{-- <div class="item-stars">
                                                    <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                        <span style='width:67px'></span>
                                                    </div>
                                                    <span>(23)</span>
                                                </div> --}}
                                            </div>
                                            <?php $getDiscountPrice = Product::discountPrice($product['id']); ?>

                                            @if ($getDiscountPrice > 0)
                                                <div class="price-template">
                                                    <div class="item-new-price">
                                                        {{ $getDiscountPrice }} Tk
                                                    </div>
                                                    <div class="item-old-price">
                                                        {{ $product['product_price'] }} Tk
                                                    </div>
                                                </div>
                                            @else
                                                <div class="price-template">
                                                    <div class="item-new-price">
                                                        {{ $product['product_price'] }} Tk
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Recently-View-Products /- -->
            </div>
            <!-- Different-Product-Section /- -->
        </div>
    </div>
    <!-- Single-Product-Full-Width-Page /- -->
@endsection
