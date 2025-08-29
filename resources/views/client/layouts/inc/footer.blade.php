<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="/client/img/footer-logo.png" alt=""></a>
                    </div>
                    <p>{{ \Fomvasss\Variable\Facade::get('site.description') }}</p>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 col-md-4 col-sm-6">
                <div class="footer__widget">
                    <h6>Contact Us</h6>
                    <ul>
                        @foreach(\Fomvasss\Variable\Facade::getArray('contacts') as $field => $values)
                            @if(is_array($values))
                                @foreach($values as $subField => $value)
                                    <li><a href="#">{{ $subField }}: {{ $value }}</a></li>
                                @endforeach
                            @else
                                <li><a href="#">{{ $field }}: {{ $values }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="footer__widget">
                <h6>Addresses</h6>
                <ul>
                    @foreach(\Fomvasss\Variable\Facade::getArray('addresses') as $values)
                        <li><a href="#">{{ $values }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</footer>
