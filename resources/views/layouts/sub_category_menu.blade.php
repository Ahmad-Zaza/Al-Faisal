
<div class="container category-menu-info">
    {{-- <div class="row preparing-food-row">
        <div class="col menu-col-colored"></div>
    </div> --}}
    <div class="row menu-row">
        {{-- <div class="col-md-6 col-sm-12 menu-col breadcrumb-col" style="">

        </div>
        <div class="col-md-6 col-sm-12 menu-col"
            style="background-image: url(../img/background/faisal-yellow.png);
            background-position: center;
            background-repeat: no-repeat;
            background-size: 50% 100%;
            height:100px; ">
        </div> --}}
        @foreach ($category_menus as $key => $category_menu)
            @php
                $recipes_ar = explode('|', $category_menu['recipes_ar']);
                $recipes_en = explode('|', $category_menu['recipes_en']);
            @endphp
            {{-- @if ($key % 2 == 0)
                <div class="col-md-6 col-sm-12 menu-col {{ $lang == 'ar' ? 'menu-col-ar' : 'menu-col-en' }}">
                    <div class="menu-items">
                        <h5 class="menu-title">{{ $category_menu["name_$lang"] }}</h5>
                        @foreach ($recipes_ar as $key1 => $recipe_ar)
                            <p class="cat-menu-item">{{ $lang == 'ar' ? $recipes_ar[$key1] : $recipes_en[$key1] }}
                            </p>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 menu-col">
                    @if ($category_menu['image'])
                        <img class="menu-item-img" src="{{ asset($category_menu['image']) }}"
                            alt="{{ $category_menu['image_alt'] }}" loading="lazy">
                    @else
                        <img class="menu-item-img default-menu-img" src="{{ asset('img/covers/no-photo-img.jpg') }}"
                            alt="default_img" loading="lazy">
                    @endif
                </div> --}}
            {{-- @else --}}
                <div class="col-md-6 col-sm-12 menu-col">
                    @if ($category_menu['image'])
                        <img class="menu-item-img colored-menu-item-img" src="{{ asset($category_menu['image']) }}"
                            alt="{{ $category_menu['image_alt'] }}" loading="lazy">
                    @else
                        <img class="menu-item-img default-menu-img" src="{{ asset('img/covers/no-photo-img.jpg') }}"
                            alt="default_img" loading="lazy">
                    @endif

                </div>
                <div class="col-md-6 col-sm-12 menu-col menu-col-colored">
                    <div class="menu-items">
                        <h5 class="menu-title colored-menu-title">{{ $category_menu["name_$lang"] }}</h5>
                        @foreach ($recipes_ar as $key1 => $recipe_ar)
                            <p class="cat-menu-item">
                                {{ $lang == 'ar' ? $recipes_ar[$key1] : $recipes_en[$key1] }}
                            </p>
                        @endforeach
                    </div>
                </div>
            {{-- @endif --}}
        @endforeach
    </div>
