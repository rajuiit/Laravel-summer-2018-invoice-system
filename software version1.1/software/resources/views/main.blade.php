<!DOCTYPE html>
<html>

<!-- head tag started -->

@include ('partial/header');
<!-- head tag ended -->



<body class="theme-red">
<!-- Page Loader -->
   @include ('partial/pageLoader');
<!-- #END# Page Loader -->


<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->



<!-- Search Bar (Not important) -->
   <!--
   <div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
   -->
<!-- #END# Search Bar -->


<!-- Top Bar -->
@include ('partial/topBar');
<!-- #Top Bar -->


<section>
    <!-- Left Sidebar -->
      @include ('partial/sideBar');
    <!-- #END# Left Sidebar -->


    <!-- Right Sidebar  (Display as blocked now) -->
    @include('partial/rightSideBar');
    <!-- #END# Right Sidebar -->
</section>


<section class="content">
    <div class="container-fluid">
        <!-- Different content will take place from here -->
        @yield('dashboard')
        @yield('404')
        @yield('balance')
        @yield('bank')
        @yield('boucher')
        @yield('buyerList')
        @yield('productList')
        @yield('registerBrand')
        @yield('registerCustomer')
        @yield('registerProduct')
        @yield('sell')
        @yield('buy')
        @yield('return')
        @yield('sellerLists')
        <!-- Different content will end here -->
    </div>
</section>


<!-- Script is here -->

@include ('partial/script')
@yield('sellScript')
@yield('impScript')
<!-- Script is ended -->
</body>

</html>
