@extends('client.layouts.app')

@section('content')
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                @for($i = 0; $i < 15; $i++)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="/client/img/product/product-2.jpg" style="background-image: url(&quot;/client/img/product/product-2.jpg&quot;);">
                            </div>
                           <div class="p-2">
                               <h5>
                                   name to cateboty
                               </h5>
                           </div>
                            <ul class="product_categories-list ">
                                <li class="pl-3">
                                    qexqeexweweqweqweqweqwewqewqeqexqeexweweqweqweqweqwewqewqe
                                </li>
                                <li class="pl-3">
                                    qexqeexweweqweqweqweqwewqewqe
                                </li>
                                <li class="pl-3">
                                    qexqeexweweqweqweqweqwewqewqe
                                </li>
                                <li class="pl-3">
                                    qexqeexweweqweqweqweqwewqewqe
                                </li>
                                <li class="pl-3">
                                    qexqeexweweqweqweqweqwewqewqe
                                </li>
                            </ul>
                        </div>
                    </div>
                @endfor


            </div>
        </div>
    </section>
@endsection
