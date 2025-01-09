<?php $__env->startSection('title', 'File Management'); ?>
<?php $__env->startSection('content'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css">

<style type="text/css">

  .select2-container .select2-selection--single .select2-selection__rendered img,
        .select2-results__option img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        
        .img-flag{
             width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }



  .actives{
    border: 0px solid #1ff11f;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: #1ff11f;
    }
  .inactives{
    border: 0px solid red;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: red;
    }

#inner_content_three{

  display:none;
}

.navbar-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    -webkit-box-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    margin: 0 auto;
    height: 70px;
    padding: 0 calc(1.5rem / 2) 0 0
}

.navbar-header .dropdown .show.header-item {
    background-color: var(--bs-tertiary-bg)
}

.navbar-brand-box {
    padding: 0 1.5rem;
    width: 240px;
    height: 70px
}

.logo {
    line-height: 70px
}

.logo .logo-sm {
    display: none
}

.page-title {
    margin: 0;
    line-height: 70px;
    font-size: 20px
}

[data-layout=horizontal] .search-wrap {
    width: 100%
}

.search-wrap {
    background-color: var(--bs-topbar-search-bg);
    color: var(--bs-dark);
    z-index: 9997;
    position: absolute;
    top: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: calc(100% - 240px);
    right: 0;
    height: 70px;
    padding: 0 15px;
    -webkit-transform: translate3d(0,-100%,0);
    transform: translate3d(0,-100%,0);
    -webkit-transition: .3s;
    transition: .3s
}

.search-wrap form {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%
}

.search-wrap .search-bar {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    width: 100%
}

.search-wrap .search-input {
    -webkit-box-flex: 1;
    -ms-flex: 1 1;
    flex: 1 1;
    border: none;
    outline: 0;
    -webkit-box-shadow: none;
    box-shadow: none;
    background-color: transparent
}

.search-wrap .close-search {
    width: 36px;
    height: 64px;
    line-height: 64px;
    text-align: center;
    color: inherit;
    font-size: 24px
}

.search-wrap .close-search:hover {
    color: #ea553d
}

.search-wrap.open {
    -webkit-transform: translate3d(0,0,0);
    transform: translate3d(0,0,0)
}

.megamenu-list li {
    position: relative;
    padding: 5px 0
}

.megamenu-list li a {
    color: var(--bs-body-color)
}

@media (max-width: 992px) {
    .navbar-brand-box {
        width:auto
    }

    .logo span.logo-lg {
        display: none
    }

    .logo span.logo-sm {
        display: inline-block
    }
}

.page-content {
    padding: calc(70px + 1.5rem) calc(1.5rem / 2) 60px calc(1.5rem / 2)
}

.header-item {
    height: 70px;
    -webkit-box-shadow: none!important;
    box-shadow: none!important;
    color: var(--bs-header-item-color);
    border: 0;
    border-radius: 0
}

.header-item:hover {
    color: var(--bs-header-item-color)
}

.header-profile-user {
    height: 36px;
    width: 36px;
    background-color: #eee
}

.noti-icon i {
    font-size: 28px;
    color: var(--bs-header-item-color)
}

.noti-icon .badge {
    position: absolute;
    top: 15px;
    right: 2px
}

.notify-item img {
    float: right;
    margin-top: 5px
}

.notification-item .d-flex {
    padding: .75rem 1rem
}

.notification-item .d-flex:hover {
    background-color: var(--bs-tertiary-bg)
}

.dropdown-icon-item {
    display: block;
    border-radius: 3px;
    line-height: 34px;
    text-align: center;
    padding: 15px 0 9px;
    display: block;
    border: 1px solid transparent;
    color: #848f98
}

.dropdown-icon-item img {
    height: 24px
}

.dropdown-icon-item span {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap
}

.dropdown-icon-item:hover {
    border-color: #f3f3f3
}

.fullscreen-enable [data-bs-toggle=fullscreen] .mdi-fullscreen::before {
    content: "\f0294"
}

body[data-topbar=dark] #page-topbar {
    background-color: var(--bs-header-dark-bg)
}

body[data-topbar=dark] .navbar-header .dropdown .show.header-item {
    background-color: rgba(255,255,255,.5)
}

body[data-topbar=dark] .navbar-header .waves-effect .waves-ripple {
    background: rgba(255,255,255,.4)
}

body[data-topbar=dark] .header-item {
    color: var(--bs-header-dark-item-color)
}

body[data-topbar=dark] .header-item:hover {
    color: var(--bs-header-dark-item-color)
}

body[data-topbar=dark] .header-profile-user {
    background-color: rgba(255,255,255,.25)
}

body[data-topbar=dark] .noti-icon i {
    color: var(--bs-header-dark-item-color)
}

body[data-topbar=dark] .page-title {
    color: var(--bs-header-dark-item-color)
}

body[data-topbar=dark] .logo-dark {
    display: none
}

body[data-topbar=dark] .logo-light {
    display: block
}

body[data-topbar=dark] .app-search .form-control {
    background-color: rgba(var(--bs-topbar-search-bg),.07);
    color: #fff
}

body[data-topbar=dark] .app-search input.form-control::-webkit-input-placeholder,body[data-topbar=dark] .app-search span {
    color: rgba(255,255,255,.5)
}

body[data-sidebar=dark] .navbar-brand-box {
    background: var(--bs-sidebar-dark-bg)
}

body[data-sidebar=dark] .logo-dark {
    display: none
}

body[data-sidebar=dark] .logo-light {
    display: block
}

body[data-sidebar=colored] .navbar-brand-box {
    background: #67a8e4
}

body[data-sidebar=colored] .logo-dark {
    display: none
}

body[data-sidebar=colored] .logo-light {
    display: block
}

@media (max-width: 600px) {
    .navbar-header .dropdown {
        position:static
    }

    .navbar-header .dropdown .dropdown-menu {
        left: 10px!important;
        right: 10px!important
    }
}

@media (max-width: 380px) {
    .navbar-brand-box {
        display:none
    }
}

body[data-layout=horizontal] .navbar-brand-box {
    width: auto
}

body[data-layout=horizontal] .page-content {
    margin-top: 70px;
    padding: calc(60px + 1.5rem) calc(1.5rem / 2) 60px calc(1.5rem / 2)
}

@media (max-width: 992px) {
    body[data-layout=horizontal] .page-content {
        margin-top:12px
    }
}

.page-title-box {
    padding-bottom: 1.5rem
}

.page-title-box .breadcrumb {
    background-color: transparent;
    padding: 0
}

/* .footer {
    bottom: 0;
    padding: 20px calc(1.5rem / 2);
    position: absolute;
    right: 0;
    color: var(--bs-footer-color);
    left: 240px;
    height: 60px;
    background-color: var(--bs-footer-bg)
} */

@media (max-width: 991.98px) {
    .footer {
        left:0
    }
}

.vertical-collpsed .footer {
    left: 70px
}

body[data-layout=horizontal] .footer {
    left: 0!important
}

.right-bar {
    background-color: var(--bs-secondary-bg);
    -webkit-box-shadow: 0 0 24px 0 rgba(0,0,0,.06),0 1px 0 0 rgba(0,0,0,.02);
    box-shadow: 0 0 24px 0 rgba(0,0,0,.06),0 1px 0 0 rgba(0,0,0,.02);
    display: block;
    position: fixed;
    -webkit-transition: all .2s ease-out;
    transition: all .2s ease-out;
    width: 280px;
    z-index: 9999;
    float: right!important;
    right: -290px;
    top: 0;
    bottom: 0
}

.right-bar .right-bar-toggle {
    background-color: #3d505b;
    height: 24px;
    width: 24px;
    line-height: 24px;
    color: #f3f3f3;
    text-align: center;
    border-radius: 50%
}

.right-bar .right-bar-toggle:hover {
    background-color: #435865
}



.light-style .dz-message:before{


  display:none !important;
}

.rightbar-overlay {
    background-color: rgba(47,61,70,.55);
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    display: none;
    z-index: 9998;
    -webkit-transition: all .2s ease-out;
    transition: all .2s ease-out
}

.right-bar-enabled .right-bar {
    right: 0
}

.right-bar-enabled .rightbar-overlay {
    display: block
}

@media (max-width: 767.98px) {
    .right-bar {
        overflow:auto
    }

    .right-bar .slimscroll-menu {
        height: auto!important
    }
}

.metismenu {
    margin: 0
}

.metismenu li {
    display: block;
    width: 100%
}

.metismenu .mm-collapse {
    display: none
}

.metismenu .mm-collapse:not(.mm-show) {
    display: none
}

.metismenu .mm-collapse.mm-show {
    display: block
}

.metismenu .mm-collapsing {
    position: relative;
    height: 0;
    overflow: hidden;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    -webkit-transition-duration: .35s;
    transition-duration: .35s;
    -webkit-transition-property: height,visibility;
    transition-property: height,visibility
}

.vertical-menu {
    width: 240px;
    z-index: 1001;
    background: var(--bs-sidebar-bg);
    bottom: 0;
    margin-top: 0;
    position: fixed;
    top: 70px;
    -webkit-box-shadow: 0 2px 3px -2px rgba(0,0,0,.15);
    box-shadow: 0 2px 3px -2px rgba(0,0,0,.15)
}

.main-content {
    margin-left: 240px;
    overflow: hidden
}

.main-content .content {
    padding: 0 15px 10px 15px;
    margin-top: 70px
}

#sidebar-menu {
    padding: 10px 0 30px 0
}

#sidebar-menu .mm-active>.has-arrow:after {
    content: "\f0140"
}

#sidebar-menu .has-arrow:after {
    content: "\f0142";
    font-family: "Material Design Icons";
    display: block;
    float: right;
    -webkit-transition: -webkit-transform .2s;
    transition: -webkit-transform .2s;
    transition: transform .2s;
    transition: transform .2s,-webkit-transform .2s;
    font-size: 1rem
}

#sidebar-menu ul li a {
    display: block;
    padding: .625rem 1.5rem;
    color: var(--bs-sidebar-menu-item-color);
    position: relative;
    font-size: 16px;
    -webkit-transition: all .4s;
    transition: all .4s
}

#sidebar-menu ul li a i {
    display: inline-block;
    min-width: 1.75rem;
    padding-bottom: .125em;
    font-size: 17px;
    line-height: 1.40625rem;
    vertical-align: middle;
    -webkit-transition: all .4s;
    transition: all .4s
}

#sidebar-menu ul li a:hover {
    color: var(--bs-sidebar-menu-item-hover-color)
}

#sidebar-menu ul li a:hover i {
    color: var(--bs-sidebar-menu-item-hover-color)
}

#sidebar-menu ul li .badge {
    margin-top: 4px
}

#sidebar-menu ul li ul.sub-menu {
    padding: 0
}

#sidebar-menu ul li ul.sub-menu li a {
    padding: .4rem 1.5rem .4rem 3.5rem;
    font-size: 15px;
    color: var(--bs-sidebar-menu-sub-item-color);
    background-color: transparent
}

#sidebar-menu ul li ul.sub-menu li ul.sub-menu {
    padding: 0
}

#sidebar-menu ul li ul.sub-menu li ul.sub-menu li a {
    padding: .4rem 1.5rem .4rem 4.5rem;
    font-size: 14.5px
}

.menu-title {
    padding: 12px 20px!important;
    letter-spacing: .05em;
    pointer-events: none;
    cursor: default;
    font-size: 13px;
    color: var(--bs-sidebar-menu-item-icon-color)
}

.mm-active {
    color: var(--bs-sidebar-menu-item-active-color)!important
}

.mm-active>a {
    color: var(--bs-sidebar-menu-item-active-color)!important;
    background-color: var(--bs-sidebar-menu-item-active-bg)
}

.mm-active>a i {
    color: var(--bs-sidebar-menu-item-active-color)!important
}

.mm-active .active {
    color: var(--bs-sidebar-menu-item-active-color)!important
}

.mm-active .active i {
    color: var(--bs-sidebar-menu-item-active-color)!important
}

.mm-active>i {
    color: var(--bs-sidebar-menu-item-active-color)!important
}

@media (max-width: 992px) {
    .vertical-menu {
        display:none
    }

    .main-content {
        margin-left: 0!important
    }

    body.sidebar-enable .vertical-menu {
        display: block
    }
}

.vertical-collpsed .main-content {
    margin-left: 70px
}

.vertical-collpsed .navbar-brand-box {
    width: 70px!important
}

.vertical-collpsed .logo span.logo-lg {
    display: none
}

.vertical-collpsed .logo span.logo-sm {
    display: block
}

.vertical-collpsed .vertical-menu {
    position: absolute;
    width: 70px!important;
    z-index: 5
}

.vertical-collpsed .vertical-menu .-content-wrapper,.vertical-collpsed .vertical-menu .-mask {
    overflow: visible!important
}

.vertical-collpsed .vertical-menu .-scrollbar {
    display: none!important
}

.vertical-collpsed .vertical-menu .-offset {
    bottom: 0!important
}

.vertical-collpsed .vertical-menu #sidebar-menu .badge,.vertical-collpsed .vertical-menu #sidebar-menu .collapse.in,.vertical-collpsed .vertical-menu #sidebar-menu .menu-title {
    display: none!important
}

.vertical-collpsed .vertical-menu #sidebar-menu .nav.collapse {
    height: inherit!important
}

.vertical-collpsed .vertical-menu #sidebar-menu .has-arrow:after {
    display: none
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li {
    position: relative;
    white-space: nowrap
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li>a {
    padding: 15px 20px;
    min-height: 55px;
    -webkit-transition: none;
    transition: none
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li>a:active,.vertical-collpsed .vertical-menu #sidebar-menu>ul>li>a:focus,.vertical-collpsed .vertical-menu #sidebar-menu>ul>li>a:hover {
    color: var(--bs-sidebar-menu-item-hover-color)
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li>a i {
    font-size: 20px;
    margin-left: 4px
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li>a span {
    display: none;
    padding-left: 25px
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>a {
    position: relative;
    width: calc(190px + 70px);
    color: #67a8e4;
    background-color: var(--bs-sidebar-bg);
    -webkit-transition: none;
    transition: none
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>a i {
    color: #67a8e4
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>a span {
    display: inline
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>ul {
    display: block;
    left: 70px;
    position: absolute;
    width: 190px;
    height: auto!important;
    -webkit-box-shadow: 3px 5px 10px 0 rgba(54,61,71,.1);
    box-shadow: 3px 5px 10px 0 rgba(54,61,71,.1)
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>ul ul {
    -webkit-box-shadow: 3px 5px 10px 0 rgba(54,61,71,.1);
    box-shadow: 3px 5px 10px 0 rgba(54,61,71,.1)
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>ul a {
    -webkit-box-shadow: none;
    box-shadow: none;
    padding: 8px 20px;
    position: relative;
    width: 190px;
    z-index: 6;
    color: var(--bs-sidebar-menu-sub-item-color)
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>ul a:hover {
    color: var(--bs-sidebar-menu-item-hover-color)
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul ul {
    padding: 5px 0;
    z-index: 9999;
    display: none;
    background-color: var(--bs-sidebar-bg)
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul ul li:hover>ul {
    display: block;
    left: 190px;
    height: auto!important;
    margin-top: -36px;
    position: absolute;
    width: 190px
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul ul li>a span.pull-right {
    position: absolute;
    right: 20px;
    top: 12px;
    -webkit-transform: rotate(270deg);
    transform: rotate(270deg)
}

.vertical-collpsed .vertical-menu #sidebar-menu>ul ul li.active a {
    color: #f7f7f7
}

body[data-sidebar=dark] .vertical-menu {
    background: var(--bs-sidebar-dark-bg)
}

body[data-sidebar=dark] #sidebar-menu ul li a {
    color: var(--bs-sidebar-dark-menu-item-color)
}

body[data-sidebar=dark] #sidebar-menu ul li a i {
    color: var(--bs-sidebar-dark-menu-item-icon-color)
}

body[data-sidebar=dark] #sidebar-menu ul li a:hover {
    color: var(--bs-sidebar-dark-menu-item-hover-color)
}

body[data-sidebar=dark] #sidebar-menu ul li a:hover i {
    color: var(--bs-idebar-dark-menu-item-hover-color)
}

body[data-sidebar=dark] #sidebar-menu ul li ul.sub-menu li a {
    color: var(--bs-sidebar-dark-menu-sub-item-color);
    background: 0 0
}

body[data-sidebar=dark] #sidebar-menu ul li ul.sub-menu li a:hover {
    color: var(--bs-idebar-dark-menu-item-hover-color)
}

body[data-sidebar=dark] #sidebar-menu ul>li>a.mm-active {
    background-color: var(--bs-sidebar-dark-menu-item-active-bg)
}

body[data-sidebar=dark].vertical-collpsed {
    min-height: 1200px
}

body[data-sidebar=dark].vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>a {
    background: var(--bs-sidebar-dark-menu-item-active-bg);
    color: var(--bs-sidebar-dark-menu-item-hover-color)
}

body[data-sidebar=dark].vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>a i {
    color: var(--bs-idebar-dark-menu-item-hover-color)
}

body[data-sidebar=dark].vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>ul a {
    color: var(--bs-sidebar-dark-menu-sub-item-color)
}

body[data-sidebar=dark].vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>ul a:hover {
    color: var(--bs-idebar-dark-menu-item-hover-color)
}

body[data-sidebar=dark].vertical-collpsed .vertical-menu #sidebar-menu>ul ul {
    background-color: var(--bs-sidebar-dark-bg)
}

body[data-sidebar=dark].vertical-collpsed .vertical-menu #sidebar-menu ul li.mm-active .active {
    color: var(--bs-sidebar-menu-item-active-color)
}

body[data-sidebar=dark].vertical-collpsed .vertical-menu #sidebar-menu ul li.mm-active .active i {
    color: var(--bs-sidebar-menu-item-active-color)
}

body[data-sidebar=dark] .mm-active {
    color: var(--bs-sidebar-dark-menu-item-active-color)!important
}

body[data-sidebar=dark] .mm-active>a {
    color: var(--bs-sidebar-dark-menu-item-active-color)!important;
    background-color: var(--bs-sidebar-dark-menu-item-active-bg)
}

body[data-sidebar=dark] .mm-active>a i {
    color: var(--bs-sidebar-dark-menu-item-active-color)!important
}

body[data-sidebar=dark] .mm-active>i {
    color: var(--bs-sidebar-dark-menu-item-active-color)!important
}

body[data-sidebar=dark] .mm-active .active {
    color: var(--bs-sidebar-dark-menu-item-active-color)!important;
    background-color: var(--bs-sidebar-dark-menu-item-active-bg)
}

body[data-sidebar=dark] .mm-active .active i {
    color: var(--bs-sidebar-dark-menu-item-active-color)!important
}

body[data-sidebar=dark] .menu-title {
    color: var(--bs-sidebar-dark-menu-item-icon-color)
}

body[data-layout=horizontal] .main-content {
    margin-left: 0!important
}

body[data-sidebar-size=small] .navbar-brand-box {
    width: 160px
}

body[data-sidebar-size=small] .vertical-menu {
    width: 160px;
    text-align: center
}

body[data-sidebar-size=small] .vertical-menu .badge,body[data-sidebar-size=small] .vertical-menu .has-arrow:after {
    display: none!important
}

body[data-sidebar-size=small] .main-content {
    margin-left: 160px
}

body[data-sidebar-size=small] .footer {
    left: 160px
}

body[data-sidebar-size=small] #sidebar-menu ul li.menu-title {
    background-color: var(--bs-sidebar-dark-bg)
}

body[data-sidebar-size=small] #sidebar-menu ul li a i {
    display: block
}

body[data-sidebar-size=small] #sidebar-menu ul li ul.sub-menu li a {
    padding-left: 1.5rem
}

body[data-sidebar-size=small] #sidebar-menu ul li ul.sub-menu li ul.sub-menu li a {
    padding-left: 1.5rem
}

body[data-sidebar-size=small].vertical-collpsed .main-content {
    margin-left: 70px
}

body[data-sidebar-size=small].vertical-collpsed .vertical-menu #sidebar-menu {
    text-align: left
}

body[data-sidebar-size=small].vertical-collpsed .vertical-menu #sidebar-menu>ul>li>a i {
    display: inline-block
}

body[data-sidebar-size=small].vertical-collpsed .footer {
    left: 70px
}

body[data-sidebar=colored] .vertical-menu {
    background-color: #67a8e4
}

