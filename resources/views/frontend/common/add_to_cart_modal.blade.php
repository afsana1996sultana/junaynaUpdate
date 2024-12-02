{{--  product details modal start  --}}
    <div class="modal fade" id="quickViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Product Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModel"></button>
                </div>
                <div class="modal-body product-details-modal">
                    <div class="quick-view-product d-flex">
                        <div class="quick-view-product-slider-active">
                            <img id="pimage" src="" alt="">
                        </div>
                        <div class="quick-view-product-content">
                            <div class="search-product-content">
                                <a href="#" id="product_name"></a>
                               <div class='d-flex align-items-center'>
                                     <div class="d-flex align-items-center justify-content-start regular-view-price">
                                    <span> ৳</span>
                                    <span id="pprice"></span>
                                </div>
                                <span><del><span id="oldprice" style="color: #DD1D21:"></span></del></span>
                                </div>
                            </div>
                            
                            <p id=pdetail></p>
                            
                            <form id="choice_form">
                                <div class="row " id="attributes">
                                    <div class="form-group col-lg-6" id="colorArea">
                                        
                                    </div>
                                </div>
                                
                                <div class="row" id="attribute_alert"></div>
                            </form>
                            
                            <ul class="product-count-item d-flex align-items-center">
                                <li class="product_quantity">
                                    <a href="#" class="quantity__minus"><span><i class="fa fa-minus"></i></span></a>
                                    <input type="text" name="quantity" class="quantity__input" value="{{ $product->minimum_buy_qty ?? '1' }}" min="1" id="qty">
                                    <a href="#" class="quantity__plus"><span><i class="fa fa-plus"></i></span></a>
                                </li>
                                <div class="product-extra-link2">
                                    <input type="hidden" id="product_id">
                                    <input type="hidden" id="pname">
                                    <input type="hidden" id="product_price">
                                    <input type="hidden" id="discount_amount">
                                    <input type="hidden" id="pfrom" value="modal">
                                    <input type="hidden" id="pvarient" value="">
                                    <input type="hidden" id="minimum_buy_qty" value="">
	                                <input type="hidden" id="stock_qty" value="">
                                    <input type="hidden" id="buyNowCheck" value="0">
                                </div>
                                <li class="product-cart-btn" onclick="addToCart()" id="closeModel">add to cart</li>
                                <li class="product-cart-btn" onclick="buyNow()" id="closeModel">Buy Now</li>
                            </ul>

                            <ul class="product-item">
                                <li><strong>SKU : </strong><span id="pcode"></span></li>
                                <li><strong>Categories : </strong>
                                    <span id="pcategory"></span>
                                </li>
                                
                                <li><strong>Tags : </strong>
                                    <span id="ptag"></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{--  product details modal end  --}}