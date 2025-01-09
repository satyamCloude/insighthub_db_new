<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{url('public/assets/')}}/"
  data-template="vertical-menu-template">
@include('includes.head')
<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      @include('includes.sidebar')
          <div class="layout-page">
            @include('includes.navbar')
          <div class="content-wrapper">
            @yield('content')
            @include('includes.footer')
              <div class="content-backdrop fade"></div>
          </div>
          </div>
    </div>
    <!-- Overlay --> 
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
  </div>
</body>
</html>