body[data-sidebar=colored] .navbar-brand-box {
    background-color: #67a8e4
}

body[data-sidebar=colored] .navbar-brand-box .logo-dark {
    display: none
}

body[data-sidebar=colored] .navbar-brand-box .logo-light {
    display: block
}

body[data-sidebar=colored] .mm-active {
    color: #fff!important
}

body[data-sidebar=colored] .mm-active>a {
    color: #fff!important;
    background-color: #70ade6
}

body[data-sidebar=colored] .mm-active>a i {
    color: #fff!important
}

body[data-sidebar=colored] .mm-active .active,body[data-sidebar=colored] .mm-active>i {
    color: #fff!important
}

body[data-sidebar=colored] #sidebar-menu ul li.menu-title {
    color: rgba(255,255,255,.6)
}

body[data-sidebar=colored] #sidebar-menu ul li a {
    color: rgba(255,255,255,.7)
}

body[data-sidebar=colored] #sidebar-menu ul li a i {
    color: rgba(255,255,255,.7)
}

body[data-sidebar=colored] #sidebar-menu ul li a.waves-effect .waves-ripple {
    background: rgba(255,255,255,.1)
}

body[data-sidebar=colored] #sidebar-menu ul li a:hover {
    color: #fff
}

body[data-sidebar=colored] #sidebar-menu ul li a:hover i {
    color: #fff
}

body[data-sidebar=colored] #sidebar-menu ul li ul.sub-menu li a {
    color: rgba(255,255,255,.6)
}

body[data-sidebar=colored] #sidebar-menu ul li ul.sub-menu li a:hover {
    color: #fff
}

body[data-sidebar=colored].vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>a {
    background-color: #70ade6;
    color: #fff
}

body[data-sidebar=colored].vertical-collpsed .vertical-menu #sidebar-menu>ul>li:hover>a i {
    color: #fff
}

body[data-sidebar=colored].vertical-collpsed .vertical-menu #sidebar-menu ul li.mm-active .active {
    color: var(--bs-sidebar-menu-item-active-color)!important
}

body[data-sidebar=colored].vertical-collpsed .vertical-menu #sidebar-menu ul li ul.sub-menu li a:hover {
    color: var(--bs-sidebar-menu-item-active-color)
}

body[data-sidebar=colored].vertical-collpsed .vertical-menu #sidebar-menu ul li ul.sub-menu li.mm-active {
    color: var(--bs-sidebar-menu-item-active-color)!important
}

body[data-sidebar=colored].vertical-collpsed .vertical-menu #sidebar-menu ul li ul.sub-menu li.mm-active>a {
    color: var(--bs-sidebar-menu-item-active-color)!important
}

body[data-sidebar=colored].vertical-collpsed .vertical-menu #sidebar-menu ul li ul.sub-menu li.mm-active>a i {
    color: var(--bs-sidebar-menu-item-active-color)!important
}

[dir=rtl] #sidebar-menu .has-arrow:after {
    content: "\f0141"
}

[dir=rtl] #sidebar-menu .mm-active>.has-arrow:after {
    content: "\f0140"
}

.topnav {
    background: var(--bs-topnav-bg);
    padding: 0 calc(1.5rem / 2);
    -webkit-box-shadow: 0 2px 3px -2px rgba(0,0,0,.15);
    box-shadow: 0 2px 3px -2px rgba(0,0,0,.15);
    margin-top: 70px;
    position: fixed;
    left: 0;
    right: 0;
    z-index: 100
}

.topnav .topnav-menu {
    margin: 0;
    padding: 0
}

.topnav .navbar-nav .nav-link {
    font-size: 16px;
    position: relative;
    padding: 1rem 1.3rem;
    color: var(--bs-menu-item-color)
}

.topnav .navbar-nav .nav-link i {
    font-size: 18px;
    vertical-align: top
}

.topnav .navbar-nav .nav-link:focus,.topnav .navbar-nav .nav-link:hover {
    color: var(--bs-menu-item-active-color);
    background-color: transparent
}

.topnav .navbar-nav .dropdown-item {
    color: var(--bs-menu-item-color)
}

.topnav .navbar-nav .dropdown-item.active,.topnav .navbar-nav .dropdown-item:hover {
    color: var(--bs-menu-item-active-color);
    background-color: transparent
}

.topnav .navbar-nav .nav-item .nav-link.active {
    color: var(--bs-menu-item-active-color)
}

.topnav .navbar-nav .dropdown.active>a {
    color: var(--bs-menu-item-active-color);
    background-color: transparent
}

body[data-layout=horizontal] .navbar-brand-box .logo.logo-dark {
    display: block
}

body[data-layout=horizontal] .navbar-brand-box .logo.logo-light {
    display: none
}

body[data-layout=horizontal][data-topbar=dark] .navbar-brand-box .logo.logo-dark {
    display: none
}

body[data-layout=horizontal][data-topbar=dark] .navbar-brand-box .logo.logo-light {
    display: block
}

body[data-layout=horizontal][data-topbar=dark] .navbar-header .dropdown .show.header-item {
    background-color: rgba(255,255,255,.1)
}

@media (min-width: 1200px) {
    body[data-layout=horizontal] .container-fluid,body[data-layout=horizontal] .navbar-header {
        max-width:95%
    }
}

@media (min-width: 992px) {
    .topnav .dropdown-item {
        padding:.5rem 1.5rem;
        min-width: 180px;
        font-size: 16px
    }

    .topnav .dropdown.mega-dropdown .mega-dropdown-menu {
        left: 0;
        right: auto
    }

    .topnav .dropdown .dropdown-menu {
        margin-top: 0;
        border-radius: 0 0 var(--bs-border-radius) var(--bs-border-radius)
    }

    .topnav .dropdown .dropdown-menu .arrow-down::after {
        right: 15px;
        -webkit-transform: rotate(-135deg) translateY(-50%);
        transform: rotate(-135deg) translateY(-50%);
        position: absolute
    }

    .topnav .dropdown .dropdown-menu .dropdown .dropdown-menu {
        position: absolute;
        top: 0!important;
        left: 100%;
        display: none
    }

    .topnav .dropdown:hover>.dropdown-menu {
        display: block
    }

    .topnav .dropdown:hover>.dropdown-menu>.dropdown:hover>.dropdown-menu {
        display: block
    }

    .navbar-toggle {
        display: none
    }
}

.arrow-down {
    display: inline-block
}


.dropdown-toggle::after{

display:none;

}

.arrow-down:after {
    border-color: initial;
    border-style: solid;
    border-width: 0 0 1px 1px;
    content: "";
    height: .4em;
    display: inline-block;
    right: 5px;
    top: 50%;
    margin-left: 10px;
    -webkit-transform: rotate(-45deg) translateY(-50%);
    transform: rotate(-45deg) translateY(-50%);
    -webkit-transform-origin: top;
    transform-origin: top;
    -webkit-transition: all .3s ease-out;
    transition: all .3s ease-out;
    width: .4em
}

@media (max-width: 1199.98px) {
    .topnav-menu .navbar-nav li:last-of-type .dropdown .dropdown-menu {
        right:100%;
        left: auto
    }
}

@media (max-width: 991.98px) {
    .topnav {
        background-color:var(--bs-secondary-bg);
        max-height: 360px;
        overflow-y: auto;
        padding: 0
    }

    .topnav .navbar-nav .nav-link {
        padding: .75rem 1.1rem
    }


    .light-style .dz-message:before {
    background-image: ;
    background: rgba(75, 70, 92, 0.08);
    visibility:hidden !important;
}

    .topnav .dropdown .dropdown-menu {
        background-color: transparent;
        border: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding-left: 15px
    }

    .topnav .dropdown .dropdown-menu.dropdown-mega-menu-xl {
        width: auto
    }

    .topnav .dropdown .dropdown-menu.dropdown-mega-menu-xl .row {
        margin: 0
    }

    .topnav .dropdown .dropdown-item {
        position: relative;
        background-color: transparent
    }

    .topnav .dropdown .dropdown-item.active,.topnav .dropdown .dropdown-item:active {
        color: #67a8e4
    }

    .topnav .arrow-down::after {
        right: 15px;
        position: absolute
    }
}

@media (min-width: 992px) {
    body[data-layout=horizontal] .topnav .navbar-nav .nav-link {
        color:rgba(255,255,255,.5)
    }

    body[data-layout=horizontal] .topnav .navbar-nav .nav-link:focus,body[data-layout=horizontal] .topnav .navbar-nav .nav-link:hover {
        color: rgba(255,255,255,.9)
    }

    body[data-layout=horizontal] .topnav .navbar-nav>.dropdown.active>a {
        color: rgba(255,255,255,.9)!important;
        background-color: rgba(255,255,255,.1)!important
    }
}

body[data-layout=horizontal][data-topbar=colored] #page-topbar {
    background-color: #67a8e4;
    -webkit-box-shadow: none;
    box-shadow: none
}

body[data-layout=horizontal][data-topbar=colored] .logo-dark {
    display: none
}

body[data-layout=horizontal][data-topbar=colored] .logo-light {
    display: block
}

body[data-layout=horizontal][data-topbar=colored] .app-search .form-control {
    background-color: rgba(var(--bs-topbar-search-bg),.07);
    color: #fff
}

body[data-layout=horizontal][data-topbar=colored] .app-search input.form-control::-webkit-input-placeholder,body[data-layout=horizontal][data-topbar=colored] .app-search span {
    color: rgba(255,255,255,.5)
}

body[data-layout=horizontal][data-topbar=colored] .header-item {
    color: var(--bs-header-dark-item-color)
}

body[data-layout=horizontal][data-topbar=colored] .header-item:hover {
    color: var(--bs-header-dark-item-color)
}

body[data-layout=horizontal][data-topbar=colored] .navbar-header .dropdown.show .header-item {
    background-color: rgba(255,255,255,.5)
}

body[data-layout=horizontal][data-topbar=colored] .navbar-header .waves-effect .waves-ripple {
    background: rgba(255,255,255,.4)
}

body[data-layout=horizontal][data-topbar=colored] .noti-icon i {
    color: var(--bs-header-dark-item-color)
}

@media (min-width: 992px) {
    body[data-layout=horizontal][data-topbar=colored] .topnav {
        background-color:#67a8e4
    }

    body[data-layout=horizontal][data-topbar=colored] .topnav .navbar-nav .nav-link {
        color: rgba(255,255,255,.5)
    }

    body[data-layout=horizontal][data-topbar=colored] .topnav .navbar-nav .nav-link:focus,body[data-layout=horizontal][data-topbar=colored] .topnav .navbar-nav .nav-link:hover {
        color: rgba(255,255,255,.9)
    }

    body[data-layout=horizontal][data-topbar=colored] .topnav .navbar-nav>.dropdown.active>a {
        color: rgba(255,255,255,.9)!important
    }
}

body[data-layout-size=boxed] {
    background-color: var(--bs-boxed-body-bg)
}

body[data-layout-size=boxed] #layout-wrapper {
    background-color: var(--bs-body-bg);
    max-width: 1300px;
    margin: 0 auto;
    -webkit-box-shadow: 0 2px 3px -2px rgba(0,0,0,.15);
    box-shadow: 0 2px 3px -2px rgba(0,0,0,.15)
}

body[data-layout-size=boxed] #page-topbar {
    max-width: 1300px;
    margin: 0 auto
}

body[data-layout-size=boxed] .footer {
    margin: 0 auto;
    max-width: calc(1300px - 240px)
}

body[data-layout-size=boxed].vertical-collpsed .footer {
    max-width: calc(1300px - 70px)
}

body[data-layout=horizontal][data-layout-size=boxed] #layout-wrapper,body[data-layout=horizontal][data-layout-size=boxed] #page-topbar,body[data-layout=horizontal][data-layout-size=boxed] .footer {
    max-width: 100%
}

body[data-layout=horizontal][data-layout-size=boxed] .container-fluid,body[data-layout=horizontal][data-layout-size=boxed] .navbar-header {
    max-width: 1300px
}

/*!
 * Waves v0.7.6
 * http://fian.my.id/Waves 
 * 
 * Copyright 2014-2018 Alfiana E. Sibuea and other contributors 
 * Released under the MIT license 
 * https://github.com/fians/Waves/blob/master/LICENSE */
.waves-effect {
    position: relative;
    cursor: pointer;
    display: inline-block;
    overflow: hidden;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent
}

.waves-effect .waves-ripple {
    position: absolute;
    border-radius: 50%;
    width: 100px;
    height: 100px;
    margin-top: -50px;
    margin-left: -50px;
    opacity: 0;
    background: rgba(0,0,0,.2);
    background: radial-gradient(rgba(0,0,0,.2) 0,rgba(0,0,0,.3) 40%,rgba(0,0,0,.4) 50%,rgba(0,0,0,.5) 60%,rgba(255,255,255,0) 70%);
    -webkit-transition: all .5s ease-out;
    transition: all .5s ease-out;
    -webkit-transition-property: -webkit-transform,opacity;
    -webkit-transition-property: opacity,-webkit-transform;
    transition-property: opacity,-webkit-transform;
    transition-property: transform,opacity;
    transition-property: transform,opacity,-webkit-transform;
    -webkit-transform: scale(0) translate(0,0);
    transform: scale(0) translate(0,0);
    pointer-events: none
}

.waves-effect.waves-light .waves-ripple {
    background: rgba(255,255,255,.4);
    background: radial-gradient(rgba(255,255,255,.2) 0,rgba(255,255,255,.3) 40%,rgba(255,255,255,.4) 50%,rgba(255,255,255,.5) 60%,rgba(255,255,255,0) 70%)
}

.waves-effect.waves-classic .waves-ripple {
    background: rgba(0,0,0,.2)
}

.waves-effect.waves-classic.waves-light .waves-ripple {
    background: rgba(255,255,255,.4)
}

.waves-notransition {
    -webkit-transition: none!important;
    transition: none!important
}

.waves-button,.waves-circle {
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-mask-image: -webkit-radial-gradient(circle,#fff 100%,#000 100%)
}

.waves-button,.waves-button-input,.waves-button:hover,.waves-button:visited {
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    border: none;
    outline: 0;
    color: inherit;
    background-color: rgba(0,0,0,0);
    font-size: 1em;
    line-height: 1em;
    text-align: center;
    text-decoration: none;
    z-index: 1
}

.waves-button {
    padding: .85em 1.1em;
    border-radius: .2em
}

.waves-button-input {
    margin: 0;
    padding: .85em 1.1em
}

.waves-input-wrapper {
    border-radius: .2em;
    vertical-align: bottom
}

.waves-input-wrapper.waves-button {
    padding: 0
}

.waves-input-wrapper .waves-button-input {
    position: relative;
    top: 0;
    left: 0;
    z-index: 1
}

.waves-circle {
    text-align: center;
    width: 2.5em;
    height: 2.5em;
    line-height: 2.5em;
    border-radius: 50%
}

.waves-float {
    -webkit-mask-image: none;
    -webkit-box-shadow: 0 1px 1.5px 1px rgba(0,0,0,.12);
    box-shadow: 0 1px 1.5px 1px rgba(0,0,0,.12);
    -webkit-transition: all .3s;
    transition: all .3s
}

.waves-float:active {
    -webkit-box-shadow: 0 8px 20px 1px rgba(0,0,0,.3);
    box-shadow: 0 8px 20px 1px rgba(0,0,0,.3)
}

.waves-block {
    display: block
}

.waves-effect.waves-light .waves-ripple {
    background-color: rgba(255,255,255,.4)
}

.waves-effect.waves-primary .waves-ripple {
    background-color: rgba(103,168,228,.4)
}

.waves-effect.waves-success .waves-ripple {
    background-color: rgba(74,193,142,.4)
}

.waves-effect.waves-info .waves-ripple {
    background-color: rgba(59,195,233,.4)
}

.waves-effect.waves-warning .waves-ripple {
    background-color: rgba(255,187,68,.4)
}

.waves-effect.waves-danger .waves-ripple {
    background-color: rgba(234,85,61,.4)
}

.avatar-xs {
    height: 2rem;
    width: 2rem
}

.avatar-sm {
    height: 3rem;
    width: 3rem
}

.avatar-md {
    height: 4.5rem;
    width: 4.5rem
}

.avatar-lg {
    height: 6rem;
    width: 6rem
}

.avatar-xl {
    height: 7.5rem;
    width: 7.5rem
}

.avatar-title {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background-color: #67a8e4;
    color: #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    font-weight: 500;
    height: 100%;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 100%
}

.font-size-11 {
    font-size: 11px!important
}

.font-size-12 {
    font-size: 12px!important
}

.font-size-13 {
    font-size: 13px!important
}

.font-size-14 {
    font-size: 14px!important
}

.font-size-15 {
    font-size: 15px!important
}

.font-size-16 {
    font-size: 16px!important
}

.font-size-17 {
    font-size: 17px!important
}

.font-size-18 {
    font-size: 18px!important
}

.font-size-20 {
    font-size: 20px!important
}

.font-size-22 {
    font-size: 22px!important
}

.font-size-24 {
    font-size: 24px!important
}

.font-size-32 {
    font-size: 32px!important
}

.font-size-40 {
    font-size: 40px!important
}

.fw-medium {
    font-weight: 500
}

.fw-semibold {
    font-weight: 600
}

.social-links li a {
    background: var(--bs-border-color);
    border-radius: 50%;
    font-size: 14px;
    color: #adb5bd;
    display: inline-block;
    height: 30px;
    line-height: 30px;
    text-align: center;
    width: 30px
}

.w-xs {
    min-width: 80px
}

.w-sm {
    min-width: 95px
}

.w-md {
    min-width: 110px
}

.w-lg {
    min-width: 140px
}

.w-xl {
    min-width: 160px
}

.alert-dismissible .btn-close {
    font-size: 10px;
    padding: 1.125rem 1.25rem;
    -webkit-box-shadow: none;
    box-shadow: none;
    background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat
}

.flex-1 {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1
}

.border-dark {
    border-color: var(--bs-dark)!important
}

.border-light {
    border-color: var(--bs-light)!important
}

.text-dark {
    color: var(--bs-emphasis-color)!important
}

.bg-dark {
    background-color: #1f2c33!important
}

ol {
    list-style: none
}

#preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #f5f5f5;
    z-index: 9999999
}

#status {
    width: 40px;
    height: 40px;
    position: absolute;
    left: 50%;
    top: 50%;
    margin: -20px 0 0 -20px
}

.spinner {
    position: absolute;
    width: 78px;
    height: 78px;
    left: 50%;
    margin-left: -39px;
    margin-top: -39px
}

.spinner:before {
    content: "";
    position: absolute;
    width: 45px;
    height: 45px;
    top: 50%;
    margin-top: -23px;
    left: 50%;
    margin-left: -23px;
    border-width: 2px 1px;
    border-style: solid;
    border-color: #3bc3e9 rgba(59,195,233,.3);
    border-radius: 50%;
    -o-border-radius: 50%;
    -ms-border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    box-sizing: border-box;
    -o-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    animation: spin 3.45s infinite;
    -o-animation: spin 3.45s infinite;
    -ms-animation: spin 3.45s infinite;
    -webkit-animation: spin 3.45s infinite;
    -moz-animation: spin 3.45s infinite
}

.spinner:after {
    content: "";
    position: absolute;
    width: 12px;
    height: 12px;
    top: 50%;
    margin-top: -6px;
    left: 50%;
    margin-left: -6px;
    background-color: #3bc3e9;
    border-radius: 50%;
    -o-border-radius: 50%;
    -ms-border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    box-sizing: border-box;
    -o-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    animation: pulse 6.9s infinite,borderPulse 6.9s infinite;
    -o-animation: pulse 6.9s infinite,borderPulse 6.9s infinite;
    -ms-animation: pulse 6.9s infinite,borderPulse 6.9s infinite;
    -webkit-animation: pulse 6.9s infinite,borderPulse 6.9s infinite;
    -moz-animation: pulse 6.9s infinite,borderPulse 6.9s infinite
}

@keyframes spin {
    0% {
        -webkit-transform: rotate(0);
        transform: rotate(0)
    }

    50% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg)
    }

    100% {
        -webkit-transform: rotate(1080deg);
        transform: rotate(1080deg)
    }
}

@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0)
    }

    50% {
        -webkit-transform: rotate(360deg)
    }

    100% {
        -webkit-transform: rotate(1080deg)
    }
}

