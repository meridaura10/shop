@extends('client.layouts.app')

@section('content')
    <section class="spad">
        <div class="container-fluid px-4">
            <div class="card border-0 shadow rounded-3 overflow-hidden">

                <!-- Header -->
                <div class="bw-hero d-flex align-items-center gap-3 p-4">
                    <img src="{{ $user->getAvatar() }}"
                         class="rounded-circle border border-2 border-light" alt="Avatar">
                    <div class="ml-3">
                        <h5 class="mb-1 fw-bold text-white">Особистий кабінет</h5>
                        <small class="text-white-50">Ласкаво просимо !</small>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-4">

                    <!-- Вкладки -->
                    <ul class="nav nav-tabs-bw" role="tablist">
                        <li class="nav-item">
                            <a href="#profile" class="tab-link is-active" role="tab" aria-selected="true" data-tab-target="profile">Профіль</a>
                        </li>
                        <li class="nav-item">
                            <a href="#orders" class="tab-link" role="tab" aria-selected="false" data-tab-target="orders">Історія замовлень</a>
                        </li>
                        @if(auth()->check())
                            <li class="nav-item">
                                <a href="#favoriteProducts" class="tab-link" role="tab" aria-selected="false" data-tab-target="favoriteProducts">Обрані товари</a>
                            </li>
                            <li class="nav-item">
                                <a href="#favoriteArticles" class="tab-link" role="tab" aria-selected="false" data-tab-target="favoriteArticles">Обрані статті</a>
                            </li>
                        @endif
                    </ul>

                    <div class="tab-content-bw mt-4">
                        <div class="tab-pane-bw active" id="profile" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-semibold mb-3">Інформація про профіль</h5>
                                <form method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        Вийти
                                    </button>
                                </form>
                            </div>
                            <form method="post" action="{{ route('my.update-profile') }}">
                                @method('POST')
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Ім'я</label>
                                        <input name="name" type="text" class="form-control bw-input" value="{{ $user->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control bw-input" value="{{ $user->email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Телефон</label>
                                        <input name="phone" type="text" class="form-control bw-input" value="{{ $user->phone }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Пароль</label>
                                        <input name="password" type="password" class="form-control bw-input">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn-bw">Зберегти</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane-bw" id="orders" role="tabpanel">
                           @include('client.my.orders.index', ['orders' => $user->orders])
                        </div>
                        @include('client.my.favorites.index')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        :root{
            --bw-bg:#fff; --bw-text:#111; --bw-muted:#6c6c6c; --bw-border:#e6e6e6; --bw-black:#000; --bw-shadow:0 6px 18px rgba(0,0,0,.08);
        }
        body{ background:#fafafa; }
        .bw-hero{ background:#000; }
        .nav-tabs-bw{
            display:flex; gap:.5rem; border-bottom:1px solid var(--bw-border); padding-bottom:.25rem; margin:0;
        }
        .nav-tabs-bw .nav-item{ list-style:none; }
        .tab-link{
            display:inline-block; padding:.6rem 1rem; color:#555; text-decoration:none;
            border-bottom:2px solid transparent; border-radius:.25rem .25rem 0 0; transition:.2s;
        }
        .tab-link:hover{ color:#000; background:#f3f3f3; }
        .tab-link.is-active{ color:#000; border-bottom-color:#000; }

        .tab-content-bw{ position:relative; }
        .tab-pane-bw{ display:none; }
        .tab-pane-bw.active{ display:block; animation:fadeIn .15s ease-in; }
        @keyframes fadeIn{ from{opacity:0; transform:translateY(4px)} to{opacity:1; transform:none} }

        .bw-input{
            background:#fff; border:1px solid var(--bw-border); color:var(--bw-text);
        }
        .bw-input:focus{ border-color:#000; box-shadow:none; }

        .bw-item{
            background:#fff; border:1px solid var(--bw-border); border-radius:.75rem; box-shadow:var(--bw-shadow);
            transition:transform .15s ease, box-shadow .15s ease;
        }
        .bw-item:hover{ transform:translateY(-2px); box-shadow:0 10px 24px rgba(0,0,0,.10); }

        .bw-card{
            background:#fff; border:1px solid var(--bw-border); border-radius:1rem; overflow:hidden;
            transition:transform .2s ease, box-shadow .2s ease; box-shadow:var(--bw-shadow);
        }
        .bw-card:hover{ transform:translateY(-3px); box-shadow:0 12px 28px rgba(0,0,0,.12); }

        .bw-thumb{ background:#000; position:relative; overflow:hidden; }
        .ratio-16x9{ aspect-ratio:16/9; }
        .bw-thumb img{ width:100%; height:100%; object-fit:cover; filter:grayscale(100%); }

        .btn-bw, .btn-bw-outline{
            font-weight:600; letter-spacing:.2px; padding:.55rem 1rem; border-radius:999px; cursor:pointer; display:inline-block;
            text-decoration:none; user-select:none; transition:.15s ease;
        }
        .btn-bw{ background:#000; color:#fff; border:1px solid #000; }
        .btn-bw:hover{ filter:brightness(1.1); transform:translateY(-1px); }
        .btn-bw-outline{ background:#fff; color:#000; border:1px solid #000; }
        .btn-bw-outline:hover{ background:#000; color:#fff; transform:translateY(-1px); }
        .btn-bw-sm{ padding:.4rem .8rem; font-size:.875rem; }

        .text-muted{ color:var(--bw-muted) !important; }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('.tab-link');
            const panes = document.querySelectorAll('.tab-pane-bw');

            function activate(id){
                links.forEach(a => {
                    const is = a.dataset.tabTarget === id;
                    a.classList.toggle('is-active', is);
                    a.setAttribute('aria-selected', is ? 'true' : 'false');
                });
                panes.forEach(p => p.classList.toggle('active', p.id === id));
            }

            links.forEach(a => {
                a.addEventListener('click', function(e){
                    e.preventDefault();
                    const id = this.dataset.tabTarget;
                    activate(id);
                    if(history.replaceState){
                        history.replaceState(null, '', '#' + id);
                    } else {
                        location.hash = id;
                    }
                });
            });

            const hash = (location.hash || '').replace('#','');
            const initial = hash && document.getElementById(hash) ? hash : (links[0]?.dataset.tabTarget || 'profile');
            activate(initial);
        });
    </script>
@endpush
