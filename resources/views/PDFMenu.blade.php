<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    .menu-row {
        font-family: DejaVu Sans !important;
        margin: 0 auto;
        width: 100%;
    }

    .menu-row-ar {
        direction: rtl;
    }

    .menu-row-en {
        direction: ltr;
    }

    .menu-title {
        /* margin-right: 10px; */
        color: #fcc233;
        font-size: 22px !important;
        /* padding-top: 35px; */
    }

    .cat-menu-item {
        /* margin-right: 20px; */
        font-size: 14px !important;
        color: #373737;
        line-height: 2;
    }

    .menu-title-ar {
        text-align: right;
    }

    .cat-menu-item-ar {
        text-align: right;
        padding-right: 15px;
        margin-right: 15px;
    }

    .menu-title-en {
        text-align: left;
    }

    .cat-menu-item-en {
        text-align: left;
        padding-left: 15px;
        margin-left: 15px;
    }
</style>
<div class="row menu-row menu-row-{{ $lang }}">
    <table class="studies" cellpadding="2" border="0" style="" width="100%">
        <tbody>
            @foreach ($category_menus as $key => $category_menu)
                @php
                    $recipes_ar = explode('|', $category_menu['recipes_ar']);
                    $recipes_en = explode('|', $category_menu['recipes_en']);
                @endphp
                <tr class="title-tr" nobr="true">
                    <td class="menu-title menu-title-{{ $lang }}">
                        {{ $category_menu["name_$lang"] }}
                    </td>
                </tr>
                @foreach ($recipes_ar as $key1 => $recipe_ar)
                    <tr nobr="true">
                        <td class="cat-menu-item cat-menu-item-{{ $lang }}">
                            &nbsp;&nbsp;&nbsp;{{ $lang == 'ar' ? $recipes_ar[$key1] : $recipes_en[$key1] }}
                        </td>
                    </tr>
                @endforeach
                <br>
            @endforeach
        </tbody>
    </table>
</div>