@keyframes pulse {
    0% {
        background-color: rgba(59,195,233,.2)
    }

    13% {
        background-color: rgba(59,195,233,.2)
    }

    15% {
        background-color: rgba(59,195,233,.9)
    }

    28% {
        background-color: rgba(59,195,233,.9)
    }

    30% {
        background-color: rgba(59,195,233,.2)
    }

    43% {
        background-color: rgba(59,195,233,.2)
    }

    45% {
        background-color: rgba(59,195,233,.9)
    }

    70% {
        background-color: rgba(59,195,233,.9)
    }

    74% {
        background-color: rgba(59,195,233,.2)
    }

    100% {
        background-color: rgba(59,195,233,.9)
    }
}

@-webkit-keyframes pulse {
    0% {
        background-color: rgba(59,195,233,.2)
    }

    13% {
        background-color: rgba(59,195,233,.2)
    }

    15% {
        background-color: rgba(59,195,233,.9)
    }

    28% {
        background-color: rgba(59,195,233,.9)
    }

    30% {
        background-color: rgba(59,195,233,.2)
    }

    43% {
        background-color: rgba(59,195,233,.2)
    }

    45% {
        background-color: rgba(59,195,233,.9)
    }

    70% {
        background-color: rgba(59,195,233,.9)
    }

    74% {
        background-color: rgba(59,195,233,.2)
    }

    100% {
        background-color: rgba(59,195,233,.9)
    }
}

@keyframes borderPulse {
    0% {
        -webkit-box-shadow: 0 0 0 0 #fff,0 0 0 1px rgba(59,195,233,.8);
        box-shadow: 0 0 0 0 #fff,0 0 0 1px rgba(59,195,233,.8)
    }

    40% {
        -webkit-box-shadow: 0 0 0 1px #fff,0 0 0 2px rgba(59,195,233,.8);
        box-shadow: 0 0 0 1px #fff,0 0 0 2px rgba(59,195,233,.8)
    }

    80% {
        -webkit-box-shadow: 0 0 0 3px #fff,0 0 1px 3px rgba(59,195,233,.8);
        box-shadow: 0 0 0 3px #fff,0 0 1px 3px rgba(59,195,233,.8)
    }
}

@-webkit-keyframes borderPulse {
    0% {
        -webkit-box-shadow: 0 0 0 0 #fff,0 0 0 1px rgba(59,195,233,.8);
        box-shadow: 0 0 0 0 #fff,0 0 0 1px rgba(59,195,233,.8)
    }

    40% {
        -webkit-box-shadow: 0 0 0 1px #fff,0 0 0 2px rgba(59,195,233,.8);
        box-shadow: 0 0 0 1px #fff,0 0 0 2px rgba(59,195,233,.8)
    }

    80% {
        -webkit-box-shadow: 0 0 0 3px #fff,0 0 1px 3px rgba(59,195,233,.8);
        box-shadow: 0 0 0 3px #fff,0 0 1px 3px rgba(59,195,233,.8)
    }
}

@-webkit-keyframes load8 {
    0% {
        -webkit-transform: rotate(0);
        transform: rotate(0)
    }

    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg)
    }
}

@keyframes load8 {
    0% {
        -webkit-transform: rotate(0);
        transform: rotate(0)
    }

    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg)
    }
}

.mini-stat-icon {
    width: 60px;
    height: 60px;
    display: inline-block;
    line-height: 60px;
    text-align: center;
    font-size: 30px;
    border-radius: 50%;
    color: #fff
}

.mini-stat-info {
    font-size: 14px;
    padding-top: 2px
}

.mini-stat-info span {
    display: block;
    font-size: 22px;
    font-weight: 400;
    font-family: Roboto,sans-serif
}

.mini-stats-wid .mini-stat-icon {
    overflow: hidden;
    position: relative
}

.mini-stats-wid .mini-stat-icon:after,.mini-stats-wid .mini-stat-icon:before {
    content: "";
    position: absolute;
    width: 8px;
    height: 54px;
    background-color: rgba(255,255,255,.1);
    left: 16px;
    -webkit-transform: rotate(32deg);
    transform: rotate(32deg);
    top: -5px;
    -webkit-transition: all .4s;
    transition: all .4s
}

.mini-stats-wid .mini-stat-icon::after {
    left: -12px;
    width: 12px;
    -webkit-transition: all .2s;
    transition: all .2s
}

.mini-stats-wid:hover .mini-stat-icon::after {
    left: 60px
}

@media (min-width: 768px) {
    .monthly-earning-wid {
        padding-right:0
    }

    .earning-wid {
        padding-left: 0
    }
}

.inbox-widget .inbox-item {
    border-bottom: 1px solid var(--bs-border-color);
    overflow: hidden;
    padding: 10px 0;
    position: relative
}

.inbox-widget .inbox-item .inbox-item-img {
    display: block;
    float: left;
    margin-right: 15px;
    width: 40px
}

.inbox-widget .inbox-item img {
    width: 40px
}

.inbox-widget .inbox-item .inbox-item-author {
    color: var(--bs-body-color);
    display: block;
    margin: 0
}

.inbox-widget .inbox-item .inbox-item-text {
    color: #a0a0a0;
    display: block;
    font-size: 12px;
    margin: 0
}

.inbox-widget .inbox-item .inbox-item-date {
    color: #a9a9a9;
    font-size: 11px;
    position: absolute;
    right: 7px;
    top: 10px
}

.activity-feed {
    padding: 15px 15px 0 15px;
    list-style: none
}

.activity-feed .feed-item {
    position: relative;
    padding-bottom: 20px;
    padding-left: 30px;
    border-left: 2px solid var(--bs-border-color)
}

.activity-feed .feed-item:last-child {
    border-color: transparent
}

.activity-feed .feed-item::after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    left: -6px;
    width: 10px;
    height: 10px;
    border-radius: 6px;
    background: #eee;
    border: 1px solid #67a8e4
}

.activity-feed .feed-item .date {
    display: block;
    position: relative;
    top: -5px;
    color: #8c96a3;
    text-transform: uppercase;
    font-size: 13px
}

.activity-feed .feed-item .activity-text {
    position: relative;
    top: -3px
}

:root,[data-bs-theme=light] {
    --bs-header-bg: #ffffff;
    --bs-header-item-color: #636e75;
    --bs-header-height: 70px;
    --bs-navbar-brand-box-width: 250px;
    --bs-header-dark-bg: #67a8e4;
    --bs-header-dark-item-color: #ffffff;
    --bs-display-block: block;
    --bs-display-none: none;
    --bs-footer-height: 60px;
    --bs-sidebar-collapsed-width: 70px;
    --bs-rightbar-width: 280px;
    --bs-sidebar-width-sm: 160px;
    --bs-footer-bg: #fff;
    --bs-topbar-search-bg: #f1f5f7;
    --bs-sidebar-width: 240px;
    --bs-sidebar-bg: #ffffff;
    --bs-sidebar-menu-item-color: #707070;
    --bs-sidebar-menu-sub-item-color: #707070;
    --bs-sidebar-menu-item-icon-color: #707070;
    --bs-sidebar-menu-item-hover-color: #383c40;
    --bs-sidebar-menu-item-active-color: #67a8e4;
    --bs-sidebar-menu-item-active-bg: #f5f5f5;
    --bs-topbar-search-border: #eff0f2;
    --bs-topbar-search-bg: #f1f5f7;
    --bs-topnav-bg: #263238;
    --bs-menu-item-color: #74788d;
    --bs-menu-item-active-color: #67a8e4;
    --bs-boxed-body-bg: #eaedf2;
    --bs-footer-bg: #fff;
    --bs-footer-color: #74788d;
    --bs-font-family-secondary: "Work Sans",sans-serif
}

:root [data-sidebar=dark],[data-bs-theme=light] [data-sidebar=dark] {
    --bs-sidebar-dark-bg: #263238;
    --bs-sidebar-dark-menu-item-color: rgba(255,255,255,0.5);
    --bs-sidebar-dark-menu-sub-item-color: rgba(255,255,255,0.5);
    --bs-sidebar-dark-menu-item-icon-color: rgba(255,255,255,0.5);
    --bs-sidebar-dark-menu-item-hover-color: #ffffff;
    --bs-sidebar-dark-menu-item-active-color: #ffffff;
    --bs-sidebar-dark-menu-item-active-bg: #33424c
}

:root [data-topbar=dark],[data-bs-theme=light] [data-topbar=dark] {
    --bs-header-bg: $gray-800;
    --bs-header-item-color: #919bae;
    --bs-header-item-sub-color: #8795ab
}

[data-bs-theme=dark] {
    --bs-light-rgb: 47,67,81;
    --bs-dark: #f3f3f3;
    --bs-header-bg: #2a363e;
    --bs-header-dark-bg: #35454f;
    --bs-header-item-color: #ffffff;
    --bs-topbar-search-bg: #2b3244;
    --bs-topnav-dark-bg: #292731;
    --bs-menu-dark-item-color: #afacbb;
    --bs-menu-dark-item-active-color: #eeeff1;
    --bs-sidebar-bg: #ffffff;
    --bs-sidebar-menu-item-color: #707070;
    --bs-sidebar-menu-sub-item-color: #707070;
    --bs-sidebar-menu-item-icon-color: #707070;
    --bs-sidebar-menu-item-hover-color: #383c40;
    --bs-sidebar-menu-item-active-color: #67a8e4;
    --bs-sidebar-menu-item-active-bg: #f5f5f5;
    --bs-sidebar-dark-bg: #2f3d46;
    --bs-sidebar-dark-menu-item-color: rgba(255,255,255,0.5);
    --bs-sidebar-dark-menu-sub-item-color: rgba(255,255,255,0.5);
    --bs-sidebar-dark-menu-item-icon-color: rgba(255,255,255,0.5);
    --bs-sidebar-dark-menu-item-hover-color: #ffffff;
    --bs-sidebar-dark-menu-item-active-color: #ffffff;
    --bs-sidebar-dark-menu-item-active-bg: #33424c;
    --bs-footer-bg: #2a363e;
    --bs-footer-color: #adb5bd;
    --bs-topnav-bg: #2f3d46;
    --bs-topnav-item-color: #afacbb;
    --bs-topnav-item-color-active: #fff;
    --bs-menu-item-color: #919bae;
    --bs-menu-item-active-color: #67a8e4;
    --bs-input-bg: #33414a;
    --bs-accordion-button-active-bg: #3b403d;
    --bs-boxed-body-bg: #1a2429;
    --bs-header-dark-item-color: #ffffff;
    --bs-header-height: 70px;
    --bs-navbar-brand-box-width: 250px;
    --bs-display-block: block;
    --bs-display-none: none;
    --bs-footer-height: 60px;
    --bs-sidebar-collapsed-width: 70px;
    --bs-rightbar-width: 280px;
    --bs-sidebar-width-sm: 160px
}

[data-bs-theme=dark] .table-light {
    --bs-table-color: var(--bs-body-color);
    --bs-table-bg: var(--bs-secondary-bg);
    --bs-table-border-color: var(--bs-border-color)
}

[data-bs-theme=dark] .table-dark {
    --bs-table-bg: var(--bs-tertiary-bg);
    --bs-table-border-color: var(--bs-border-color);
    --bs-table-striped-bg: #313d5166;
    --bs-table-striped-color: #dadada;
    --bs-table-active-bg: var(--bs-tertiary-bg);
    --bs-table-hover-bg: var(--bs-tertiary-bg)
}

[data-bs-theme=dark][data-sidebar=dark] {
    --bs-sidebar-dark-bg: #2f3d46;
    --bs-sidebar-dark-menu-item-color: rgb(255 255 255 / 50%);
    --bs-sidebar-dark-menu-sub-item-color: rgb(255 255 255 / 50%);
    --bs-sidebar-dark-menu-item-icon-color: rgb(255 255 255 / 50%);
    --bs-sidebar-dark-menu-item-hover-color: #fff;
    --bs-sidebar-dark-menu-item-active-color: #fff
}

.button-items {
    margin-left: -8px;
    margin-bottom: -12px
}

.button-items .btn {
    margin-bottom: 12px;
    margin-left: 8px
}

.mfp-popup-form {
    max-width: 1140px
}

.bs-example-modal {
    position: relative;
    top: auto;
    right: auto;
    bottom: auto;
    left: auto;
    z-index: 1;
    display: block
}

.icon-demo-content {
    color: var(--bs-secondary-color)
}

.icon-demo-content i {
    font-size: 22px;
    margin-right: 5px;
    vertical-align: middle;
    width: 30px;
    display: inline-block
}

.icon-demo-content .col-sm-6 {
    margin-bottom: 30px;
    cursor: pointer
}

.icon-demo-content .col-sm-6:hover i {
    color: #67a8e4
}

.grid-structure .grid-container {
    background-color: #f7f7f7;
    margin-top: 10px;
    font-size: .8rem;
    font-weight: 500;
    padding: 10px 20px
}

[dir=rtl] .modal-open {
    padding-left: 0!important
}

@media print {
    .footer,.navbar-header,.page-title-box,.right-bar,.vertical-menu {
        display: none!important
    }

    .card-body,.main-content,.page-content,.right-bar,body {
        padding: 0;
        margin: 0
    }

    .card {
        border: 0
    }
}

.fc td,.fc th {
    border: var(--bs-border-width) solid var(--bs-border-color)
}

.fc .fc-toolbar h2 {
    font-size: 16px;
    line-height: 30px;
    text-transform: uppercase
}

@media (max-width: 767.98px) {
    .fc .fc-toolbar .fc-center,.fc .fc-toolbar .fc-left,.fc .fc-toolbar .fc-right {
        float:none;
        display: block;
        text-align: center;
        clear: both;
        margin: 10px 0
    }

    .fc .fc-toolbar>*>* {
        float: none
    }

    .fc .fc-toolbar .fc-today-button {
        display: none
    }
}

.fc .fc-toolbar .btn {
    text-transform: capitalize
}

.fc .fc-today-button {
    background-color: #2f8ee0!important
}

.fc .fc-col-header-cell {
    background-color: var(--bs-tertiary-bg)
}

.fc .fc-col-header-cell-cushion {
    display: block;
    padding: 8px 4px;
    color: var(--bs-secondary-color)!important
}

.fc .fc-scrollgrid {
    border: 1px solid var(--bs-border-color)!important
}

.fc .fc-daygrid-day-number {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    padding: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 500;
    margin: 2px;
    color: var(--bs-emphasis-color)
}

.fc .fc-button-primary:disabled {
    border-color: var(--bs-border-color)
}

.fc .fc-daygrid-day.fc-day-today {
    background-color: rgba(103,168,228,.1)
}

.fc .fc-daygrid-day.fc-day-today .fc-daygrid-day-number {
    background-color: #67a8e4;
    color: #fff
}

.fc .fc-button-group button {
    background-color: #67a8e4;
    border-color: #2f8ee0
}

.fc .fc-button-group button:hover {
    background-color: #2f8ee0;
    border-color: #2f8ee0
}

.fc .fc-button-group button:active {
    background-color: #2f8ee0!important;
    border-color: #2f8ee0!important
}

.fc .fc-button-primary:not(:disabled).fc-button-active {
    background-color: #2f8ee0!important;
    border-color: #2f8ee0!important
}

.fc .fc-list-event:hover td {
    background: 0 0
}

.fc .fc-list-event-dot {
    border-color: #fff
}

.fc .fc-list-event-title a {
    color: #fff!important
}

.fc .fc-col-header,.fc .fc-daygrid-body,.fc .fc-scrollgrid-sync-table {
    width: 100%!important
}

.fc .fc-list-day th {
    background-color: var(--bs-secondary-bg)!important
}

.fc-theme-bootstrap a:not([href]) {
    color: var(--bs-body-color)
}

.fc-event {
    color: #fff
}

.fc th.fc-widget-header {
    background: var(--bs-border-color);
    color: #374650;
    line-height: 20px;
    padding: 10px 0;
    text-transform: uppercase;
    font-weight: 600
}

.fc-unthemed .fc-content,.fc-unthemed .fc-divider,.fc-unthemed .fc-list-heading td,.fc-unthemed .fc-list-view,.fc-unthemed .fc-popover,.fc-unthemed .fc-row,.fc-unthemed tbody,.fc-unthemed td,.fc-unthemed th,.fc-unthemed thead {
    border-color: var(--bs-border-color)
}

.fc-unthemed td.fc-today {
    background: #f8f8f8
}

.fc-button {
    background: var(--bs-secondary-bg);
    border-color: #eee;
    color: #374650;
    text-transform: capitalize;
    -webkit-box-shadow: none;
    box-shadow: none;
    padding: 6px 12px!important;
    height: auto!important
}

.fc-state-active,.fc-state-disabled,.fc-state-down {
    background-color: #67a8e4;
    color: #fff;
    text-shadow: none
}

.fc-event {
    border-radius: 2px;
    border: none;
    cursor: move;
    font-size: .8125rem;
    margin: 5px 7px;
    padding: 5px 5px;
    text-align: center
}

.fc-event,.fc-event-dot {
    background-color: #67a8e4
}

.fc-daygrid-dot-event.fc-event-mirror,.fc-daygrid-dot-event:hover {
    background-color: #67a8e4
}

.fc-daygrid-dot-event {
    color: #fff!important
}

.fc-daygrid-dot-event .fc-event-title {
    font-weight: 600
}

.fc-daygrid-event-dot {
    border-color: #fff!important;
    color: #fff!important
}

.fc-event .fc-content {
    color: #fff
}

#external-events .external-event {
    text-align: left;
    padding: 8px 16px;
    margin: 6px 0
}

.fc-day-grid-event.fc-h-event.fc-event.fc-start.fc-end.bg-dark .fc-content {
    color: #f3f3f3
}

[dir=rtl] .fc-header-toolbar {
    direction: ltr!important
}

[dir=rtl] .fc-toolbar>*>:not(:first-child) {
    margin-left: .75em
}

@media (max-width: 575.98px) {
    .fc-toolbar {
        -webkit-box-orient:vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        gap: 16px
    }
}

[data-] {
    position: relative;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-pack: start;
    -ms-flex-pack: start;
    justify-content: flex-start;
    -ms-flex-line-pack: start;
    align-content: flex-start;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start
}

.-wrapper {
    overflow: hidden;
    width: inherit;
    height: inherit;
    max-width: inherit;
    max-height: inherit
}

.-mask {
    direction: inherit;
    position: absolute;
    overflow: hidden;
    padding: 0;
    margin: 0;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    width: auto!important;
    height: auto!important;
    z-index: 0
}

.-offset {
    direction: inherit!important;
    -webkit-box-sizing: inherit!important;
    box-sizing: inherit!important;
    resize: none!important;
    position: absolute;
    top: 0;
    left: 0!important;
    bottom: 0;
    right: 0!important;
    padding: 0;
    margin: 0;
    -webkit-overflow-scrolling: touch
}

.-content-wrapper {
    direction: inherit;
    -webkit-box-sizing: border-box!important;
    box-sizing: border-box!important;
    position: relative;
    display: block;
    height: 100%;
    width: auto;
    visibility: visible;
    overflow: auto;
    max-width: 100%;
    max-height: 100%;
    scrollbar-width: none;
    padding: 0!important
}

.-content-wrapper::-webkit-scrollbar,.-hide-scrollbar::-webkit-scrollbar {
    display: none
}

.-content:after,.-content:before {
    content: " ";
    display: table
}

.-placeholder {
    max-height: 100%;
    max-width: 100%;
    width: 100%;
    pointer-events: none
}

.-height-auto-observer-wrapper {
    -webkit-box-sizing: inherit!important;
    box-sizing: inherit!important;
    height: 100%;
    width: 100%;
    max-width: 1px;
    position: relative;
    float: left;
    max-height: 1px;
    overflow: hidden;
    z-index: -1;
    padding: 0;
    margin: 0;
    pointer-events: none;
    -webkit-box-flex: inherit;
    -ms-flex-positive: inherit;
    flex-grow: inherit;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    -ms-flex-preferred-size: 0;
    flex-basis: 0
}

.-height-auto-observer {
    -webkit-box-sizing: inherit;
    box-sizing: inherit;
    display: block;
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    height: 1000%;
    width: 1000%;
    min-height: 1px;
    min-width: 1px;
    overflow: hidden;
    pointer-events: none;
    z-index: -1
}

.-track {
    z-index: 1;
    position: absolute;
    right: 0;
    bottom: 0;
    pointer-events: none;
    overflow: hidden
}

