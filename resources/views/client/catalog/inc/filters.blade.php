<div class="col-lg-3">
    <div class="shop__sidebar">
        <div class="shop__sidebar__search">
            <form action="#">
                <input type="text" name="name" value="{{ request('name') }}" placeholder="Search...">
                <button type="submit"><span class="icon_search"></span></button>
            </form>
        </div>
        <form class="shop__sidebar__accordion">
            <div class="accordion" id="accordionExample">
                @if(count(request()->all()))
                    <div class="mb-3">
                        <a href="{{ route('catalog.show', $category->slug) }}">
                            <button type="button" class="btn btn-danger btn-block mt-2">Cкинути</button>
                        </a>
                    </div>
                @endif
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-block mt-2">Застосувати</button>
                </div>
                <div class="card">
                    <div class="card-heading">
                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                    </div>
                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="shop__sidebar__price">
                                    <div class="form-group">
                                        <label for="price_from">Ціна від</label>
                                        <input type="number"
                                               name="price_from"
                                               id="price_from"
                                               class="form-control"
                                               min="{{ $filters['price']['from'] }}"
                                               max="{{ $filters['price']['to'] }}"
                                               value="{{ $filters['price']['from'] }}"
                                               placeholder="Ціна від">
                                    </div>
                                    <div class="form-group">
                                        <label for="price_to">Ціна до</label>
                                        <input type="number"
                                               name="price_to"
                                               id="price_to"
                                               class="form-control"
                                               min="{{ $filters['price']['from'] }}"
                                               max="{{ $filters['price']['to'] }}"
                                               value="{{ $filters['price']['to'] }}"
                                               placeholder="Ціна до">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-heading">
                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                    </div>
                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="shop__sidebar__brand">
                                <ul>
                                    @foreach($filters['brands'] as $brand)
                                        <li>
                                            <label>
                                                <input type="radio" name="brand_id" value="{{ $brand->id }}"
                                                    {{ request('brand_id') == $brand->id ? 'checked' : '' }}>
                                                {{ $brand->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($filters['characteristics'] as $attributeName => $items)
                    <div class="card">
                        <div class="card-heading">
                            <a data-toggle="collapse" data-target="#collapse{{str()->slug($attributeName)}}">
                                {{ $attributeName }}
                            </a>
                        </div>
                        <div id="collapse{{str()->slug($attributeName)}}" class="collapse
                            show

                         " data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="characteristics-group">
                                    @foreach($items as $item)
                                        @php
                                            $id = 'char.'.str()->slug($item->id);
                                            $isChecked = in_array($item->id, (array) request('characteristics', []));
                                        @endphp
                                        <label for="{{ $id }}" class="char-item {{ $isChecked ? 'active' : '' }}">
                                            {{ $item->name }}
                                            <input type="checkbox"
                                                   name="characteristics[]"
                                                   value="{{ $item->id }}"
                                                   id="{{ $id }}"
                                                {{ $isChecked ? 'checked' : '' }}>
                                        </label>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>
</div>


@push('styles')
    <style>
        .characteristics-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .char-item {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #333;
            border-radius: 4px;
            cursor: pointer;
            user-select: none;
            transition: all 0.2s;
        }
        .char-item input {
            display: none;
        }
        .char-item.active {
            background-color: black;
            color: #fff;
            border-color: #333;
        }
        .char-item:hover {
            background-color: black;
            color: #fff;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.querySelectorAll('.char-item input').forEach(function(input) {
            input.addEventListener('change', function() {
                if(this.checked) {
                    this.closest('label').classList.add('active');
                } else {
                    this.closest('label').classList.remove('active');
                }
            });
        });
    </script>
@endpush
