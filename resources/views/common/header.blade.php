<!--Top Navbar Starts from here -->
<section class="topNavbar">
    <header>
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </a>
        <div class="search-container">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" placeholder="Search for gifts" name="searchQuery">
                <button type="submit"><i class="fa fa-search"></i><span id="mob-search">Search</span></button>
            </form>
        </div>

        <div class="icons">
            <a href="https://www.facebook.com/Crazzygift/" target="_blank" id="fb-menu"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://twitter.com/undergrndmedia" target="_blank" id="twitter-menu"><i class="fa-brands fa-twitter"></i></a>
            <div class="user-dropdown">
                <a href="#" class="user-icon"><i class="fa-solid fa-user"></i></a>
                <div class="user-content">
                    <a href="{{ url('/Myprofile') }}">My Account</a>
                    <a href="{{ url('/myorder') }}">My Orders</a>
                    @if (auth()->check())
                        <a href="javascript:void(0)" onclick="forceLogout()">Logout</a>
                    @endif
                </div>
            </div>
            <a href="{{ url('/shippingCart') }}" id="cart-menu">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-count"></span>
            </a>
        </div>
        <div class="toggle" >
            <input type="checkbox" id="toggle-btn">
            <label for="toggle-btn" class="toggle-label"><i class="fa-solid fa-bars"></i></label>
            <nav class="modifiedNav">
                <button id="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <ul>
                    <li><a href="{{ url('/') }}"><i class="fa-solid fa-house-chimney-window"></i> Home</a></li>
                    @if (!auth()->check())
                        <li><a href="{{ url('/signin') }}"><i class="fa-solid fa-users"></i> Register</a></li>
                        <li><a href="{{ url('/login') }}"><i class="fa-solid fa-arrow-right-to-bracket"></i> Log In</a></li>
                    @endif


                    <li><a href="{{ url('/products-all') }}"><i class="fa-solid fa-gift"></i> Products</a></li>

                    <li><a href="{{ url('/shippingCart') }}"><i class="fa-solid fa-cart-shopping"></i> Cart Page</a></li>

                    @if (auth()->check())
                        <li><a href="{{ url('/myorder') }}"><i class="fa-solid fa-bag-shopping"></i> My Order</a></li>
                        <li><a href="{{ url('/Myprofile') }}"><i class="fa-solid fa-user-shield"></i> My Account</a></li>
                        <li> <a href="javascript:void(0)" onclick="forceLogout()"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
</section>
<!--Top Navbar Starts end here -->