[data-].-dragging .-content {
    pointer-events: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-user-select: none
}

[data-].-dragging .-track {
    pointer-events: all
}

.-scrollbar {
    position: absolute;
    right: 2px;
    width: 4px;
    min-height: 10px
}

.-scrollbar:before {
    position: absolute;
    content: "";
    background: #a2adb7;
    border-radius: 7px;
    left: 0;
    right: 0;
    opacity: 0;
    -webkit-transition: opacity .2s linear;
    transition: opacity .2s linear
}

.-scrollbar.-visible:before {
    opacity: .5;
    -webkit-transition: opacity 0s linear;
    transition: opacity 0s linear
}

.-track.-vertical {
    top: 0;
    width: 11px
}

.-track.-vertical .-scrollbar:before {
    top: 2px;
    bottom: 2px
}

.-track.-horizontal {
    left: 0;
    height: 11px
}

.-track.-horizontal .-scrollbar:before {
    height: 100%;
    left: 2px;
    right: 2px
}

.-track.-horizontal .-scrollbar {
    right: auto;
    left: 0;
    top: 2px;
    height: 7px;
    min-height: 0;
    min-width: 10px;
    width: auto
}

[data--direction=rtl] .-track.-vertical {
    right: auto;
    left: 0
}

.hs-dummy-scrollbar-size {
    direction: rtl;
    position: fixed;
    opacity: 0;
    visibility: hidden;
    height: 500px;
    width: 500px;
    overflow-y: hidden;
    overflow-x: scroll
}

.-hide-scrollbar {
    position: fixed;
    left: 0;
    visibility: hidden;
    overflow-y: scroll;
    scrollbar-width: none
}

.custom-scroll {
    height: 100%
}

.fc-toolbar h2 {
    font-size: 16px;
    line-height: 30px;
    text-transform: uppercase
}

.fc th.fc-widget-header {
    background: #f3f3f3;
    font-size: 13px;
    line-height: 20px;
    padding: 10px 0;
    text-transform: uppercase;
    font-weight: 600
}

.fc-unthemed .fc-content,.fc-unthemed .fc-divider,.fc-unthemed .fc-list-heading td,.fc-unthemed .fc-list-view,.fc-unthemed .fc-popover,.fc-unthemed .fc-row,.fc-unthemed tbody,.fc-unthemed td,.fc-unthemed th,.fc-unthemed thead {
    border-color: #f3f3f3
}

.fc-unthemed td.fc-today {
    background: #fdfdfd
}

.fc-button {
    background: var(--bs-secondary-bg);
    border-color: #eee;
    color: #374650;
    text-transform: capitalize;
    -webkit-box-shadow: none;
    box-shadow: none;
    padding: 6px 12px!important;
    height: auto!important
}

.fc-state-active,.fc-state-disabled,.fc-state-down {
    background-color: #67a8e4;
    color: #fff;
    text-shadow: none
}

.fc-event {
    border-radius: 2px;
    border: none;
    cursor: move;
    font-size: .8125rem;
    margin: 5px 7px;
    padding: 5px 5px;
    text-align: center
}

.fc-event,.fc-event-dot {
    background-color: #67a8e4
}

.fc-event .fc-content {
    color: #fff
}

.fc-event.bg-dark .fc-content {
    color: var(--bs-gray-100)!important
}

.fc .table-bordered td,.fc .table-bordered th {
    border-color: #eee
}

@media (max-width: 575.98px) {
    .fc .fc-toolbar {
        display:block
    }
}

.fc .fc-toolbar h2 {
    font-size: 16px;
    line-height: 30px;
    text-transform: uppercase
}

@media (max-width: 767.98px) {
    .fc .fc-toolbar .fc-center,.fc .fc-toolbar .fc-left,.fc .fc-toolbar .fc-right {
        float:none;
        display: block;
        text-align: center;
        clear: both;
        margin: 10px 0
    }

    .fc .fc-toolbar>*>* {
        float: none
    }

    .fc .fc-toolbar .fc-today-button {
        display: none
    }
}

.fc .fc-toolbar .btn {
    text-transform: capitalize
}

[dir=rtl] .fc-header-toolbar {
    direction: ltr!important
}

[dir=rtl] .fc-toolbar>*>:not(:first-child) {
    margin-left: .75em
}

@media (min-width: 1200px) {
    .filemanager-sidebar {
        min-width:270px;
        max-width: 270px
    }
}

@media (min-width: 1366px) {
    .filemanager-sidebar {
        min-width:300px;
        max-width: 300px
    }
}

@media (width: 1440px) {
    .filemanager-sidebar {
        min-width:240px;
        max-width: 240px
    }
}

.categories-list {
    padding: 4px 0
}

.categories-list li a {
    display: block;
    padding: 8px 0;
    color: var(--bs-body-color);
    font-weight: 500
}

.categories-list li.active a {
    color: #67a8e4
}

.categories-list li ul {
    padding-left: 8px
}

.categories-list li ul li a {
    padding: 4px 12px;
    color: var(--bs-body-color);
    font-size: 14px
}

.custom-accordion .card+.card {
    margin-top: .5rem
}

.custom-accordion a.collapsed i.accor-down-icon:before {
    content: "\f0140";
    -webkit-transition: all .5s ease-in;
    transition: all .5s ease-in
}

.custom-accordion .card-body {
    color: var(--bs-body-color)
}

.file-img {
    max-width: 100px;
    height: auto
}

#session-timeout-dialog .close {
    display: none
}

#session-timeout-dialog .countdown-holder {
    color: #ea553d;
    font-weight: 500
}

#session-timeout-dialog .btn-default {
    background-color: #fff;
    color: #ea553d;
    -webkit-box-shadow: none;
    box-shadow: none
}

.irs--modern .irs-bar,.irs--modern .irs-from,.irs--modern .irs-single,.irs--modern .irs-to {
    background: #67a8e4!important;
    font-size: 11px
}

.irs--modern .irs-from:before,.irs--modern .irs-single:before,.irs--modern .irs-to:before {
    border-top-color: #67a8e4
}

.irs--modern .irs-grid-pol {
    background: var(--bs-border-color)
}

.irs--modern .irs-line {
    background: var(--bs-border-color);
    border-color: var(--bs-border-color)
}

.irs--modern .irs-grid-text {
    font-size: 11px;
    color: #ced4da
}

.irs--modern .irs-max,.irs--modern .irs-min {
    color: #adb5bd;
    background: var(--bs-border-color);
    font-size: 11px
}

.irs--modern .irs-handle>i:nth-child(1) {
    width: 8px;
    height: 8px
}

.irs--modern .irs-handle {
    width: 12px;
    height: 12px;
    top: 37px;
    background-color: var(--bs-secondary-bg)!important
}

.swal2-container .swal2-title {
    font-size: 24px;
    font-weight: 500;
    color: var(--bs-body-color)
}

.swal2-html-container {
    color: var(--bs-body-color)
}

.swal2-popup {
    background-color: var(--bs-secondary-bg)
}

.swal2-content {
    font-size: 16px
}

.swal2-icon.swal2-question {
    border-color: #3bc3e9;
    color: #3bc3e9
}

.swal2-icon.swal2-success [class^=swal2-success-line] {
    background-color: #4ac18e
}

.swal2-icon.swal2-success .swal2-success-ring {
    border-color: rgba(74,193,142,.3)
}

.swal2-icon.swal2-warning {
    border-color: #fb4;
    color: #fb4
}

.swal2-styled:focus {
    -webkit-box-shadow: none;
    box-shadow: none
}

.swal2-progress-steps .swal2-progress-step {
    background: #67a8e4
}

.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step {
    background: #67a8e4
}

.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step,.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line {
    background: rgba(103,168,228,.3)
}

.swal2-progress-steps .swal2-progress-step-line {
    background: #67a8e4
}

.swal2-actions.swal2-loading .swal2-styled.swal2-confirm {
    border-left-color: #67a8e4!important;
    border-right-color: #67a8e4!important
}

.swal2-file,.swal2-input,.swal2-textarea {
    border: 1px solid var(--bs-border-color)
}

.swal2-file:focus,.swal2-input:focus,.swal2-textarea:focus {
    -webkit-box-shadow: none;
    box-shadow: none;
    border-color: var(--bs-border-color)
}

.symbol {
    border-color: var(--bs-secondary-bg)
}

.rating-symbol-background,.rating-symbol-foreground {
    font-size: 24px
}

.rating-symbol-foreground {
    top: 0
}

.rating-star>span {
    display: inline-block;
    vertical-align: middle
}

.rating-star>span.badge {
    margin-left: 4px
}

.error {
    color: #ea553d
}

.parsley-error {
    border-color: #ea553d
}

.parsley-errors-list {
    display: none;
    margin: 0;
    padding: 0
}

.parsley-errors-list.filled {
    display: block
}

.parsley-errors-list>li {
    font-size: 12px;
    list-style: none;
    color: #ea553d;
    margin-top: 5px
}

.select2-container .select2-selection--single {
    background-color: var(--bs-tertiary-bg);
    border: 1px solid var(--bs-border-color);
    height: 38px
}

.select2-container .select2-selection--single:focus {
    outline: 0
}

.select2-container .select2-selection--single .select2-selection__rendered {
    line-height: 36px;
    padding-left: 12px;
    color: var(--bs-body-color)
}

.select2-container .select2-selection--single .select2-selection__arrow {
    height: 34px;
    width: 34px;
    right: 3px
}

.select2-container .select2-selection--single .select2-selection__arrow b {
    border-color: #adb5bd transparent transparent transparent;
    border-width: 6px 6px 0 6px
}

.select2-container--open .select2-selection--single .select2-selection__arrow b {
    border-color: transparent transparent #adb5bd transparent!important;
    border-width: 0 6px 6px 6px!important
}

.select2-container--default .select2-search--dropdown {
    padding: 10px;
    background-color: var(--bs-secondary-bg)
}

.select2-container--default .select2-search--dropdown .select2-search__field {
    border: 1px solid var(--bs-border-color);
    background-color: var(--bs-tertiary-bg);
    color: #848f98;
    outline: 0
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #67a8e4
}

.select2-container--default .select2-results__option[aria-selected=true] {
    background-color: var(--bs-dropdown-link-hover-bg);
    color: var(--bs-dropdown-link-hover-color)
}

.select2-container--default .select2-results__option[aria-selected=true]:hover {
    background-color: #67a8e4;
    color: #fff
}

.select2-results__option {
    padding: 6px 12px
}

.select2-dropdown {
    border: 1px solid var(--bs-border-color);
    background-color: var(--bs-white);
    -webkit-box-shadow: 0 2px 3px -2px rgba(0,0,0,.15);
    box-shadow: 0 2px 3px -2px rgba(0,0,0,.15)
}

.select2-search input {
    border: 1px solid var(--bs-border-color)
}

.select2-container .select2-selection--multiple {
    min-height: 38px;
    background-color: var(--bs-tertiary-bg);
    border: 1px solid var(--bs-border-color)!important
}

.select2-container .select2-selection--multiple .select2-selection__rendered {
    padding: 2px 10px
}

.select2-container .select2-selection--multiple .select2-search__field {
    border: 0;
    color: var(--bs-body-color)
}

.select2-container .select2-selection--multiple .select2-search__field::-webkit-input-placeholder {
    color: var(--bs-body-color)
}

.select2-container .select2-selection--multiple .select2-search__field::-moz-placeholder {
    color: var(--bs-body-color)
}

.select2-container .select2-selection--multiple .select2-search__field:-ms-input-placeholder {
    color: var(--bs-body-color)
}

.select2-container .select2-selection--multiple .select2-search__field::-ms-input-placeholder {
    color: var(--bs-body-color)
}

.select2-container .select2-selection--multiple .select2-search__field::placeholder {
    color: var(--bs-body-color)
}

.select2-container .select2-selection--multiple .select2-selection__choice {
    background-color: #f3f3f3;
    border: 1px solid var(--bs-border-color);
    border-radius: 1px;
    padding: 0 7px
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: var(--bs-border-color)
}

input[switch] {
    display: none
}

input[switch]+label {
    font-size: 1em;
    line-height: 1;
    width: 56px;
    height: 24px;
    background-color: #ced4da;
    background-image: none;
    border-radius: 2rem;
    padding: .16667rem;
    cursor: pointer;
    display: inline-block;
    text-align: center;
    position: relative;
    font-weight: 500;
    -webkit-transition: all .1s ease-in-out;
    transition: all .1s ease-in-out
}

input[switch]+label:before {
    color: #2f3d46;
    content: attr(data-off-label);
    display: block;
    font-family: inherit;
    font-weight: 500;
    font-size: 12px;
    line-height: 21px;
    position: absolute;
    right: 1px;
    margin: 3px;
    top: -2px;
    text-align: center;
    min-width: 1.66667rem;
    overflow: hidden;
    -webkit-transition: all .1s ease-in-out;
    transition: all .1s ease-in-out
}

input[switch]+label:after {
    content: "";
    position: absolute;
    left: 3px;
    background-color: #f3f3f3;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-radius: 2rem;
    height: 20px;
    width: 20px;
    top: 2px;
    -webkit-transition: all .1s ease-in-out;
    transition: all .1s ease-in-out
}

input[switch]:checked+label {
    background-color: #67a8e4
}

input[switch]:checked+label {
    background-color: #67a8e4
}

input[switch]:checked+label:before {
    color: #fff;
    content: attr(data-on-label);
    right: auto;
    left: 3px
}

input[switch]:checked+label:after {
    left: 33px;
    background-color: #f3f3f3
}

input[switch=bool]+label {
    background-color: #ea553d
}

input[switch=bool]+label:before,input[switch=bool]:checked+label:before,input[switch=default]:checked+label:before {
    color: #fff
}

input[switch=bool]:checked+label {
    background-color: #4ac18e
}

input[switch=default]:checked+label {
    background-color: #a2a2a2
}

input[switch=primary]:checked+label {
    background-color: #67a8e4
}

input[switch=success]:checked+label {
    background-color: #4ac18e
}

input[switch=info]:checked+label {
    background-color: #3bc3e9
}

input[switch=warning]:checked+label {
    background-color: #fb4
}

input[switch=danger]:checked+label {
    background-color: #ea553d
}

input[switch=dark]:checked+label {
    background-color: #2f3d46
}

.square-switch {
    margin-right: 7px
}

.square-switch input[switch]+label,.square-switch input[switch]+label:after {
    border-radius: 0
}

[dir=rtl] .datepicker {
    right: 0!important;
    left: auto
}

.datepicker {
    border: 1px solid var(--bs-border-color);
    padding: 8px;
    z-index: 999!important
}

.datepicker table tr th {
    font-weight: 500
}

.datepicker table tr td .active.disabled,.datepicker table tr td.active,.datepicker table tr td.active.disabled:hover,.datepicker table tr td.active:hover,.datepicker table tr td.selected,.datepicker table tr td.selected.disabled,.datepicker table tr td.selected.disabled:hover,.datepicker table tr td.selected:hover,.datepicker table tr td.today,.datepicker table tr td.today.disabled,.datepicker table tr td.today.disabled:hover,.datepicker table tr td.today:hover {
    background-color: #67a8e4!important;
    background-image: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    color: #fff!important
}

.datepicker table tr td span.focused,.datepicker table tr td span:hover,.datepicker table tr td.day.focused,.datepicker table tr td.day:hover {
    background-color: var(--bs-tertiary-bg)
}

.datepicker table tr td span.new,.datepicker table tr td span.old,.datepicker table tr td.new,.datepicker table tr td.old {
    color: var(--bs-body-color);
    opacity: .6
}

.datepicker table tr td.range,.datepicker table tr td.range.disabled,.datepicker table tr td.range.disabled:hover,.datepicker table tr td.range:hover {
    background-color: var(--bs-tertiary-bg)
}

.datepicker table tr td.day:hover {
    background-color: var(--bs-tertiary-bg)
}

.datepicker .datepicker-switch:hover {
    background-color: var(--bs-tertiary-bg)
}

.datepicker .prev:hover {
    background-color: var(--bs-tertiary-bg)
}

.table-condensed>tbody>tr>td,.table-condensed>thead>tr>th {
    padding: 7px
}

.bootstrap-touchspin.input-group>.input-group-prepend>.btn,.bootstrap-touchspin.input-group>.input-group-prepend>.input-group-text {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0
}

.bootstrap-touchspin.input-group>.input-group-append>.btn,.bootstrap-touchspin.input-group>.input-group-append>.input-group-text {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0
}

.sp-container {
    background-color: var(--bs-white)
}

.sp-container button {
    padding: .25rem .5rem;
    font-size: .71094rem;
    border-radius: .2rem;
    font-weight: 400;
    color: #2f3d46
}

.sp-container button.sp-palette-toggle {
    background-color: #f3f3f3
}

.sp-container button.sp-choose {
    background-color: #4ac18e;
    margin-left: 5px;
    margin-right: 0
}

.sp-palette-container {
    border-right: 1px solid #eee
}

.sp-input {
    background-color: var(--bs-tertiary-bg);
    border-color: var(--bs-border-color)!important;
    color: var(--bs-body-color)
}

.sp-input:focus {
    outline: 0
}

[dir=rtl] .sp-alpha {
    direction: rtl
}

[dir=rtl] .sp-original-input-container .sp-add-on {
    border-top-right-radius: 0!important;
    border-bottom-right-radius: 0!important;
    border-top-left-radius: 4px!important;
    border-bottom-left-radius: 4px!important
}

[dir=rtl] input.spectrum.with-add-on {
    border: 1px solid var(--bs-border-color);
    border-left: 0;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-top-right-radius: var(--bs-border-radius);
    border-bottom-right-radius: var(--bs-border-radius)
}

.tox-tinymce {
    border: 1px solid var(--bs-border-color)!important
}

.tox .tox-menu {
    background-color: var(--bs-secondary-bg)!important;
    border-color: var(--bs-border-color)!important
}

.tox .tox-statusbar {
    border-top: 1px solid var(--bs-border-color)!important
}

.tox .tox-edit-area__iframe,.tox .tox-menubar,.tox .tox-statusbar {
    background-color: var(--bs-secondary-bg)!important;
    background: 0 0!important
}

.tox .tox-mbtn {
    color: var(--bs-body-color)!important
}

.tox .tox-mbtn:hover:not(:disabled):not(.tox-mbtn--active) {
    background-color: var(--bs-tertiary-bg)!important
}

.tox .tox-tbtn:active,.tox .tox-tbtn:focus,.tox .tox-tbtn:hover {
    background-color: var(--bs-tertiary-bg)!important;
    -webkit-box-shadow: none!important;
    box-shadow: none!important
}

.tox .tox-tbtn--enabled {
    background-color: var(--bs-tertiary-bg)!important
}

.tox .tox-toolbar,.tox .tox-toolbar__overflow,.tox .tox-toolbar__primary {
    background: var(--bs-secondary-bg)!important
}

.tox .tox-tbtn {
    color: var(--bs-emphasis-color)!important
}

.tox .tox-tbtn svg {
    fill: var(--bs-emphasis-color)!important
}

.tox .tox-edit-area__iframe {
    background-color: var(--bs-secondary-bg)!important
}

.tox .tox-statusbar a,.tox .tox-statusbar__path-item,.tox .tox-statusbar__wordcount {
    color: var(--bs-emphasis-color)!important
}

.tox:not([dir=rtl]) .tox-toolbar__group:not(:last-of-type) {
    border-right: 1px solid var(--bs-border-color)!important
}

.tox .tox-toolbar-overlord .tox-toolbar__primary {
    border-color: var(--bs-border-color)!important;
    border-bottom: 1px solid var(--bs-border-color)
}

.tox-mbtn__select-label {
    color: var(--bs-emphasis-color)!important
}

.tox .tox-split-button:active,.tox .tox-split-button:focus,.tox .tox-split-button:hover {
    -webkit-box-shadow: none!important;
    box-shadow: none!important;
    background-color: var(--bs-tertiary-bg)!important
}

.tox-collection__group {
    background-color: var(--bs-secondary-bg)!important;
    color: var(--bs-body-color)!important;
    border-color: var(--bs-border-color)!important
}

.tox-collection--list .tox-collection__item--active {
    background-color: var(--bs-tertiary-bg)!important
}

.tox-collection__item-label {
    color: var(--bs-body-color)!important
}

.tox-collection__item-label span {
    color: var(--bs-body-color)!important
}

