@extends('client.layouts.app')

@push('styles')
    <style>
        .region-wrapper{
            display: none;
        }
        .city-wrapper{
            display: none;
        }
        .city_region-wrapper{
            display: none;
        }
    </style>
@endpush

@section('content')
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form method="post" action="{{ route('checkout.store') }}">
                    @method('POST')
                    @csrf
                    @error('order')
                    <div class="p-4 row">
                        <div style="width: 100%;">
                            <div style="background: indianred" class="p-4">
                                <p class="text-center" style="color: white">
                                    {{ $message }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @enderror
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input name="customer[first_name]" type="text" value="{{ old('customer.first_name') }}" class="@error('customer.first_name') is-invalid @enderror">
                                        @error('customer.first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input name="customer[last_name]" type="text">
                                        @error('customer.last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input name="customer[phone]" type="number">
                                        @error('customer.phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input name="customer[email]" type="text">
                                        @error('customer.email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input mt-3">
                                <p>Область<span>*</span></p>
                                <select class="select-area" name="area_id" style="width: 100%">
                                    <option value="">Область</option>
                                </select>
                            </div>

                            <div class="checkout__input mt-3">
                                <div class="region-wrapper">
                                    <p>Регіон<span>*</span></p>
                                    <select class="select-region" name="region_id" style="width: 100%">
                                        <option value="">Регіон</option>
                                    </select>
                                </div>
                            </div>

                            <div class="checkout__input mt-3">
                                <div class="city-wrapper">
                                    <p>Місто<span>*</span></p>
                                    <select class="select-city" name="city_id" style="width: 100%">
                                        <option value="">Місто</option>
                                    </select>
                                </div>
                            </div>

                            <div class="checkout__input mt-3">
                                <div class="city_region-wrapper">
                                    <p>Регіон міста<span>*</span></p>
                                    <select class="select-city-region" name="city_region_id" style="width: 100%">
                                        <option value="">Регіон міста</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    @foreach(cart()->purchases() as $key => $purchase)
                                        <li>{{$key + 1}}. {{ $purchase->name }} <span>{{ $purchase->amount }}.грн</span></li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Total <span>{{ cart()->totalPrice() }}.грн</span></li>
                                </ul>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            let area_id = null;
            let region_id = null;
            let city_id = null;

            $('.select-area').select2({
                ajax: {
                    url: "{{ route('suggest.settlements', \App\Models\Settlement::TYPE_AREA) }}",
                    dataType: 'json'
                }
            }).change(function (e){
                 area_id = $(this).val();
                $('.region-wrapper').toggle(!!area_id);
                $('.select-region').val(null).trigger('change');
            })

            $('.select-region').select2({
                ajax: {
                    url: "{{ route('suggest.settlements', \App\Models\Settlement::TYPE_REGION) }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            area_id: area_id,
                            q: params.term
                        };
                    }
                }
            }).change(function (e){
                region_id = $(this).val();
                $('.city-wrapper').toggle(!!region_id);
                $('.select-city').val(null).trigger('change');
            })

            $('.select-city').select2({
                ajax: {
                    url: "{{ route('suggest.settlements', \App\Models\Settlement::TYPE_CITY) }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            area_id: area_id,
                            region_id: region_id,
                            q: params.term
                        };
                    }
                }
            }).change(function (e){
                city_id = $(this).val();
                $('.city_region-wrapper').toggle(!!city_id);
                $('.select-city-region').val(null).trigger('change');
            })

            $('.select-city-region').select2({
                ajax: {
                    url: "{{ route('suggest.settlements', \App\Models\Settlement::TYPE_CITY_REGION) }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            area_id: area_id,
                            region_id: region_id,
                            city_id: city_id,
                            q: params.term
                        };
                    }
                }
            })
        });
    </script>
@endpush