<section class="bottomNavbar">

    <div class="btHeader">
        <div class="borderRadius">

            @php
            $parentCount = count($menus->where('status', 1)->where('parent_id', null));
            $currentParentIndex = 0;
            @endphp
            @foreach ($menus as $key => $menu)

            @if($menu->status==1)
                @if ($menu->parent_id === null)
                    @if (count($menu->children) > 0)
                        <div class="dropdown">
                            <a href="{{ url('/').'/'.$menu->url}}" style="text-decoration: none;"
                                class="btHeader-item hover-item">
                                {!! $menu->icon !!}
                                <span>{{ $menu->name }} <i class="fa-solid fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($menu->children as $child)
                                    @if($child->status==1)
                                         <li><a href="{{ url('/').'/'.$child->url}}">{!! $child->icon !!} {{ $child->name }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="menu-item">
                            <a href="{{ url('/').'/'.$menu->url}}" style="text-decoration: none;" class="btHeader-item">
                                {!! $menu->icon !!}
                                <span>{{ $menu->name }}</span>
                            </a>
                        </div>
                    @endif
                    @if ($currentParentIndex < $parentCount - 1)
                        <div class="header-divider"></div>
                    @endif
        
                    @php
                        $currentParentIndex++;
                    @endphp
                @endif
            @endif

            @endforeach

        </div>
    </div>


    <div class="mobileBtHeader">
        <div class="row">

            {{-- @php
            $parentCount2 = count($menus->where('status', 1)->where('parent_id', null));
            $currentParentIndex2 = 0;
            @endphp --}}
            @foreach ($menus as $key => $menu)
            @if($menu->status==1)
                @if ($menu->parent_id === null)
                    @if (count($menu->children) > 0)
                        <div class="col-lg-6" id="col-6">
                            <div class="btHeader-item">

                                <div class="dropdown">
                                    <a href="javascript:void(0)" style="text-decoration: none;" class="btHeader-item">
                                        {!! $menu->icon !!}
                                        <span>{{ $menu->name }} <i class="fa-solid fa-angle-down"></i></span>

                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach ($menu->children as $child)
                                            <li><a href="{{ url('/').'/'.$child->url}}">{!! $child->icon !!} {{ $child->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6" id="col-6">
                            <a href="{{ url('/').'/'.$menu->url}}" style="text-decoration: none;" class="btHeader-item">
                                {!! $menu->icon !!}
                                <span>{{ $menu->name }}</span>
                            </a> 
                        </div>
                    @endif
                    {{-- <div class="header-divider"></div> --}}
                    {{-- @if ($currentParentIndex2 < $parentCount2 - 1)
                    <div class="header-divider"></div>
                @endif
    
                @php
                    $currentParentIndex2++;
                @endphp --}}
                @endif
            @endif
            @endforeach

        </div>
    </div>



    {{-- <div class="mobileBtHeader">
        <div class="row">
            <div class="col-lg-6" id="col-6">
                <a href="{{ url('/') }}" style="text-decoration: none;" class="btHeader-item">
                    <i class="fa-solid fa-home"></i>
                    <span>Home</span>
                </a>
            </div>
            <div class="col-lg-6" id="col-6">
                <div class="btHeader-item">
                    <i class="fa-solid fa-image"></i>
                    <div class="dropdown">
                        <div class="dropdown-header" onmouseover="toggleDropdown(event)"
                            onmouseout="hideDropdown(event)">
                            <span>Products <i class="fa-solid fa-angle-down"></i></span>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a href="#">3D Crystals</a></li>
                            <li><a href="#">Wooden Engraved</a></li>
                            <li><a href="#">Photo Frames</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" id="col-6">
                <div class="btHeader-item">
                    <i class="fa-solid fa-cake-candles"></i>
                    <div class="dropdown">
                        <div class="dropdown-header" onclick="toggleDropdown(event)">
                            <span>Occasions <i class="fa-solid fa-angle-down"></i></span>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a href="#">Anniversary</a></li>
                            <li><a href="#">Birthday</a></li>
                            <li><a href="#">Valentine Day</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" id="col-6">
                <div class="btHeader-item">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                    <div class="dropdown">
                        <div class="dropdown-header" onclick="toggleDropdown(event)">
                            <span>Price <i class="fa-solid fa-angle-down"></i></span>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a href="#">0 to 500</a></li>
                            <li><a href="#">1001 to 2000</a></li>
                            <li><a href="#">2000 and Above</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" id="col-6">
                <a href="#" style="text-decoration: none;" class="btHeader-item">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>About Us</span>
                </a>
            </div>
            <div class="col-lg-6" id="col-6">
                <a href="#" style="text-decoration: none;" class="btHeader-item">
                    <i class="fa-solid fa-phone-volume"></i>
                    <span>Contact Us</span>
                </a>
            </div>
            <div class="col-lg-6" id="col-6">
                <a href="#" style="text-decoration: none;" class="btHeader-item">
                    <i class="fa-solid fa-gift"></i>
                    <span>Gifts</span>
                </a>
            </div>
            <div class="col-lg-6" id="col-6">
                <a href="#" style="text-decoration: none;" class="btHeader-item">
                    <img src="{{ asset('images/icons/party.png') }}" alt="">
                    <span>Birthdays</span>
                </a>
            </div>
            <div class="col-lg-6" id="col-6">
                <a href="#" style="text-decoration: none;" class="btHeader-item">
                    <i class="fa-solid fa-tag"></i>
                    <span>Best Selling</span>
                </a>
            </div>
        </div>
    </div>
     --}}
</section>

<script>
    const toggleBtn = document.getElementById('toggle-btn');
const closeBtn = document.getElementById('close-btn');
const nav = document.querySelector('nav');

closeBtn.addEventListener('click', () => {
    toggleBtn.checked = false;
});

toggleBtn.addEventListener('click', () => {
    if (toggleBtn.checked) {
        nav.classList.add('open');
    } else {
        nav.classList.remove('open');
    }
});
</script>