.tox-collection__group-heading {
    background-color: var(--bs-tertiary-bg)!important;
    color: var(--bs-body-color)!important
}

.dropzone {
    min-height: 230px;
    border: 2px dashed var(--bs-border-color);
    background: var(--bs-card-bg);
    border-radius: 6px
}

.dropzone .dz-message {
    font-size: 24px
}

.editable-input .form-control {
    display: inline-block
}

.editable-buttons {
    margin-left: 7px
}

.editable-buttons .editable-cancel {
    margin-left: 7px
}

.form-wizard-wrapper label {
    font-size: 14px;
    text-align: right
}

.wizard ul {
    list-style: none!important;
    padding: 0;
    margin: 0
}

.wizard>.steps>ul>li {
    width: 25%
}

.wizard>.steps .current-info {
    position: absolute;
    left: -999em
}

.wizard>.steps a,.wizard>.steps a:active,.wizard>.steps a:hover {
    margin: 3px;
    padding: 15px;
    display: block;
    width: auto;
    border-radius: 5px
}

.wizard>.steps .current a,.wizard>.steps .current a:active,.wizard>.steps .current a:hover {
    background-color: #67a8e4;
    color: #fff
}

.wizard>.steps .current a .number,.wizard>.steps .current a:active .number,.wizard>.steps .current a:hover .number {
    border: 2px solid var(--bs-border-color)
}

.wizard>.steps .disabled a,.wizard>.steps .disabled a:active,.wizard>.steps .disabled a:hover,.wizard>.steps .done a,.wizard>.steps .done a:active,.wizard>.steps .done a:hover {
    background-color: #e9f2fb;
    color: #67a8e4
}

.wizard>.steps .disabled a .number,.wizard>.steps .disabled a:active .number,.wizard>.steps .disabled a:hover .number,.wizard>.steps .done a .number,.wizard>.steps .done a:active .number,.wizard>.steps .done a:hover .number {
    border-color: #67a8e4
}

.wizard>.steps .number {
    font-size: 16px;
    padding: 5px;
    border-radius: 50%;
    border: 2px solid var(--bs-border-color);
    width: 38px;
    display: inline-block;
    font-weight: 500;
    text-align: center;
    margin-right: 10px;
    background-color: rgba(103,168,228,.25)
}

.wizard>.content {
    background-color: transparent;
    margin: 0 5px;
    border-radius: 0;
    min-height: 150px
}

.wizard>.content>.title {
    position: absolute;
    left: -999em
}

.wizard>.content>.body {
    width: 100%;
    height: 100%;
    padding: 30px 0 0;
    position: static
}

.wizard>.actions {
    position: relative;
    display: block;
    text-align: right;
    width: 100%
}

.wizard>.actions>ul {
    display: inline-block;
    text-align: right
}

.wizard>.actions>ul>li {
    display: block;
    margin: 0 .5em
}

.wizard>.actions a,.wizard>.actions a:active,.wizard>.actions a:hover {
    background-color: #67a8e4;
    border-radius: 4px;
    padding: 8px 15px;
    color: #fff
}

.wizard>.actions .disabled a,.wizard>.actions .disabled a:active,.wizard>.actions .disabled a:hover {
    opacity: .65;
    background-color: #67a8e4;
    color: #fff;
    cursor: not-allowed
}

.wizard>.actions>ul>li,.wizard>.steps>ul>li {
    float: left
}

@media (max-width: 768px) {
    .wizard>.steps>ul>li {
        width:50%
    }

    .form-wizard-wrapper label {
        text-align: left
    }
}

@media (max-width: 520px) {
    .wizard>.steps>ul>li {
        width:100%
    }
}

div.dataTables_wrapper div.dataTables_filter {
    text-align: right
}

div.dataTables_wrapper div.dataTables_filter input {
    margin-left: .5em;
    display: inline-block;
    width: auto
}

div.dataTables_wrapper div.dataTables_length label {
    margin-bottom: .5rem
}

.table-rep-plugin .btn-toolbar {
    display: block
}

.table-rep-plugin .table-responsive {
    border: none!important
}

.table-rep-plugin .btn-group .btn-default {
    background-color: #848f98;
    color: #f3f3f3;
    border: 1px solid #848f98
}

.table-rep-plugin .btn-group .btn-default.btn-primary {
    background-color: rgba(var(--bs-primary-rgb),1);
    border-color: rgba(var(--bs-primary-rgb),1);
    color: #fff;
    -webkit-box-shadow: 0 0 0 2px rgba(var(--bs-primary-rgb),.5);
    box-shadow: 0 0 0 2px rgba(var(--bs-primary-rgb),.5)
}

.table-rep-plugin .btn-group.pull-right {
    float: right
}

.table-rep-plugin .btn-group.pull-right .dropdown-menu {
    right: 0;
    -webkit-transform: none!important;
    transform: none!important;
    top: 100%!important
}

.table-rep-plugin tbody th {
    font-size: 14px;
    font-weight: 400
}

.table-rep-plugin .checkbox-row {
    padding-left: 40px;
    color: var(--bs-body-color)!important
}

.table-rep-plugin .checkbox-row:hover {
    background-color: var(--bs-tertiary-bg)!important
}

.table-rep-plugin .checkbox-row label {
    display: inline-block;
    padding-left: 5px;
    position: relative
}

.table-rep-plugin .checkbox-row label::before {
    -o-transition: .3s ease-in-out;
    -webkit-transition: .3s ease-in-out;
    background-color: #fff;
    border-radius: 3px;
    border: 1px solid var(--bs-border-color);
    content: "";
    display: inline-block;
    height: 17px;
    left: 0;
    margin-left: -20px;
    position: absolute;
    transition: .3s ease-in-out;
    width: 17px;
    outline: 0!important
}

.table-rep-plugin .checkbox-row label::after {
    color: var(--bs-body-color);
    display: inline-block;
    font-size: 11px;
    height: 16px;
    left: 0;
    margin-left: -20px;
    padding-left: 3px;
    padding-top: 1px;
    position: absolute;
    top: -1px;
    width: 16px
}

.table-rep-plugin .checkbox-row input[type=checkbox] {
    cursor: pointer;
    opacity: 0;
    z-index: 1;
    outline: 0!important
}

.table-rep-plugin .checkbox-row input[type=checkbox]:disabled+label {
    opacity: .65
}

.table-rep-plugin .checkbox-row input[type=checkbox]:focus+label::before {
    outline-offset: -2px;
    outline: 0
}

.table-rep-plugin .checkbox-row input[type=checkbox]:checked+label::after {
    content: "\f00c";
    font-family: "Font Awesome 5 Free";
    font-weight: 900
}

.table-rep-plugin .checkbox-row input[type=checkbox]:disabled+label::before {
    background-color: var(--bs-tertiary-bg);
    cursor: not-allowed
}

.table-rep-plugin .checkbox-row input[type=checkbox]:checked+label::before {
    background-color: rgba(var(--bs-primary-rgb),1);
    border-color: rgba(var(--bs-primary-rgb),1)
}

.table-rep-plugin .checkbox-row input[type=checkbox]:checked+label::after {
    color: #fff
}

.table-rep-plugin .fixed-solution .sticky-table-header {
    top: 70px!important;
    background-color: rgba(var(--bs-primary-rgb),1)
}

.table-rep-plugin .fixed-solution .sticky-table-header table {
    color: #fff
}

.table-rep-plugin .sticky-table-header,.table-rep-plugin table.focus-on tbody tr.focused td,.table-rep-plugin table.focus-on tbody tr.focused th {
    background: rgba(var(--bs-primary-rgb),1);
    border-color: rgba(var(--bs-primary-rgb),1);
    color: #fff
}

.table-rep-plugin .sticky-table-header table,.table-rep-plugin table.focus-on tbody tr.focused td table,.table-rep-plugin table.focus-on tbody tr.focused th table {
    color: #fff
}

@media (min-width: 992px) {
    body[data-layout=horizontal] .fixed-solution .sticky-table-header {
        top:120px!important
    }
}

.table-edits input,.table-edits select {
    height: calc(1.5em + .5rem + calc(var(--bs-border-width) * 2));
    padding: .25rem .5rem;
    border: 1px solid var(--bs-border-color);
    background-color: var(--bs-tertiary-bg);
    color: var(--bs-body-color);
    border-radius: var(--bs-border-radius)
}

.table-edits input:focus,.table-edits select:focus {
    outline: 0;
    border-color: var(--bs-border-color)
}

.morris-charts text {
    font-family: Roboto,sans-serif!important;
    fill: var(--bs-tertiary-bg)
}

.morris-hover {
    position: absolute;
    z-index: 10
}

.morris-hover.morris-default-style {
    font-size: 12px;
    text-align: center;
    border-radius: 5px;
    padding: 10px 12px;
    background: var(--bs-border-color);
    color: var(--bs-body-color);
    border: 2px solid var(--bs-border-color);
    font-family: var(--bs-font-sans-serif)
}

.morris-hover.morris-default-style .morris-hover-row-label {
    font-weight: 700;
    margin: .25em 0;
    font-family: Roboto,sans-serif
}

.morris-hover.morris-default-style .morris-hover-point {
    white-space: nowrap;
    margin: .1em 0;
    color: #fff
}

.ct-golden-section:before {
    float: none
}

.ct-chart {
    max-height: 300px
}

.ct-chart .ct-label {
    fill: #adb5bd;
    color: #adb5bd;
    font-size: 14px;
    line-height: 1
}

.ct-chart.simple-pie-chart-chartist .ct-label {
    color: #fff;
    fill: #fff;
    font-size: 16px
}

.ct-grid {
    stroke: rgba(47,61,70,.09);
    stroke-width: 1px;
    stroke-dasharray: 3px
}

.ct-chart .ct-series.ct-series-a .ct-bar,.ct-chart .ct-series.ct-series-a .ct-line,.ct-chart .ct-series.ct-series-a .ct-point,.ct-chart .ct-series.ct-series-a .ct-slice-donut {
    stroke: #564ab1
}

.ct-chart .ct-series.ct-series-b .ct-bar,.ct-chart .ct-series.ct-series-b .ct-line,.ct-chart .ct-series.ct-series-b .ct-point,.ct-chart .ct-series.ct-series-b .ct-slice-donut {
    stroke: #fb4
}

.ct-chart .ct-series.ct-series-c .ct-bar,.ct-chart .ct-series.ct-series-c .ct-line,.ct-chart .ct-series.ct-series-c .ct-point,.ct-chart .ct-series.ct-series-c .ct-slice-donut {
    stroke: #3bc3e9
}

.ct-chart .ct-series.ct-series-d .ct-bar,.ct-chart .ct-series.ct-series-d .ct-line,.ct-chart .ct-series.ct-series-d .ct-point,.ct-chart .ct-series.ct-series-d .ct-slice-donut {
    stroke: #ea553d
}

.ct-chart .ct-series.ct-series-e .ct-bar,.ct-chart .ct-series.ct-series-e .ct-line,.ct-chart .ct-series.ct-series-e .ct-point,.ct-chart .ct-series.ct-series-e .ct-slice-donut {
    stroke: #009688
}

.ct-chart .ct-series.ct-series-f .ct-bar,.ct-chart .ct-series.ct-series-f .ct-line,.ct-chart .ct-series.ct-series-f .ct-point,.ct-chart .ct-series.ct-series-f .ct-slice-donut {
    stroke: #afb42b
}

.ct-chart .ct-series.ct-series-g .ct-bar,.ct-chart .ct-series.ct-series-g .ct-line,.ct-chart .ct-series.ct-series-g .ct-point,.ct-chart .ct-series.ct-series-g .ct-slice-donut {
    stroke: #8d6e63
}

.ct-series-a .ct-area,.ct-series-a .ct-slice-pie {
    fill: #564ab1
}

.ct-series-b .ct-area,.ct-series-b .ct-slice-pie {
    fill: #fb4
}

.ct-series-c .ct-area,.ct-series-c .ct-slice-pie {
    fill: #3bc3e9
}

.ct-series-d .ct-area,.ct-series-d .ct-slice-pie {
    fill: #4ac18e
}

.ct-area {
    fill-opacity: .33
}

.chartist-tooltip {
    position: absolute;
    display: inline-block;
    opacity: 0;
    min-width: 10px;
    padding: 2px 10px;
    border-radius: 3px;
    background: #2f3d46;
    color: #eee;
    text-align: center;
    pointer-events: none;
    z-index: 1;
    -webkit-transition: opacity .2s linear;
    transition: opacity .2s linear
}

.chartist-tooltip.tooltip-show {
    opacity: 1
}

.ct-line {
    stroke-width: 3px
}

.ct-point {
    stroke-width: 7px
}

.c3-tooltip {
    -webkit-box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
    opacity: 1
}

.c3-tooltip td {
    border-left: none;
    font-family: Roboto,sans-serif;
    background-color: var(--bs-tertiary-bg)
}

.c3-tooltip td>span {
    background: var(--bs-dark)
}

.c3-tooltip tr {
    border: none!important
}

.c3-tooltip th {
    background-color: var(--bs-tertiary-bg)!important;
    color: var(--bs-body-color)!important
}

.c3-chart-arcs-title {
    font-size: 18px;
    font-weight: 600
}

.c3 text {
    font-family: var(--bs-font-sans-serif);
    fill: var(--bs-body-color)
}

.c3 line,.c3 path {
    stroke: var(--bs-border-color)
}

.c3-legend-item {
    font-family: Roboto,sans-serif;
    font-size: 14px
}

.c3-chart-arc.c3-target g path {
    stroke: var(--bs-border-color)!important
}

:not(pre)>code[class*=language-],pre[class*=language-] {
    background: var(--bs-light)
}

code[class*=language-],pre[class*=language-] {
    color: var(--bs-body-color);
    text-shadow: none
}

.dd-list .dd-item .dd-handle {
    background: var(--bs-border-color);
    border: none;
    padding: 8px 16px;
    height: auto;
    font-weight: 400;
    border-radius: 3px;
    color: var(--bs-body-color);
    font-size: 15px
}

.dd-list .dd-item .dd-handle:hover {
    color: #67a8e4
}

.dd-list .dd-item button {
    height: 36px;
    font-size: 17px;
    margin: 0;
    color: #848f98;
    width: 36px
}

.dd-list .dd3-item {
    margin: 5px 0
}

.dd-list .dd3-item .dd-item button {
    width: 36px;
    height: 36px
}

.dd-list .dd3-handle {
    margin: 0;
    height: 36px!important;
    float: left
}

.dd-list .dd3-content {
    height: auto;
    border: none;
    padding: 8px 16px 8px 46px;
    background: var(--bs-tertiary-bg)
}

.dd-list .dd3-content:hover {
    color: #67a8e4
}

.dd-list .dd3-handle:before {
    content: "\f35c";
    font-family: "Material Design Icons";
    color: #adb5bd
}

.dd-empty,.dd-placeholder {
    background: rgba(206,212,218,.1);
    border-color: var(--bs-border-color)
}

.custom-dd-empty .dd-list .dd3-handle {
    border: none
}

.dd-dragel .dd-handle {
    -webkit-box-shadow: 0 2px 3px -2px rgba(0,0,0,.15);
    box-shadow: 0 2px 3px -2px rgba(0,0,0,.15)
}

.dd-dragel .dd3-handle {
    border: none!important
}

.dd-list .dd-list {
    padding-right: 0;
    padding-left: 30px
}

.dd-item>button {
    float: left
}

pre[class*=language-] {
    background-color: var(--bs-secondary-bg)!important
}

.alertify,.alertify-logs {
    z-index: 1002
}

.alertify input {
    border: 2px solid var(--bs-border-color)
}

.alertify .dialog input:not(.form-control) {
    background-color: var(--bs-secondary-bg);
    color: var(--bs-gray-400)
}

.alertify .dialog>* {
    background-color: var(--bs-secondary-bg)
}

.alertify .dialog>* nav button {
    color: var(--bs-body-color)!important
}

.alertify-logs>.success {
    background-color: #4ac18e;
    color: #fff
}

.alertify-logs>.error {
    background-color: #ea553d;
    color: #fff
}

.alertify-logs>*,.alertify-logs>.default {
    background-color: #2f3d46
}

.flot-charts-height {
    height: 320px
}

.flotTip {
    padding: 8px 12px;
    background-color: var(--bs-dark);
    z-index: 100;
    color: var(--bs-body-color);
    -webkit-box-shadow: 0 2px 3px -2px rgba(0,0,0,.15);
    box-shadow: 0 2px 3px -2px rgba(0,0,0,.15);
    border-radius: 4px
}

.legendLabel {
    color: var(--bs-gray-500)
}

.jqstooltip {
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
    width: auto!important;
    height: auto!important;
    background-color: var(--bs-gray-800)!important;
    -webkit-box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
    padding: 5px 10px!important;
    border-radius: 3px;
    border-color: var(--bs-gray-900)!important
}

.jqsfield {
    color: var(--bs-gray-200)!important;
    font-size: 12px!important;
    line-height: 18px!important;
    font-family: var(--bs-font-sans-serif)!important;
    font-weight: 500!important
}

.gmaps,.gmaps-panaroma {
    height: 300px;
    background: var(--bs-tertiary-bg);
    border-radius: 3px
}

.gmaps-overlay {
    display: block;
    text-align: center;
    color: #fff;
    font-size: 16px;
    line-height: 40px;
    background: #67a8e4;
    border-radius: 4px;
    padding: 10px 20px
}

.gmaps-overlay_arrow {
    left: 50%;
    margin-left: -16px;
    width: 0;
    height: 0;
    position: absolute
}

.gmaps-overlay_arrow.above {
    bottom: -15px;
    border-left: 16px solid transparent;
    border-right: 16px solid transparent;
    border-top: 16px solid #67a8e4
}

.gmaps-overlay_arrow.below {
    top: -15px;
    border-left: 16px solid transparent;
    border-right: 16px solid transparent;
    border-bottom: 16px solid #67a8e4
}

.jvectormap-label {
    border: none;
    background: #2f3d46;
    color: #f7f7f7;
    font-family: var(--bs-font-sans-serif);
    font-size: .9375rem;
    padding: 5px 8px
}

.accountbg {
    position: absolute;
    background-size: cover;
    height: 100%;
    width: 100%;
    top: 0
}

.account-page-full {
    left: 0;
    position: absolute;
    height: 100%;
    margin: 0;
    width: 420px;
    background-color: var(--bs-secondary-bg)
}

.account-page-full .card {
    border: none
}

.account-copyright {
    position: absolute;
    bottom: 0;
    width: 100%
}

.search-box .form-control {
    border-radius: 30px;
    padding-left: 40px
}

.search-box .search-icon {
    font-size: 16px;
    position: absolute;
    left: 13px;
    top: 0;
    line-height: 38px
}

.product-list li a {
    display: block;
    padding: 4px 0;
    color: var(--bs-body-color)
}

.product-view-nav.nav-pills .nav-item {
    margin-left: 4px
}

.product-view-nav.nav-pills .nav-link {
    width: 36px;
    height: 36px;
    font-size: 16px;
    padding: 0;
    line-height: 36px;
    text-align: center;
    border-radius: 50%
}

.product-tag {
    position: absolute;
    left: 0;
    top: 28px;
    padding: 2px 13px;
    text-transform: uppercase;
    font-size: 13px;
    color: #fff;
    letter-spacing: 1px;
    line-height: 21px;
    background-color: #ea553d
}

.email-leftbar {
    width: 200px;
    float: left
}

.email-rightbar {
    margin-left: 230px
}

.chat-user-box p.user-title {
    color: var(--bs-emphasis-color);
    font-weight: 600;
    font-size: 14px
}

.chat-user-box p {
    font-size: 12px
}

@media (max-width: 767px) {
    .email-leftbar {
        float:none;
        width: 100%
    }

    .email-rightbar {
        margin: 0
    }
}

.mail-list a {
    display: block;
    color: var(--bs-gray-600);
    line-height: 24px;
    font-size: 14px;
    padding: 8px 5px;
    font-family: Roboto,sans-serif
}

.mail-list a.active {
    color: #ea553d;
    font-weight: 500
}

.message-list {
    display: block;
    padding-left: 0
}

.message-list li {
    position: relative;
    display: block;
    height: 50px;
    line-height: 50px;
    cursor: default;
    -webkit-transition-duration: .3s;
    transition-duration: .3s
}

