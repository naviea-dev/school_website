<div class="header-sticky">
    <header class="navbar container">
        <div class="nav-content">
            <a class="logo-section" href="{{ route('home') }}">
                <img src="{{ $commonData['logo'] }}" alt="{{ $commonData['school_name'] }}" class="logo">
                <h2 class="logo_text">{{ $commonData['school_name'] }}</h2>
            </a>

            <ul class="main-menu" id="navMenu">
                <li><a href="{{ route('home') }}"><ion-icon name="home" class="home-icon"></ion-icon> হোম </a></li>

                @foreach ($commonData['menus'] as $menu)
                <?php
                if($menu->page_structure == 'Page') {
                    $mainurl = url($menu->uri);
                }
                else{
                    $mainurl = route('websitecontent.slug', [$menu->uri]);
                }
                $mclass = $menu->subMenu->count() != 0 ? 'has-sub' : '';
                ?>
                <li class="{{ $mclass }}">
                    <a href="{{ $mainurl }}">
                        {{ $menu->title_bangla }}
                        @if ($menu->subMenu->count() != 0)
                        <ion-icon name="caret-down-outline"></ion-icon>
                        @endif
                    </a>

                    @if ($menu->subMenu->count() != 0)
                    <ul class="dropdown">
                        @foreach ($menu->subMenu as $smenu)
                        <?php
                        $suburl = route('websitecontent.sslug', [$menu->uri, $smenu->uri]);
                        $sclass = $smenu->lastMenu->count() != 0 ? 'has-sub' : '';
                        ?>
                        <li class="{{ $sclass }}">
                            <a href="{{ $suburl }}">
                                {{ $menu->title_bangla }}
                                @if ($smenu->lastMenu->count() != 0)
                                <ion-icon name="caret-down-outline"></ion-icon>
                                @endif
                            </a>

                            @if ($smenu->lastMenu->count() != 0)
                            <ul class="dropdown submenu">
                                @foreach ($smenu->lastMenu as $lmenu)
                                <?php
                                $lasturl = route('websitecontent.ssslug', [$menu->uri, $smenu->uri, $lmenu->uri]);
                                ?>
                                <li><a href="{{ $lasturl }}">{{ $lmenu->title }}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach

                <div class="auth-btns">

                    <div class="d-flex align-items-center gap-2">

                        <!-- LOGIN BUTTON (school-sass) -->
                        <a href="{{ config('services.school_sass.base_url') }}" target="_blank" rel="noopener"
                            class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 px-3 rounded-pill shadow-sm hover-shadow">

                            <ion-icon name="person-circle-outline"></ion-icon>
                            <span>লগইন</span>
                        </a>

                    </div>

                </div>
            </ul>


            <div class="menu-toggle" onclick="toggleMenu()">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
    </header>
</div>