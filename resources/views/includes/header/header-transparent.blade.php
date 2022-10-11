<div class="header-transparent {{ $isHome ? 'home' : '' }}">
    <div class="desktop-wide-wrap">
        <div class="header-transparent-content">
            <a href="/" title="Boston firearms" class="logo-header-transparent {{ !$isHome ? 'light' : '' }}"></a>
            <div class="menu-row {{ $isHome ? 'home' : '' }}">
                @include('includes.menu.top-menu')
            </div>
            @include('includes.menu.mob-menu')
        </div>
    </div>
</div>