.message-list li a {
    color: var(--bs-secondary-color)
}

.message-list li:hover {
    background: var(--bs-tertiary-bg);
    -webkit-transition-duration: 50ms;
    transition-duration: 50ms
}

.message-list li .col-mail {
    float: left;
    position: relative
}

.message-list li .col-mail-1 {
    width: 320px
}

.message-list li .col-mail-1 .checkbox-wrapper-mail,.message-list li .col-mail-1 .dot,.message-list li .col-mail-1 .star-toggle {
    display: block;
    float: left
}

.message-list li .col-mail-1 .dot {
    border: 4px solid transparent;
    border-radius: 100px;
    margin: 22px 26px 0;
    height: 0;
    width: 0;
    line-height: 0;
    font-size: 0
}

.message-list li .col-mail-1 .checkbox-wrapper-mail {
    margin: 15px 10px 0 20px
}

.message-list li .col-mail-1 .star-toggle {
    margin-top: 18px;
    margin-left: 5px
}

.message-list li .col-mail-1 .title {
    position: absolute;
    top: 0;
    left: 110px;
    right: 0;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    margin-bottom: 0
}

.message-list li .col-mail-2 {
    position: absolute;
    top: 0;
    left: 320px;
    right: 0;
    bottom: 0
}

.message-list li .col-mail-2 .date,.message-list li .col-mail-2 .subject {
    position: absolute;
    top: 0
}

.message-list li .col-mail-2 .subject {
    left: 0;
    right: 200px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap
}

.message-list li .col-mail-2 .date {
    right: 0;
    width: 170px;
    padding-left: 80px
}

.message-list li.active,.message-list li.active:hover {
    -webkit-box-shadow: inset 3px 0 0 #67a8e4;
    box-shadow: inset 3px 0 0 #67a8e4
}

.message-list li.unread {
    background-color: var(--bs-tertiary-bg);
    font-weight: 500;
    color: var(--bs-emphasis-color)
}

.message-list li.unread a {
    color: var(--bs-emphasis-color);
    font-weight: 500
}

.message-list .checkbox-wrapper-mail {
    cursor: pointer;
    height: 20px;
    width: 20px;
    position: relative;
    display: inline-block;
    -webkit-box-shadow: inset 0 0 0 1px #ced4da;
    box-shadow: inset 0 0 0 1px #ced4da;
    border-radius: 1px
}

.message-list .checkbox-wrapper-mail input {
    opacity: 0;
    cursor: pointer
}

.message-list .checkbox-wrapper-mail input:checked~label {
    opacity: 1
}

.message-list .checkbox-wrapper-mail label {
    position: absolute;
    height: 20px;
    width: 20px;
    left: 0;
    cursor: pointer;
    opacity: 0;
    margin-bottom: 0;
    -webkit-transition-duration: 50ms;
    transition-duration: 50ms;
    top: 0
}

.message-list .checkbox-wrapper-mail label:before {
    content: "\f012c";
    font-family: "Material Design Icons";
    top: 0;
    height: 20px;
    color: var(--bs-dark);
    width: 20px;
    position: absolute;
    margin-top: -16px;
    left: 4px;
    font-size: 13px
}

@media (max-width: 575.98px) {
    .message-list li .col-mail-1 {
        width:200px
    }
}

.counter-number {
    font-size: 32px;
    font-weight: 500;
    text-align: center;
    color: #67a8e4
}

.counter-number span {
    font-size: 16px;
    font-weight: 400;
    display: block;
    padding-top: 7px;
    color: var(--bs-secondary-color)
}

.coming-box {
    float: left;
    width: 21%;
    padding: 14px 7px;
    margin: 0 3rem,1.5rem 3rem;
    background-color: var(--bs-secondary-bg);
    border-radius: calc(var(--bs-border-radius) - var(--bs-border-width));
    -webkit-box-shadow: 0 2px 3px -2px rgba(0,0,0,.15);
    box-shadow: 0 2px 3px -2px rgba(0,0,0,.15)
}

@media (max-width: 991.98px) {
    .coming-box {
        width:40%
    }
}

.cd-container {
    width: 90%;
    max-width: 1170px;
    margin: 0 auto
}

.cd-container::after {
    content: "";
    display: table;
    clear: both
}

#cd-timeline {
    margin-bottom: 2em;
    margin-top: 2em;
    padding: 2em 0;
    position: relative
}

#cd-timeline::before {
    border-left: 3px solid var(--bs-border-color);
    content: "";
    height: 100%;
    left: 18px;
    position: absolute;
    top: 0;
    width: 3px
}

@media only screen and (min-width: 1170px) {
    #cd-timeline {
        margin-bottom:3em;
        margin-top: 3em
    }

    #cd-timeline::before {
        left: 50%;
        margin-left: -2px
    }
}

.cd-timeline-block {
    margin: 2em 0;
    position: relative
}

.cd-timeline-block:after {
    clear: both;
    content: "";
    display: table
}

.cd-timeline-block:first-child {
    margin-top: 0
}

.cd-timeline-block:last-child {
    margin-bottom: 0
}

@media only screen and (min-width: 1170px) {
    .cd-timeline-block {
        margin:4em 0
    }

    .cd-timeline-block:first-child {
        margin-top: 0
    }

    .cd-timeline-block:last-child {
        margin-bottom: 0
    }
}

.cd-timeline-img {
    position: absolute;
    top: 20px;
    left: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    text-align: center;
    line-height: 30px;
    font-size: 20px;
    color: #fff;
    background-color: #67a8e4;
    border: 5px solid var(--bs-border-color)
}

.cd-timeline-img i {
    margin-left: 1px
}

@media only screen and (min-width: 1170px) {
    .cd-timeline-img {
        width:40px;
        height: 40px;
        line-height: 30px;
        left: 50%;
        margin-left: -20px;
        -webkit-transform: translateZ(0);
        -webkit-backface-visibility: hidden
    }

    .cssanimations .cd-timeline-img.is-hidden {
        visibility: hidden
    }

    .cssanimations .cd-timeline-img.bounce-in {
        visibility: visible;
        -webkit-animation: cd-bounce-1 .6s;
        animation: cd-bounce-1 .6s
    }
}

.cd-timeline-content {
    border-radius: 5px;
    border: 1px solid var(--bs-border-color);
    margin-left: 60px;
    padding: 1em;
    position: relative
}

.cd-timeline-content:after {
    clear: both;
    content: "";
    display: table
}

.cd-timeline-content h2 {
    margin-top: 0
}

.cd-timeline-content .cd-read-more {
    background: #67a8e4;
    border-radius: .25em;
    color: #fff;
    display: inline-block;
    font-size: 14px;
    padding: .8em 1em
}

.cd-timeline-content .cd-date {
    display: inline-block;
    font-size: 14px
}

.cd-timeline-content h3 {
    font-size: 18px;
    margin: 0 0 15px 0
}

.no-touch .cd-timeline-content .cd-read-more:hover {
    background-color: #f3f3f3
}

.cd-timeline-content .cd-date {
    float: left;
    padding: .8em 0;
    opacity: .7
}

.cd-timeline-content::before {
    content: "";
    position: absolute;
    top: 16px;
    right: 100%;
    height: 0;
    width: 0;
    border: 12px solid transparent;
    border-right: 12px solid var(--bs-border-color)
}

@media only screen and (min-width: 1170px) {
    .cd-timeline-content {
        margin-left:0;
        padding: 1.6em;
        width: 45%
    }

    .cd-timeline-content::before {
        top: 24px;
        left: 100%;
        border-color: transparent;
        border-left-color: var(--bs-border-color)
    }

    .cd-timeline-content .cd-read-more {
        float: left
    }

    .cd-timeline-content .cd-date {
        position: absolute;
        width: 100%;
        left: 122%;
        top: 20px
    }

    .cd-timeline-block:nth-child(even) .cd-timeline-content {
        float: right
    }

    .cd-timeline-block:nth-child(even) .cd-timeline-content::before {
        top: 24px;
        left: auto;
        right: 100%;
        border-color: transparent;
        border-right-color: var(--bs-border-color)
    }

    .cd-timeline-block:nth-child(even) .cd-timeline-content .cd-read-more {
        float: right
    }

    .cd-timeline-block:nth-child(even) .cd-timeline-content .cd-date {
        left: auto;
        right: 122%;
        text-align: right
    }

    .cssanimations .cd-timeline-content.is-hidden {
        visibility: hidden
    }

    .cssanimations .cd-timeline-content.bounce-in {
        visibility: visible;
        -webkit-animation: cd-bounce-2 .6s;
        animation: cd-bounce-2 .6s
    }
}

@media only screen and (min-width: 1170px) {
    .cssanimations .cd-timeline-block:nth-child(even) .cd-timeline-content.bounce-in {
        -webkit-animation:cd-bounce-2-inverse .6s;
        animation: cd-bounce-2-inverse .6s
    }
}

.overlay-container {
    position: relative
}

.project-item img.gallery-thumb-img {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 10px;
    margin-top: 10px
}

.project-item-overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    opacity: 0;
    border-radius: 5px;
    background: -webkit-gradient(linear,left top,left bottom,from(rgba(0,0,0,.3)),to(rgba(0,0,0,.8)));
    background: linear-gradient(to bottom,rgba(0,0,0,.3) 0,rgba(0,0,0,.8) 100%);
    -webkit-transition: .5s ease;
    transition: .5s ease
}

.project-item-overlay h4 {
    font-size: 18px;
    font-weight: 500;
    white-space: nowrap;
    color: #fff;
    position: absolute;
    overflow: hidden;
    top: 7%;
    left: 7%;
    margin: 0;
    text-overflow: ellipsis
}

.project-item-overlay p {
    font-size: 15px;
    font-weight: 600;
    white-space: nowrap;
    color: #fff;
    position: absolute;
    overflow: hidden;
    bottom: 7%;
    left: 7%;
    text-overflow: ellipsis;
    margin: 0
}

.overlay-container:hover .project-item-overlay {
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    opacity: 1;
    height: 100%;
    width: 100%;
    -webkit-transition: .5s ease;
    transition: .5s ease
}

.plan-card .plan-icon {
    display: inline-block;
    font-size: 35px;
    width: 100px;
    height: 100px;
    color: #fff;
    line-height: 76px;
    overflow: hidden;
    border: 12px solid #f3f3f3;
    border-radius: 50%;
    background: #67a8e4;
    -webkit-box-shadow: 0 0 3px #ced4da;
    box-shadow: 0 0 3px #ced4da;
    -webkit-transition: all .3s;
    transition: all .3s
}

.plan-card .plan-price span {
    font-size: 15px;
    vertical-align: middle
}

.plan-card .plan-features p {
    line-height: 32px
}

.plan-card .plan-features .btn-dark {
    color: #fff
}

.plan-card .ion.bg-dark {
    background-color: #2f3d46!important
}

.ex-page-content h1 {
    font-size: 98px;
    font-weight: 700;
    line-height: 150px;
    text-shadow: rgba(61,61,61,.3) 1px 1px,rgba(61,61,61,.2) 2px 2px,rgba(61,61,61,.3) 3px 3px
}

/*# sourceMappingURL=app.min.css.map */



    .orangecose{
    border: 0px solid orange;
    padding: 0px 1px 0px 17px;
    border-radius: 146px;
    background: orange;
    }
    
    
    .inner_cont{
        
      box-shadow: #7367f0 0px 1px 1px 0px, #7367f0 0px 1px 2px 1px;
        display:flex;
     flex-direction:column;
     min-height:100px;
     align-items:center;
     justify-content:center;
     border-radius:8px;
     transition: all 0.5s ease;
     margin: 5px;
        
        
    }
    
    .inner_cont:hover{
        
     background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
     display:flex;
     flex-direction:column;
     min-height:120px;
     align-items:center;
     justify-content:center;
     border-radius:8px;
        color:white;
       transition: all 0.5s ease;
        
        
    }
    
    
    .inner_cont:hover .fa-file {
        
        
        color: white;
        font-size:43px;
        transition: all 0.5s ease;
    }
    
    
    .inner_cont:hover span {
        
        
        color: white;
        transition: all 0.5s ease;
        /*font-size:43px;*/
    }
    
    .inner_cont .fa-file{
        
        color: #7367f0;
        font-size:43px;
        
    }
    
   
    .inner_cont span{
        
        margin-top: 12px;
        color: #7367f0;
    }


    #inner_content_one{


