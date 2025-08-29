<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-lg text-center p-5">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="text-danger" width="80" height="80" fill="currentColor"
                     viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8
                            0 0 1 16 0zM5.354 4.646a.5.5
                            0 1 0-.708.708L7.293 8l-2.647
                            2.646a.5.5 0 0 0 .708.708L8
                            8.707l2.646 2.647a.5.5 0 0 0
                            .708-.708L8.707 8l2.647-2.646a.5.5
                            0 0 0-.708-.708L8 7.293 5.354
                            4.646z"/>
                </svg>
            </div>
            <h3 class="mb-3">Оплата неуспішна ❌</h3>
            <p class="text-muted mb-4">
                На жаль, оплату не вдалося провести. Спробуйте ще раз або зверніться до підтримки.
            </p>

            <a href="{{ route('home') }}"
               class="btn btn-danger px-4 py-2">
                На головну
            </a>
        </div>
    </div>
</div>