display:none;

    }
    
   
    
    
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl-12 p-2">
              <div class=" large fw-medium" style="font-size:23px;color:#6f6b7d;">File Overview</div>
        </div>
    </div>
    <div id="inner_content_two" style="margin-top:10px;">
        <div class="container-fluid" style="padding:0;">
            <div class="d-xl-flex">
                <div class="w-100">
                    <div class="d-xl-flex">
                    <div class="card filemanager-sidebar me-md-3">
                        <div class="card-body">
                            <div class="d-flex flex-column h-100">
                                <div class="">
                                    <div class="mb-3">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-plus me-1"></i> Create New
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" data-bs-target="#add-folder" data-bs-toggle="modal"><i class="bx bx-folder me-1"></i> Folder</a>
                                                <a class="dropdown-item" href="#" data-bs-target="#add-sub-folder" data-bs-toggle="modal"><i class="bx bx-folder me-1"></i>Sub Folder</a>
                                                <a class="dropdown-item" href="#" data-bs-target="#add-file" data-bs-toggle="modal"><i class="bx bx-file me-1"></i> File</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div>
                                        <h6 class="">My Documents</h6>
                                        <ul class="list-unstyled categories-list">
                                          
                                         <!--<li class="text-body fw-medium py-1 d-flex align-items-center">-->
                                         <!--    <i class="fa fa-share font-size-20 text-muted me-2"></i>  <a class="dropdown-item" href="#" data-bs-target="#share-file-modal" data-bs-toggle="modal"><i class="bx bx-file me-1"></i>Share File</a>-->

                                         <!--</li>-->
                                       
                                      <li>
                                                    <div class="custom-accordion">
                                                        <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#employee-folder-collapse" role="button" aria-expanded="true" aria-controls="employee-folder-collapse">
                                                            <i class="mdi mdi-folder font-size-20 text-warning me-2"></i>Employee Folders<i class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                                        </a>
                                                        <div class="collapse show" id="employee-folder-collapse">
                                                            <div class="card border-0 shadow-none ps-2 mb-0">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li>
                                                                        <a href="#" class="text-body d-flex align-items-center open-department-folder">
                                                                            <i class="mdi mdi-file font-size-20 text-warning me-2"></i><span class="me-auto">Show All</span>
                                                                        </a>
                                                                    </li>
                                                                    <?php $__currentLoopData = $empfolders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li>
                                                                        <a href="#" class="text-body d-flex align-items-center open-files" data-id="<?php echo e($folder->id); ?>">
                                                                            <i class="mdi mdi-file font-size-20 text-warning me-2"></i><span class="me-auto"><?php echo e(str_replace('_', ' ', $folder->folder_name)); ?></span>
                                                                        </a>
                                                                    </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                                <li>
                                                    <div class="custom-accordion">
                                                        <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#department-folder-collapse" role="button" aria-expanded="true" aria-controls="department-folder-collapse">
                                                            <i class="mdi mdi-folder font-size-20 text-warning me-2"></i>Department Folder<i class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                                        </a>
                                                        <div class="collapse show" id="department-folder-collapse">
                                                            <div class="card border-0 shadow-none ps-2 mb-0">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li>
                                                                        <a href="#" class="text-body d-flex align-items-center open-department-folder">
                                                                            <i class="mdi mdi-file font-size-20 text-warning me-2"></i><span class="me-auto">Show All</span>
                                                                        </a>
                                                                    </li>
                                                                    <?php $__currentLoopData = $department_folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li>
                                                                        <a href="#" class="text-body d-flex align-items-center open-files" data-id="<?php echo e($folder->id); ?>">
                                                                            <i class="mdi mdi-file font-size-20 text-warning me-2"></i><span class="me-auto"><?php echo e(substr(str_replace('_', ' ', $folder->folder_name), 0, 22)); ?></span>
                                                                        </a>
                                                                    </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                                <li>
                                                    <div class="custom-accordion">
                                                        <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#all-folder-collapse" role="button" aria-expanded="true" aria-controls="all-folder-collapse">
                                                            <i class="mdi mdi-folder font-size-20 text-warning me-2"></i>Other Folder<i class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                                        </a>
                                                        <div class="collapse show" id="all-folder-collapse">
                                                            <div class="card border-0 shadow-none ps-2 mb-0">
                                                                <ul class="list-unstyled mb-0">
                                                                    <!--<li>-->
                                                                    <!--    <a href="#" class="text-body d-flex align-items-center open-department-folder">-->
                                                                    <!--        <i class="mdi mdi-file font-size-20 text-warning me-2"></i><span class="me-auto">Show All</span>-->
                                                                    <!--    </a>-->
                                                                    <!--</li>-->
                                                                    <?php $__currentLoopData = $adminfolders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li>
                                                                        <a href="#" class="text-body d-flex align-items-center open-files" data-id="<?php echo e($folder->id); ?>">
                                                                            <i class="mdi mdi-file font-size-20 text-warning me-2"></i><span class="me-auto"><?php echo e(str_replace('_', ' ', $folder->folder_name)); ?></span>
                                                                        </a>
                                                                    </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                            
                                            <!--<li>-->
                                            <!--    <a href="javascript: void(0);" class="text-body d-flex align-items-center">-->
                                            <!--        <i class="mdi mdi-trash-can text-danger font-size-20 me-2"></i> <span class="me-auto">Trash</span>-->
                                            <!--    </a>-->
                                            <!--</li>-->
                                            <!-- <li>
                                                <a href="javascript: void(0);" class="text-body d-flex align-items-center">
                                                    <i class="mdi mdi-cog text-muted font-size-20 me-2"></i> <span class="me-auto">Setting</span>
                                                </a>
                                            </li> -->
                                              <li>
                                            <div class="custom-accordion">
                                                <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#recent-files-collapse" role="button" aria-expanded="true" aria-controls="recent-files-collapse">
                                                    <i class="mdi mdi-file-clock font-size-20 text-muted me-2"></i>Recent Files<i class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                                </a>
                                                <div class="collapse show" id="recent-files-collapse">
                                                    <div class="card border-0 shadow-none ps-2 mb-0">
                                                         <ul class="list-unstyled mb-0">
                                                                    <li>
                                                                        <a href="#" class="text-body d-flex align-items-center open-all-files">
                                                                            <i class="mdi mdi-file font-size-20 text-warning me-2"></i><span class="me-auto">Show All</span>
                                                                        </a>
                                                                    </li>
                                                                    <?php $__currentLoopData = $recent_files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent_file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li class="d-flex">
                                                                        <a href="#"  class="text-body d-flex align-items-center ">

                                                                    
                                                                      <?php switch($recent_file->type):
                                                                            case ('image'): ?>
                                                                                <i class="mdi mdi-image font-size-20 text-info me-2"></i>
                                                                                <?php break; ?>
                                                                    
                                                                            <?php case ('audio'): ?>
                                                                                <i class="mdi mdi-music font-size-20 text-warning me-2"></i>
                                                                                <?php break; ?>
                                                                    
                                                                            <?php case ('document'): ?>
                                                                                <i class="mdi mdi-file font-size-20 text-primary me-2"></i>
                                                                                <?php break; ?>
                                                                                <?php case ('video'): ?>
                                                                                <i class="mdi mdi-video font-size-20 text-success me-2"></i>
                                                                                <?php break; ?>
                                                                    
                                                                            <?php case ('other'): ?>
                                                                            <?php default: ?>
                                                                                <i class="mdi mdi-file-document-multiple-outline font-size-20 text-warning me-2"></i>
                                                                                <?php break; ?>
                                                                        <?php endswitch; ?>
        
                                                                    
                                                                    <span class="me-auto"><?php echo e($recent_file->document_name); ?></span></a>
                                                                    
                                                                  
                                                                    </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                                                </ul>
                                                                
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                            
                                        </ul>
                                    </div>
                                    <div>
                                        
                                        <!--<h6>Favourite Files</h6>-->
                                        <!--<ul class="list-unstyled categories-list">-->
                                        <!--    <li>-->
                                        <!--        <div class="custom-accordion">-->
                                        <!--            <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#categories-collapse" role="button" aria-expanded="true" aria-controls="categories-collapse">-->
                                        <!--                <i class="mdi mdi-file-document-outline font-size-20 text-primary me-2"></i>DOC-->
                                        <!--            </a>-->
                                        <!--        </div>-->
                                        <!--    </li>-->
                                        <!--    <li>-->
                                        <!--        <div class="custom-accordion">-->
                                        <!--            <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#categories-collapse" role="button" aria-expanded="true" aria-controls="categories-collapse">-->
                                        <!--                <i class="mdi mdi-file-image font-size-20 text-success me-2"></i>IMG-->
                                        <!--            </a>-->
                                        <!--        </div>-->
                                        <!--    </li>-->
                                        <!--</ul>-->
                                    </div>
                                </div>
                                <!--<div class="mt-auto">-->
                                <!--    <form action="#" class="dropzone dz-clickable">-->
                                        
                                <!--        <div class="dz-message needsclicks m-0">-->
                                <!--            <div class="mb-3">-->
                                <!--                <i class="display-4 text-muted mdi mdi-cloud-upload"></i>-->
                                <!--            </div>-->
        
                                <!--            <h5>Drop Your Files Here</h5>-->
                                <!--        </div>-->
                                <!--    </form>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                    <!-- filemanager-leftsidebar -->
        
                    <div class="w-100">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-xl-6 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-warning fs-1">
                                                        <i class="mdi mdi-file"></i>
                                                    </div>
                                                    <p class="text-muted mb-0"><?php echo e(count($docFile)); ?> files</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--end col-->
        
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-success fs-1">
                                                        <i class="mdi mdi-image"></i>
                                                    </div>
                                                    <p class="text-muted mb-0"><?php echo e(count($imgFile)); ?> images</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--end col-->
        
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-info fs-1">
                                                        <i class="mdi mdi-video"></i>
                                                    </div>
                                                    <p class="text-muted mb-0"><?php echo e(count($videoFile)); ?> videos</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--end col-->
        
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-warning fs-1">
                                                        <i class="mdi mdi-headphones"></i>
                                                    </div>
                                                    <p class="text-muted mb-0"><?php echo e(count($audioFile)); ?> files</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!--end col-->
                                </div> <!--end row-->
        
                                <h5 class="font-size-16 me-3 mb-0 mt-4" id="div_name">Department Folders</h5>
                                    <div class="row mt-4" id="folders-container">
                                        <?php if($department_folders): ?>
                                       <?php $__currentLoopData = $department_folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department_folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($department_folder->id >= 1 && $department_folder->id <= 5): ?>
                                                        <?php
                                                            $count_files = App\Models\File::where('folder_id', $department_folder->id)->count();
                                                    $LstFile = App\Models\File::where('folder_id', $department_folder->id)->latest()->first(); // Get the latest file in the folder
                                                    $ids = explode(',', $department_folder->share_ids); // Convert comma-separated string to an array
                                                    $users = App\Models\User::whereIn('id', $ids)
                                                                            ->select('id', 'first_name', 'last_name', 'profile_img')
                                                                            ->get();
                                                ?>
                                                <div class="col-xl-6 col-sm-6 mb-3 mt-2">
                                                    <div class="card ">
                                                        <div class="card-body p-3">
                                                            <div class="dropdown float-end">
                                                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                    <i class="mdi mdi-dots-horizontal font-size-20"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item edit-folder" href="#" data-id="<?php echo e($department_folder->id); ?>" data-name="<?php echo e($department_folder->folder_name); ?>" data-bs-target="#edit-folder" data-bs-toggle="modal">Edit</a>
                                                                    <a class="dropdown-item share-folders" href="#" data-id="<?php echo e($department_folder->id); ?>" data-name="<?php echo e($department_folder->folder_name); ?>" data-bs-target="#share-folder" data-bs-toggle="modal">Share</a>
                                                                    <?php if($department_folder->id > 5): ?>
                                                                        <a class="dropdown-item delete-folder" href="#" data-id="<?php echo e($department_folder->id); ?>">Remove</a>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="overflow-hidden">
                                                                <div class="me-3">
                                                                    <div class="avatar-sm align-self-center">
                                                                        <div class="avatar-title rounded-circle bg-success-subtle text-success font-size-24" style="background-color:#f5cca69c">
                                                                            <i class="mdi mdi-folder font-size-30 text-warning mr-2"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3 pt-1 open-files" data-id="<?php echo e($department_folder->id); ?>">
                                                                <h5 class="font-size-15 mb-1 text-truncate"><?php echo e(substr(str_replace('_', ' ', $department_folder->folder_name), 0, 22)); ?></h5>
                                                                <div class="d-flex justify-content-between">
                                                                    <!--<p class="text-muted font-size-13">15GB <span>/</span> 25GB used</p>-->
                                                                    <p class="text-muted font-size-13"><?php echo e($count_files); ?> files</p>
                                                                </div>
                                                            </div>
                                                            
                                                             <?php if($department_folder && $department_folder->share_ids): ?>
            <div class="overflow-hidden d-flex">
                
                     
                        <div class="avatar-group d-flex">
                                                            <?php
                                                             $ids = explode(',', $department_folder->share_ids); // Convert comma-separated string to an array
                                                             $users = App\Models\User::whereIn('id', $ids)
                                                                            ->select('id', 'first_name', 'last_name', 'profile_img')
                                                                            ->get();
                                                            ?>
                                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div class="avatar-group-item">
                                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                                <?php if($user->profile_img): ?>
                                                                                <img src="<?php echo e($user->profile_img); ?>" alt="" class="rounded-circle avatar-xs">
                                                                                <?php else: ?>
                                                                             <img src="<?php echo e(url('/')); ?>/public/images/profile_Ri1o.jpeg" alt="" class="rounded-circle avatar-xs">
                                                                                <?php endif; ?>
                                                                            </a>
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>
            </div>
            <?php endif; ?>
                                                            <div class="">
                                                                <p class="text-muted mb-0 font-size-13"><i class="mdi mdi-clock-time-five-outline align-middle me-1"></i>Last changes: <?php echo e($LstFile ? $LstFile->created_at : '--'); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                     <div class="row mt-4" id="files-container"> <div id="dynamic-content"></div></div>
                                     
                                     
                                     <div class="row mt-4" id="all-files-container"> <div id="dynamic-file-content"></div></div>
                                <h5 class="font-size-16 me-3 mb-0 mt-4">Shared Folders</h5>
        
                               <div class="row mt-4 mb-4">
                                    <?php if(count($shared_folders) > 0): ?>
                                        <?php $__currentLoopData = $shared_folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sharedEmployee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <?php
                                                    $LstFile = App\Models\File::where('folder_id', $sharedEmployee->id)->latest()->first(); // Get the latest file in the folder
                                                    $countFile = App\Models\File::where('folder_id', $sharedEmployee->id)->count();
                                                    $ids = explode(',', $sharedEmployee->share_ids); // Convert comma-separated string to an array
                                                    $users = App\Models\User::whereIn('id', $ids)
                                                                            ->select('id', 'first_name', 'last_name', 'profile_img')
                                                                            ->get();
                                                ?>
                                            <div class="col-xl-6 col-sm-6 mt-4">
                                                <div class="card">
                                                    <div class="card-body p-3">
                                                        <div class="open-files" data-id="<?php echo e($sharedEmployee->id); ?>">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <i class="mdi mdi-folder display-4 mb-0 text-warning"></i>
                                                                </div>
                                                                <div class="avatar-group d-flex overflow-hidden">
                                                                    
                                                                     <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                                                                      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teaml): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="<?php echo e($teaml->first_name); ?>">
                                                                         <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($teaml->profile_img) ? $teaml->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />
                                                                      </li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </ul>
                                                                
                                                                </div>
                                                            </div>
                                                            <div class="d-flex mt-3">
                                                                <div class="overflow-hidden me-auto">
                                                                    <h5 class="font-size-15 text-truncate mb-1"><a href="javascript: void(0);" class="text-body"><?php echo e(substr(str_replace('_', ' ', $sharedEmployee->folder_name), 0, 22)); ?></a></h5>
                                                                    <p class="text-muted text-truncate mb-0"><?php echo e($countFile); ?> Files</p>
                                                                </div>
                                                                 <div class="align-self-end ms-2">
                                                                    <p class="text-muted mb-0 font-size-13"><i class="bx mdi mdi-clock-time-five-outline align-middle me-1"></i> <?php echo e($LstFile ? $LstFile->created_at->diffForHumans() : '--'); ?></p>
                                                                 </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php else: ?>
                                     <div class="col-xl-4 col-sm-6">
                                         <h5>No Record Found</h5>
                                         </div>
                                    <?php endif; ?>
                                   
                                    
                                    <!-- end col -->
        
                                  
        
                                </div>
                                
                                  <h5 class="font-size-16 me-3 mb-0 mt-4">Shared Sub Folders</h5>
        
                               <div class="row mt-4">
                                    <?php if(count($shared_sub_folders) > 0): ?>
                                        <?php $__currentLoopData = $shared_sub_folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sharedEmployee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <?php
                                                    $LstFile = App\Models\File::where('sub_folder_id', $sharedEmployee->id)->latest()->first(); // Get the latest file in the folder
                                                    $countFile = App\Models\File::where('sub_folder_id', $sharedEmployee->id)->count();
                                                    $ids = explode(',', $sharedEmployee->share_ids); // Convert comma-separated string to an array
                                                    $users = App\Models\User::whereIn('id', $ids)
                                                                            ->select('id', 'first_name', 'last_name', 'profile_img')
                                                                            ->get();
                                                ?>
                                            <div class="col-xl-4 col-sm-6 mt-4">
                                                <div class="card">
                                                    <div class="card-body p-3">
                                                        <div class="open-subfolders-files" data-id="<?php echo e($sharedEmployee->id); ?>">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <i class="mdi mdi-folder display-4 mb-0 text-warning"></i>
                                                                </div>
                                                                <div class="avatar-group d-flex overflow-hidden">
                                                                    
                                                                     <ul class="list-unstyled m-0 d-flex align-items-center avatar-group my-3">
                                                                      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teaml): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" data-bs-original-title="<?php echo e($teaml->first_name); ?>">
                                                                         <img class="rounded-circle" style="margin-right: 15px;margin-top: 10px;" src="<?php echo e(isset($teaml->profile_img) ? $teaml->profile_img : url('public/images/21104.png')); ?>" height="30" width="30" alt="User avatar" />
                                                                      </li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </ul>
                                                                
                                                                </div>
                                                            </div>
                                                            <div class="d-flex mt-3">
                                                                <div class="overflow-hidden me-auto">
                                                                    <h5 class="font-size-15 text-truncate mb-1"><a href="javascript: void(0);" class="text-body"><?php echo e(substr(str_replace('_', ' ', $sharedEmployee->sub_folder_name), 0, 22)); ?></a></h5>
                                                                    <p class="text-muted text-truncate mb-0"><?php echo e($countFile); ?> Files</p>
                                                                </div>
                                                                 <div class="align-self-end ms-2">
                                                                    <p class="text-muted mb-0 font-size-13"><i class="bx mdi mdi-clock-time-five-outline align-middle me-1"></i> <?php echo e($LstFile ? $LstFile->created_at->diffForHumans() : '--'); ?></p>
                                                                 </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php else: ?>
                                     <div class="col-xl-4 col-sm-6">
                                         <h5>No Record Found</h5>
                                         </div>
                                    <?php endif; ?>
                                   
                                    
                                    <!-- end col -->
        
                                  
        
                                </div>
                                <!-- End row -->
        
                                <!--<h5 class="font-size-16 me-3 mb-0 mt-4">Recent Files</h5>-->
                                <!--<div class="mx-n4 px-4 mt-4 -scrollable-y" data-="init" style="max-height: 350px;"><div class="-wrapper" style="margin: 0px -24px;"><div class="-height-auto-observer-wrapper"><div class="-height-auto-observer"></div></div><div class="-mask">-->
                                <!--    <div class="-offset" style="right: 0px; bottom: 0px;"><div class="-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;height:358px;"><div class="-content" style="padding: 0px 24px;">-->
                                <!--    <div class="table-responsive">-->
        
                                <!--        <table class="table align-middle table-nowrap table-hover mb-0">-->
                                <!--            <thead class="table-light">-->
                                <!--                <tr>-->
                                <!--                    <th scope="col">Name</th>-->
                                <!--                    <th scope="col">Date modified</th>-->
                                <!--                    <th scope="col">Size</th>-->
                                <!--                    <th scope="col" colspan="2">Members</th>-->
                                <!--                </tr>-->
                                <!--            </thead>-->
                                <!--            <tbody>-->
                                <!--                <tr>-->
                                <!--                    <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-file-document font-size-20 align-middle text-primary me-2"></i> index.html</a></td>-->
                                <!--                    <td>18-07-2022</td>-->
                                <!--                    <td>09 KB</td>-->
                                <!--                    <td>-->
                                <!--                        <div class="avatar-group d-flex">-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="<?php echo e(url('/')); ?>/public/images/profile_Ri1o.jpeg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="<?php echo e(url('/')); ?>/public/images/profile_Ri1o.jpeg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <div class="avatar-xs">-->
                                <!--                                        <span class="avatar-title rounded-circle bg-success text-white font-size-15">-->
                                <!--                                            A-->
                                <!--                                        </span>-->
                                <!--                                    </div>-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                    <td>-->
                                <!--                        <div class="dropdown">-->
                                <!--                            <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                <!--                                <i class="mdi mdi-dots-horizontal"></i>-->
                                <!--                            </a>-->
        
                                <!--                            <div class="dropdown-menu dropdown-menu-end" style="">-->
                                <!--                                <a class="dropdown-item" href="#">Open</a>-->
                                <!--                                <a class="dropdown-item" href="#">Edit</a>-->
                                <!--                                <a class="dropdown-item" href="#">Rename</a>-->
                                <!--                                <div class="dropdown-divider"></div>-->
                                <!--                                <a class="dropdown-item" href="#">Remove</a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                </tr>-->
                                <!--                <tr>-->
                                <!--                    <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-folder-zip font-size-20 align-middle text-warning me-2"></i> Project-A.zip</a></td>-->
                                <!--                    <td>18-07-2022</td>-->
                                <!--                    <td>115 KB</td>-->
                                <!--                    <td>-->
                                <!--                        <div class="avatar-group d-flex">-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                    <td>-->
                                <!--                        <div class="dropdown">-->
                                <!--                            <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">-->
                                <!--                                <i class="mdi mdi-dots-horizontal"></i>-->
                                <!--                            </a>-->
        
                                <!--                            <div class="dropdown-menu dropdown-menu-end">-->
                                <!--                                <a class="dropdown-item" href="#">Open</a>-->
                                <!--                                <a class="dropdown-item" href="#">Edit</a>-->
                                <!--                                <a class="dropdown-item" href="#">Rename</a>-->
                                <!--                                <div class="dropdown-divider"></div>-->
                                <!--                                <a class="dropdown-item" href="#">Remove</a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                </tr>-->
                                <!--                <tr>-->
                                <!--                    <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-image font-size-20 align-middle text-muted me-2"></i> Img-1.jpeg</a></td>-->
                                <!--                    <td>18-07-2022</td>-->
                                <!--                    <td>86 KB</td>-->
                                <!--                    <td>-->
                                <!--                        <div class="avatar-group d-flex">-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <div class="avatar-xs">-->
                                <!--                                        <span class="avatar-title rounded-circle bg-info text-white font-size-15">-->
                                <!--                                            M-->
                                <!--                                        </span>-->
                                <!--                                    </div>-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                    <td>-->
                                <!--                        <div class="dropdown">-->
                                <!--                            <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">-->
                                <!--                                <i class="mdi mdi-dots-horizontal"></i>-->
                                <!--                            </a>-->
        
                                <!--                            <div class="dropdown-menu dropdown-menu-end">-->
                                <!--                                <a class="dropdown-item" href="#">Open</a>-->
                                <!--                                <a class="dropdown-item" href="#">Edit</a>-->
                                <!--                                <a class="dropdown-item" href="#">Rename</a>-->
                                <!--                                <div class="dropdown-divider"></div>-->
                                <!--                                <a class="dropdown-item" href="#">Remove</a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                </tr>-->
                                <!--                <tr>-->
                                <!--                    <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-text-box font-size-20 align-middle text-muted me-2"></i> update list.txt</a></td>-->
                                <!--                    <td>18-07-2022</td>-->
                                <!--                    <td>08 KB</td>-->
                                <!--                    <td>-->
                                <!--                        <div class="avatar-group d-flex">-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                    <td>-->
                                <!--                        <div class="dropdown">-->
                                <!--                            <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">-->
                                <!--                                <i class="mdi mdi-dots-horizontal"></i>-->
                                <!--                            </a>-->
        
                                <!--                            <div class="dropdown-menu dropdown-menu-end">-->
                                <!--                                <a class="dropdown-item" href="#">Open</a>-->
                                <!--                                <a class="dropdown-item" href="#">Edit</a>-->
                                <!--                                <a class="dropdown-item" href="#">Rename</a>-->
                                <!--                                <div class="dropdown-divider"></div>-->
                                <!--                                <a class="dropdown-item" href="#">Remove</a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                </tr>-->
                                <!--                <tr>-->
                                <!--                    <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-folder font-size-20 align-middle text-warning me-2"></i> Project B</a></td>-->
                                <!--                    <td>18-07-2022</td>-->
                                <!--                    <td>72 KB</td>-->
                                <!--                    <td>-->
                                <!--                        <div class="avatar-group d-flex">-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <div class="avatar-xs">-->
                                <!--                                        <span class="avatar-title rounded-circle bg-danger text-white font-size-15">-->
                                <!--                                            3+-->
                                <!--                                        </span>-->
                                <!--                                    </div>-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                    <td>-->
                                <!--                        <div class="dropdown">-->
                                <!--                            <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">-->
                                <!--                                <i class="mdi mdi-dots-horizontal"></i>-->
                                <!--                            </a>-->
        
                                <!--                            <div class="dropdown-menu dropdown-menu-end">-->
                                <!--                                <a class="dropdown-item" href="#">Open</a>-->
                                <!--                                <a class="dropdown-item" href="#">Edit</a>-->
                                <!--                                <a class="dropdown-item" href="#">Rename</a>-->
                                <!--                                <div class="dropdown-divider"></div>-->
                                <!--                                <a class="dropdown-item" href="#">Remove</a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                </tr>-->
                                <!--                <tr>-->
                                <!--                    <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-text-box font-size-20 align-middle text-muted me-2"></i> Changes list.txt</a></td>-->
                                <!--                    <td>08-07-2022</td>-->
                                <!--                    <td>07 KB</td>-->
                                <!--                    <td>-->
                                <!--                        <div class="avatar-group d-flex">-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                    <td>-->
                                <!--                        <div class="dropdown">-->
                                <!--                            <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">-->
                                <!--                                <i class="mdi mdi-dots-horizontal"></i>-->
                                <!--                            </a>-->
        
                                <!--                            <div class="dropdown-menu dropdown-menu-end">-->
                                <!--                                <a class="dropdown-item" href="#">Open</a>-->
                                <!--                                <a class="dropdown-item" href="#">Edit</a>-->
                                <!--                                <a class="dropdown-item" href="#">Rename</a>-->
                                <!--                                <div class="dropdown-divider"></div>-->
                                <!--                                <a class="dropdown-item" href="#">Remove</a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                </tr>-->
                                <!--                <tr>-->
                                <!--                    <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-image font-size-20 align-middle text-success me-2"></i> Img-2.png</a></td>-->
                                <!--                    <td>08-07-2022</td>-->
                                <!--                    <td>31 KB</td>-->
                                <!--                    <td>-->
                                <!--                        <div class="avatar-group d-flex">-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <div class="avatar-xs">-->
                                <!--                                        <span class="avatar-title rounded-circle bg-pink text-white font-size-15">-->
                                <!--                                            L-->
                                <!--                                        </span>-->
                                <!--                                    </div>-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                    <td>-->
                                <!--                        <div class="dropdown">-->
                                <!--                            <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">-->
                                <!--                                <i class="mdi mdi-dots-horizontal"></i>-->
                                <!--                            </a>-->
        
                                <!--                            <div class="dropdown-menu dropdown-menu-end">-->
                                <!--                                <a class="dropdown-item" href="#">Open</a>-->
                                <!--                                <a class="dropdown-item" href="#">Edit</a>-->
                                <!--                                <a class="dropdown-item" href="#">Rename</a>-->
                                <!--                                <div class="dropdown-divider"></div>-->
                                <!--                                <a class="dropdown-item" href="#">Remove</a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                </tr>-->
                                <!--                <tr>-->
                                <!--                    <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-folder font-size-20 align-middle text-warning me-2"></i> Project C</a></td>-->
                                <!--                    <td>08-07-2022</td>-->
                                <!--                    <td>20 KB</td>-->
                                <!--                    <td>-->
                                <!--                        <div class="avatar-group d-flex">-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <div class="avatar-xs">-->
                                <!--                                        <span class="avatar-title rounded-circle bg-success text-white font-size-15">-->
                                <!--                                            A-->
                                <!--                                        </span>-->
                                <!--                                    </div>-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                    <td>-->
                                <!--                        <div class="dropdown">-->
                                <!--                            <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">-->
                                <!--                                <i class="mdi mdi-dots-horizontal"></i>-->
                                <!--                            </a>-->
        
                                <!--                            <div class="dropdown-menu dropdown-menu-end">-->
                                <!--                                <a class="dropdown-item" href="#">Open</a>-->
                                <!--                                <a class="dropdown-item" href="#">Edit</a>-->
                                <!--                                <a class="dropdown-item" href="#">Rename</a>-->
                                <!--                                <div class="dropdown-divider"></div>-->
                                <!--                                <a class="dropdown-item" href="#">Remove</a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                </tr>-->
                                <!--                <tr>-->
                                <!--                    <td><a href="javascript: void(0);" class="text-dark fw-medium"><i class="mdi mdi-file font-size-20 align-middle text-primary me-2"></i> starter-page.html</a></td>-->
                                <!--                    <td>08-07-2022</td>-->
                                <!--                    <td>11 KB</td>-->
                                <!--                    <td>-->
                                <!--                        <div class="avatar-group d-flex">-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                            <div class="avatar-group-item">-->
                                <!--                                <a href="javascript: void(0);" class="d-inline-block">-->
                                <!--                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xs">-->
                                <!--                                </a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                    <td>-->
                                <!--                        <div class="dropdown">-->
                                <!--                            <a class="font-size-16 text-muted" role="button" data-bs-toggle="dropdown" aria-haspopup="true">-->
                                <!--                                <i class="mdi mdi-dots-horizontal"></i>-->
                                <!--                            </a>-->
        
                                <!--                            <div class="dropdown-menu dropdown-menu-end">-->
                                <!--                                <a class="dropdown-item" href="#">Open</a>-->
                                <!--                                <a class="dropdown-item" href="#">Edit</a>-->
                                <!--                                <a class="dropdown-item" href="#">Rename</a>-->
                                <!--                                <div class="dropdown-divider"></div>-->
                                <!--                                <a class="dropdown-item" href="#">Remove</a>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </td>-->
                                <!--                </tr>-->
                                <!--            </tbody>-->
                                <!--        </table>-->
                                <!--    </div>-->
                                <!--</div></div></div></div></div><div class="-track -horizontal" style="visibility: hidden;"><div class="-scrollbar" style="width: 0px; display: none;"></div></div><div class="-track -vertical" style="visibility: visible;"><div class="-scrollbar" style="height: 219px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>-->
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end w-100 -->
                </div>
                </div>
                <div class="card filemanager-sidebar ms-md-3">
                    <div class="card-body">
                        <div class="d-flex flex-column h-100">
                            <div class="">
                                <div class="text-center">
                                    <h5 class="font-size-16 mb-3">Activity Chart</h5>
                                    <div style="display:inline;width:150px;height:200px;"><canvas width="187" height="250" style="width: 150px; height: 200px;"></canvas><input class="knob" data-width="150" data-angleoffset="5" data-linecap="round" data-fgcolor="#67a8e4" value="50" style="width: 79px; height: 50px; position: absolute; vertical-align: middle; margin-top: 50px; margin-left: -114px; border: 0px; background: none; font: bold 30px Arial; text-align: center; color: rgb(103, 168, 228); padding: 0px; appearance: none;"></div>
                                    <p class="text-muted"><?php if($formattedSize): ?><?php echo e($formattedSize); ?> <?php else: ?> 0KB <?php endif; ?> used</p>
                                </div>
            
                                <h5 class="font-size-16 mb-0">Details Storage</h5>
            
                           <div class="mt-4">
    <div class="mt-4">
        <?php $__currentLoopData = ['Images', 'Videos', 'Audios', 'Documents']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="pb-2 mb-2">
                <a href="javascript:void(0);" class="text-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar align-self-center me-3">
                            <div class="avatar-title rounded bg-transparent text-success fs-2">
                                <?php if($type == 'Images'): ?>
                                    <i class="mdi mdi-image"></i>
                                <?php elseif($type == 'Videos'): ?>
                                    <i class="mdi mdi-play-circle-outline"></i>
                                <?php elseif($type == 'Audios'): ?>
                                    <i class="mdi mdi-music"></i>
                                <?php elseif($type == 'Documents'): ?>
                                    <i class="mdi mdi-file-document"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="overflow-hidden me-auto">
                            <h5 class="font-size-13 text-truncate mb-1"><?php echo e($type); ?></h5>
                            <p class="font-size-13 text-muted text-truncate mb-0">
                                <?php if($type == 'Images'): ?>
                                    <?php echo e(count($imgFile)); ?> Files
                                <?php elseif($type == 'Videos'): ?>
                                    <?php echo e(count($videoFile)); ?> Files
                                <?php elseif($type == 'Audios'): ?>
                                    <?php echo e(count($audioFile)); ?> Files
                                <?php elseif($type == 'Documents'): ?>
                                    <?php echo e(count($docFile)); ?> Files
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="ms-2">
                            <p class="text-muted font-size-13">
                                <?php if($type == 'Images'): ?>
                                    <?php echo e($imageSizeFormatted); ?>

                                <?php elseif($type == 'Videos'): ?>
                                    <?php echo e($videoSizeFormatted); ?>

                                <?php elseif($type == 'Audios'): ?>
                                    <?php echo e($audioSizeFormatted); ?>

                                <?php elseif($type == 'Documents'): ?>
                                    <?php echo e($documentSizeFormatted); ?>

                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <div class="progress progress-sm animated-progess custom-progress">
                        <div class="progress-bar bg-gradient bg-success" role="progressbar" style="width: 
                            <?php if($type == 'Images'): ?>
                                <?php echo e($imagePercentage); ?>%
                            <?php elseif($type == 'Videos'): ?>
                                <?php echo e($videoPercentage); ?>%
                            <?php elseif($type == 'Audios'): ?>
                                <?php echo e($audioPercentage); ?>%
                            <?php elseif($type == 'Documents'): ?>
                                <?php echo e($documentPercentage); ?>%
                            <?php endif; ?>
                            " aria-valuenow="
                            <?php if($type == 'Images'): ?>
                                <?php echo e($imagePercentage); ?>

                            <?php elseif($type == 'Videos'): ?>
                                <?php echo e($videoPercentage); ?>

                            <?php elseif($type == 'Audios'): ?>
                                <?php echo e($audioPercentage); ?>

                            <?php elseif($type == 'Documents'): ?>
                                <?php echo e($documentPercentage); ?>

                            <?php endif; ?>
                            " aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

                                
                                    <div class="mt-auto text-center">
                                        <div class="card mb-0 bg-primary-subtle">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--for create folder-->
<div class="modal fade" id="add-folder" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content ">
            <form action="<?php echo e(url('admin/FileManagement/store-folder')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h4>Create Folder</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body">
                    <label>Folder Name</label>
                    <input type="text" class="form-control" name="folder_name" placeholder="Folder Name" required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--for create folder end-->
<!--for edit folder-->
<div class="modal fade" id="edit-folder" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?php echo e(url('admin/FileManagement/update-folder')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h4>Edit Folder</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body">
                    <label>Folder Name</label>
                    <input type="text" class="form-control" name="folder_name" id="folder_name_edit" placeholder="Folder Name" required />
                    <input type="hidden" class="form-control" name="folder_id" id="folder_id_edit" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--share folder-->
<div class="modal fade" id="share-folder" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?php echo e(url('admin/FileManagement/share-folder')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h4>Share Folder</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body">
                    <label>Folder</label>
                    <input type="text" class="form-control" name="folder_name" id="share_folder_name" placeholder="Folder Name" required readonly />
                    <input type="hidden" class="form-control" name="folder_id" id="share_folder_id" />
                </div>
                <div class="modal-body">
                    <label>Employee</label>
                    <select class="form-control select2" name="share_employee_id[]" multiple required>
                        <!-- Options will be populated here by jQuery -->
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--create sub folder-->
<div class="modal fade" id="add-sub-folder" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?php echo e(url('admin/FileManagement/store-sub-folder')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h4>Create Sub Folder</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body">
                    <label>Folder</label>
                    <select class="form-control" name="folder_id">
                        <option value="">Select Folder</option>
                        <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($folder1->id); ?>"><?php echo e(str_replace('_', ' ', $folder1->folder_name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="modal-body">
                    <label>Folder Name</label>
                    <input type="text" class="form-control" name="sub_folder_name" placeholder="Sub Folder Name" required />
                </div>
                 <div class="modal-body">
                    <label>Employee</label>
                   <select class="form-control emp_id select2" name="share_ids[]" multiple >
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($emp->id); ?>" data-img-src="<?php echo e($emp->profile_img); ?>"><?php echo e($emp->first_name); ?> <?php echo e($emp->last_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--for create file-->
<div class="modal fade" id="add-file" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?php echo e(url('admin/FileManagement/store-file')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h4>Create File</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="modal-body">
                    <label>Folder</label>
                    <select class="form-control" name="folder_id" id="my_folder">
                        <option value="">Select Folder</option>
                        <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($folder1->id); ?>"><?php echo e(str_replace('_', ' ', $folder1->folder_name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="modal-body">
                    <label>Sub Folder</label>
                    <select class="form-control" name="sub_folder_id" id="my_sub_folder">
                    <!--    <option value="">Select Sub Folder</option>-->
                    <!--    <?php $__currentLoopData = $sub_folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                    <!--        <option value="<?php echo e($folder->id); ?>"><?php echo e($folder->sub_folder_name); ?></option>-->
                    <!--    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                    </select>
                </div>
                
                <!--<div class="modal-body">-->
                <!--    <label>File Name</label>-->
                <!--    <input type="text" class="form-control" name="document_name" placeholder="File Name" required />-->
                <!--</div>-->
                <div class="modal-body">
                    <label>File</label>
                    <input type="file" class="form-control" name="file" placeholder="File" required />
                </div>
                 <div class="modal-body">
                    <label>Employee</label>
                   <select class="form-control emp_id select2" id="share_ids" name="share_ids[]" multiple >
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($emp->id); ?>" data-img-src="<?php echo e($emp->profile_img); ?>"><?php echo e($emp->first_name); ?> <?php echo e($emp->last_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    // document.addEventListener('DOMContentLoaded', function () {
    //     var editFolderLinks = document.querySelectorAll('.edit-folder');
    //     var folderIdInput = document.getElementById('folder_id');
    //     var folderNameInput = document.getElementById('folder_name'); // Ensure the ID matches the input ID

    //     editFolderLinks.forEach(function (link) {
    //         link.addEventListener('click', function () {
    //             var folderId = this.getAttribute('data-id');
    //             var folderName = this.getAttribute('data-name');
    //             folderIdInput.value = folderId;
    //             folderNameInput.value = folderName; // Set the folder name
    //         });
    //     });
    // });


$(document).ready(function () {
 $(document).on('click', '.edit-sub-folder', function (e) {
    e.preventDefault();
    var folderId = $(this).data('id');
    var folderName = $(this).data('name').replace(/_/g, ' '); // Replace underscores with spaces
    $('#folder_id_edit_sub').val(folderId);
    $('#folder_name_edit_sub').val(folderName);
});


// Function to handle click on edit folder links
$(document).on('click', '.edit-folder', function (e) {
    e.preventDefault();
    var folderId = $(this).data('id');
    var folderName = $(this).data('name').replace(/_/g, ' '); // Replace underscores with spaces
    $('#folder_id_edit').val(folderId);
    $('#folder_name_edit').val(folderName);
});

$(document).on('change', '#my_folder', function (e) {
    e.preventDefault();
    var folderId = $(this).val();
    var subFolderSelect = $('#my_sub_folder');

    $.ajax({
        url: '<?php echo e(url('admin/FileManagement/get-sub-folders')); ?>',
        type: 'GET',
        data: {
            _token: '<?php echo e(csrf_token()); ?>',
            folder_id: folderId
        },
        success: function (data) {
            subFolderSelect.empty();

            // If data is empty, display "No sub-folders found" message
            if (data.length === 0) {
                subFolderSelect.append('<option value="" disabled>No sub-folders found</option>');
            } else {
                // Add default option for sub-folders at the top
                subFolderSelect.append('<option value="" disabled selected>Select a sub-folder</option>');
                
                // Add options for each sub-folder
                $.each(data, function (key, subFolder) {
                    // Replace underscores with spaces in the subFolder name
                    var subFolderName = subFolder.sub_folder_name.replace(/_/g, ' ');
                    subFolderSelect.append('<option value="' + subFolder.id + '">' + subFolderName + '</option>');
                });
            }
        },
        error: function (xhr) {
            console.error('An error occurred:', xhr.responseText);
        }
    });
});


 function formatState(state) {
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span><img src="' + $(state.element).data('img-src') + '" class="img-flag" /> ' + state.text + '</span>'
        );
        return $state;
    };

    $(document).ready(function() {
        // Initialize Select2 on the specific element by ID when the modal is shown
        $('#add-file').on('shown.bs.modal', function () {
            $('.emp_id').select2({
                dropdownParent: $('#add-file'),
                 templateResult: formatState,
                templateSelection: formatState
            });
        });
    });   
    



  $(document).on('click', '.share-folders', function (e) {
    e.preventDefault();
    var folderId = $(this).data('id');
    var folderName = $(this).data('name');
    $('#share_folder_id').val(folderId);
    $('#share_folder_name').val(folderName);

    // Make an AJAX request to fetch employees
    $.ajax({
        url: '<?php echo e(url('admin/FileManagement/get-employees')); ?>',
        type: 'POST',
        data: {
            _token: '<?php echo e(csrf_token()); ?>',
            folder_id: folderId
        },
        success: function (data) {
            var employeeSelect = $('select[name="share_employee_id[]"]');
            employeeSelect.empty();

            $.each(data, function (key, employee) {
                employeeSelect.append('<option value="' + employee.id + '"data-img-src="'+ employee.profile_img +'">' + employee.first_name + ' ' + employee.last_name + '</option>');
            });

            // Reinitialize select2
            employeeSelect.select2({
                dropdownParent: $('#share-folder'),
                 templateResult: formatState,
                templateSelection: formatState// Ensure the dropdown is displayed within the modal
            });
        },
        error: function (xhr) {
            console.error('An error occurred:', xhr.responseText);
        }
    });
});

$(document).on('click', '.share-sub-folders', function (e) {
    e.preventDefault();
    var sub_folder_id = $(this).data('id');
    var folder_id = $(this).data('folder_id');
    var folderName = $(this).data('name');
    $('#share_folder_id_sub').val(sub_folder_id);
    $('#share_folder_name_sub').val(folderName);
    
    $.ajax({
        url: '<?php echo e(url('admin/FileManagement/get-employees')); ?>',
        type: 'POST',
        data: {
            _token: '<?php echo e(csrf_token()); ?>',
            sub_folder_id: sub_folder_id,
            folder_id: folder_id
        },
        success: function (data) {
            console.log('AJAX success:', data);  // Debugging: Check if data is being received
            var employeeSelect = $('select[name="share_sub_employee_id[]"]');
            employeeSelect.empty();

            $.each(data, function (key, employee) {
                employeeSelect.append('<option value="' + employee.id + '">' + employee.first_name + ' ' + employee.last_name + '</option>');
            });

            console.log('Options added:', employeeSelect.html());  // Debugging: Check if options are added

            // Reinitialize select2
            employeeSelect.select2({
                dropdownParent: $('#share-sub-folder') // Ensure the dropdown is displayed within the modal
            });
        },
        error: function (xhr) {
            console.error('An error occurred:', xhr.responseText);
        }
    });
});


    $(document).ready(function() {
        // Initialize Select2 on the specific element by ID when the modal is shown
        $('#add-sub-folder').on('shown.bs.modal', function () {
            $('.emp_id').select2({
                dropdownParent: $('#add-sub-folder'),
                 templateResult: formatState,
                templateSelection: formatState
            });
        });
    });
    
    // Function to handle click on delete folder links
    $(document).on('click', '.delete-folder', function (e) {
        e.preventDefault();
        var folderId = $(this).data('id');
        var url = '/admin/FileManagement/delete-folder/' + folderId;

        bootbox.confirm({
            message: "Are you sure you want to delete this folder?",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Delete'
                },
            },
            callback: function (result) {
                if (result) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            "_token": "<?php echo e(csrf_token()); ?>",
                        },
                        success: function (response) {
                            if (response.success) {
                                location.reload();
                            } else {
                                bootbox.alert(response.message);
                            }
                        }
                    });
                }
            }
        });
    });
    
    
    $(document).on('click', '.delete-sub-folder', function (e) {
        e.preventDefault();
        var folderId = $(this).data('id');
        var url = '/admin/FileManagement/delete-sub-folder/' + folderId;

        bootbox.confirm({
            message: "Are you sure you want to delete this folder?",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Delete'
                },
            },
            callback: function (result) {
                if (result) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            "_token": "<?php echo e(csrf_token()); ?>",
                        },
                        success: function (response) {
                            if (response.success) {
                                location.reload();
                            } else {
                                bootbox.alert(response.message);
                            }
                        }
                    });
                }
            }
        });
    });

    // Function to handle click on open files links
    $(document).on('click', '.open-files', function (e) {
        e.preventDefault();
        var folderId = $(this).data('id');
        var url = "<?php echo e(url('/')); ?>"+'/admin/FileManagement/view-folder-files/' + folderId;
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function (response) {


                    $("#folders-container").hide();
                    $("#all-files-container").hide();
                    $("#files-container").show();
                    $("#div_name").html('');
                    $("#dynamic-content").html(response);
                
            },
            error: function () {
                bootbox.alert('An error occurred while retrieving the folder files.');
            }
        });
    });    
        // Function to handle click on open files links
    $(document).on('click', '.open-all-files', function (e) {
        e.preventDefault();
        var url = "<?php echo e(url('/')); ?>"+'/admin/FileManagement/view-all-files';
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function (response) {


                    $("#folders-container").hide();
                     $("#files-container").hide();
                    $("#all-files-container").show();
                    $("#div_name").html('All Files');
                    $("#dynamic-file-content").html(response);
                
            },
            error: function () {
                bootbox.alert('An error occurred while retrieving the folder files.');
            }
        });
    });    
    
    // Function to handle click on open files links
  
    
        // for show all folders
    
     $(document).on('click', '.open-department-folder', function () {
        $("#folders-container").show();
        $("#files-container").hide();
        $("#all-files-container").hide();
                            $("#div_name").html('Department Folders');

    });

   $(document).on('click', '.open-subfolders-files', function (e) {
        e.preventDefault();
        var folderId = $(this).data('id');
        var url = "<?php echo e(url('/')); ?>"+'/admin/FileManagement/view-subfolder-files/' + folderId;
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
            },
           success: function (response) {
                    $("#dynamic-file-content").hide();
                    $("#folders-container").hide();
                    $("#files-container").show();
                    $("#div_name").html('Employee Folders');
                    $("#dynamic-content").html(response);
                
                    // Scroll to the files container
                    $('html, body').animate({
                        scrollTop: $("#files-container").offset().top
                    }, 200);
                },
            error: function () {
                bootbox.alert('An error occurred while retrieving the folder files.');
            }
        });
    }); 

    $("#btnradio1").click(function () {
        $("#inner_content_two").show();
        $("#inner_content_one").hide();
        $("#inner_content_three").hide();
    });

    $("#btnradio2").click(function () {
        $("#inner_content_two").hide();
        $("#inner_content_one").show();
        $("#inner_content_three").hide();
    });

    $("#btnradio3").click(function () {
        $("#inner_content_one").hide();
        $("#inner_content_three").show();
    });
});






</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/insighthub/public_html/resources/views/admin/FileManagement/home.blade.php ENDPATH**/ ?>