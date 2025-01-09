@extends('layouts.admin')
@section('title', 'Product')
@section('content')

<style>
@import "https://fonts.googleapis.com/css2?family=Chivo:wght@400;700&family=Noto+Sans:wght@400;700&display=swap";@import "../css/vendors/normalize.css";@import "../css/vendors/bootstrap.min.css";@import "../css/vendors/uicons-regular-rounded.css";@import "../css/vendors/swiper-bundle.min.css";@import "../css/vendors/magnific-popup.css";@import "../css/vendors/select2.min.css";@import "../css/vendors/perfect-scrollbar.css";@import "../css/vendors/animate.min.css";@import "../css/vendors/slick.css";@font-face {
    font-family: uicons-regular-rounded;
    src: url(../fonts/uicons/uicons-regular-rounded.eot#iefix) format("embedded-opentype"),url(../fonts/uicons/uicons-regular-rounded.woff2) format("woff2"),url(../fonts/uicons/uicons-regular-rounded.woff) format("woff")
}

html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline
}
.block-pricing-2 .box-pricing-item:hover .list-package-feature li, .block-pricing-2 .box-pricing-item.active .list-package-feature li {
    background: url('{{url('/')}}/public/logo/check-circle-pink.svg') no-repeat left center;
}

.hieu-test {
    display: none
}

main {
    display: block;
    clear: both
}

thead {
    font-weight: 600
}

article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section {
    display: block
}

body {
    line-height: 1
}

ol,ul {
    list-style: none
}

blockquote,q {
    quotes: none
}

blockquote:before,blockquote:after,q:before,q:after {
    content: "";
    content: none
}

table {
    border-collapse: collapse;
    border-spacing: 0
}

img {
    max-width: 100%
}

input,select,button,textarea {
    font-family: chivo,sans-serif;
    font-size: 14px
}

*:focus,select:focus,.custom-select:focus,button:focus,textarea:focus,textarea.form-control:focus,input.form-control:focus,input[type=text]:focus,input[type=password]:focus,input[type=email]:focus,input[type=number]:focus,[type=text].form-control:focus,[type=password].form-control:focus,[type=email].form-control:focus,[type=tel].form-control:focus,[contenteditable].form-control:focus {
    outline: none!important;
    box-shadow: none!important
}

input:focus::-moz-placeholder {
    opacity: 0;
    -moz-transition: .4s;
    transition: .4s
}

li.hr span {
    width: 100%;
    height: 1px;
    background-color: #e4e4e4;
    margin: 20px 0;
    display: block
}

::-moz-selection {
    background: #006d77;
    color: #fff
}

::selection {
    background: #006d77;
    color: #fff
}

::-moz-selection {
    background: #006d77;
    color: #fff
}

::-moz-placeholder {
    color: #667085;
    opacity: 1
}

::placeholder {
    color: #667085;
    opacity: 1
}

:-ms-input-placeholder,::-webkit-input-placeholder {
    color: #667085;
    opacity: 1
}

.fix {
    overflow: hidden
}

.hidden {
    display: none
}

.clear {
    clear: both
}

.section {
    float: left;
    width: 100%
}

.f-right {
    float: right
}

.capitalize {
    text-transform: capitalize
}

.uppercase {
    text-transform: uppercase
}

.bg-img {
    background-position: center center;
    background-size: cover
}

.position-relative {
    position: relative
}

.height-100vh {
    height: 100vh!important
}

*:focus,select:focus,.custom-select:focus,button:focus,textarea:focus,textarea.form-control:focus,input.form-control:focus,input[type=text]:focus,input[type=password]:focus,input[type=email]:focus,input[type=number]:focus,[type=text].form-control:focus,[type=password].form-control:focus,[type=email].form-control:focus,[type=tel].form-control:focus,[contenteditable].form-control:focus {
    outline: none!important;
    box-shadow: none
}

.border-radius {
    border-radius: 4px
}

.border-radius-5 {
    border-radius: 5px
}

.border-radius-10 {
    border-radius: 10px
}

.border-radius-15 {
    border-radius: 15px
}

.border-radius-20 {
    border-radius: 20px
}

.hover-up {
    transition: all .25s cubic-bezier(.02,.01,.47,1)
}

.hover-up:hover {
    transform: translateY(-3px);
    transition: all .25s cubic-bezier(.02,.01,.47,1)
}

body {
    background: #fff;
    background-size: contain;
    overflow-x: hidden
}

a {
    text-decoration: none
}

*:hover {
    transition-duration: .2s
}

.img-responsive {
    max-width: 100%
}

.text-body-lead {
    font-family: noto sans,sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px
}

.text-body-excerpt {
    font-family: noto sans,sans-serif;
    font-weight: 400;
    font-size: 18px;
    line-height: 26px
}

.ssl-benefits img {
    padding: 20px;
    border: 2px solid #bee1e6;
    max-height: 130px;
    width: 100%
}

.img__wrap {
    position: relative
}

.img__wrap:hover {
    cursor: pointer
}

.img__description {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgb(0 0 0/72%);
    color: #fff;
    visibility: hidden;
    opacity: 0;
    transition: opacity .2s,visibility .2s;
    padding: 10px;
    text-align: center
}

.img__description h6 {
    color: #fff
}

.img__wrap:hover .img__description {
    visibility: visible;
    opacity: 1
}

.text-body-text {
    font-family: noto sans,sans-serif;
    font-weight: 400!important;
    font-size: 16px;
    line-height: 28px
}

.text-body-quote {
    font-family: noto sans,sans-serif;
    font-weight: 600;
    font-size: 20px;
    line-height: 28px
}

.text-body-normal {
    font-family: noto sans,sans-serif;
    font-weight: 400;
    font-size: 20px;
    line-height: 28px
}

.text-body-capitalized {
    font-family: noto sans,sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 19px;
    letter-spacing: 2px
}

.text-body-small {
    font-family: noto sans,sans-serif;
    font-weight: 500;
    font-size: 13px;
    line-height: 16px
}

.text-body-tiny {
    font-family: noto sans,sans-serif;
    font-weight: 600;
    font-size: 10px;
    line-height: 14px
}

.text-body-lead-large {
    font-family: noto sans,sans-serif;
    font-weight: 400;
    font-size: 24px;
    line-height: 32px
}

.text-body-text-md {
    font-family: noto sans,sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 19px
}

.fontsize20 {
    font-size: 20px!important
}

.tablet-display-2 {
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 72px;
    line-height: 82px;
    letter-spacing: -.5%
}

.text-display-1 {
    font-family: chivo,sans-serif;
    font-weight: 900;
    font-size: 96px;
    line-height: 132px;
    letter-spacing: -1%
}

.text-display-2 {
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 80px;
    line-height: 88px;
    letter-spacing: -.5%
}

.text-display-3 {
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 64px;
    line-height: 72px;
    letter-spacing: 0%
}

.text-display-4 {
    font-family: chivo,sans-serif;
    font-weight: 400;
    font-size: 56px;
    line-height: 66px;
    letter-spacing: 0%
}

.text-heading-1 {
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 46px;
    line-height: 64px;
    letter-spacing: -1%;
    color: #101828
}

.team-section img {
    background-color: #bee1e6
}

.text-heading-2 {
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 42px;
    line-height: 44px;
    letter-spacing: 0%
}

.text-heading-3 {
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 35px;
    line-height: 38px;
    letter-spacing: 0%
}

.text-heading-4 {
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 28px;
    line-height: 32px;
    letter-spacing: 0%
}

.text-heading-5 {
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 22px;
    line-height: 24px;
    letter-spacing: 0%
}

.text-heading-6 {
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 18px;
    line-height: 22px;
    letter-spacing: 0%
}

.text-bold {
    font-family: noto sans,sans-serif;
    font-size: 14px;
    line-height: 14px;
    font-weight: 700
}

.color-orange-100 {
    color: #faede3
}

.color-orange-500 {
    color: #ffddd2
}

.color-orange-900 {
    color: #e29578
}

.color-green-900 {
    color: #006d77!important
}

.color-green-500 {
    color: #83c5be
}

.color-green-100 {
    color: #afeae4
}

.color-gray-900 {
    color: #101828!important
}

.color-gray-1000 {
    color: #1f2938
}

.color-gray-1100 {
    color: #7e7e7e
}

.color-gray-1200 {
    color: #9a9a9a
}

.color-gray-500 {
    color: #667085
}

.color-gray-400 {
    color: #98a2b3!important
}

.color-gray-300 {
    color: #d0d5dd!important
}

.color-gray-600 {
    color: #475467
}

.color-gray-100 {
    color: #f2f4f7
}

.color-white {
    color: #fff!important
}

.bg-1 {
    background-color: #eae4e9!important
}

.bg-2 {
    background-color: #fff3ea!important
}

.bg-2-opacity-80 {
    background-color: rgba(255,243,234,.8)
}

.bg-3 {
    background-color: #fde2e4!important
}

.bg-4 {
    background-color: #fad2e1!important
}

.bg-5 {
    background-color: #dbece5!important
}

.bg-6 {
    background-color: #bee1e6!important
}

.bg-6-opacity-30 {
    background-color: rgba(190,225,230,.3019607843)!important
}

.bg-7 {
    background-color: #f0efeb!important
}

.bg-8 {
    background-color: #dfe7fd!important
}

.bg-9 {
    background-color: #d1ecfd!important
}

.bg-10 {
    background-color: #ddd3fa!important
}

.bg-gray-100 {
    background-color: #f2f4f7!important
}

.text-billed {
    font-weight: 400;
    font-family: noto sans,sans-serif;
    font-size: 16px;
    line-height: 28px;
    display: inline-block;
    vertical-align: middle;
    color: #fff
}

a {
    color: #006d77
}

a:hover {
    color: #83c5be
}

.section-box {
    display: inline-block;
    width: 100%
}

.box-shadow-4 {
    box-shadow: 4px 6px 23px rgba(228,92,35,.1)
}

.content-detail {
    color: #101828
}

.content-detail h2 {
    margin: 0 0 20px
}

.content-detail p {
    margin-bottom: 15px;
    font-size: 16px;
    font-family: noto sans,sans-serif;
    color: #101828;
    line-height: 28px
}

.content-detail ul {
    list-style: disc;
    color: #101828;
    padding-left: 20px;
    font-size: 16px;
    font-family: noto sans,sans-serif;
    line-height: 28px
}

.border-bottom {
    border-bottom: 1px solid #061224;
    width: 100%;
    margin: 30px 0
}

.img-middle {
    display: inline-block;
    vertical-align: middle;
    margin-top: -2px
}

.box-shadow-2 {
    box-shadow: 0 45px 80px rgba(0,0,0,.04)
}

.box-line-throught {
    display: inline-block;
    position: relative;
    padding: 0 60px
}

.box-line-throught::before {
    content: "";
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 0;
    width: 50px;
    height: 1px;
    background-color: #d0d5dd
}

.box-line-throught::after {
    content: "";
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 0;
    width: 50px;
    height: 1px;
    background-color: #d0d5dd
}

.img-full {
    width: 100%
}

.tab-content>.active {
    overflow: hidden
}

.thw-20 {
    width: 20%
}

.thw-40 {
    width: 40%
}

.br-16 {
    border-radius: 16px
}

a,button,img,input,span,h4 {
    transition: all .3s ease 0s
}

@-webkit-keyframes slideleft {
    10% {
        opacity: 0;
        transform: scale(0);
        right: 0
    }

    50% {
        opacity: 1;
        transform: scale(1)
    }

    90% {
        opacity: 0;
        transform: scale(0);
        right: 100%
    }
}

@keyframes slideleft {
    10% {
        opacity: 0;
        transform: scale(0);
        right: 0
    }

    50% {
        opacity: 1;
        transform: scale(1)
    }

    90% {
        opacity: 0;
        transform: scale(0);
        right: 100%
    }
}

[data-loader=spinner] {
    width: 35px;
    height: 35px;
    display: inline-block;
    -webkit-animation: spinner 1.2s infinite ease-in-out;
    animation: spinner 1.2s infinite ease-in-out;
    background: url(../imgs/template/favicon.svg);
    box-shadow: 0 0 10px #fff
}

@-webkit-keyframes spinner {
    0% {
        transform: perspective(120px) rotateX(0) rotateY(0)
    }

    50% {
        transform: perspective(120px) rotateX(-180deg) rotateY(0)
    }

    100% {
        transform: perspective(120px) rotateX(-180deg) rotateY(-180deg)
    }
}

@keyframes spinner {
    0% {
        transform: perspective(120px) rotateX(0) rotateY(0)
    }

    50% {
        transform: perspective(120px) rotateX(-180deg) rotateY(0)
    }

    100% {
        transform: perspective(120px) rotateX(-180deg) rotateY(-180deg)
    }
}

@-webkit-keyframes shadow-pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(151,119,250,.8)
    }

    100% {
        box-shadow: 0 0 0 5px transparent
    }
}

@keyframes shadow-pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(151,119,250,.8)
    }

    100% {
        box-shadow: 0 0 0 5px transparent
    }
}

@-webkit-keyframes shadow-pulse-big {
    0% {
        box-shadow: 0 0 0 0 rgba(239,63,72,.1)
    }

    100% {
        box-shadow: 0 0 0 20px transparent
    }
}

@keyframes shadow-pulse-big {
    0% {
        box-shadow: 0 0 0 0 rgba(239,63,72,.1)
    }

    100% {
        box-shadow: 0 0 0 20px transparent
    }
}

@-webkit-keyframes jump {
    0% {
        transform: translate3d(0,20%,0)
    }

    100% {
        transform: translate3d(0,0,0)
    }
}

@keyframes jump {
    0% {
        transform: translate3d(0,20%,0)
    }

    100% {
        transform: translate3d(0,0,0)
    }
}

.jump {
    transform-origin: 0;
    -webkit-animation: jump .5s linear alternate infinite;
    animation: jump .5s linear alternate infinite
}

body {
    color: #101828;
    font-family: chivo,sans-serif;
    font-size: 14px;
    line-height: 24px;
    font-style: normal;
    font-weight: 400
}

h1,h2,h3,h4,h5,h6,.font-heading,.display-1,.display-2,.heading-lg,.heading-sm-1 {
    font-family: noto sans,sans-serif;
    color: #101828;
    font-weight: 700;
    line-height: 1.2
}

h1 {
    font-size: 69px;
    line-height: 1.2
}

h2 {
    font-size: 55px;
    line-height: 67px
}

h3 {
    font-size: 44px;
    line-height: 54px
}

h4 {
    font-size: 28px;
    line-height: 34px
}

h5 {
    font-size: 22px;
    line-height: 28px;
    font-weight: 500
}

h6 {
    font-size: 16px;
    line-height: 22px;
    font-weight: 500
}

.heading-lg {
    font-size: 52px;
    line-height: 63px;
    font-weight: 700
}

.heading-md {
    font-size: 20px;
    line-height: 24px;
    color: #101828;
    font-weight: 500;
    font-family: noto sans,sans-serif
}

.heading-sm {
    font-size: 14px;
    line-height: 20px;
    font-weight: 500
}

.text-sm {
    font-size: 12px;
    line-height: 16px;
    font-family: chivo,sans-serif
}

.text-md {
    font-size: 16px;
    line-height: 20px;
    font-family: chivo,sans-serif
}

.small-heading {
    font-size: 16px;
    line-height: 20px;
    font-weight: 700;
    font-family: noto sans,sans-serif
}

.medium-heading {
    font-size: 18px;
    color: #101828;
    line-height: 22px;
    font-weight: 600;
    font-family: noto sans,sans-serif
}

.display-block {
    display: block
}

.font-bold {
    font-weight: 700
}

.font-semibold {
    font-weight: 600
}

.font-3xs {
    font-size: 10px
}

.font-xxs {
    font-size: 12px
}

.font-xs {
    font-size: 13px
}

.font-sm {
    font-size: 14px
}

.font-md {
    font-size: 16px
}

.font-md-2 {
    font-size: 15px
}

.font-lg {
    font-size: 18px
}

.font-xl {
    font-size: 20px
}

.font-2xl {
    font-size: 22px
}

.font-3xl {
    font-size: 58px
}

.text-grey-6 {
    color: #101828!important
}

.text-muted {
    color: #667085!important
}

.btn {
    font-family: chivo,sans-serif;
    padding: 22px 32px;
    font-size: 18px;
    line-height: 22px;
    transition: .2s;
    letter-spacing: .45px;
    border-radius: 50px
}

.btn.btn-square {
    border-radius: 4px;
    background-color: #101828;
    color: #fff;
    font-size: 14px;
    line-height: 14px;
    font-weight: 700;
    padding: 18px 20px;
    border: 2px solid transparent
}

.btn.btn-square:hover {
    background-color: #fff;
    color: #101828;
    border-color: #101828
}

.btn.btn-black-border {
    border: 1px solid #101828;
    padding: 12px 22px;
    border-radius: 8px;
    width: 100%;
    text-align: left
}

.btn.btn-black-border:hover {
    background-color: #101828;
    background-image: url('{{url('/')}}/public/logo/check-circle-pink.svg');
    background-repeat: no-repeat;
    color: #fff;
    transform: translateY(-2px);
    transition: .2s
}

.btn.btn-default {
    color: #101828;
    background-color: #f2f4f7;
    border-radius: 50px;
    font-size: 18px;
    line-height: 22px;
    font-family: chivo,sans-serif;
    font-weight: 700
}

.btn.btn-default:hover {
    background-color: #101828;
    background-image: url(../imgs/template/icons/arrow-small-right-w.svg);
    background-repeat: no-repeat;
    color: #fff!important;
    transform: translateY(-2px);
    transition: .2s
}

.btn.btn-white {
    background-color: #fff
}

.btn.btn-bd-green-hover {
    color: #475467;
    border: 2px solid transparent
}

.btn.btn-bd-green-hover:hover {
    color: #006d77!important;
    background-color: #fff!important;
    border: 2px solid #006d77
}

.btn.active {
    color: #006d77!important;
    background-color: #fff!important;
    border: 2px solid #006d77
}

.btn.btn-select {
    margin-left: 10px;
    margin-right: 10px;
    margin-bottom: 15px
}

.btn.btn-green-900 {
    background-color: #006d77;
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 18px;
    line-height: 22px;
    letter-spacing: 0%;
    color: #fff
}

.btn.btn-green-900:hover {
    background-color: #101828;
    background-image: url(../imgs/template/icons/arrow-small-right-w.svg);
    background-repeat: no-repeat;
    color: #fff!important;
    transform: translateY(-2px);
    transition: .2s
}

.btn.btn-black {
    color: #fff;
    background-color: #101828;
    border-radius: 50px;
    font-size: 18px;
    line-height: 22px;
    font-family: noto sans,sans-serif;
    font-weight: 700
}

.btn.btn-black.icon-arrow-right-white:hover {
    background-color: #f2f4f7;
    background-image: url(../imgs/template/icons/fi-sr-arrow-small-right.svg);
    background-repeat: no-repeat;
    color: #101828;
    transform: translateY(-2px);
    transition: .2s
}

.btn.btn-black:hover {
    background-color: #e4e7ec;
    color: #101828
}

.btn.btn-md {
    padding: 16px 20px
}

.btn.shape-square {
    border-radius: 4px
}

.btn.btn-link {
    font-family: chivo,sans-serif;
    font-style: normal;
    font-size: 18px;
    line-height: 18px;
    color: #101828;
    text-decoration: none
}

.btn.btn-link:hover {
    color: #667085
}

.btn.btn-pink {
    background-color: #e29578;
    color: #fff;
    border-radius: 4px
}

.btn.btn-pink:hover {
    background-color: #101828
}

.btn.btn-link-inter {
    font-family: chivo,sans-serif!important;
    font-weight: 500;
    font-size: 20px;
    line-height: 24px
}

.btn.btn-round-icon {
    background-image: url(../imgs/template/icons/btn-send.svg);
    background-repeat: no-repeat;
    background-position: -30px -21px;
    display: inline-block;
    height: 57px;
    width: 79px;
    border-radius: 0;
    padding: 0
}

.btn.btn-square-green {
    background-color: #006d77;
    padding: 1px 22px;
    color: #fff;
    border-radius: 8px;
    height: 48px;
    width: 120px
}

.btn.btn-green-full {
    background-color: #006d77;
    padding: 1px 22px;
    color: #fff;
    border-radius: 4px;
    height: 48px;
    width: 100%
}

.btn.btn-media {
    border-radius: 4px;
    padding: 1px 16px 3px;
    min-height: 36px;
    line-height: 32px;
    border: 1px solid rgba(6,18,36,.1)
}

.btn.btn-media img {
    display: inline-block;
    vertical-align: middle;
    margin-right: 5px
}

.btn.btn-login-google {
    border-radius: 8px;
    background-color: #fff;
    padding: 13px 25px;
    display: block
}

.btn.btn-tag {
    background-color: #e4e7ec;
    color: #101828;
    font-family: noto sans,sans-serif;
    font-size: 14px;
    line-height: 18px;
    font-weight: 400;
    border-radius: 8px;
    padding: 12px 20px
}

.btn.btn-tag:hover {
    background-color: #101828;
    color: #fff
}

.btn.btn-newsletter {
    position: absolute;
    top: 10px;
    right: 10px;
    border-radius: 8px;
    padding: 16px 56px 16px 27px;
    border: 0;
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 18px;
    line-height: 22px;
    color: #fff;
    background-color: #006d77;
    background-image: url(../imgs/template/icons/arrow-small-right-w.svg);
    background-repeat: no-repeat;
    background-position: center right 25px;
    background-size: 15px
}

.btn.btn-newsletter ::-moz-placeholder {
    color: #98a2b3;
    font-size: 16px;
    line-height: 28px
}

.btn.btn-newsletter ::placeholder {
    color: #98a2b3;
    font-size: 16px;
    line-height: 28px
}

.btn.btn-cart {
    background-color: #afeae4;
    color: #006d77;
    padding: 5px 25px 5px 15px;
    border-radius: 8px;
    background-image: url(../imgs/page/homepage5/icon-plus.svg);
    background-repeat: no-repeat;
    background-position: center right 10px;
    font-family: noto sans,sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px
}

.btn.btn-cart:hover {
    background-color: #83c5be
}

.btn.btn-explorer {
    background-color: #afeae4;
    color: #006d77;
    padding: 5px 32px 5px 15px;
    border-radius: 8px;
    background-image: url(../imgs/page/homepage8/icon-arrow-green.svg);
    background-repeat: no-repeat;
    background-position: center right 12px;
    font-family: noto sans,sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px
}

.btn.btn-explorer:hover {
    background-color: #83c5be
}

.btn.btn-border {
    border: 1px solid #e4e7ec;
    padding: 13px 20px
}

.btn.btn-border:hover {
    border-color: #004b52;
    color: #004b52
}

.icon-arrow-right {
    background-image: url(../imgs/template/icons/fi-sr-arrow-small-right.svg);
    background-repeat: no-repeat;
    background-position: center right 25px;
    padding-right: 56px
}

.icon-arrow-left {
    background-image: url(../imgs/template/icons/arrow-small-left-white.svg);
    background-repeat: no-repeat;
    background-position: center left 25px;
    padding-left: 56px
}

.icon-arrow-left:hover {
    background-image: url(../imgs/template/icons/arrow-small-left.svg)!important
}

.icon-arrow-right-white {
    background-image: url(../imgs/template/icons/arrow-small-right-w.svg);
    background-repeat: no-repeat;
    background-position: center right 25px;
    padding-right: 56px
}

.icon-triangle {
    background-image: url(../imgs/template/icons/icon-triangle.svg);
    background-repeat: no-repeat;
    background-position: center left;
    padding-left: 30px;
    font-family: chivo,sans-serif!important;
    font-weight: 500;
    font-size: 20px;
    line-height: 24px
}

.btn-play-video {
    position: absolute;
    top: 50%;
    margin-top: -30px;
    left: -34px;
    width: 64px;
    height: 72px;
    background: url(../imgs/template/icons/play-button.svg) no-repeat
}

.switch {
    position: relative;
    display: inline-block;
    width: 65px;
    height: 30px;
    vertical-align: middle
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #f2f4f7;
    transition: .4s
}

.slider:before {
    position: absolute;
    content: "";
    height: 21px;
    width: 21px;
    left: 5px;
    bottom: 5px;
    background-color: #101828;
    transition: .4s
}

input:checked+.slider {
    background-color: #fff
}

input:focus+.slider {
    box-shadow: 0 0 1px #101828
}

input:checked+.slider:before {
    transform: translateX(34px)
}

.slider.round {
    border-radius: 34px
}

.slider.round:before {
    border-radius: 50%
}

span.btn {
    cursor: unset
}

.cb-container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    line-height: 21px;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none
}

.cb-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 23px;
    width: 23px;
    background-color: #fff;
    border: 2px solid #101828;
    border-radius: 4px
}

.cb-container input:checked~.checkmark {
    border: 2px solid #101828
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none
}

.cb-container input:checked~.checkmark:after {
    display: block
}

.cb-container .checkmark:after {
    left: -1px;
    top: -1px;
    width: 21px;
    height: 21px
}

input:-moz-placeholder,textarea:-moz-placeholder {
    opacity: 1
}

input::-webkit-input-placeholder,textarea::-webkit-input-placeholder {
    opacity: 1
}

input::-moz-placeholder,textarea::-moz-placeholder {
    opacity: 1
}

input:-ms-input-placeholder,textarea:-ms-input-placeholder {
    opacity: 1
}

.form-control {
    background: #fff;
    border: 0;
    height: 60px;
    box-shadow: none;
    padding-left: 30px;
    padding-right: 30px;
    font-size: 14px;
    line-height: 20px;
    width: 100%;
    border-radius: 0;
    color: #98a2b3
}

.form-control:focus {
    background: #fff;
    border-color: #1d2939
}

.form-control.form-icons {
    padding-left: 42px
}

.form-control::-moz-placeholder {
    color: #98a2b3
}

.form-control::placeholder {
    color: #98a2b3
}

textarea.form-control {
    background: #fff;
    border: 0;
    min-height: 160px;
    box-shadow: none;
    padding: 30px;
    font-size: 14px;
    line-height: 20px;
    width: 100%;
    border-radius: 0;
    color: #98a2b3
}

textarea.form-control:focus {
    background: #fff;
    border-color: #1d2939
}

textarea.form-control.form-icons {
    padding-left: 42px
}

.form-group {
    margin-bottom: 25px
}

.form-group input {
    background: #fff;
    border: 0;
    height: 60px;
    box-shadow: none;
    padding-left: 30px;
    padding-right: 30px;
    font-size: 14px;
    line-height: 20px;
    width: 100%;
    border-radius: 0
}

.form-group input:focus {
    background: #fff;
    border-color: #1d2939
}

.form-group input.form-icons {
    padding-left: 42px
}

label {
    margin-bottom: 5px
}

.form-round {
    background: #fff;
    max-width: 500px;
    padding: 10px 12px;
    border-radius: 55px;
    margin: 15px auto
}

.form-inline {
    display: flex;
    align-items: center
}

.input-round {
    outline: 0;
    border-radius: 55px
}

.input-round:focus {
    background: #fff;
    border-color: #1d2939
}

.form-square {
    background: #fff;
    max-width: 100%;
    padding: 10px 12px;
    border-radius: 15px;
    margin: 15px auto;
    position: relative
}

.input-with-button {
    outline: 0;
    border-radius: 15px;
    background: url(../imgs/template/icons/icon-search-input.svg) no-repeat 7px 17px;
    padding-left: 50px
}

.input-with-button:focus {
    background: url(../imgs/template/icons/icon-search-input.svg) no-repeat 7px 17px;
    border-color: #1d2939
}

.box-signup {
    max-width: 405px;
    display: table;
    table-layout: fixed;
    margin: auto;
    width: 100%
}

.box-signup .box-form-signup {
    background-color: #fff;
    border-radius: 6px;
    padding: 45px;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.box-signup .chkbox {
    float: left;
    margin: -1px 10px 0 0;
    width: 18px;
    height: 18px
}

.box-signup .form-group input.form-control {
    background: #fff;
    border: 1px solid #eee;
    height: 56px;
    box-shadow: none;
    padding-left: 20px;
    padding-right: 20px;
    font-size: 14px;
    line-height: 20px;
    width: 100%;
    border-radius: 4px;
    color: #101828
}

.box-signup .form-group input.input-green-bd {
    border: 2px solid #006d77
}

.box-signup .form-group input.input-with-icon {
    padding-right: 40px
}

.box-signup .form-field {
    position: relative
}

.box-signup .form-field .tag-top {
    position: absolute;
    top: -7px;
    padding: 0 5px;
    left: 10px;
    background-color: #fff
}

.box-signup .form-field .icon-eye-right {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 14px;
    background: url(../imgs/template/icons/icon-eye.svg) no-repeat center;
    height: 24px;
    width: 25px;
    cursor: pointer
}

.box-signup .form-field .icon-email-right {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 14px;
    background: url(../imgs/template/icons/icon-email-2.svg) no-repeat center;
    height: 24px;
    width: 25px;
    cursor: pointer
}

.box-reset .box-form-signup {
    border: 1px solid #e4e7ec
}

.form-comment .input-comment {
    border-radius: 16px;
    border: 2px solid #e4e7ec;
    padding: 20px;
    width: 100%;
    color: #98a2b3;
    font-size: 20px;
    line-height: 27px;
    font-family: noto sans,sans-serif;
    font-weight: 400;
    min-height: 150px
}

.form-comment .box-agree span {
    display: block;
    padding-left: 25px
}

.form-comment .box-agree input {
    float: left;
    margin: 5px 0 0
}

.box-swiper {
    position: relative
}

.box-swiper .swiper-container {
    position: relative
}

.box-swiper .swiper-container .item-logo {
    border: 1px solid #667085;
    padding: 39px 0 36px;
    display: inline-block;
    width: 100%;
    text-align: center;
    border-radius: 12px;
    box-shadow: 0 45px 80px rgba(0,0,0,.04)
}

.box-swiper .swiper-container .item-logo img {
    max-width: 100%
}

.box-swiper .swiper-container .item-logo:hover {
    border: 1px solid #1d2939;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.box-swiper .swiper-button-next:after,.box-swiper .swiper-button-prev:after {
    content: ""
}

.box-swiper .swiper-button-next {
    background: url(../imgs/slider/swiper/next.svg) no-repeat 0 0
}

.box-swiper .swiper-button-next:hover {
    background: url(../imgs/slider/swiper/next-active.svg) no-repeat 0 0
}

.box-swiper .swiper-button-prev {
    background: url(../imgs/slider/swiper/prev.svg) no-repeat 0 0
}

.box-swiper .swiper-button-prev:hover {
    background: url(../imgs/slider/swiper/prev-active.svg) no-repeat 0 0
}

.box-swiper .swiper-button-next,.box-swiper .swiper-button-prev {
    width: 64px;
    height: 64px;
    margin-top: -55px
}

.box-swiper .swiper-button-next {
    left: auto;
    right: 0;
    top: -65px
}

.box-swiper .swiper-button-prev {
    left: auto;
    right: 84px;
    top: -65px
}

.box-swiper .swiper-button-next.swiper-button-disabled,.box-swiper .swiper-button-prev.swiper-button-disabled {
    opacity: 1
}

.swiper-pagination {
    text-align: center;
    width: 100%
}

.swiper-pagination-bullet {
    margin: 10px
}

.swiper-pagination-custom {
    bottom: -5px
}

.swiper-pagination-customs {
    background: url(../imgs/slider/swiper/dot.svg) no-repeat 0 0;
    display: inline-block;
    background-repeat: no-repeat;
    background-size: contain;
    width: 10px;
    height: 10px;
    margin-left: 4px;
    margin-right: 4px
}

.swiper-pagination-customs-active,.swiper-pagination-customs:hover {
    background: url(../imgs/slider/swiper/dot-active.svg) no-repeat 0 0;
    width: 12px;
    height: 12px;
    margin-bottom: -1px;
    margin-left: 3px;
    margin-right: 3px
}

.box-swiper {
    position: relative
}

.box-swiper .swiper-container {
    position: relative
}

.box-swiper .swiper-container .item-logo {
    border: 1px solid #667085;
    padding: 39px 0 36px;
    display: inline-block;
    width: 100%;
    text-align: center;
    border-radius: 12px;
    box-shadow: 0 45px 80px rgba(0,0,0,.04)
}

.box-swiper .swiper-container .item-logo img {
    max-width: 100%
}

.box-swiper .swiper-container .item-logo:hover {
    border: 1px solid #1d2939;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.box-swiper .swiper-button-next:after,.box-swiper .swiper-button-prev:after {
    content: ""
}

.box-swiper .swiper-button-next {
    background: url(../imgs/slider/swiper/next.svg) no-repeat 0 0
}

.box-swiper .swiper-button-next:hover {
    background: url(../imgs/slider/swiper/next-active.svg) no-repeat 0 0
}

.box-swiper .swiper-button-prev {
    background: url(../imgs/slider/swiper/prev.svg) no-repeat 0 0
}

.box-swiper .swiper-button-prev:hover {
    background: url(../imgs/slider/swiper/prev-active.svg) no-repeat 0 0
}

.box-swiper .swiper-button-next,.box-swiper .swiper-button-prev {
    width: 64px;
    height: 64px;
    margin-top: -55px
}

.box-swiper .swiper-button-next {
    left: auto;
    right: 0;
    top: -65px
}

.box-swiper .swiper-button-prev {
    left: auto;
    right: 84px;
    top: -65px
}

.box-swiper .swiper-button-next.swiper-button-disabled,.box-swiper .swiper-button-prev.swiper-button-disabled {
    opacity: 1
}

.swiper-pagination {
    text-align: center;
    width: 100%
}

.swiper-pagination-bullet {
    margin: 10px
}

.swiper-pagination-custom {
    bottom: -5px
}

.swiper-pagination-customs {
    background: url(../imgs/slider/swiper/dot.svg) no-repeat 0 0;
    display: inline-block;
    background-repeat: no-repeat;
    background-size: contain;
    width: 10px;
    height: 10px;
    margin-left: 4px;
    margin-right: 4px
}

.swiper-pagination-customs-active,.swiper-pagination-customs:hover {
    background: url(../imgs/slider/swiper/dot-active.svg) no-repeat 0 0;
    width: 12px;
    height: 12px;
    margin-bottom: -1px;
    margin-left: 3px;
    margin-right: 3px
}

.slider-labels {
    margin-top: 10px
}

.noUi-target,.noUi-target * {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    touch-action: none;
    -moz-user-select: none;
    user-select: none;
    box-sizing: border-box
}

.noUi-target {
    position: relative;
    direction: ltr
}

.noUi-base {
    width: 100%;
    height: 100%;
    position: relative;
    z-index: 1
}

.noUi-origin {
    position: absolute;
    right: 0;
    top: 0;
    left: 0;
    bottom: 0
}

.noUi-handle {
    position: relative;
    z-index: 1
}

.noUi-stacking .noUi-handle {
    z-index: 10
}

.noUi-state-tap .noUi-origin {
    transition: left .3s,top .3s
}

.noUi-state-drag * {
    cursor: inherit!important
}

.noUi-base,.noUi-handle {
    transform: translate3d(0,0,0)
}

.noUi-horizontal {
    height: 4px
}

.noUi-horizontal .noUi-handle {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    left: -7px;
    top: -7px;
    background-color: #345dbb
}

.noUi-background {
    background: #d6d7d9
}

.noUi-connect {
    background: #345dbb;
    transition: background 450ms
}

.noUi-origin {
    border-radius: 2px
}

.noUi-target {
    border-radius: 2px
}

.noUi-draggable {
    cursor: w-resize
}

.noUi-vertical .noUi-draggable {
    cursor: n-resize
}

.noUi-handle {
    cursor: default;
    box-sizing: content-box!important
}

.noUi-handle:active {
    border: 8px solid #345dbb;
    border: 8px solid rgba(53,93,187,.38);
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    left: -14px;
    top: -14px
}

[disabled].noUi-connect,[disabled] .noUi-connect {
    background: #006d77
}

[disabled].noUi-origin,[disabled] .noUi-handle {
    cursor: not-allowed
}

.ui-slider-handle {
    display: none
}

.ui-widget.ui-widget-content {
    border: 0 solid #ebebeb
}

.noUi-target {
    border-radius: 12px
}

.noUi-horizontal {
    height: 6px
}

.noUi-background {
    background: #e4e7ec
}

.noUi-origin {
    border-radius: 12px
}

.noUi-connect {
    background: #006d77;
    transition: background 450ms;
    height: 6px;
    margin-top: 0
}

.noUi-horizontal .noUi-handle {
    background-color: #006d77;
    border: 1px solid #006d77;
    box-shadow: 0 47px 65px rgba(21,28,38,.1);
    left: -8px;
    top: -8px
}

.noUi-handle:active {
    border-width: 1px;
    left: -8px;
    top: -8px
}

.card-grid-1 {
    padding: 53px 48px;
    display: inline-block;
    width: 100%;
    border-radius: 16px;
    margin-bottom: 20px
}

.card-grid-1.bg-business {
    position: relative
}

.card-grid-1.bg-business::before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 90px;
    height: 90px;
    background: url(../imgs/page/homepage1/bg-business.svg) no-repeat
}

.card-grid-1.bg-local {
    position: relative
}

.card-grid-1.bg-local::before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 90px;
    height: 90px;
    background: url(../imgs/page/homepage1/bg-local.svg) no-repeat
}

.card-grid-1.bg-social {
    position: relative
}

.card-grid-1.bg-social::before {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 90px;
    height: 90px;
    background: url(../imgs/page/homepage1/bg-social.svg) no-repeat
}

.card-grid-style-2 {
    padding: 53px 48px;
    display: inline-block;
    width: 100%;
    border-radius: 16px;
    position: relative;
    background: #fff;
    box-shadow: inset 0 40px 80px #fcfcfc
}

.card-grid-style-2 .text-comment {
    height: 84px;
    overflow: hidden;
    width: 100%
}

.card-grid-style-2.card-square {
    border-radius: 0;
    padding: 30px;
    box-shadow: 0 45px 80px rgba(0,0,0,.04)
}

.card-grid-style-2.card-square .text-comment {
    height: auto
}

.card-grid-style-2.card-square .img-user-round img {
    border-radius: 50%;
    width: 80px;
    height: 80px
}

.card-grid-style-3 {
    padding: 40px 40px 10px;
    display: inline-block;
    width: 100%;
    border-radius: 0;
    position: relative;
    background: #fff;
    border: 10px solid #fad2e1;
    margin-bottom: 30px
}

.card-grid-style-3:hover {
    box-shadow: 0 45px 80px rgba(0,0,0,.04)
}

.card-grid-style-3 .grid-3-img img {
    border-radius: 50%;
    width: 55px;
    height: 55px
}

.card-grid-style-3 .text-desc {
    height: 280px;
    overflow: hidden
}

.card-grid-style-3.bd-bg-6 {
    border-color: #bee1e6
}

.card-grid-style-3.bd-bg-10 {
    border-color: #ddd3fa
}

.card-grid-style-3.bd-bg-9 {
    border-color: #d1ecfd
}

.card-grid-style-4 {
    margin-bottom: 30px
}

.card-grid-style-4 a.text-heading-4 {
    display: block;
    padding: 15px 0 25px;
    color: #101828
}

.card-grid-style-4 a.text-heading-4:hover {
    color: #006d77
}

.card-grid-style-4 .grid-4-img {
    position: relative;
    padding-bottom: 15px
}

.card-grid-style-4 .grid-4-img img {
    transition: .2s
}

.card-grid-style-4 .grid-4-img::before {
    content: "";
    position: absolute;
    bottom: 0;
    right: -20px;
    width: 100%;
    border-radius: 16px;
    background-color: #d1ecfd;
    top: 20px;
    transition-duration: .2s
}

.card-grid-style-4 .grid-4-img.color-bg-4::before {
    background-color: #fad2e1
}

.card-grid-style-4 .grid-4-img.color-bg-3::before {
    background-color: #fde2e4
}

.card-grid-style-4 .grid-4-img.color-bg-2::before {
    background-color: #fff3ea
}

.card-grid-style-4 .grid-4-img.color-bg-1::before {
    background-color: #eae4e9
}

.card-grid-style-4 .grid-4-img.color-bg-5::before {
    background-color: #dbece5
}

.card-grid-style-4 .grid-4-img.color-bg-6::before {
    background-color: #bee1e6
}

.card-grid-style-4 .grid-4-img.color-bg-7::before {
    background-color: #f0efeb
}

.card-grid-style-4 .grid-4-img.color-bg-8::before {
    background-color: #dfe7fd
}

.card-grid-style-4 .grid-4-img.color-bg-9::before {
    background-color: #d1ecfd
}

.card-grid-style-4 .grid-4-img.color-bg-10::before {
    background-color: #ddd3fa
}

.card-grid-style-4 .grid-4-img img {
    position: relative;
    z-index: 2;
    border-radius: 16px;
    max-width: 100%;
    width: 100%
}

.card-grid-style-4:hover .grid-4-img::before {
    right: -10px;
    top: 10px;
    bottom: 10px;
    transition-duration: .2s
}

.card-grid-style-4:hover .grid-4-img img {
    opacity: .95;
    transition: .2s
}

.card-grid-style-5 {
    margin-bottom: 50px
}

.card-grid-style-6 {
    padding: 53px 48px;
    display: inline-block;
    width: 100%;
    border-radius: 16px;
    position: relative;
    background: #fff3ea;
    margin-bottom: 30px
}

.card-grid-style-6 .text-comment {
    height: 84px;
    overflow: hidden;
    width: 100%
}

.card-grid-style-6.card-square {
    border-radius: 0;
    padding: 30px;
    box-shadow: 0 45px 80px rgba(0,0,0,.04)
}

.card-grid-style-6.card-square .text-comment {
    height: auto
}

.card-grid-style-6.card-square .img-user-round img {
    border-radius: 50%;
    width: 80px;
    height: 80px
}

.block-pricing .box-pricing-item {
    display: inline-block;
    width: 100%;
    padding: 40px 32px;
    background: #fff;
    border-radius: 16px;
    margin-bottom: 30px
}

.block-pricing .box-pricing-item .line-bd-bottom {
    border-bottom: 1px solid #d0d5dd;
    padding: 0 0 40px;
    margin-bottom: 21px
}

.block-pricing .box-pricing-item .for-year,.block-pricing .box-pricing-item .for-month {
    display: none
}

.block-pricing .box-pricing-item .display-month {
    display: inline-block
}

.block-pricing .box-pricing-item .display-year {
    display: inline-block
}

.block-pricing .box-pricing-item .btn-border {
    border: 1px solid #475467;
    color: #101828
}

.block-pricing .box-info-price {
    display: inline-block;
    width: 100%;
    padding-bottom: 20px
}

.block-pricing .box-info-price .text-price {
    font-size: 36px;
    color: #101828;
    font-family: noto sans,sans-serif;
    line-height: 46px;
    font-weight: 600;
    margin-right: 15px
}

.block-pricing .box-info-price .text-month {
    font-size: 17px;
    line-height: 23px;
    color: #98a2b3
}

.block-pricing .list-package-feature {
    display: inline-block;
    width: 100%;
    padding-bottom: 30px;
    min-height: 200px
}

.block-pricing .list-package-feature li {
    display: inline-block;
    width: 100%;
    padding: 1px 0 1px 30px;
    background: url('{{url('/')}}/public/logo/check-circle.svg') no-repeat left center;
    margin-bottom: 12px;
    font-size: 14px;
    line-height: 22px;
    color: #101828
}

.block-pricing .list-package-feature li.uncheck {
    background: url('{{url('/')}}/public/logo/check-circle-pink.svg') no-repeat left center
}

.block-bill-2 .slider {
    background-color: #101828
}

.block-bill-2 .slider::before {
    background-color: #f2f4f7
}

.block-bill-2 .text-billed {
    color: #101828
}

.block-bill-2 input:checked+.slider {
    background-color: #006d77
}

.block-pricing-2 .box-pricing-item {
    border: 1px solid #d0d5dd
}

.block-pricing-2 .box-pricing-item.active,.block-pricing-2 .box-pricing-item:hover {
    background-color: #006d77;
    border: none
}

.block-pricing-2 .box-pricing-item.active .checkbox,.block-pricing-2 .box-pricing-item:hover .checkbox {
    background: url('{{url('/')}}/public/logo/check-circle-pink.svg') no-repeat 0 0
}

.block-pricing-2 .box-pricing-item.active .text-heading-5,.block-pricing-2 .box-pricing-item.active .text-heading-3,.block-pricing-2 .box-pricing-item.active li,.block-pricing-2 .box-pricing-item:hover .text-heading-5,.block-pricing-2 .box-pricing-item:hover .text-heading-3,.block-pricing-2 .box-pricing-item:hover li {
    color: #fff!important
}

.block-pricing-2 .box-pricing-item.active .tag-round,.block-pricing-2 .box-pricing-item:hover .tag-round {
    background-color: #83c5be
}

.block-pricing-2 .box-pricing-item.active .text-month,.block-pricing-2 .box-pricing-item:hover .text-month {
    color: #bfd1ff!important
}

.block-pricing-3 {
    background-color: #fff;
    border-radius: 16px;
    box-shadow: 14px 14px 36px rgba(153,153,153,.22);
    padding: 40px
}

.block-pricing-3 .block-pricing-left {
    background-color: #006d77;
    padding: 40px;
    border-radius: 16px;
    color: #fff
}

.block-pricing-3 .block-pricing-left .box-switch {
    margin-bottom: 20px;
    border-radius: 28px;
    background-color: #83c5be;
    padding: 7px;
    display: inline-block
}

.block-pricing-3 .block-pricing-left .box-switch label {
    margin: 0
}

.block-pricing-3 .block-pricing-left .box-switch input {
    display: none
}

.block-pricing-3 .block-pricing-left .box-switch span {
    min-width: 100px;
    text-align: center;
    cursor: pointer;
    display: inline-block;
    padding: 7px 22px
}

.block-pricing-3 .block-pricing-left .box-switch .active {
    border-radius: 24px;
    background-color: #006d77
}

.block-pricing-3 .block-pricing-left .list-package-feature li {
    display: inline-block;
    width: 100%;
    padding: 2px 30px 2px 0;
    margin-top: 22px;
    margin-bottom: 22px;
    font-size: 16px;
    line-height: 28px;
    color: #fff;
    font-family: noto sans,sans-serif;
    font-weight: 400;
    background: url(../imgs/template/icons/icon-untick.svg) no-repeat right 15px top 1px
}

.block-pricing-3 .block-pricing-left .list-package-feature li.active {
    background: url(../imgs/template/icons/icon-tick.svg) no-repeat right 15px top 1px
}

.block-pricing-3 .block-price-item {
    border: 1px solid #98a2b3;
    border-radius: 16px;
    position: relative;
    padding: 22px 120px 21px 100px;
    cursor: pointer;
    margin-bottom: 24px
}

.block-pricing-3 .block-price-item .checkbox {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 35px;
    height: 30px;
    width: 30px;
    background: url(../imgs/template/icons/icon-unselect.svg) no-repeat 0 0
}

.block-pricing-3 .block-price-item .box-info-price {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 15px
}

.block-pricing-3 .block-price-item .box-info-price .for-year {
    display: none
}

.block-pricing-3 .block-price-item .box-info-price .for-month {
    display: none
}

.block-pricing-3 .block-price-item .box-info-price .display-month {
    display: inline-block
}

.block-pricing-3 .block-price-item .box-info-price .display-year {
    display: inline-block
}

.block-pricing-3 .block-price-item .tag-round {
    border-radius: 14px;
    background-color: #667085;
    display: inline-block;
    padding: 2px 15px;
    color: #fff
}

.block-pricing-3 .block-price-item.active,.block-pricing-3 .block-price-item:hover {
    background-color: #006d77
}

.block-pricing-3 .block-price-item.active .checkbox,.block-pricing-3 .block-price-item:hover .checkbox {
    background: url(../imgs/template/icons/icon-selected.svg) no-repeat 0 0
}

.block-pricing-3 .block-price-item.active .text-heading-5,.block-pricing-3 .block-price-item.active .text-heading-3,.block-pricing-3 .block-price-item:hover .text-heading-5,.block-pricing-3 .block-price-item:hover .text-heading-3 {
    color: #fff!important
}

.block-pricing-3 .block-price-item.active .tag-round,.block-pricing-3 .block-price-item:hover .tag-round {
    background-color: #83c5be
}

.block-pricing-3 .block-price-item.active .text-month,.block-pricing-3 .block-price-item:hover .text-month {
    color: #bfd1ff!important
}

.card-list-style-1 {
    padding: 0 140px 30px 0;
    position: relative;
    margin-bottom: 30px;
    display: inline-block;
    width: 100%;
    border-bottom: 1px solid #e4e7ec
}

.card-list-style-1 a {
    color: #101828
}

.card-list-style-1 a:hover {
    color: #006d77
}

.card-list-style-1 .style-1-img {
    position: absolute;
    top: 0;
    right: 0;
    width: 120px;
    padding: 0 10px 10px 0
}

.card-list-style-1 .style-1-img img {
    position: relative;
    z-index: 2;
    border-radius: 8px
}

.card-list-style-1 .style-1-img::before {
    content: "";
    position: absolute;
    bottom: 5px;
    right: -5px;
    width: calc(100% - 10px);
    border-radius: 8px;
    background-color: #d1ecfd;
    top: 10px;
    z-index: 1;
    transition-duration: .2s
}

.card-list-style-1 .style-1-img.color-bg-4::before {
    background-color: #fad2e1
}

.card-list-style-1 .style-1-img.color-bg-3::before {
    background-color: #fde2e4
}

.card-list-style-1 .style-1-img.color-bg-2::before {
    background-color: #fff3ea
}

.card-list-style-1 .style-1-img.color-bg-1::before {
    background-color: #eae4e9
}

.card-list-style-1 .style-1-img.color-bg-5::before {
    background-color: #dbece5
}

.card-list-style-1 .style-1-img.color-bg-6::before {
    background-color: #bee1e6
}

.card-list-style-1 .style-1-img.color-bg-7::before {
    background-color: #f0efeb
}

.card-list-style-1 .style-1-img.color-bg-8::before {
    background-color: #dfe7fd
}

.card-list-style-1 .style-1-img.color-bg-9::before {
    background-color: #d1ecfd
}

.card-list-style-1 .style-1-img.color-bg-10::before {
    background-color: #ddd3fa
}

.card-list-style-1:hover .style-1-img::before {
    bottom: 10px;
    right: 0;
    transition-duration: .2s
}

.grid-category-2 {
    position: relative;
    display: inline-block;
    width: 100%;
    margin-bottom: 60px
}

.grid-category-2 .grid-category-image {
    margin: 0 0 20px
}

.grid-category-2 .category-info-bottom {
    display: flex;
    margin: 20px 0 0;
    padding-top: 30px;
    border-top: 1px solid #e4e7ec
}

.grid-category-2 .category-info-bottom * {
    font-size: 12px;
    line-height: 16px;
    color: #006d77;
    font-family: noto sans,sans-serif;
    font-weight: 700;
    text-decoration: none
}

.grid-category-2 .category-info-bottom a:hover {
    color: #101828
}

.grid-category-2 .category-info-bottom span {
    color: #667085
}

.grid-category-2 .category-info-bottom .link-category {
    width: 75%
}

.grid-category-2 .category-info-bottom .link-readmore {
    width: 25%;
    text-align: right
}

.grid-category-2 .category-info-bottom .link-readmore a {
    text-decoration: underline
}

.product-item-1 {
    position: relative;
    border: 1px solid #e4e7ec;
    padding: 10px;
    border-radius: 16px;
    display: inline-block;
    width: 100%;
    margin-bottom: 30px
}

.product-item-1:hover {
    box-shadow: 0 45px 80px rgba(0,0,0,.04)
}

.product-item-1 .product-image {
    width: 150px;
    margin: 0;
    padding: 5px 0 0;
    float: left;
    text-align: center
}

.product-item-1 .product-image img {
    max-height: 150px
}

.product-item-1 .product-info {
    display: block;
    padding: 20px 0 20px 160px
}

.product-item-1 .product-info .title-product {
    color: #101828;
    font-size: 26px;
    font-family: chivo,sans-serif;
    line-height: 32px;
    margin-bottom: 10px
}

.product-item-1 .product-info .price-regular {
    font-size: 28px;
    font-family: chivo,sans-serif;
    line-height: 34px;
    color: #101828
}

.product-item-1 .product-info .price-line {
    color: #667085;
    text-decoration: line-through
}

.product-item-2 {
    position: relative;
    border: 1px solid #e4e7ec;
    padding: 10px;
    border-radius: 16px;
    display: inline-block;
    width: 100%;
    margin-bottom: 30px;
    background-color: #fff
}

.product-item-2:hover {
    box-shadow: 0 45px 80px rgba(0,0,0,.04)
}

.product-item-2:hover .box-quick-view {
    display: block;
    opacity: 1;
    visibility: visible;
    transition-duration: .2s
}

.product-item-2 .box-quick-view {
    display: none;
    opacity: 0;
    visibility: hidden;
    transition-duration: .2s
}

.product-item-2 .box-quick-view .quick-view {
    position: absolute;
    top: 110px;
    left: 0;
    right: 0;
    width: 150px;
    border: 1px solid #d0d5dd;
    border-radius: 8px;
    display: flex;
    margin: auto;
    overflow: hidden
}

.product-item-2 .box-quick-view .quick-view .like-product {
    background: #fff url(../imgs/page/homepage5/like.svg) no-repeat center;
    padding: 10px;
    width: 33.33%;
    display: inline-block;
    height: 46px
}

.product-item-2 .box-quick-view .quick-view .shuffle-product {
    background: #fff url(../imgs/page/homepage5/shuffle.svg) no-repeat center;
    padding: 10px;
    width: 33.33%;
    display: inline-block;
    height: 46px;
    border-right: 1px solid #e4e7ec;
    border-left: 1px solid #e4e7ec
}

.product-item-2 .box-quick-view .quick-view .view-product {
    background: #fff url(../imgs/page/homepage5/view.svg) no-repeat center;
    padding: 10px;
    width: 34%;
    display: inline-block;
    height: 46px
}

.product-item-2 .box-quick-view .quick-view a:hover {
    background-color: #f2f4f7
}

.product-item-2 .product-image {
    width: 100%;
    margin: 0 0 20px;
    padding: 5px 0 0;
    float: left;
    text-align: center;
    min-height: 220px;
    height: 220px;
    line-height: 220px;
    position: relative
}

.product-item-2 .product-image img {
    display: inline-block;
    max-width: 80%;
    vertical-align: middle;
    max-height: 100%;
    width: auto;
    height: auto;
    max-height: 100%
}

.product-item-2 .product-info {
    display: block;
    padding: 20px 0
}

.product-item-2 .product-info a:hover h3 {
    color: #006d77!important
}

.product-item-2 .product-info .box-prices {
    width: 50%
}

.product-item-2 .product-info .box-prices .price-regular {
    font-size: 22px;
    font-family: noto sans,sans-serif;
    line-height: 24px;
    font-weight: 700;
    color: #006d77
}

.product-item-2 .product-info .box-prices .price-line {
    font-size: 14px;
    line-height: 19px;
    color: #98a2b3;
    text-decoration: line-through
}

.product-item-2 .product-info .button-add {
    width: 50%
}

.product-item-2 .product-info .rating .box-rating {
    display: inline-block;
    margin-right: 5px
}

.product-item-2 .product-info .rating .box-rating span {
    display: inline-block;
    vertical-align: top
}

.product-item-3 {
    padding: 25px;
    margin-bottom: 40px
}

.product-item-3:hover {
    border-color: #bee1e6
}

.product-item-3 .product-image {
    min-height: auto;
    height: auto;
    line-height: normal;
    padding-top: 0;
    margin-bottom: 30px
}

.product-item-3 .product-image img {
    max-width: 100%;
    border-radius: 16px;
    width: 100%
}

.product-item-3 .product-info {
    padding-bottom: 0
}

.product-item-3 .location-icon,.product-item-3 .calendar-icon {
    font-size: 12px;
    line-height: 16px;
    color: #667085;
    font-family: noto sans,sans-serif;
    font-weight: 700;
    text-decoration: none;
    display: inline-block;
    padding: 0 0 0 16px
}

.product-item-3 .location-icon {
    background: url(../imgs/page/homepage8/location.svg) no-repeat 0 0
}

.product-item-3 .calendar-icon {
    background: url(../imgs/page/homepage8/calendar.svg) no-repeat 0 0;
    padding-left: 20px
}

.nav-right {
    float: right;
    margin-top: -10px
}

.nav-right li {
    float: left;
    padding: 0 0 0 5px
}

.nav-right li button {
    display: block;
    color: #101828;
    font-size: 16px;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 8px;
    background: 0 0;
    border: 0;
    font-family: noto sans,sans-serif;
    font-weight: 500;
    transition-duration: .2s
}

.nav-right li button:hover {
    background-color: #fff3ea;
    color: #fff;
    transition-duration: .2s;
    transform: translateY(-3px)
}

.nav-right li button.active {
    color: #fff;
    background-color: #fff3ea
}

.box-newsletter {
    border-radius: 18px;
    padding: 52px 74px
}

.box-newsletter .box-form-newsletter {
    background: #fff;
    max-width: 500px;
    padding: 11px 12px;
    border-radius: 55px
}

.box-newsletter .box-form-newsletter form {
    display: flex;
    align-items: center
}

.box-newsletter .box-form-newsletter form .input-newsletter {
    width: 90%;
    padding: 15px;
    border: 0;
    min-height: 50px;
    font-family: noto sans;
    font-weight: 400;
    font-size: 16px;
    line-height: 28px;
    color: #98a2b3
}

.box-newsletter .box-form-newsletter form .input-newsletter::-moz-placeholder {
    font-family: noto sans;
    font-weight: 400;
    font-size: 16px;
    line-height: 28px;
    color: #98a2b3
}

.box-newsletter .box-form-newsletter form .input-newsletter::placeholder {
    font-family: noto sans;
    font-weight: 400;
    font-size: 16px;
    line-height: 28px;
    color: #98a2b3
}

.box-newsletter .box-form-newsletter form .font-heading {
    font-family: noto sans,sans-serif;
    font-weight: 500
}

.box-newsletter .btn-send {
    background-image: url(../imgs/template/icons/btn-send.svg);
    background-repeat: no-repeat;
    background-position: -30px -21px;
    display: inline-block;
    height: 57px;
    width: 72px;
    border-radius: 0;
    padding: 0
}

.box-newsletter .block-chart {
    position: absolute;
    bottom: 0;
    left: 0;
    max-width: 255px;
    height: 194px;
    z-index: 2
}

.box-newsletter .block-chart img {
    box-shadow: 0 47px 65px rgba(21,28,38,.1);
    border-radius: 16px
}

.box-newsletter .img-newsletter {
    box-shadow: 0 47px 65px rgba(21,28,38,.1);
    border-radius: 16px;
    max-width: 332px;
    position: absolute;
    bottom: -110px;
    right: 0;
    display: inline-block;
    z-index: 1
}

.preloader {
    background-color: #f7f7f7;
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 999999;
    transition: .6s;
    margin: 0 auto
}

.preloader img {
    max-width: 250px
}

.rate {
    height: 21px;
    padding: 0 10px;
    display: flex;
    flex-direction: row-reverse;
    justify-content: center
}

.rate:not(:checked)>input {
    position: absolute;
    visibility: hidden
}

.rate:not(:checked)>label {
    float: right;
    width: 21px;
    height: 21px;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 30px;
    color: #ccc;
    margin-right: 3px
}

.rate:not(:checked)>label:before {
    content: "";
    width: 21px;
    height: 21px;
    display: block
}

.rate.small {
    transform: scale(.7);
    -moz-transform: scale(.7);
    -webkit-transform: scale(.7);
    -o-transform: scale(.7);
    -ms-transform: scale(.7);
    padding: 0
}

.breacrumb-cover {
    background-color: #dbece5;
    padding: 20px 0
}

.breadcrumbs li {
    color: #101828;
    font-size: 16px;
    display: inline-block;
    padding-left: 13px;
    position: relative
}

.breadcrumbs li::before {
    content: "/";
    position: absolute;
    top: 1px;
    left: 1px;
    color: #101828
}

.breadcrumbs li a {
    font-size: 16px;
    color: #101828;
    text-decoration: none
}

.breadcrumbs li a:hover {
    color: #101828
}

.breadcrumbs li:last-child::before {
    color: #101828
}

.breadcrumbs li:first-child::before {
    display: none
}

.breadcrumbs li:first-child {
    padding-left: 0
}

.text-center .nav {
    justify-content: center
}

@-webkit-keyframes load7 {
    0%,80%,100% {
        box-shadow: 0 2.5em 0 -1.3em
    }

    40% {
        box-shadow: 0 2.5em 0 0
    }
}

@keyframes load7 {
    0%,80%,100% {
        box-shadow: 0 2.5em 0 -1.3em
    }

    40% {
        box-shadow: 0 2.5em 0 0
    }
}

.loader {
    border-radius: 50%;
    width: 2em;
    height: 2em;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation: load7 1.8s infinite ease-in-out;
    animation: load7 1.8s infinite ease-in-out;
    color: #101828;
    font-size: 10px;
    margin: 80px auto;
    position: relative;
    text-indent: -9999em;
    transform: translateZ(0);
    -webkit-animation-delay: -.16s;
    animation-delay: -.16s
}

.loader:before {
    border-radius: 50%;
    width: 2em;
    height: 2em;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation: load7 1.8s infinite ease-in-out;
    animation: load7 1.8s infinite ease-in-out;
    content: "";
    position: absolute;
    top: 0;
    left: -3.5em;
    -webkit-animation-delay: -.32s;
    animation-delay: -.32s
}

.loader:after {
    border-radius: 50%;
    width: 2em;
    height: 2em;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation: load7 1.8s infinite ease-in-out;
    animation: load7 1.8s infinite ease-in-out;
    content: "";
    position: absolute;
    top: 0;
    left: 3.5em
}

.banner-hero {
    padding: 60px 0 20px;
    position: relative
}

.banner-hero.banner-1 {
    background-color: #faede3
}

.banner-hero.banner-1 .container {
    z-index: 2;
    position: relative
}

.banner-hero.banner-1::before {
    content: "";
    position: absolute;
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    height: 200px;
    width: 200px;
    background: url(../imgs/template/pattern-1.svg) no-repeat;
    background-size: cover;
    z-index: 1
}

.banner-hero.banner-1::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    height: 200px;
    width: 200px;
    background: url(../imgs/template/pattern-2.svg) no-repeat;
    background-size: cover
}

.banner-hero.banner-1 .banner-imgs {
    padding: 20px 0 0;
    position: relative;
    width: 100%;
    height: 560px;
    float: right
}

.banner-hero.banner-1 .banner-imgs img {
    position: absolute;
    bottom: -40px;
    right: 0;
    left: 0;
    max-width: 100%;
    z-index: 1
}

.banner-hero.banner-1 .banner-imgs .video-block {
    position: absolute;
    bottom: 2%;
    left: -80px;
    height: 224px;
    width: 176px;
    background: url(../imgs/page/homepage1/watch-intro.png) no-repeat;
    background-size: cover;
    line-height: 224px;
    text-align: left;
    padding: 0 30px 0 50px;
    z-index: 2
}

.banner-hero.banner-1 .banner-imgs .video-block span {
    display: inline-block;
    list-style: none;
    color: #fff;
    vertical-align: middle
}

.banner-hero.banner-2 {
    background-color: #bee1e6
}

.banner-hero.banner-2 .container {
    position: relative;
    z-index: 4
}

.banner-hero.banner-2::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    height: 200px;
    width: 200px;
    background: url(../imgs/template/pattern-6.svg) no-repeat;
    background-size: cover
}

.banner-hero.banner-2 .banner-imgs {
    padding: 20px 0 0;
    position: relative;
    width: 100%;
    float: right
}

.banner-hero.banner-2 .banner-imgs .block-1 {
    position: absolute;
    bottom: 20px;
    left: -70px;
    z-index: 3;
    width: 220px;
    height: 260px
}

.banner-hero.banner-2 .banner-imgs .block-1 img {
    border-radius: 10px
}

.banner-hero.banner-2 .banner-imgs .block-2 {
    z-index: 3;
    position: absolute;
    top: 15%;
    right: -80px;
    height: 169px;
    width: 155px
}

.banner-hero.banner-2 .banner-imgs .block-2 img {
    border-radius: 10px
}

.banner-hero.banner-4 {
    background-color: #006d77;
    padding: 120px 0 80px
}

.banner-hero.banner-4 .banner-imgs {
    position: relative
}

.banner-hero.banner-4 .banner-imgs .btn-play-video-2 {
    position: absolute;
    top: 50%;
    left: -44px;
    margin-top: -54px;
    height: 109px;
    width: 116px;
    background: url(../imgs/template/icons/icon-play-2.svg) no-repeat;
    z-index: 5
}

.banner-hero.bg-about-1 {
    background: url(../imgs/page/about/1/bg-about-1.png) no-repeat bottom left;
    background-size: 100% 100%;
    background-color: transparent;
    padding-top: 100px
}

.banner-hero.bg-about-1::after {
    display: none
}

.banner-hero.bg-about-1 .banner-imgs {
    max-width: 510px
}

.banner-hero.bg-about-1 .banner-imgs .block-1 {
    left: -220px;
    bottom: 0
}

.banner-hero.bg-about-2 {
    background-color: #fff3ea
}

.banner-hero.bg-about-2 .box-banner-left {
    padding-bottom: 100px
}

.banner-hero.bg-about-2 .banner-imgs {
    position: relative;
    width: 100%;
    height: 100%
}

.banner-hero.bg-about-2 .block-1 {
    position: absolute;
    bottom: -47px;
    left: -150px;
    z-index: 3;
    width: 350px
}

.banner-hero.bg-about-2 .block-1 img {
    border-radius: 10px
}

.banner-hero.bg-service-1 {
    background-color: #bee1e6;
    padding-bottom: 60px;
    padding-top: 20px;
    position: relative
}

.banner-hero.bg-service-1 * {
    z-index: 2
}

.banner-hero.bg-service-1 .banner-imgs {
    position: relative;
    margin-top: 40px
}

.banner-hero.bg-service-1 .banner-imgs img {
    border-radius: 16px
}

.banner-hero.bg-service-1 .banner-imgs .block-1 {
    max-width: 310px;
    position: absolute;
    top: -10px;
    z-index: 2;
    left: -90px
}

.banner-hero.bg-service-1 .banner-imgs .block-1 img {
    border-radius: 8px;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.banner-hero.bg-service-2 {
    padding-bottom: 60px;
    padding-top: 50px;
    position: relative
}

.banner-hero.bg-service-2 .banner-imgs {
    position: relative;
    margin-top: 140px
}

.banner-hero.bg-service-2 .banner-imgs img {
    border-radius: 16px;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.banner-hero.bg-service-2 .banner-imgs .block-1 {
    max-width: 212px;
    position: absolute;
    top: -20px;
    z-index: 2;
    left: -110px
}

.banner-hero.bg-service-2 .banner-imgs .block-1 img {
    border-radius: 8px;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.banner-hero.bg-service-2 .banner-imgs .block-2 {
    max-width: 310px;
    position: absolute;
    bottom: 110px;
    z-index: 2;
    left: -150px
}

.banner-hero.bg-service-2 .banner-imgs .block-2 img {
    border-radius: 8px;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.banner-hero.bg-service-2 .banner-imgs .block-3 {
    max-width: 400px;
    position: absolute;
    bottom: 50px;
    z-index: 2;
    right: -160px
}

.banner-hero.bg-service-2 .banner-imgs .block-3 img {
    border-radius: 8px;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.banner-hero.banner-faqs-1 {
    padding-top: 150px;
    padding-bottom: 150px;
    margin-bottom: 50px;
    background: url(/themes/cloudtechtiq/assets/imgs/bg-banner.jpg) no-repeat center top;
    background-size: cover
}

.banner-hero.banner-technology {
    padding-top: 150px;
    padding-bottom: 150px;
    margin-bottom: 50px;
    background: url(/themes/cloudtechtiq/assets/imgs/partner-banner.jpg) no-repeat center top;
    background-size: cover
}

.banner-hero.banner-breadcrums {
    background-color: #fff3ea;
    padding: 48px 0
}

.banner-hero.banner-head-image {
    background-size: cover!important;
    background-repeat: top center!important;
    background-repeat: no-repeat!important;
    padding-bottom: 130px;
    padding-top: 130px;
    position: relative
}

.banner-hero.banner-head-image .container {
    z-index: 2;
    position: relative
}

.banner-hero.banner-head-image::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(16,24,40,.5);
    z-index: 1
}

.banner-hero.banner-homepage5 .banner-imgs {
    position: relative
}

.banner-hero.banner-homepage5 .banner-imgs .block-1 {
    position: absolute;
    top: -30px;
    left: -30px;
    z-index: 12
}

.banner-hero.banner-homepage5 .banner-imgs .block-2 {
    position: absolute;
    bottom: 0;
    z-index: 12;
    left: 0
}

.banner-hero.banner-homepage5 .banner-imgs .block-3 {
    position: absolute;
    bottom: -50px;
    right: -105px;
    z-index: 12;
    max-width: 230px
}

.banner-hero.banner-homepage5 .banner-imgs .block-3 img {
    border-radius: 16px;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.banner-hero.banner-homepage6 {
    padding-top: 0;
    padding-bottom: 0
}

.banner-hero.banner-homepage6 .banner-imgs {
    position: relative;
    display: flex;
    align-items: flex-end;
    height: 100%;
    bottom: -20px
}

.banner-hero.banner-homepage6 .banner-imgs .img-banner {
    z-index: 3;
    position: relative
}

.banner-hero.banner-homepage6 .banner-imgs .block-1 {
    position: absolute;
    top: 290px;
    left: -10px;
    z-index: 12
}

.banner-hero.banner-homepage6 .banner-imgs .block-2 {
    position: absolute;
    top: 130px;
    right: -105px;
    z-index: 1;
    max-width: 180px
}

.banner-hero.banner-homepage6 .banner-imgs .block-2 img {
    border-radius: 16px;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.banner-hero.banner-homepage8 .rounded-img {
    border-radius: 157px;
    overflow: hidden;
    width: 190px;
    margin-right: 17px;
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.banner-hero.banner-homepage8 .rounded-img img {
    height: 100%
}

@-webkit-keyframes hero-thumb-animation {
    0% {
        transform: translateY(-20px)
    }

    100% {
        transform: translateY(0px)
    }
}

@keyframes hero-thumb-animation {
    0% {
        transform: translateY(-20px)
    }

    100% {
        transform: translateY(0px)
    }
}

@-webkit-keyframes hero-thumb-sm-animation {
    0% {
        transform: translateY(-20px) translateX(50px)
    }

    100% {
        transform: translateY(-20px) translateX(0px)
    }
}

@keyframes hero-thumb-sm-animation {
    0% {
        transform: translateY(-20px) translateX(50px)
    }

    100% {
        transform: translateY(-20px) translateX(0px)
    }
}

@-webkit-keyframes hero-thumb-sm-2-animation {
    0% {
        transform: translateY(-50px)
    }

    100% {
        transform: translateY(0px)
    }
}

@keyframes hero-thumb-sm-2-animation {
    0% {
        transform: translateY(-50px)
    }

    100% {
        transform: translateY(0px)
    }
}

.shape-1 {
    -webkit-animation: hero-thumb-animation 2s linear infinite alternate;
    animation: hero-thumb-animation 2s linear infinite alternate
}

.shape-2 {
    -webkit-animation: hero-thumb-sm-animation 4s linear infinite alternate;
    animation: hero-thumb-sm-animation 4s linear infinite alternate
}

.shape-3 {
    -webkit-animation: hero-thumb-sm-2-animation 4s linear infinite alternate;
    animation: hero-thumb-sm-2-animation 4s linear infinite alternate
}

.header {
    padding: 10px 0;
    float: left;
    width: 100%;
    position: relative
}

.header .main-header {
    display: flex;
    align-items: center;
    justify-content: space-between
}

.header .main-header .header-left {
    display: flex;
    align-items: center;
    width: 100%
}

.header .main-header .header-left .header-nav {
    display: inline-block;
    width: 100%;
    text-align: center
}

.header .main-header .header-right {
    max-width: 225px;
    width: 100%
}

.header .main-header .header-right .block-signin {
    text-align: right
}

.header .nav-main-menu {
    width: 100%;
    padding: 0;
    float: left;
    font-size: 20px!important
}

.header .main-menu {
    display: inline-block;
    padding-top: 5px
}

.header .main-menu li {
    float: left;
    position: relative;
    text-align: left
}

.header .main-menu li.has-children>a::after {
    content: "\f151";
    font-family: uicons-regular-rounded!important;
    font-style: normal;
    font-weight: 400!important;
    font-variant: normal;
    text-transform: none;
    line-height: 1!important;
    font-size: 14px;
    opacity: 1;
    margin-left: 4px
}

.header .main-menu li.hr {
    padding: 0 22px
}

.header-font-1 {
    font-size: 20px!important
}

.header .main-menu li.hr span {
    background-color: #f2f4f7;
    height: 1px;
    width: 100%;
    display: block;
    margin: 5px 0
}

.header .main-menu li a {
    font-family: chivo,sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    color: #101828;
    display: block;
    padding: 30px 22px;
    text-decoration: none;
    position: relative
}

.header .main-menu li a:hover {
    color: #006d77
}

.header .main-menu li a:hover i {
    opacity: 1;
    transition: .2s
}

.header .main-menu li a i {
    font-size: 12px;
    margin-right: 8px;
    opacity: .38;
    transition: .2s
}

.header .main-menu li ul {
    opacity: 0;
    visibility: hidden;
    transition-duration: .2s;
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 999;
    min-width: 480px;
    border-radius: 4px;
    padding: 8px 0 8px 0;
    box-shadow: 4px 4px 40px rgba(16,24,40,.1);
    background-color: #fff
}

.header .main-menu li ul li {
    width: 100%
}

.header .main-menu li ul li a {
    font-size: 14px;
    color: #101828;
    position: relative;
    padding: 10px 22px;
    transition: .2s
}

.header .main-menu li ul li a:hover {
    padding-left: 25px;
    transition: .2s
}

.header .main-menu li ul li a.closer {
    padding: 8px 22px
}

.header .main-menu li ul li ul {
    top: 0;
    left: 100%
}

.header .main-menu li ul.two-col {
    columns: 1;
    -webkit-columns: 1;
    -moz-columns: 1;
    min-width: 350px
}

.header .main-menu li:hover>ul {
    opacity: 1;
    visibility: visible
}

.header .main-menu li:hover>ul li {
    width: 100%
}

.header .text-link-bd-btom {
    font-family: noto sans,sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 150%;
    color: #006d77;
    display: inline-block;
    position: relative;
    padding-left: 13px
}

.header .text-link-bd-btom:hover {
    color: #101828
}

.header .text-link-bd-btom::before {
    content: "";
    background: #006d77;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    position: absolute;
    left: 0;
    top: 50%;
    margin-top: -3px;
    -webkit-animation: shadow-pulse 1s infinite;
    animation: shadow-pulse 1s infinite
}

.header .block-signin .btn-shadow {
    box-shadow: 0 47px 65px rgba(21,28,38,.1)
}

.header.stick {
    padding: 10px 0
}

.header.header-2 {
    background-color: #dbece5
}

.sticky-bar.stick {
    -webkit-animation: 700ms ease-in-out 0s normal none 1 running fadeInDown;
    animation: 700ms ease-in-out 0s normal none 1 running fadeInDown;
    box-shadow: 0 8px 20px 0 rgba(0,0,0,.05);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
    left: 0;
    transition: all .3s ease 0s;
    border-bottom: 1px solid #f2f4f7;
    background: #fff
}

.sticky-bar.stick.sticky-white-bg {
    background-color: #fff
}

.sticky-bar.stick.sticky-blue-bg {
    background-color: #3286e0
}

.sticky-bar.stick .burger-icon {
    top: 45px
}

.user-account {
    display: flex;
    align-items: center
}

.user-account img {
    max-width: 50px;
    border-radius: 50%;
    margin-right: 10px
}

.user-account .user-name {
    margin-bottom: 0;
    font-weight: 600;
    font-size: 14px
}

.perfect-scroll {
    height: 100vh;
    width: 300px;
    position: relative
}

.body-overlay-1 {
    background: 0 0;
    height: 100%;
    left: 0;
    opacity: 0;
    position: fixed;
    top: 0;
    visibility: hidden;
    width: 100%;
    cursor: crosshair;
    z-index: 997
}

.mobile-menu-active .body-overlay-1 {
    opacity: 1;
    visibility: visible
}

.header-top {
    color: #fff;
    padding: 10px 0
}

.header-top span {
    font-family: noto sans,sans-serif;
    font-size: 16px;
    line-height: 24px;
    font-weight: 700
}

.header-top a {
    color: #e29578
}

.header-top .line-right {
    position: relative;
    display: inline-block;
    padding-right: 35px
}

.header-top .line-right::before {
    content: "";
    position: absolute;
    top: 5px;
    right: 15px;
    width: 1px;
    height: 18px;
    border-right: 1px dashed #e29578
}

.header-top.header-top-green {
    background-color: #006d77
}

.header-top.header-top-green a {
    color: #afeae4
}

.header-top.header-top-green .line-right::before {
    border-right: 1px dashed #afeae4
}

.header-style-2 {
    background-color: #006d77
}

.header-style-2.sticky-bar.stick {
    background-color: #006d77;
    border-bottom: 1px solid #008c99
}

.header-style-2 .burger-icon.burger-icon-white>span::before,.header-style-2 .burger-icon.burger-icon-white>span::after {
    background-color: #e4e7ec
}

.header-style-2 .main-menu>li>a {
    color: #fff
}

.header-style-2 .main-menu>li>a:hover {
    color: #83c5be
}

.header-style-2 .btn-default {
    background-color: #006d77;
    color: #fff;
    border: 1px solid #fff;
    background-image: url(../imgs/template/icons/arrow-small-right-w.svg);
    background-repeat: no-repeat;
    background-position: center right 25px;
    padding-right: 56px
}

.header-style-3 {
    background-color: #fff3ea
}

.header-style-3.sticky-bar.stick {
    background-color: #fff3ea
}

.header-style-4 {
    background-color: #bee1e6
}

.header-style-4.sticky-bar.stick {
    background-color: #bee1e6
}

.header-style-5 {
    z-index: 2
}

.header-style-5 .burger-icon.burger-icon-white>span::before,.header-style-5 .burger-icon.burger-icon-white>span::after {
    background-color: #e4e7ec
}

.header-style-5 .main-menu>li>a {
    color: #fff
}

.header-style-5 .main-menu>li>a:hover {
    color: #83c5be
}

.header-style-5.sticky-bar.stick {
    background-color: #006d77;
    border-bottom: 1px solid #008c99
}

.header-style-5 .btn-default {
    background-color: transparent;
    color: #fff;
    border: 1px solid #fff;
    background-image: url(../imgs/template/icons/arrow-small-right-w.svg);
    background-repeat: no-repeat;
    background-position: center right 25px;
    padding-right: 56px
}

.mobile-header-wrapper-style {
    position: fixed;
    top: 0;
    width: 380px;
    min-height: 100vh;
    bottom: 0;
    right: 0;
    visibility: hidden;
    opacity: 0;
    transition: all .25s cubic-bezier(.645,.045,.355,1);
    background-color: #fff;
    box-shadow: 0 0 15px 0 rgba(0,0,0,.09);
    z-index: 1000
}

.mobile-header-wrapper-style.sidebar-visible {
    visibility: visible;
    opacity: 1;
    transform: translate(0,0)
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner {
    padding: 0 0 30px;
    height: 100%;
    overflow-y: auto;
    overflow-x: hidden
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-top {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 34px 30px 30px;
    background-color: #fff;
    align-items: center;
    align-self: center;
    border-bottom: thin solid #f2f4f7
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-top .mobile-header-logo a {
    display: block
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-top .mobile-header-logo a img {
    width: 100px
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area {
    padding: 30px
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li {
    display: block;
    position: relative;
    padding: 13px 0
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li:last-child {
    border-bottom: none
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li.has-children .menu-expand {
    right: 0;
    position: absolute;
    cursor: pointer;
    z-index: 9;
    text-align: center;
    font-size: 12px;
    display: block;
    width: 30px;
    height: 30px;
    line-height: 38px;
    top: 5px;
    color: #101828
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li.has-children .menu-expand i {
    font-size: 18px;
    font-weight: 300;
    opacity: .5
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li.has-children.active>.menu-expand {
    background: rgba(255,255,255,.2)
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li.has-children.active>.menu-expand i::before {
    content: "\f113"
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li a {
    font-size: 16px;
    font-family: chivo,sans-serif;
    line-height: 1;
    text-transform: capitalize;
    font-weight: 500;
    position: relative;
    display: inline-block;
    color: #101828;
    transition-duration: .2s
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li a i {
    margin-right: 5px
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li ul {
    padding: 10px 0 0 10px
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li ul li {
    padding: 10px 0;
    border-bottom: none
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li ul li.has-children .menu-expand {
    top: 0
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li ul li:hover a {
    padding-left: 13px;
    transition-duration: .2s
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li ul li a {
    font-size: 14px;
    display: block;
    font-weight: 500;
    color: #101828;
    padding-left: 10px;
    position: relative;
    transition-duration: .2s
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li ul li ul {
    margin-top: 0
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li ul li.has-children.active {
    padding-bottom: 0
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li ul li.hr {
    padding: 0 0 0 10px
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li ul li.hr span {
    background-color: #f2f4f7;
    height: 1px;
    width: 100%;
    display: block;
    margin: 5px 0
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li:hover>a {
    color: #006d77;
    padding-left: 3px;
    transition-duration: .2s
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .categories-dropdown-wrap ul li a {
    padding: 5px 15px
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap {
    padding: 20px;
    border-radius: 5px;
    border: 1px solid #101828;
    margin: 17px 0 30px
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info {
    position: relative;
    margin-bottom: 13px
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info:last-child {
    margin-bottom: 0
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info a {
    font-size: 14px;
    display: block;
    font-weight: 500;
    color: #006d77
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info a:hover {
    color: #101828
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info a i {
    font-size: 14px;
    color: #101828;
    margin-right: 8px
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info .lang-curr-dropdown {
    margin-top: 5px;
    display: none;
    background-color: transparent;
    box-shadow: none;
    padding: 10px 0 0;
    width: 100%;
    z-index: 11
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info .lang-curr-dropdown ul li {
    padding-bottom: 10px
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info .lang-curr-dropdown ul li:last-child {
    padding-bottom: 0
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info .lang-curr-dropdown ul li a {
    font-size: 16px;
    color: rgba(255,255,255,.7);
    font-weight: 400
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info .lang-curr-dropdown ul li a:hover {
    color: #006d77
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-info-wrap .single-mobile-header-info:hover>a {
    color: #101828
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-header-border {
    border-bottom: 1px solid rgba(255,255,255,.15)
}

.mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .site-copyright {
    font-size: 13px;
    color: #101828
}

.burger-icon {
    position: absolute;
    width: 24px;
    height: 20px;
    cursor: pointer;
    transition: all .25s cubic-bezier(.645,.045,.355,1);
    top: 45px;
    right: 27px;
    z-index: 1002
}

.burger-icon>span {
    display: block;
    position: absolute;
    left: 0;
    width: 100%;
    height: 2px
}

.burger-icon>span.burger-icon-top {
    top: 2px
}

.burger-icon>span.burger-icon-bottom {
    bottom: 2px
}

.burger-icon>span.burger-icon-mid {
    top: 9px
}

.burger-icon.burger-close {
    position: fixed
}

.burger-icon.burger-close>span.burger-icon-top {
    display: none;
    opacity: 0
}

.burger-icon.burger-close>span.burger-icon-mid {
    top: 8px;
    transform: rotate(45deg)
}

.burger-icon.burger-close>span.burger-icon-bottom {
    bottom: 10px;
    transform: rotate(-45deg)
}

.burger-icon>span::before,.burger-icon>span::after {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    content: "";
    background-color: #333
}

.burger-icon.burger-icon-white>span::before,.burger-icon.burger-icon-white>span::after {
    background-color: #667085
}

.mobile-search form {
    background-color: #eae4e9;
    border-radius: 8px;
    height: 44px;
    padding: 0 15px 0 44px;
    position: relative
}

.mobile-search form input {
    border: 0;
    background-color: transparent;
    width: 100%;
    padding: 12px 10px
}

.mobile-search form i {
    position: absolute;
    left: 18px;
    top: 14px;
    font-size: 18px;
    color: #1d2939
}

.mobile-social-icon h6 {
    font-weight: 600;
    font-size: 20px;
    margin-bottom: 30px
}

.mobile-social-icon a {
    text-align: center;
    font-size: 14px;
    margin-right: 5px;
    transition-duration: .5s;
    height: 30px;
    width: 30px;
    display: inline-flex;
    background: #efeaff;
    border-radius: 30px;
    line-height: 1;
    align-content: center;
    justify-content: center
}

.mobile-social-icon a img {
    max-width: 18px
}

.mobile-social-icon a img:hover {
    opacity: .8
}

.mobile-social-icon a:hover {
    transform: translateY(-2px);
    transition-duration: .5s;
    margin-top: -2px
}

.mobile-social-icon a:last-child {
    margin-right: 0
}

.mobile-account {
    margin: 20px 0 25px;
    padding: 30px 0 20px;
    border-top: thin solid #f2f4f7;
    border-bottom: thin solid #f2f4f7
}

.mobile-account h6 {
    font-weight: 600;
    font-size: 18px
}

.mobile-account ul li {
    padding: 13px 0
}

.mobile-account ul li a {
    font-size: 15px;
    line-height: 1;
    text-transform: capitalize;
    font-weight: 500;
    position: relative;
    display: inline-block;
    color: #101828;
    transition-duration: .2s
}

.mobile-account ul li:hover a {
    padding-left: 3px;
    transition-duration: .2s;
    color: #006d77
}

.sidebar-title {
    border-bottom: thin solid #101828;
    font-weight: 600;
    margin-bottom: 30px;
    padding-bottom: 10px
}

.search-form form {
    position: relative
}

.search-form form input {
    border: 1px solid #ececec;
    border-radius: 10px;
    height: 64px;
    box-shadow: none;
    padding-left: 20px;
    font-size: 16px;
    width: 100%
}

.search-form form button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 0;
    border: none;
    font-size: 20px;
    height: 100%;
    padding: 0 24px;
    background-color: transparent;
    color: #242424
}

.widget-categories {
    background-color: #fff3ea!important
}

.widget-categories li {
    padding: 8px 0
}

.widget-categories li+li {
    border-top: 1px solid #101828
}

.widget-categories li a {
    color: #006d77;
    font-size: 16px
}

.widget-categories li span.count {
    background-color: #ddd3fa;
    color: #006d77;
    border-radius: 3px;
    display: block;
    padding: 3px 5px;
    min-width: 26px;
    text-align: center
}

.widget-categories li:hover span.count {
    background-color: #006d77;
    color: #fff
}

.post-list-small-item {
    transition-duration: .2s
}

.post-list-small-item:hover {
    transition-duration: .2s;
    transform: translateY(-3px)
}

.post-list-small-item figure img {
    max-width: 85px;
    border-radius: 5px
}

.post-list-small-item .post-meta {
    font-size: 13px
}

.post-list-small-item .post-meta img {
    max-width: 30px;
    border-radius: 50%;
    margin-right: 5px
}

.post-list-small-item h5 {
    font-weight: 600;
    font-size: 14px;
    line-height: 1.2;
    margin-bottom: 10px
}

.post-list-small-item:not(:last-child) {
    margin-bottom: 15px
}

.footer .width-20 {
    width: 21%
}

.footer .width-16 {
    width: 16%
}

.footer .footer-top {
    display: inline-block;
    width: 100%;
    padding: 0 0 40px;
    margin-bottom: 40px;
    border-bottom: 1px solid #e4e7ec
}

.footer .menu-footer {
    display: inline-block
}

.footer .menu-footer li {
    list-style: none;
    margin-bottom: 8px
}

.footer .menu-footer li a {
    color: #667085;
    font-family: noto sans,sans-serif;
    font-size: 16px;
    line-height: 28px;
    text-decoration: none;
    transition-duration: .2s
}

.footer .menu-footer li a:hover {
    color: #006d77;
    transition-duration: .2s;
    padding-left: 3px
}

.footer .footer-bottom {
    border-top: 1px solid #e4e7ec;
    padding: 30px 0;
    color: #667085;
    font-size: 14px
}

.footer .footer-bottom a {
    text-decoration: none
}

.footer .footer-bottom .icon-socials {
    display: inline-block;
    margin-left: 10px;
    height: 32px;
    width: 32px;
    transition-duration: .2s
}

.footer .footer-bottom .icon-socials:hover {
    transform: translateY(-3px);
    transition-duration: .2s
}

.footer .footer-bottom .icon-socials.icon-facebook {
    background: url(../imgs/template/icons/facebook.svg) no-repeat 0 0;
    transition-duration: .2s
}

.footer .footer-bottom .icon-socials.icon-facebook:hover {
    opacity: .8;
    transition-duration: .2s
}

.footer .footer-bottom .icon-socials.icon-twitter {
    background: url(../imgs/template/icons/twitter.svg) no-repeat 0 0;
    transition-duration: .2s
}

.footer .footer-bottom .icon-socials.icon-twitter:hover {
    opacity: .8;
    transition-duration: .2s
}

.footer .footer-bottom .icon-socials.icon-instagram {
    background: url(../imgs/template/icons/instagram.svg) no-repeat 0 0;
    transition-duration: .2s
}

.footer .footer-bottom .icon-socials.icon-instagram:hover {
    opacity: .8;
    transition-duration: .2s
}

.footer .footer-bottom .icon-socials.icon-linkedin {
    background: url(../imgs/template/icons/linkedin.svg) no-repeat 0 0;
    transition-duration: .2s
}

.footer .footer-bottom .icon-socials.icon-linkedin:hover {
    opacity: .8;
    transition-duration: .2s
}

#scrollUp {
    width: 42px;
    height: 42px;
    color: #fff;
    right: 30px;
    bottom: 30px;
    border-radius: 30px;
    text-align: center;
    overflow: hidden;
    z-index: 999!important;
    border: 0;
    background-color: #fff;
    transition-duration: .2s;
    background-color: #006d77
}

#scrollUp i {
    display: block;
    line-height: 46px!important;
    font-size: 20px;
    color: #fff
}

#scrollUp:hover {
    transform: translateY(-3px);
    transition-duration: .2s
}

.section-padding-30 {
    padding: 30px 0
}

.section-padding-50 {
    padding: 50px 0
}

.section-padding-60 {
    padding: 60px 0
}

.section-padding {
    padding: 25px 0
}

.ptb-0 {
    padding: 0
}

.ptb-10 {
    padding: 10px 0
}

.ptb-20 {
    padding: 20px 0
}

.ptb-30 {
    padding: 30px 0
}

.ptb-35 {
    padding: 35px 0
}

.ptb-32 {
    padding: 32px 0
}

.ptb-40 {
    padding: 40px 0
}

.ptb-50 {
    padding: 50px 0
}

.ptb-60 {
    padding: 60px 0
}

.ptb-70 {
    padding: 70px 0
}

.ptb-80 {
    padding: 80px 0
}

.ptb-90 {
    padding: 90px 0
}

.ptb-100 {
    padding: 100px 0
}

.ptb-110 {
    padding: 110px 0
}

.ptb-120 {
    padding: 120px 0
}

.ptb-130 {
    padding: 130px 0
}

.ptb-140 {
    padding: 140px 0
}

.ptb-150 {
    padding: 150px 0
}

.ptb-160 {
    padding: 160px 0
}

.ptb-170 {
    padding: 170px 0
}

.ptb-177 {
    padding: 177px 0
}

.ptb-180 {
    padding: 180px 0
}

.ptb-190 {
    padding: 190px 0
}

.ptb-200 {
    padding: 200px 0
}

.ptb-210 {
    padding: 210px 0
}

.ptb-220 {
    padding: 220px 0
}

.ptb-290 {
    padding: 290px 0
}

.ptb-310 {
    padding: 310px 0
}

.p-10 {
    padding: 10px!important
}

.p-15 {
    padding: 15px!important
}

.p-20 {
    padding: 20px!important
}

.p-25 {
    padding: 25px!important
}

.p-30 {
    padding: 30px!important
}

.p-40 {
    padding: 40px!important
}

.p-65 {
    padding: 65px!important
}

.pt-5 {
    padding-top: 5px!important
}

.pt-10 {
    padding-top: 10px!important
}

.pt-15 {
    padding-top: 15px!important
}

.pt-20 {
    padding-top: 20px!important
}

.pt-25 {
    padding-top: 25px!important
}

.pt-30 {
    padding-top: 30px!important
}

.pt-35 {
    padding-top: 35px!important
}

.pt-40 {
    padding-top: 40px!important
}

.pt-45 {
    padding-top: 45px!important
}

.pt-50 {
    padding-top: 50px!important
}

.pt-55 {
    padding-top: 55px!important
}

.pt-60 {
    padding-top: 60px!important
}

.pt-65 {
    padding-top: 65px!important
}

.pt-70 {
    padding-top: 70px!important
}

.pt-75 {
    padding-top: 75px!important
}

.pt-80 {
    padding-top: 80px!important
}

.pt-85 {
    padding-top: 85px!important
}

.pt-90 {
    padding-top: 90px!important
}

.pt-95 {
    padding-top: 95px!important
}

.pt-100 {
    padding-top: 100px!important
}

.pt-105 {
    padding-top: 105px!important
}

.pt-110 {
    padding-top: 110px!important
}

.pt-115 {
    padding-top: 115px!important
}

.pt-120 {
    padding-top: 120px!important
}

.pt-125 {
    padding-top: 125px!important
}

.pt-130 {
    padding-top: 130px!important
}

.pt-135 {
    padding-top: 135px!important
}

.pt-140 {
    padding-top: 140px!important
}

.pt-145 {
    padding-top: 145px!important
}

.pt-150 {
    padding-top: 150px!important
}

.pt-155 {
    padding-top: 155px!important
}

.pt-160 {
    padding-top: 160px!important
}

.pt-165 {
    padding-top: 165px!important
}

.pt-170 {
    padding-top: 170px!important
}

.pt-175 {
    padding-top: 175px!important
}

.pt-180 {
    padding-top: 180px!important
}

.pt-185 {
    padding-top: 185px!important
}

.pt-190 {
    padding-top: 190px!important
}

.pt-195 {
    padding-top: 195px!important
}

.pt-200 {
    padding-top: 200px!important
}

.pt-260 {
    padding-top: 260px!important
}

.pb-5 {
    padding-bottom: 5px!important
}

.pb-10 {
    padding-bottom: 10px!important
}

.pb-15 {
    padding-bottom: 15px!important
}

.pb-20 {
    padding-bottom: 20px!important
}

.pb-25 {
    padding-bottom: 25px!important
}

.pb-30 {
    padding-bottom: 30px!important
}

.pb-35 {
    padding-bottom: 35px!important
}

.pb-40 {
    padding-bottom: 40px!important
}

.pb-45 {
    padding-bottom: 45px!important
}

.pb-50 {
    padding-bottom: 50px!important
}

.pb-55 {
    padding-bottom: 55px!important
}

.pb-60 {
    padding-bottom: 60px!important
}

.pb-65 {
    padding-bottom: 65px!important
}

.pb-70 {
    padding-bottom: 70px!important
}

.pb-75 {
    padding-bottom: 75px!important
}

.pb-80 {
    padding-bottom: 80px!important
}

.pb-85 {
    padding-bottom: 85px!important
}

.pb-90 {
    padding-bottom: 90px!important
}

.pb-95 {
    padding-bottom: 95px!important
}

.pb-100 {
    padding-bottom: 100px!important
}

.pb-105 {
    padding-bottom: 105px!important
}

.pb-110 {
    padding-bottom: 110px!important
}

.pb-115 {
    padding-bottom: 115px!important
}

.pb-120 {
    padding-bottom: 120px!important
}

.pb-125 {
    padding-bottom: 125px!important
}

.pb-130 {
    padding-bottom: 130px!important
}

.pb-135 {
    padding-bottom: 135px!important
}

.pb-140 {
    padding-bottom: 140px!important
}

.pb-145 {
    padding-bottom: 145px!important
}

.pb-150 {
    padding-bottom: 150px!important
}

.pb-155 {
    padding-bottom: 155px!important
}

.pb-160 {
    padding-bottom: 160px!important
}

.pb-165 {
    padding-bottom: 165px!important
}

.pb-170 {
    padding-bottom: 170px!important
}

.pb-175 {
    padding-bottom: 175px!important
}

.pb-180 {
    padding-bottom: 180px!important
}

.pb-185 {
    padding-bottom: 185px!important
}

.pb-190 {
    padding-bottom: 190px!important
}

.pb-195 {
    padding-bottom: 195px!important
}

.pb-200 {
    padding-bottom: 200px!important
}

.pl-0 {
    padding-left: 0!important
}

.pl-5 {
    padding-left: 5px!important
}

.pl-10 {
    padding-left: 10px!important
}

.pl-15 {
    padding-left: 15px!important
}

.pl-20 {
    padding-left: 20px!important
}

.pl-25 {
    padding-left: 25px!important
}

.pl-30 {
    padding-left: 30px!important
}

.pl-35 {
    padding-left: 35px!important
}

.pl-40 {
    padding-left: 40px!important
}

.pl-45 {
    padding-left: 45px!important
}

.pl-50 {
    padding-left: 50px!important
}

.pl-55 {
    padding-left: 55px!important
}

.pl-60 {
    padding-left: 60px!important
}

.pl-65 {
    padding-left: 65px!important
}

.pl-70 {
    padding-left: 70px!important
}

.pl-75 {
    padding-left: 75px!important
}

.pl-80 {
    padding-left: 80px!important
}

.pl-85 {
    padding-left: 85px!important
}

.pl-90 {
    padding-left: 90px!important
}

.pl-95 {
    padding-left: 95px!important
}

.pl-100 {
    padding-left: 100px!important
}

.pl-105 {
    padding-left: 105px!important
}

.pl-110 {
    padding-left: 110px!important
}

.pl-115 {
    padding-left: 115px!important
}

.pl-120 {
    padding-left: 120px!important
}

.pl-125 {
    padding-left: 125px!important
}

.pl-130 {
    padding-left: 130px!important
}

.pl-135 {
    padding-left: 135px!important
}

.pl-140 {
    padding-left: 140px!important
}

.pl-145 {
    padding-left: 145px!important
}

.pl-150 {
    padding-left: 150px!important
}

.pl-155 {
    padding-left: 155px!important
}

.pl-160 {
    padding-left: 160px!important
}

.pl-165 {
    padding-left: 165px!important
}

.pl-170 {
    padding-left: 170px!important
}

.pl-175 {
    padding-left: 175px!important
}

.pl-180 {
    padding-left: 180px!important
}

.pl-185 {
    padding-left: 185px!important
}

.pl-190 {
    padding-left: 190px!important
}

.pl-195 {
    padding-left: 195px!important
}

.pl-200 {
    padding-left: 200px!important
}

.pr-0 {
    padding-right: 0!important
}

.pr-5 {
    padding-right: 5px!important
}

.pr-10 {
    padding-right: 10px!important
}

.pr-15 {
    padding-right: 15px!important
}

.pr-20 {
    padding-right: 20px!important
}

.pr-25 {
    padding-right: 25px!important
}

.pr-30 {
    padding-right: 30px!important
}

.pr-35 {
    padding-right: 35px!important
}

.pr-40 {
    padding-right: 40px!important
}

.pr-45 {
    padding-right: 45px!important
}

.pr-50 {
    padding-right: 50px!important
}

.pr-55 {
    padding-right: 55px!important
}

.pr-60 {
    padding-right: 60px!important
}

.pr-65 {
    padding-right: 65px!important
}

.pr-70 {
    padding-right: 70px!important
}

.pr-75 {
    padding-right: 75px!important
}

.pr-80 {
    padding-right: 80px!important
}

.pr-85 {
    padding-right: 85px!important
}

.pr-90 {
    padding-right: 90px!important
}

.pr-95 {
    padding-right: 95px!important
}

.pr-100 {
    padding-right: 100px!important
}

.pr-105 {
    padding-right: 105px!important
}

.pr-110 {
    padding-right: 110px!important
}

.pr-115 {
    padding-right: 115px!important
}

.pr-120 {
    padding-right: 120px!important
}

.pr-125 {
    padding-right: 125px!important
}

.pr-130 {
    padding-right: 130px!important
}

.pr-135 {
    padding-right: 135px!important
}

.pr-140 {
    padding-right: 140px!important
}

.pr-145 {
    padding-right: 145px!important
}

.pr-150 {
    padding-right: 150px!important
}

.pr-155 {
    padding-right: 155px!important
}

.pr-160 {
    padding-right: 160px!important
}

.pr-165 {
    padding-right: 165px!important
}

.pr-170 {
    padding-right: 170px!important
}

.pr-175 {
    padding-right: 175px!important
}

.pr-180 {
    padding-right: 180px!important
}

.pr-185 {
    padding-right: 185px!important
}

.pr-190 {
    padding-right: 190px!important
}

.pr-195 {
    padding-right: 195px!important
}

.pr-200 {
    padding-right: 200px!important
}

.plr-5-percent {
    padding: 0 5%
}

.mtb-0 {
    margin: 0
}

.mtb-10 {
    margin: 10px 0
}

.mtb-15 {
    margin: 15px 0
}

.mtb-20 {
    margin: 20px 0
}

.mtb-30 {
    margin: 30px 0
}

.mtb-40 {
    margin: 40px 0
}

.mtb-50 {
    margin: 50px 0
}

.mtb-60 {
    margin: 60px 0
}

.mtb-70 {
    margin: 70px 0
}

.mtb-80 {
    margin: 80px 0
}

.mtb-90 {
    margin: 90px 0
}

.mtb-100 {
    margin: 100px 0
}

.mtb-110 {
    margin: 110px 0
}

.mtb-120 {
    margin: 120px 0
}

.mtb-130 {
    margin: 130px 0
}

.mtb-140 {
    margin: 140px 0
}

.mtb-150 {
    margin: 150px 0
}

.mtb-290 {
    margin: 290px 0
}

.mb-24 {
    margin-bottom: 24px
}

.mt-5 {
    margin-top: 5px!important
}

.mt-8 {
    margin-top: 8px!important
}

.mt-10 {
    margin-top: 10px!important
}

.mt-15 {
    margin-top: 15px!important
}

.mt-20 {
    margin-top: 20px!important
}

.mt-25 {
    margin-top: 25px!important
}

.mt-30 {
    margin-top: 30px!important
}

.mt-35 {
    margin-top: 35px!important
}

.mt-40 {
    margin-top: 28px!important
}

.mt-45 {
    margin-top: 45px!important
}

.mt-50 {
    margin-top: 50px!important
}

.mt-55 {
    margin-top: 55px!important
}

.mt-60 {
    margin-top: 60px!important
}

.mt-65 {
    margin-top: 65px!important
}

.mt-70 {
    margin-top: 70px!important
}

.mt-75 {
    margin-top: 75px!important
}

.mt-80 {
    margin-top: 80px!important
}

.mt-85 {
    margin-top: 85px!important
}

.mt-90 {
    margin-top: 90px!important
}

.mt-95 {
    margin-top: 95px!important
}

.mt-100 {
    margin-top: 100px!important
}

.mt-105 {
    margin-top: 105px!important
}

.mt-110 {
    margin-top: 110px!important
}

.mt-115 {
    margin-top: 115px!important
}

.mt-120 {
    margin-top: 120px!important
}

.mt-125 {
    margin-top: 125px!important
}

.mt-130 {
    margin-top: 130px!important
}

.mt-135 {
    margin-top: 135px!important
}

.mt-140 {
    margin-top: 140px!important
}

.mt-145 {
    margin-top: 145px!important
}

.mt-150 {
    margin-top: 150px!important
}

.mt-155 {
    margin-top: 155px!important
}

.mt-160 {
    margin-top: 160px!important
}

.mt-165 {
    margin-top: 165px!important
}

.mt-170 {
    margin-top: 170px!important
}

.mt-175 {
    margin-top: 175px!important
}

.mt-180 {
    margin-top: 180px!important
}

.mt-185 {
    margin-top: 185px!important
}

.mt-190 {
    margin-top: 190px!important
}

.mt-195 {
    margin-top: 195px!important
}

.mt-200 {
    margin-top: 200px!important
}

.mb-5 {
    margin-bottom: 5px!important
}

.mb-10 {
    margin-bottom: 10px!important
}

.mb-15 {
    margin-bottom: 15px!important
}

.mb-20 {
    margin-bottom: 20px!important
}

.mb-25 {
    margin-bottom: 25px!important
}

.mb-30 {
    margin-bottom: 30px!important
}

.mb-35 {
    margin-bottom: 35px!important
}

.mb-40 {
    margin-bottom: 40px!important
}

.mb-45 {
    margin-bottom: 45px!important
}

.mb-50 {
    margin-bottom: 20!important
}

.mb-55 {
    margin-bottom: 55px!important
}

.mb-60 {
    margin-bottom: 60px!important
}

.mb-65 {
    margin-bottom: 65px!important
}

.mb-70 {
    margin-bottom: 70px!important
}

.mb-75 {
    margin-bottom: 75px!important
}

.mb-80 {
    margin-bottom: 80px!important
}

.mb-85 {
    margin-bottom: 85px!important
}

.mb-90 {
    margin-bottom: 90px!important
}

.mb-95 {
    margin-bottom: 95px!important
}

.mb-100 {
    margin-bottom: 100px!important
}

.mb-105 {
    margin-bottom: 105px!important
}

.mb-110 {
    margin-bottom: 110px!important
}

.mb-115 {
    margin-bottom: 115px!important
}

.mb-120 {
    margin-bottom: 120px!important
}

.mb-125 {
    margin-bottom: 125px!important
}

.mb-130 {
    margin-bottom: 130px!important
}

.mb-135 {
    margin-bottom: 135px!important
}

.mb-140 {
    margin-bottom: 140px!important
}

.mb-145 {
    margin-bottom: 145px!important
}

.mb-150 {
    margin-bottom: 150px!important
}

.mb-155 {
    margin-bottom: 155px!important
}

.mb-160 {
    margin-bottom: 160px!important
}

.mb-165 {
    margin-bottom: 165px!important
}

.mb-170 {
    margin-bottom: 170px!important
}

.mb-175 {
    margin-bottom: 175px!important
}

.mb-180 {
    margin-bottom: 180px!important
}

.mb-185 {
    margin-bottom: 185px!important
}

.mb-190 {
    margin-bottom: 190px!important
}

.mb-195 {
    margin-bottom: 195px!important
}

.mb-200 {
    margin-bottom: 200px!important
}

.ml-0 {
    margin-left: 0!important
}

.ml-5 {
    margin-left: 5px!important
}

.ml-10 {
    margin-left: 10px!important
}

.ml-15 {
    margin-left: 15px!important
}

.ml-20 {
    margin-left: 20px!important
}

.ml-25 {
    margin-left: 25px!important
}

.ml-30 {
    margin-left: 30px!important
}

.ml-35 {
    margin-left: 35px!important
}

.ml-40 {
    margin-left: 40px!important
}

.ml-45 {
    margin-left: 45px!important
}

.ml-50 {
    margin-left: 50px!important
}

.ml-55 {
    margin-left: 55px!important
}

.ml-60 {
    margin-left: 60px!important
}

.ml-65 {
    margin-left: 65px!important
}

.ml-70 {
    margin-left: 70px!important
}

.ml-75 {
    margin-left: 75px!important
}

.ml-80 {
    margin-left: 80px!important
}

.ml-85 {
    margin-left: 85px!important
}

.ml-90 {
    margin-left: 90px!important
}

.ml-95 {
    margin-left: 95px!important
}

.ml-100 {
    margin-left: 100px!important
}

.ml-105 {
    margin-left: 105px!important
}

.ml-110 {
    margin-left: 110px!important
}

.ml-115 {
    margin-left: 115px!important
}

.ml-120 {
    margin-left: 120px!important
}

.ml-125 {
    margin-left: 125px!important
}

.ml-130 {
    margin-left: 130px!important
}

.ml-135 {
    margin-left: 135px!important
}

.ml-140 {
    margin-left: 140px!important
}

.ml-145 {
    margin-left: 145px!important
}

.ml-150 {
    margin-left: 150px!important
}

.ml-155 {
    margin-left: 155px!important
}

.ml-160 {
    margin-left: 160px!important
}

.ml-165 {
    margin-left: 165px!important
}

.ml-170 {
    margin-left: 170px!important
}

.ml-175 {
    margin-left: 175px!important
}

.ml-180 {
    margin-left: 180px!important
}

.ml-185 {
    margin-left: 185px!important
}

.ml-190 {
    margin-left: 190px!important
}

.ml-195 {
    margin-left: 195px!important
}

.ml-200 {
    margin-left: 200px!important
}

.mr-5 {
    margin-right: 5px!important
}

.mr-10 {
    margin-right: 10px!important
}

.mr-15 {
    margin-right: 15px!important
}

.mr-20 {
    margin-right: 20px!important
}

.mr-25 {
    margin-right: 25px!important
}

.mr-30 {
    margin-right: 30px!important
}

.mr-35 {
    margin-right: 35px!important
}

.mr-40 {
    margin-right: 40px!important
}

.mr-45 {
    margin-right: 45px!important
}

.mr-50 {
    margin-right: 50px!important
}

.mr-55 {
    margin-right: 55px!important
}

.mr-60 {
    margin-right: 60px!important
}

.mr-65 {
    margin-right: 65px!important
}

.mr-70 {
    margin-right: 70px!important
}

.mr-75 {
    margin-right: 75px!important
}

.mr-80 {
    margin-right: 80px!important
}

.mr-85 {
    margin-right: 85px!important
}

.mr-90 {
    margin-right: 90px!important
}

.mr-95 {
    margin-right: 95px!important
}

.mr-100 {
    margin-right: 100px!important
}

.mr-105 {
    margin-right: 105px!important
}

.mr-110 {
    margin-right: 110px!important
}

.mr-115 {
    margin-right: 115px!important
}

.mr-120 {
    margin-right: 120px!important
}

.mr-125 {
    margin-right: 125px!important
}

.mr-130 {
    margin-right: 130px!important
}

.mr-135 {
    margin-right: 135px!important
}

.mr-140 {
    margin-right: 140px!important
}

.mr-145 {
    margin-right: 145px!important
}

.mr-150 {
    margin-right: 150px!important
}

.mr-155 {
    margin-right: 155px!important
}

.box-height2 {
    height: 490px!important
}

.box-height-overflow {
    height: 150px!important;
    overflow: revert!important
}

.mb-57 {
    margin-bottom: 57px
}

.mb-3 {
    margin-bottom: 3px!important
}

.fs {
    font-size: 22px!important
}

.fs60 {
    font-size: 60px!important
}

.post-list {
    padding-top: 20px
}

h1.blog-title {
    font-size: 47px!important;
    line-height: 60px;
    font-family: chivo,sans-serif;
    font-weight: 700
}

h4.blog-desc {
    font-size: 20px;
    margin: 0 0 15px;
    font-family: chivo,sans-serif;
    font-weight: 700
}

.blog-box img {
    margin: 0 0 15px
}

.blog-content p {
    color: #667085;
    font-family: noto sans,sans-serif;
    font-size: 16px;
    line-height: 28px;
    margin: 0 0 15px
}

.blog-content li {
    margin: 0 0 15px
}

.blog-content h1,.blog-content h2,.blog-content h3,.blog-content h4,.blog-content h5,.blog-content h6 {
    font-family: chivo,sans-serif;
    font-weight: 700;
    font-size: 28px;
    line-height: 32px;
    margin: 0 0 15px
}

@media only screen and (min-width: 768px) {
    .rightimg500 {
        margin-top:200px!important
    }
}

@media only screen and (max-width: 600px) {
    .pt-tp {
        padding-top::108px!important
    }
}

@media only screen and (min-width: 768px) {
    .homebox-height {
        height:530px!important
    }
}

@media only screen and (min-width: 768px) {
    .box-height {
        height:390px!important
    }
}

@media only screen and (min-width: 768px) {
    .mt150d {
        margin-top:150px!important
    }
}

.mr-160 {
    margin-right: 160px!important
}

.mr-165 {
    margin-right: 165px!important
}

.mr-170 {
    margin-right: 170px!important
}

.mr-175 {
    margin-right: 175px!important
}

.mr-180 {
    margin-right: 180px!important
}

.mr-185 {
    margin-right: 185px!important
}

.mr-190 {
    margin-right: 190px!important
}

.mr-195 {
    margin-right: 195px!important
}

.mr-200 {
    margin-right: 200px!important
}

.item-logo {
    display: inline-block;
    width: 100%;
    padding: 15px;
    line-height: 40px;
    box-shadow: 1px 1px 10px #333
}

.item-logo img {
    vertical-align: middle
}

.box-hover-shadow:hover {
    box-shadow: 14px 14px 36px rgba(153,153,153,.22)
}

.block-video {
    position: relative
}

.block-video.icon-pattern::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    height: 132px;
    width: 146px;
    background: url(../imgs/template/pattern-3.svg) no-repeat;
    z-index: 2
}

.block-video.icon-pattern img {
    position: relative;
    z-index: 1
}

.block-video .btn-play-video {
    width: 135px;
    height: 135px;
    background-size: 135px;
    margin-top: -68px;
    left: -68px;
    z-index: 3
}

.line-bd-green {
    border: 1px dashed #006d77
}

.icon-leaf {
    background: url(../imgs/page/homepage1/icon-leaf.svg) no-repeat 0 2px;
    padding: 0 0 0 28px
}

.bdrd-16 {
    border-radius: 16px
}

.bdrd-58 {
    border-radius: 58px
}

.tag-1 {
    background-color: #fff3ea;
    border-radius: 50px;
    padding: 14px 28px;
    color: #e29578;
    font-size: 14px;
    line-height: 14px;
    font-family: chivo,sans-serif;
    display: inline-block
}

.tag-dot {
    font-size: 12px;
    line-height: 16px;
    font-family: noto sans,sans-serif;
    color: #667085;
    background: url(../imgs/template/icons/dot.svg) no-repeat left center;
    display: block;
    padding: 0 0 0 10px;
    text-transform: uppercase
}

.pattern-white {
    position: relative;
    padding-left: 130px;
    padding-right: 130px
}

.pattern-white * {
    position: relative;
    z-index: 2
}

.pattern-white::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 162px;
    width: 120px;
    background: url(../imgs/template/pattern-white.svg) no-repeat top right;
    z-index: 1
}

.section-green {
    background-color: #006d77;
    padding: 20px 0 50px;
    position: relative
}

.section-green::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    background: url(../imgs/template/pattern-4.svg) no-repeat left bottom;
    width: 150px;
    height: 150px;
    opacity: .3
}

.section-green::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    background: url(../imgs/template/pattern-5.svg) no-repeat right top;
    width: 108px;
    height: 145px;
    opacity: .3
}

.box-optimized {
    padding: 60px
}

.panel-box {
    max-height: 500px
}

.panel-box img {
    max-height: 500px
}

.mw-720 {
    max-width: 720px;
    margin: auto;
    display: table!important;
    table-layout: fixed
}

.banner-home-3 {
    position: relative;
    padding-bottom: 140px!important
}

.banner-home-3 .banner-hero::before {
    display: none
}

.banner-home-3 .banner-hero .block-banner {
    padding-right: 80px
}

.banner-home-3::before {
    content: "";
    height: 351px;
    width: 400px;
    position: absolute;
    bottom: 40px;
    left: 40px;
    background-size: contain
}

.banner-home-3::after {
    content: "";
    height: 351px;
    width: 400px;
    position: absolute;
    bottom: 40px;
    right: 20px;
    background-size: contain
}

.list-job-2-col .card-job-description {
    font-size: 14px;
    line-height: 22px
}

.findjob-homepage-2::before {
    right: 100px!important;
    bottom: -55px!important
}

.block-job-bg-homepage-2::before {
    right: 0!important
}

.none-bg-body {
    background: #fff
}

.bg-green-900 {
    background-color: #006d77;
    color: #fff
}

.list-partners {
    display: inline-block;
    width: 100%;
    text-align: center;
    border-bottom: 1px solid #d0d5dd;
    padding-bottom: 50px
}

.list-partners li {
    display: inline-block;
    width: 18%;
    text-align: center;
    margin-bottom: 30px;
    margin: 4px
}

.block-we-do-2 {
    padding-left: 80px
}

.block-img-we-do {
    position: relative
}

.block-img-we-do .inner-image {
    position: relative
}

.block-img-we-do .block-chart {
    position: absolute;
    bottom: -100px;
    right: -60px;
    width: 270px
}

.block-img-we-do .block-chart img {
    box-shadow: 0 47px 65px rgba(21,28,38,.1);
    border-radius: 16px
}

.block-we-do .inner-image {
    position: relative
}

.block-we-do .inner-image .block-image-bottom {
    position: absolute;
    bottom: -80px;
    right: -80px;
    width: 313px
}

.block-we-do .inner-image .block-image-bottom img {
    box-shadow: 0 47px 65px rgba(21,28,38,.1);
    border-radius: 16px
}

.list-icons .item-icon {
    position: relative;
    padding: 0 0 40px 80px;
    margin-bottom: 40px;
    border-bottom: 2px solid #e4e7ec
}

.list-icons .item-icon.none-bd {
    border-bottom: 0;
    padding: 0 0 20px 80px;
    margin-bottom: 10px
}

.list-icons .item-icon .icon-left {
    position: absolute;
    top: 0;
    left: 0;
    width: 50px
}

.box-square {
    width: 100%;
    height: 455px;
    border-radius: 16px;
    padding: 55px 50px 0;
    text-align: center
}

.box-square .box-image-inner {
    border-radius: 16px;
    padding: 23px 19px;
    margin-top: 30px
}

.box-square .box-image-inner.bg-color-1 {
    background-color: #ebecf4
}

.box-square .box-image-inner.bg-color-2 {
    background-color: #cbd1e5
}

.box-gray-100 {
    background-color: #f2f4f7;
    padding: 80px
}

.box-img-user {
    position: relative;
    padding: 15px 0 0 100px;
    margin-top: 32px;
    min-height: 80px
}

.box-img-user .img-user {
    position: absolute;
    top: 0;
    left: 0;
    width: 80px
}

.box-img-user .img-user img {
    border-radius: 4px
}

.block-pricing-2 .btn.btn-black {
    border: 1px solid transparent;
    padding: 12px 22px;
    border-radius: 6px;
    width: 100%;
    text-align: center
}

.block-pricing-2 .btn.btn-black:hover {
    border: 1px solid #101828;
    background-color: #fff;
    color: #101828
}

.block-pricing-2 .box-pricing-item:hover,.block-pricing-2 .box-pricing-item.active {
    background-color: #006d77
}

.block-pricing-2 .box-pricing-item:hover *,.block-pricing-2 .box-pricing-item.active * {
    color: #fff
}

.block-pricing-2 .box-pricing-item:hover .text-body-small,.block-pricing-2 .box-pricing-item.active .text-body-small {
    color: #f2f4f7!important
}

.block-pricing-2 .box-pricing-item:hover .list-package-feature li,.block-pricing-2 .box-pricing-item.active .list-package-feature li {
    background: url('{{url('/')}}/public/logo/check-circle-pink.svg') no-repeat left center
}

.block-pricing-2 .box-pricing-item:hover .btn.btn-black,.block-pricing-2 .box-pricing-item.active .btn.btn-black {
    border: 1px solid #fff;
    background-color: transparent;
    color: #fff;
    background-image: url(../imgs/template/icons/arrow-small-right-w.svg);
    background-repeat: no-repeat;
    background-position: center right 25px
}

.nav-style-homepage-3 li button.active {
    color: #006d77;
    background: 0 0
}

.nav-style-homepage-3 li button:hover {
    color: #006d77;
    background: 0 0
}

.nav-style-homepage-3>li:last-child button {
    padding-right: 0
}

.bg-body-homepage-3::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 901px;
    width: 901px;
    z-index: -1
}

.size-30 {
    font-size: 44px;
    line-height: 54px
}

.heading-inline {
    display: inline-block;
    margin-top: 30px
}

.heading-inline h1,.heading-inline h2,.heading-inline h3,.heading-inline h4,.heading-inline h5 {
    font-size: 44px;
    line-height: 54px;
    display: inline
}

@media(min-width: 1560px) {
    .banner-homepage-3 {
        padding:0 0 0 145px
    }
}

.banner-homepage-3 {
    padding-top: 40px
}

.banner-homepage-3::before {
    display: none
}

.banner-homepage-3 .block-banner {
    padding-right: 250px
}

.banner-homepage-3 .banner-imgs::before {
    content: "";
    z-index: 0;
    position: absolute;
    bottom: 0;
    left: -70px;
    height: 54px;
    width: 56px
}

.banner-homepage-3 .banner-imgs .banner-sm1,.banner-homepage-3 .banner-imgs .banner-sm2,.banner-homepage-3 .banner-imgs .banner-sm3 {
    position: absolute;
    top: 4%;
    left: -86px;
    z-index: 12
}

.banner-homepage-3 .banner-imgs .banner-sm1 img {
    width: 251px
}

.banner-homepage-3 .banner-imgs .banner-sm2 {
    top: 43%;
    left: -136px
}

.banner-homepage-3 .banner-imgs .banner-sm2 img {
    width: 144px
}

.banner-homepage-3 .banner-imgs .banner-sm3 {
    top: 62%;
    left: -90px
}

.banner-homepage-3 .banner-imgs .banner-sm3 img {
    width: 251px
}

.box-image {
    position: relative
}

.box-image .btn-play-middle {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    width: 135px;
    height: 135px;
    background-size: 135px
}

.bg-orange-100 {
    background-color: #faede3
}

.accordion-item .accordion-button {
    border-radius: 4px!important;
    padding: 20px 30px;
    background-color: #e4e7ec;
    border-width: 0;
    color: #667085
}

.accordion-button:not(.collapsed) {
    color: #fff;
    background-color: #101828
}

.accordion-button::after {
    background-image: url(../imgs/template/icons/angle-down.svg)
}

.accordion-button:not(.collapsed)::after {
    background-image: url(../imgs/template/icons/angle-up-white.svg);
    transform: rotate(0deg)
}

.accordion .accordion-item {
    margin-bottom: 25px
}

.accordion .accordion-item .accordion-header {
    line-height: 22px
}

.accordion .accordion-item .accordion-collapse {
    border-width: 0
}

.icon-home {
    background: url(../imgs/template/icons/icon-home.svg) no-repeat 0 0;
    padding: 0 0 0 30px
}

.icon-wave {
    position: relative
}

.icon-wave::before {
    content: "";
    position: absolute;
    top: 30px;
    right: 50px;
    height: 165px;
    width: 165px;
    z-index: 1;
    background: url(../imgs/template/email.png) no-repeat
}

.icon-wave .row {
    z-index: 2;
    position: relative
}

.text-gray-28 {
    font-size: 28px;
    line-height: 32px;
    color: #98a2b3;
    font-family: chivo,sans-serif;
    font-weight: 700
}

.list-icon-3 {
    display: table;
    table-layout: fixed;
    max-width: 610px;
    width: 100%
}

.list-icon-3 li {
    color: #667085;
    padding: 2px 0 2px 35px;
    margin-bottom: 15px;
    float: left;
    width: 33.33%;
    background: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjIiIGhlaWdodD0iMjIiIHZpZXdCb3g9IjAgMCAyMiAyMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEwLjk5OTkgMEM0LjkzNDYxIDAgMCA0LjkzNDUgMCAxMC45OTk5QzAgMTcuMDY1NCA0LjkzNDYxIDIyIDEwLjk5OTkgMjJDMTcuMDY1MyAyMiAyMS45OTk5IDE3LjA2NTQgMjEuOTk5OSAxMC45OTk5QzIxLjk5OTkgNC45MzQ1IDE3LjA2NTQgMCAxMC45OTk5IDBaTTE3LjMxNjMgOS4xNDE5NkwxMC40MDU2IDE2LjA1MjdDMTAuMTExOCAxNi4zNDY1IDkuNzIxMTUgMTYuNTA4MiA5LjMwNTY0IDE2LjUwODJDOC44OTAxMyAxNi41MDgyIDguNDk5NTIgMTYuMzQ2NSA4LjIwNTY4IDE2LjA1MjdMNC42ODM1OCAxMi41MzA2QzQuMzg5NzQgMTIuMjM2NyA0LjIyNzkgMTEuODQ2MSA0LjIyNzkgMTEuNDMwNkM0LjIyNzkgMTEuMDE1IDQuMzg5NzQgMTAuNjI0NCA0LjY4MzU4IDEwLjMzMDVDNC45NzczMSAxMC4wMzY3IDUuMzY3OTEgOS44NzQ4NSA1Ljc4MzU0IDkuODc0ODVDNi4xOTkwNSA5Ljg3NDg1IDYuNTg5NzcgMTAuMDM2NyA2Ljg4MzUgMTAuMzMwNkw5LjMwNTUyIDEyLjc1MjZMMTUuMTE2MiA2Ljk0MTkzQzE1LjQxIDYuNjQ4MDggMTUuODAwNiA2LjQ4NjM1IDE2LjIxNjEgNi40ODYzNUMxNi42MzE2IDYuNDg2MzUgMTcuMDIyMiA2LjY0ODA4IDE3LjMxNjEgNi45NDE5M0MxNy45MjI4IDcuNTQ4NjcgMTcuOTIyOCA4LjUzNTQ1IDE3LjMxNjMgOS4xNDE5NloiIGZpbGw9IiMwMDZENzciLz4KPC9zdmc+Cg==) no-repeat left center
}

.box-mw-610 {
    max-width: 610px
}

.form-newsletter-2 {
    box-shadow: 14px 14px 36px rgba(153,153,153,.22);
    padding: 10px;
    background-color: #fff;
    border: 1px solid #f2f4f7;
    border-radius: 10px;
    position: relative;
    padding-right: 210px
}

.form-newsletter-2 .input-newsletter {
    width: 100%;
    border: 0;
    padding: 15px 16px
}

.none-bd {
    border: 0!important
}

.font-bold {
    font-weight: 700
}

.text-semibold {
    font-family: noto sans,sans-serif;
    font-size: 10px;
    line-height: 14px;
    color: #98a2b3;
    display: inline-block;
    vertical-align: text-top;
    font-weight: 500
}

.list-category {
    display: inline-block;
    width: 100%;
    padding: 10px 0 0;
    margin: 0
}

.list-category li {
    font-family: chivo,sans-serif;
    font-weight: 500;
    display: inline-block;
    width: 100%;
    border-bottom: 1px solid #e4e7ec;
    padding: 20px 0
}

.list-category li:last-child {
    border-bottom: 0 solid #e4e7ec
}

.list-category li .number {
    height: 43px;
    width: 43px;
    text-align: center;
    line-height: 43px;
    color: #006d77;
    border-radius: 50%;
    border: 1px solid #e4e7ec;
    background-color: #e4e7ec;
    float: right;
    font-size: 19px
}

.list-category li a {
    font-size: 19px;
    line-height: 30px;
    color: #667085;
    display: inline-block;
    vertical-align: text-top
}

.list-category li:hover a {
    color: #006d77
}

.list-category li:hover .number {
    color: #fff;
    border: 1px solid #006d77;
    background-color: #006d77
}

.box-bdr-2 {
    box-shadow: 0 45px 80px rgba(0,0,0,.04);
    border: 1px solid #e4e7ec;
    padding: 30px 35px;
    border-radius: 16px;
    background-color: #fff
}

.box-green {
    background: #006d77;
    background-size: contain;
    padding: 70px 64px
}

.box-green .text-desc-white {
    font-size: 18px;
    line-height: 32px;
    font-family: noto sans,sans-serif;
    color: #fff
}

.cb-layout {
    background: url(../imgs/page/homepage5/checkbox.svg) no-repeat 0 0;
    height: 15px;
    width: auto;
    display: inline-block;
    padding: 0 0 0 20px;
    color: #b4b4b4;
    font-size: 12px;
    line-height: 16px;
    font-weight: 700
}

.grid-category {
    position: relative;
    box-shadow: 0 45px 80px rgba(0,0,0,.04);
    border: 1px solid #e4e7ec;
    padding: 34px 29px;
    border-radius: 16px;
    margin-bottom: 30px;
    background-color: #fff
}

.grid-category .grid-image-left-category {
    position: relative;
    display: flex
}

.grid-category .grid-image-left-category .category-image {
    height: 60px;
    width: 60px;
    border-radius: 50%;
    background-color: rgba(11,123,63,.2);
    text-align: center;
    line-height: 60px;
    margin-right: 15px
}

.grid-category .grid-image-left-category .category-image span {
    height: 60px;
    width: 60px;
    display: inline-block
}

.grid-category .grid-image-left-category .category-image .for-design {
    background: url(../imgs/page/homepage5/art.svg) no-repeat center
}

.grid-category .grid-image-left-category .category-image .for-sport {
    background: url(../imgs/page/homepage5/sport.svg) no-repeat center
}

.grid-category .grid-image-left-category .category-image .for-office {
    background: url(../imgs/page/homepage5/office.svg) no-repeat center
}

.grid-category .grid-image-left-category .category-image .for-software {
    background: url(../imgs/page/homepage5/software.svg) no-repeat center
}

.grid-category .grid-image-left-category .category-image img {
    display: inline-block;
    vertical-align: middle
}

.grid-category .grid-image-left-category .category-info {
    width: calc(100% - 75px);
    align-items: center;
    display: flex
}

.grid-category .grid-image-left-category .category-info h3 {
    vertical-align: middle
}

.grid-category .arrow-down-green {
    background: url(../imgs/page/homepage5/arrow-down-green.svg) no-repeat center;
    width: 25px
}

.grid-category:hover {
    background-color: #006d77;
    color: #fff;
    box-shadow: none
}

.grid-category:hover .arrow-down-green {
    background: url(../imgs/page/homepage5/arrow-down-white.svg) no-repeat center
}

.grid-category:hover .category-image {
    background-color: #158e99
}

.grid-category:hover .category-image .for-design {
    background: url(../imgs/page/homepage5/art-hover.svg) no-repeat center
}

.grid-category:hover .category-image .for-sport {
    background: url(../imgs/page/homepage5/sport-hover.svg) no-repeat center
}

.grid-category:hover .category-image .for-office {
    background: url(../imgs/page/homepage5/office-hover.svg) no-repeat center
}

.grid-category:hover .category-image .for-software {
    background: url(../imgs/page/homepage5/software-hover.svg) no-repeat center
}

.grid-category:hover .category-info h3 {
    color: #fff
}

.grid-category.grid-category-small {
    padding: 20px 30px
}

.grid-category.grid-category-small .category-image {
    height: 34px;
    width: 34px;
    border-radius: 50%;
    background-color: rgba(11,123,63,.2);
    text-align: center;
    line-height: 34px;
    margin-right: 15px
}

.grid-category.grid-category-small .category-image .for-leaf {
    background: url(../imgs/page/homepage5/leaf.svg) no-repeat center
}

.grid-category.grid-category-small .category-image img {
    display: inline-block;
    vertical-align: middle
}

.grid-category.grid-category-small .category-image span {
    height: 34px;
    width: 34px;
    display: inline-block
}

.grid-category.grid-category-small:hover {
    background-color: #006d77;
    color: #fff
}

.grid-category.grid-category-small:hover .category-image {
    background-color: #158e99
}

.grid-category.grid-category-small:hover .category-image .for-leaf {
    background: url(../imgs/page/homepage5/leaf-hover.svg) no-repeat center
}

.grid-category.grid-category-small:hover .category-info h3 {
    color: #fff
}

.box-bg-bottom {
    position: relative;
    padding: 0 50px 20px
}

.box-bg-bottom::before {
    content: "";
    top: 70px;
    bottom: 0;
    left: 0;
    right: 0;
    position: absolute;
    background-color: #fff3ea;
    border-radius: 30px
}

.box-bg-bottom .box-video-homepage6 {
    padding: 0 35px
}

.box-slider-3 {
    background-color: #bee1e6
}

.pdl-md {
    padding-left: 10px
}

.block-slider-bottom-banner {
    padding-right: 190px;
    top: -90px;
    position: relative;
    z-index: 12;
    margin-bottom: -50px
}

.block-slider-bottom-banner .box-swiper .swiper-button-next {
    top: 80%;
    right: -190px
}

.block-slider-bottom-banner .box-swiper .swiper-button-prev {
    top: 80%;
    right: -105px
}

.swiper-slide-1 {
    float: left;
    width: 30%
}

.swiper-slide-1 .grid-category-style-2 {
    box-shadow: none
}

.swiper-slide-1 .grid-category-style-2:hover {
    background-color: #fff
}

.swiper-slide-1 .grid-category-style-2:hover .category-info h3 {
    color: #101828
}

.swiper-slide-1 .grid-image-left-category a {
    display: flex
}

.swiper-slide-2 {
    float: left;
    width: 40%
}

.swiper-slide-2 .grid-category-style-2 {
    display: flex;
    box-shadow: none
}

.swiper-slide-2 .grid-category-style-2:hover {
    background-color: #fff
}

.swiper-slide-2 .grid-category-style-2:hover .category-info h3 {
    color: #101828
}

.swiper-slide-2 .grid-category-style-2 .grid-image-bottom {
    margin-top: 0
}

.swiper-slide-2 .grid-category-style-2 .grid-image-left-category {
    width: 55%;
    padding-right: 15px
}

.swiper-slide-2 .grid-category-style-2 .grid-image-left-category a {
    display: inline-block
}

.swiper-slide-2 .grid-category-style-2 .grid-image-left-category .category-info {
    display: inline-block;
    width: 100%
}

.swiper-slide-2 .grid-category-style-2 .grid-image-bottom {
    width: 45%
}

.grid-category-style-2 {
    padding: 20px 20px 15px
}

.grid-category-style-2 .grid-image-bottom {
    margin: 20px 0 0
}

.grid-category-style-2 .grid-image-bottom img {
    border-radius: 16px
}

.icon-arrow-right-thin {
    background: url(../imgs/page/homepage6/right-arrow-thin.svg) no-repeat 0 0;
    display: inline-block;
    height: 15px;
    width: 30px;
    margin: 20px 0 0
}

.pr-mb-70 {
    padding-right: 70px
}

.list-social-banner {
    position: relative;
    padding: 6px 0 0 100px;
    margin: 30px 0 0
}

.list-social-banner .social-banner {
    display: inline-block;
    height: 26px;
    width: 26px;
    margin-right: 7px
}

.list-social-banner .social-banner.facebook {
    background: url(../imgs/page/homepage7/facebook.svg) no-repeat center
}

.list-social-banner .social-banner.instagram {
    background: url(../imgs/page/homepage7/instagram.svg) no-repeat center
}

.list-social-banner .social-banner.twitter {
    background: url(../imgs/page/homepage7/twitter.svg) no-repeat center
}

.list-social-banner .social-banner.linkedin {
    background: url(../imgs/page/homepage7/linkedin.svg) no-repeat center
}

.list-social-banner::before {
    content: "";
    height: 1px;
    background-color: #98a2b3;
    width: 85px;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 0
}

.block-img-we-do .block-control {
    position: absolute;
    bottom: -40px;
    right: 10px;
    width: 190px
}

.block-img-we-do .block-control img {
    box-shadow: 0 47px 65px rgba(21,28,38,.1);
    border-radius: 16px
}

.block-img-we-do .block-card {
    position: absolute;
    top: 40px;
    left: -20px;
    width: 250px
}

.block-img-we-do .block-card img {
    box-shadow: 0 47px 65px rgba(21,28,38,.1);
    border-radius: 16px
}

.img-small {
    max-width: 80%
}

.list-category-homepage7 .row {
    margin: 0 -30px
}

.list-category-homepage7 .col-xl-6 {
    padding-left: 30px;
    padding-right: 30px
}

.page-homepage7-bg {
    position: relative;
    z-index: -1;
    height: 100%;
    width: 100%;
    top: 0
}

.page-homepage7-bg::before {
    content: "";
    position: absolute;
    left: 0;
    top: -100px;
    background: url(../imgs/page/homepage7/shadow-1.svg) no-repeat 0 0;
    background-size: contain;
    height: 1000px;
    width: 100%
}

.page-homepage7-bg::after {
    content: "";
    position: absolute;
    right: 0;
    top: 55%;
    background: url(../imgs/page/homepage7/shadow-2.svg) no-repeat top right;
    background-size: contain;
    height: 1000px;
    width: 100%
}

.img-bottom {
    display: flex;
    align-items: flex-end
}

.img-bottom .inner-image {
    display: flex;
    align-items: flex-end
}

.list-search-popular {
    padding: 0;
    margin: 25px 0 0
}

.list-search-popular li {
    display: inline-block;
    margin-right: 15px;
    margin-bottom: 15px
}

.list-search-popular li a {
    color: #667085;
    text-decoration: none;
    font-size: 14px;
    line-height: 14px;
    font-weight: 700
}

.page-homepage8 .header {
    background: #fff;
    z-index: 12;
    border-bottom: 1px solid #e4e7ec
}

.page-homepage8 .main {
    position: relative;
    z-index: 3
}

.page-homepage8::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0%;
    background: url(../imgs/page/homepage8/bg-homepage8.svg) no-repeat top 50px left 800px;
    background-size: contain;
    height: 600px;
    width: 100%;
    z-index: 1
}

.list-icons-round .item-icon {
    position: relative;
    padding: 0 0 40px 90px;
    margin-bottom: 40px;
    border-bottom: 2px solid #e4e7ec
}

.list-icons-round .item-icon.none-bd {
    border-bottom: 0;
    padding: 0 0 20px 90px;
    margin-bottom: 20px
}

.list-icons-round .item-icon .icon-left {
    position: absolute;
    top: 0;
    left: 0;
    width: 64px;
    height: 64px;
    border-radius: 50%;
    box-shadow: 14px 14px 36px rgba(153,153,153,.22);
    line-height: 64px;
    text-align: center
}

.list-icons-round .item-icon .icon-left img {
    display: inline-block;
    vertical-align: middle
}

.bd-bottom {
    border-bottom: 1px solid #d0d5dd
}

.social-bottom {
    padding-top: 15px
}

.social-bottom a {
    text-decoration: none
}

.social-bottom .icon-socials {
    display: inline-block;
    margin-right: 5px;
    height: 27px;
    width: 27px;
    transition-duration: .2s;
    background-size: 27px 27px!important
}

.social-bottom .icon-socials:hover {
    transform: translateY(-3px);
    transition-duration: .2s
}

.social-bottom .icon-socials.icon-facebook {
    background: url(../imgs/template/icons/facebook-gray.svg) no-repeat 0 0;
    transition-duration: .2s
}

.social-bottom .icon-socials.icon-facebook:hover {
    background: url(../imgs/template/icons/facebook.svg) no-repeat 0 0;
    transition-duration: .2s
}

.social-bottom .icon-socials.icon-twitter {
    background: url(../imgs/template/icons/twitter-gray.svg) no-repeat 0 0;
    transition-duration: .2s
}

.social-bottom .icon-socials.icon-twitter:hover {
    background: url(../imgs/template/icons/twitter.svg) no-repeat 0 0;
    transition-duration: .2s
}

.social-bottom .icon-socials.icon-instagram {
    background: url(../imgs/template/icons/instagram-gray.svg) no-repeat 0 0;
    transition-duration: .2s
}

.social-bottom .icon-socials.icon-instagram:hover {
    background: url(../imgs/template/icons/instagram.svg) no-repeat 0 0;
    transition-duration: .2s
}

.social-bottom .icon-socials.icon-linkedin {
    background: url(../imgs/template/icons/linkedin-gray.svg) no-repeat 0 0;
    transition-duration: .2s
}

.social-bottom .icon-socials.icon-linkedin:hover {
    background: url(../imgs/template/icons/linkedin.svg) no-repeat 0 0;
    transition-duration: .2s
}

.list-steps {
    display: inline-block;
    width: 100%;
    text-align: center
}

.list-steps li {
    display: inline-block;
    width: 33%;
    padding-right: 10px;
    padding-bottom: 90px;
    margin-bottom: 10px;
    vertical-align: top;
    position: relative
}

.list-steps li.icon-asset1::before {
    content: "";
    height: 30px;
    width: 77px;
    background: url(../imgs/page/about/2/asset1.svg) no-repeat top right;
    position: absolute;
    top: 110px;
    right: 15px
}

.list-steps li.icon-asset2::before {
    content: "";
    height: 30px;
    width: 77px;
    background: url(../imgs/page/about/2/asset2.svg) no-repeat top right;
    position: absolute;
    top: 110px;
    right: 15px
}

.list-steps li.icon-asset3::before {
    content: "";
    height: 72px;
    width: 60px;
    background: url(../imgs/page/about/2/asset3.svg) no-repeat 0 0;
    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    margin: auto
}

.list-steps li.icon-asset4::before {
    content: "";
    height: 14px;
    width: 77px;
    background: url(../imgs/page/about/2/asset4.svg) no-repeat 0 0;
    position: absolute;
    top: 110px;
    right: 15px
}

.list-steps li .block-step {
    background-color: #fff3ea;
    padding: 38px 30px 30px;
    border-radius: 8px
}

.list-steps li .block-step p.text-body-text {
    height: 50px;
    overflow: hidden
}

.text-inter-lg {
    font-family: chivo,sans-serif;
    font-weight: 400;
    font-size: 18px;
    line-height: 28px;
    color: D1DAE4
}

.block-gallery-1 img {
    border-radius: 8px
}

.block-pl {
    padding-left: 80px
}

.box-gray-100 .icon-wave::before {
    top: -60px;
    right: -20px
}

.list-5-col {
    display: flex
}

.list-5-col li {
    width: 20%
}

.list-icons .item-icon.none-bd {
    margin-bottom: 10px
}

.none-pattern::before {
    display: none
}

.page-service-2 {
    background: url(../imgs/page/services/2/bg-banner.svg) no-repeat
}

.page-pricing-2 {
    background: url(../imgs/page/pricing2/bg-banner.png) no-repeat top center;
    background-size: 100% auto
}

.tick-green {
    background: url(../imgs/template/icons/icon-tick-green.svg) no-repeat center;
    display: inline-block;
    width: 23px;
    vertical-align: middle;
    height: 22px
}

.icon-question-2 {
    background: url(../imgs/template/icons/icon-question-2.svg) no-repeat center;
    display: inline-block;
    width: 23px;
    vertical-align: middle;
    height: 22px;
    margin: 0 3px
}

.text-bd-round {
    margin: 0 3x;
    border-radius: 81px;
    color: #98a2b3;
    border: 1px solid #818b98;
    display: inline-block;
    padding: 0 6px 1px;
    vertical-align: middle
}

.table-pricing {
    font-size: 16px;
    line-height: 28px;
    color: #101828;
    font-family: noto sans,sans-serif;
    font-weight: 400;
    text-align: center
}

.table-pricing tr td {
    padding: 14px 18px
}

.table-pricing tr td:first-child {
    text-align: left
}

.table-mw-700 {
    min-width: 700px
}

.page-faqs-1 {
    background: url(../imgs/page/faqs/1/bg-banner.png) no-repeat center top;
    background-size: auto
}

.block-tags {
    position: absolute;
    top: 17px;
    right: 150px
}

.block-tags a {
    background-color: #f2f4f7;
    display: inline-block;
    padding: 10px 45px 10px 25px;
    border-radius: 10px;
    position: relative
}

.block-tags a .icon-close {
    position: absolute;
    top: 14px;
    right: 15px;
    height: 20px;
    width: 20px;
    background: url(../imgs/template/icons/icon-close.svg) no-repeat 0 0
}

.list-icons-2 {
    display: inline-block;
    padding: 0 0 0 40px
}

.list-icons-2>li {
    width: 50%;
    float: left;
    padding-right: 40px;
    padding-left: 50px;
    background: url(../imgs/template/icons/icon-question.svg) no-repeat 0 0;
    margin-bottom: 20px;
    padding-top: 6px
}

.list-icons-2>li ul {
    list-style: disc;
    color: #667085;
    padding-left: 20px
}

.images-lists {
    width: 100%;
    padding-right: var(--bs-gutter-x,0.75rem);
    padding-left: var(--bs-gutter-x,0.75rem);
    margin-right: auto;
    margin-left: auto;
    position: relative
}

.images-lists::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    height: 65%;
    z-index: 1;
    width: 100%;
    background-color: #fff
}

.images-lists .col-lg-2,.images-lists .col-lg-4 {
    position: relative
}

.images-lists img {
    border-radius: 16px;
    position: relative;
    z-index: 2
}

.images-lists .img-1 {
    position: relative;
    top: -90px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0
}

.images-lists .img-2 {
    position: relative;
    bottom: -110px
}

.images-lists .img-4 {
    position: relative;
    bottom: -150px
}

.images-lists .img-5 {
    position: relative;
    bottom: -10px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0
}

.form-group {
    position: relative
}

.link-edit {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%)
}

.box-login {
    width: 100%;
    padding-right: var(--bs-gutter-x,0.75rem);
    padding-left: var(--bs-gutter-x,0.75rem);
    margin-right: auto;
    margin-left: auto;
    position: relative
}

.box-login img {
    vertical-align: top
}

.box-login .box-login-form {
    max-width: 510px;
    width: 100%;
    margin: auto
}

.box-login .login-right {
    padding-bottom: 120px
}

@media(min-width: 1400px) {
    .login-left {
        width:55%
    }

    .login-right {
        width: 45%
    }
}

.page-blog-1 {
    background: url(../imgs/page/blog/1/banner.png) no-repeat top center;
    background-size: 100% auto
}

.slider-news {
    padding: 0 100px;
    position: relative
}

.block-news {
    display: inline-block;
    width: 100%;
    padding: 0 30px 25px 0;
    position: relative
}

.block-news::before {
    content: "";
    z-index: 1;
    border-radius: 16px;
    background-color: #fff3ea;
    position: absolute;
    top: 20px;
    right: 0;
    left: 20px;
    bottom: 0
}

.block-news .item-news {
    background: #fff;
    display: inline-block;
    width: 100%;
    border-radius: 16px;
    overflow: hidden;
    line-height: 0;
    position: relative;
    z-index: 2
}

.block-news .item-news .img-news {
    overflow: hidden
}

.block-news .item-news .img-news img {
    height: 100%;
    max-width: 100%
}

.block-news .right-news {
    padding: 40px 30px 0
}

.block-news .text-desc-fix-h {
    max-height: 100%;
    overflow: hidden
}

.swiper-button-next-5 {
    left: auto;
    right: 0;
    background: url(../imgs/page/blog/1/next.svg) no-repeat center;
    height: 65px;
    width: 65px;
    transform: translateY(-50%)
}

.swiper-button-next-5::after {
    display: none
}

.swiper-button-prev-5 {
    right: auto;
    left: 0;
    background: url(../imgs/page/blog/1/prev.svg) no-repeat center;
    height: 65px;
    width: 65px;
    transform: translateY(-50%)
}

.swiper-button-prev-5::after {
    display: none
}

.blog-img-user {
    position: relative;
    padding: 7px 0 0 70px;
    margin-top: 32px;
    min-height: 60px
}

.blog-img-user .img-user-round {
    position: absolute;
    top: 0;
    left: 0;
    width: 56px
}

.blog-img-user .img-user-round img {
    border-radius: 50%;
    height: 56px;
    width: 56px
}

.blog-img-user .text-heading-6 {
    margin-bottom: 3px
}

.card-list-style-1 .blog-img-user {
    padding: 0 0 0 51px;
    margin-top: 15px
}

.card-list-style-1 .blog-img-user .img-user-round {
    position: absolute;
    top: 0;
    left: 0;
    width: 41px
}

.card-list-style-1 .blog-img-user .img-user-round img {
    border-radius: 50%;
    height: 41px;
    width: 41px
}

.text-summary {
    font-weight: 700;
    font-family: noto sans,sans-serif;
    font-size: 18px;
    line-height: 32px;
    color: #667085
}

.single-detail p {
    margin-bottom: 15px;
    font-size: 18px;
    font-family: noto sans,sans-serif;
    color: #667085;
    line-height: 32px;
    font-weight: 400
}

.single-detail img {
    border-radius: 16px
}

.single-detail h1,.single-detail h2,.single-detail h3,.single-detail h4,.single-detail h5,.single-detail h6 {
    margin: 0 0 20px;
    font-weight: 700;
    color: #101828
}

.single-detail h6 {
    font-size: 18px
}

.social-sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 70px
}

.box-comments {
    display: inline-block;
    width: 100%;
    padding: 60px 0 0
}

.box-comments ul li {
    display: inline-block;
    width: 100%
}

.box-comments ul li .item-comment {
    display: inline-block;
    width: 100%;
    padding: 0 0 0 250px;
    position: relative;
    margin-bottom: 40px
}

.box-comments ul li .item-comment .blog-img-user {
    position: absolute;
    top: 0;
    left: 0;
    margin-top: 0
}

.box-comments ul li ul {
    padding-left: 56px
}

.box-comments .text-comment {
    border-radius: 0 16px 16px 16px;
    background-color: #f2f4f7;
    color: #101828;
    padding: 20px
}

.bdr-10 {
    border-radius: 10px
}

.box-quote {
    border-radius: 20px;
    padding: 45px;
    background-color: #006d77;
    color: #fff;
    margin: 50px 0
}

.box-quote .text-quote {
    background: url(../imgs/template/icons/left-quote.svg) no-repeat top center;
    padding: 75px 0 0;
    font-size: 32px;
    line-height: 48px;
    font-family: chivo,sans-serif;
    font-weight: 400;
    text-align: center
}

.box-user {
    text-align: center;
    position: relative;
    margin: 35px 0 20px
}

.box-user .img-user {
    display: inline-block;
    width: 55px;
    margin-right: 10px;
    vertical-align: middle
}

.box-user .img-user img {
    border-radius: 50%
}

.text-top {
    vertical-align: top
}

.share-social {
    display: inline-block;
    height: 30px;
    width: 30px;
    background-position: center;
    background-repeat: no-repeat
}

.share-social.share-fb {
    background-image: url(../imgs/page/blog/single/share-fb.svg)
}

.share-social.share-tw {
    background-image: url(../imgs/page/blog/single/share-tw.svg)
}

.share-social.share-pi {
    background-image: url(../imgs/page/blog/single/share-pi.svg)
}

.category-grid-3 {
    border: 1px solid #e4e7ec;
    padding: 25px 5px;
    border-radius: 16px;
    margin-bottom: 30px;
    text-align: center
}

.category-grid-3:hover {
    border-color: #bee1e6;
    box-shadow: 0 45px 80px rgba(0,0,0,.04)
}

.category-grid-3 .category-img {
    margin: 0 0 15px
}

.filters-products {
    background-color: #f2f4f7;
    border-radius: 8px;
    padding: 20px
}

.fitler-info {
    width: 50%;
    text-align: right
}

.number-info {
    width: 50%
}

.bdr-18 {
    border-radius: 18px
}

.box-green-2 {
    background-image: url(../imgs/page/shop1/bg-hand.png);
    background-repeat: no-repeat;
    background-position: bottom right;
    background-size: auto 340px;
    position: relative
}

.box-green-2 .block-1 {
    position: absolute;
    top: 10%;
    left: 50%;
    width: 210px
}

.box-green-2 .block-2 {
    position: absolute;
    top: 72%;
    left: 43%;
    width: 240px
}

.dropdown-sort {
    line-height: 21px;
    display: inline-block;
    vertical-align: middle
}

.dropdown-sort .dropdown-toggle {
    padding: 0;
    outline: none;
    font-size: 14px;
    font-weight: 400;
    color: #006d77
}

.dropdown-sort .dropdown-toggle i {
    color: #88929b;
    float: right;
    margin: 0 7px 0 0;
    font-size: 20px
}

.dropdown-sort .dropdown-toggle::after {
    border: 0
}

.dropdown .dropdown-menu.show {
    border: thin solid #ececec;
    box-shadow: 0 9px 26px 0 rgba(31,31,51,.06);
    background-color: #fff;
    border-radius: 10px;
    padding: 0
}

.dropdown .dropdown-menu.show .dropdown-item {
    padding: 10px 20px;
    font-size: 14px
}

.dropdown .dropdown-menu.show .dropdown-item.active {
    color: #006d77;
    text-decoration: none;
    background-color: #afeae4
}

.icon-sort {
    background: url(../imgs/page/shop1/sort.svg) no-repeat left center;
    padding: 0 0 0 22px;
    display: inline-block
}

.icon-layout {
    background: url(../imgs/page/shop1/layout.svg) no-repeat left center;
    padding: 0 0 0 22px;
    display: inline-block
}

.paginations {
    margin: 30px 0 50px
}

.paginations .pager {
    padding: 0
}

.paginations .pager li {
    display: inline-block;
    vertical-align: middle
}

.paginations .pager li a {
    display: block;
    padding: 10px 8px;
    margin: 0 5px;
    font-weight: 700;
    font-family: chivo,sans-serif;
    color: #667085;
    line-height: 30px;
    text-decoration: none;
    position: relative;
    font-size: 18px;
    border-radius: 50%;
    height: 50px;
    width: 50px;
    text-align: center;
    background-color: #e4e7ec
}

.paginations .pager li a:hover {
    background-color: #006d77;
    color: #fff
}

.paginations .pager li a.prev-page {
    background: #e4e7ec url(../imgs/page/shop1/arrow-prev-gray.svg) no-repeat center
}

.paginations .pager li a.prev-page:hover {
    background: #006d77 url(../imgs/page/shop1/arrow-prev-hover.svg) no-repeat center
}

.paginations .pager li a.next-page {
    background: #e4e7ec url(../imgs/page/shop1/arrow-next-gray.svg) no-repeat center
}

.paginations .pager li a.next-page:hover {
    background: #006d77 url(../imgs/page/shop1/arrow-next-hover.svg) no-repeat center
}

.paginations .pager li a.page-dotted {
    background: #e4e7ec url(../imgs/page/shop1/doted.svg) no-repeat center
}

.paginations .pager li a.page-dotted:hover {
    background: #006d77 url(../imgs/page/shop1/doted-hover.svg) no-repeat center
}

.product-item-2:hover {
    border-color: #bee1e6
}

.sidebar {
    border: 1px solid #e4e7ec;
    border-radius: 16px;
    padding: 25px;
    margin-bottom: 50px
}

.sidebar .widget-title {
    border-bottom: 1px solid #e4e7ec;
    padding-bottom: 20px
}

.list-type {
    padding: 0;
    margin: 20px 0;
    list-style: none;
    display: inline-block;
    width: 100%
}

.list-type li {
    margin: 0 0 20px
}

.list-type li label {
    margin-bottom: 0;
    width: 100%;
    line-height: 20px
}

.list-type li label input {
    float: left;
    margin: 8px 10px 0 0
}

.text-heading-7 {
    font-family: noto sans,sans-serif;
    font-weight: 700;
    font-size: 14px;
    line-height: 18px;
    color: #101828
}

.product-item-4 {
    border: 0;
    box-shadow: none!important;
    padding: 0
}

.product-item-4 .product-image {
    float: left;
    width: 65px;
    height: auto;
    min-height: auto;
    line-height: 20px
}

.product-item-4 .product-image img {
    max-width: 100%
}

.product-item-4 .product-info {
    display: block;
    padding: 0;
    padding-left: 80px
}

.product-item-4 .product-info .box-prices {
    width: 100%
}

.list-products-sidebar {
    list-style: none;
    padding: 15px 0 0;
    margin: 0
}

.list-products-sidebar li {
    display: inline-block;
    width: 100%;
    padding: 0
}

.list-products-sidebar li:last-child .product-item-4 {
    margin-bottom: 0
}

.sidebar-gray {
    background-color: #f2f4f7;
    border: 0
}

.text-email {
    width: 100%;
    padding: 14px 10px 12px 45px;
    border-radius: 8px;
    border: 0;
    background: #fff url(../imgs/page/shop2/icon-email.svg) no-repeat center left 16px
}

.btn-green-small {
    padding: 12px 28px
}

.btn-green-small:hover {
    background-image: none!important
}

.circle-round {
    display: inline-block;
    height: 20px;
    width: 20px;
    background-color: #006d77;
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 7px
}

.color-danger {
    background-color: #ef476f
}

.color-success {
    background-color: #06d6a0
}

.color-primary {
    background-color: #508fda
}

.color-black {
    background-color: #101828
}

.color-warning {
    background-color: #ffd166
}

.btn-filter {
    background-color: #bee1e6;
    padding: 14px 30px 13px 55px;
    border-radius: 0;
    background-image: url(../imgs/page/shop2/filter.svg);
    background-position: 30px center;
    background-repeat: no-repeat;
    font-size: 18px;
    line-height: 22px;
    font-weight: 700;
    font-family: chivo,sans-serif;
    color: #006d77
}

.btn-filter:hover {
    background-color: #d1ecfd
}

.d-inline-block {
    display: inline-block;
    vertical-align: middle
}

.dr-ltr {
    direction: ltr
}

.dr-rtl {
    direction: rtl
}

.banner-ads {
    position: relative;
    display: inline-block;
    width: 100%;
    padding: 60px 15px;
    border-radius: 6px;
    background: url(../imgs/page/shop2/banner-ads.png) no-repeat top center;
    background-size: cover
}

.banner-ads .text-head-ads {
    font-size: 39px;
    line-height: 42px;
    font-weight: 700;
    font-family: noto sans,sans-serif;
    color: #006d77
}

.banner-ads .desc-ads {
    font-size: 16px;
    line-height: 20px;
    color: #667085;
    font-family: noto sans,sans-serif
}

.banner-ads .box-banner-ads {
    display: table;
    margin: auto;
    max-width: 510px
}

.table-of-content h6 {
    font-weight: 700
}

.table-of-content ul li {
    padding: 5px 0
}

.table-of-content ul li a {
    color: #667085;
    transition-duration: .2s
}

.table-of-content ul li a:hover {
    color: #006d77;
    transition-duration: .2s;
    padding-left: 5px
}

.bdr-16 {
    border-radius: 16px
}

.nav-breadcrums {
    width: 100%;
    position: relative;
    padding: 10px 0
}

.nav-breadcrums .breadcrumb {
    margin-bottom: 0
}

.nav-breadcrums .breadcrumb ul {
    display: inline-block;
    width: 100%
}

.nav-breadcrums .breadcrumb ul li {
    float: left;
    padding: 0 0 0 30px;
    background: url(../imgs/page/single-product/right-arrow.svg) no-repeat 10px 5px
}

.nav-breadcrums .breadcrumb ul li a {
    color: #667085;
    font-size: 14px;
    line-height: 19px
}

.nav-breadcrums .breadcrumb ul li a:hover {
    color: #006d77
}

.nav-breadcrums .breadcrumb ul li.home {
    background: url(../imgs/page/single-product/home.svg) no-repeat 0 0
}

.detail-gallery {
    position: relative
}

.icon-plus {
    position: absolute;
    top: 15px;
    right: 15px;
    background: url(../imgs/page/single-product/zoom-in.svg) no-repeat center;
    height: 29px;
    width: 29px;
    background-size: 26px;
    z-index: 2
}

.product-image-slider {
    background-color: #fff;
    margin-bottom: 30px;
    border-radius: 15px;
    border: 1px solid #ececec;
    overflow: hidden;
    min-height: 710px;
    line-height: 710px;
    display: flex;
    align-items: center
}

.product-image-slider .slick-slide img {
    max-width: 99%;
    display: block;
    margin: auto
}

.slider-nav-thumbnails {
    position: relative;
    display: block;
    position: absolute;
    top: -30px;
    left: 0;
    width: 178px
}

.slider-nav-thumbnails .slick-slide {
    height: 200px;
    border: 1px solid #e4e7ec;
    border-radius: 16px;
    margin-top: 30px;
    text-align: center;
    line-height: 200px
}

.slider-nav-thumbnails .slick-slide img {
    display: inline-block;
    height: auto;
    max-width: 90%;
    vertical-align: middle;
    max-height: 90%
}

.slider-nav-thumbnails .slick-slide:hover {
    border: 1px solid #afeae4;
    cursor: pointer
}

.slider-nav-thumbnails .slick-prev {
    position: absolute;
    bottom: -57px;
    right: 40px;
    z-index: 1245;
    background: url(../imgs/page/single-product/up.svg) no-repeat center;
    height: 45px;
    width: 45px;
    border: 0
}

.slider-nav-thumbnails .slick-next {
    position: absolute;
    bottom: -57px;
    left: 40px;
    z-index: 1245;
    background: url(../imgs/page/single-product/down.svg) no-repeat center;
    height: 45px;
    width: 45px;
    border: 0
}

.slider-nav-thumbnails .slick-slide.slick-current {
    border: 1px solid #afeae4;
    cursor: pointer;
    cursor: default
}

.box-rate-product {
    text-align: right;
    width: 50%
}

.box-rate-product .box-rating span {
    display: inline-block;
    margin-right: 5px
}

.box-category-product {
    width: 50%
}

.tag-category {
    font-size: 12px;
    line-height: 16px;
    color: #667085;
    font-weight: 700;
    font-family: noto sans,sans-serif
}

.box-price {
    display: inline-block;
    width: 100%;
    margin: 30px 0 20px
}

.box-price .price {
    font-size: 35px;
    line-height: 38px;
    font-weight: 700;
    color: #004b52;
    font-family: chivo,sans-serif;
    margin-right: 15px
}

.box-price .price-old {
    color: #667085;
    font-weight: 700;
    font-size: 28px;
    line-height: 32px;
    font-family: chivo,sans-serif;
    text-decoration: line-through;
    margin-right: 15px
}

.text-stock {
    font-size: 16px;
    line-height: 28px;
    color: #667085;
    font-weight: 400;
    font-family: noto sans,sans-serif
}

.font-bold {
    font-weight: 700!important
}

.product-description {
    padding: 0;
    display: table;
    table-layout: fixed;
    margin: auto;
    max-width: 900px;
    width: 100%
}

.product-description .tab-content ul {
    padding: 0 0 0 20px;
    list-style: disc;
    color: #667085;
    margin: 20px 0
}

.product-description .tab-content ul li {
    padding-left: 5px
}

.product-description .tab-content .contact-infor {
    font-size: 15px;
    color: #253d4e;
    list-style: none;
    padding: 0
}

.btn.btn-tab {
    padding: 15px 32px;
    border-color: #e4e7ec;
    color: #667085;
    background-color: #fff;
    margin-right: 20px;
    margin-bottom: 15px
}

.btn.btn-tab:hover {
    color: #004b52!important;
    background-color: #fff;
    border-color: #afeae4
}

.btn.btn-tab.active {
    color: #004b52!important;
    background-color: #fff;
    border-color: #afeae4
}

.item-cat {
    display: inline-block;
    margin-right: 20px
}

.galleries {
    padding: 0 0 0 210px;
    position: relative
}

.slick-initialized .slick-slide {
    text-align: center
}

.product-info {
    display: inline-block;
    padding: 0 0 0 20px
}

.title-question {
    font-size: 18px;
    color: #667085;
    line-height: 28px
}

.product-rate {
    background-image: url(../imgs/page/single-product/rating-stars.png);
    background-position: 0 -12px;
    background-repeat: repeat-x;
    height: 12px;
    width: 60px;
    transition: all .5s ease-out 0s;
    -webkit-transition: all .5s ease-out 0s
}

.product-rating {
    height: 12px;
    background-repeat: repeat-x;
    background-image: url(../imgs/page/single-product/rating-stars.png);
    background-position: 0 0
}

.progress span {
    line-height: 16px;
    background: #fff;
    padding-right: 10px;
    width: 45px
}

.progress+.progress {
    margin-top: 1rem
}

.progress-bar {
    background-color: #006d77
}

.comments-area h6 {
    font-size: 16px;
    color: #253d4e;
    font-weight: 700;
    line-height: 1.2
}

.comments-area .comment-list:last-child {
    padding-bottom: 0
}

.comments-area .comment-list .single-comment {
    margin: 0 0 15px;
    border: 1px solid #f2f2f2;
    border-radius: 15px;
    padding: 20px;
    transition: .2s
}

.comments-area .comment-list .single-comment:not(:last-child) {
    border-bottom: 1px solid #ececec
}

.comments-area .comment-list .single-comment img {
    min-width: 80px;
    max-width: 80px
}

.comments-area .comment-list .single-comment .reply {
    opacity: 0;
    transition: .2s;
    color: #06d6a0
}

.comments-area .comment-list .single-comment .reply:hover {
    color: #006d77
}

.comments-area .comment-list .single-comment:hover .reply {
    opacity: 1;
    transition: .2s
}

.comments-area .thumb {
    margin-right: 20px
}

.comments-area .thumb img {
    width: 70px;
    border-radius: 50%
}

.vendor-logo h6 {
    font-size: 16px;
    color: #253d4e;
    font-weight: 700;
    line-height: 1.2
}

.justify-content-between {
    justify-content: space-between!important
}

.d-flex {
    display: flex!important
}

.comments-area .text-muted {
    color: #667085!important
}

.comments-area .text-brand {
    color: #006d77!important;
    line-height: 1.2
}

.comments-area .font-xs {
    font-size: 13px
}

.comments-area .font-heading {
    font-weight: 700
}

.contact-infor li {
    color: #253d4e
}

.contact-infor li:not(:last-child) {
    margin-bottom: 10px
}

.contact-infor li img {
    margin-right: 8px;
    max-width: 16px
}

strong {
    font-weight: 700
}

.tab-pane .table {
    width: 100%;
    margin-bottom: 1.5rem;
    border-collapse: collapse;
    vertical-align: middle;
    font-size: 16px;
    border-spacing: 0
}

.tab-pane .table td {
    padding: 10px 20px;
    border: 1px solid #ececec;
    vertical-align: middle;
    color: #667085;
    font-weight: 400
}

.tab-pane .table th {
    padding: 10px 20px;
    border: 1px solid #ececec;
    vertical-align: middle;
    color: #667085;
    font-weight: 400
}

.box-countdown {
    display: flex;
    border-bottom: 1px solid #e4e7ec;
    margin-bottom: 45px;
    padding-bottom: 30px
}

.text-hurry {
    font-size: 18px;
    line-height: 22px;
    color: #004b52;
    font-weight: 700;
    font-family: chivo,sans-serif
}

.process-bar-line {
    margin-top: 10px;
    display: inline-block;
    width: 100%;
    border-radius: 10px;
    background-color: #e4e7ec;
    height: 11px;
    position: relative
}

.box-processbar {
    width: 35%
}

.process-bar-inner {
    display: inline-block;
    width: 100%;
    border-radius: 10px;
    background-color: #e4e7ec;
    height: 11px;
    position: relative;
    background-color: #ef476f;
    width: 50%;
    vertical-align: top
}

.detail-extralink .detail-qty {
    margin: 0 6px 15px 0;
    background: #fff;
    border: 1px solid #afeae4!important;
    font-size: 16px;
    font-weight: 700;
    color: #06d6a0;
    border-radius: 5px;
    padding: 11px 20px 11px 30px;
    max-width: 110px;
    display: inline-block;
    vertical-align: top;
    position: relative;
    width: 100%
}

.detail-extralink>div {
    display: inline-block;
    vertical-align: top
}

.detail-qty>a {
    font-size: 16px;
    position: absolute;
    right: 8px;
    color: #06d6a0;
    height: 20px;
    width: 20px
}

.detail-qty>a.qty-down {
    bottom: 1px;
    background: url(../imgs/page/single-product/arrow-down.svg) no-repeat center
}

.detail-qty>a.qty-up {
    top: 1px;
    background: url(../imgs/page/single-product/arrow-up.svg) no-repeat center
}

input.qty-val {
    border: 0;
    border-radius: 0;
    height: unset;
    padding: 0!important;
    width: 100%;
    font-weight: 700;
    font-size: 20px;
    color: #004b52
}

.product-extra-link2 .button.button-add-to-cart {
    position: relative;
    padding: 0 20px;
    border-radius: 5px;
    border: 0;
    height: 50px;
    line-height: 50px;
    font-weight: 700;
    font-size: 16px;
    color: #006d77;
    display: inline-block;
    background-color: #afeae4;
    border: 1px solid #afeae4
}

.product-extra-link2 .button.button-add-to-cart:hover {
    background-color: #fff;
    border: 1px solid #afeae4
}

.product-extra-link2 .button.button-add-to-cart img {
    float: left;
    margin: 17px 10px 0 0
}

.product-extra-link2 a {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #afeae4;
    color: #333;
    border-radius: 5px;
    display: inline-block;
    height: 50px;
    line-height: 55px;
    position: relative;
    text-align: center;
    vertical-align: top;
    width: 50px;
    margin: 0 5px;
    transition: all .5s ease-out 0s;
    -webkit-transition: all .5s ease-out 0s
}

.product-extra-link2 a:hover {
    background-color: #afeae4
}

.product-extra-link2 a i {
    font-size: 18px;
    opacity: .6
}

.box-count {
    width: 65%;
    display: flex
}

.deals-countdown {
    display: flex;
    width: 100%;
    position: relative;
    right: -20px
}

.countdown-section {
    position: relative;
    width: 25%;
    padding: 0 20px 0 0;
    color: #667085
}

.countdown-section::before {
    content: "";
    position: absolute;
    top: 32%;
    margin-top: -5px;
    width: 3px;
    right: 8px;
    height: 12px;
    background: url(../imgs/page/single-product/dot.svg) no-repeat center
}

.countdown-section:last-child::before {
    display: none
}

.countdown-section:first-child {
    margin-left: 20px
}

.countdown-amount {
    border: 1px solid #e4e7ec;
    border-radius: 4px;
    display: inline-block;
    width: 100%;
    padding: 20px 10px;
    text-align: center;
    color: #004b52;
    font-size: 22px;
    line-height: 24px;
    font-weight: 700;
    font-family: chivo,sans-serif
}

.countdown-period {
    display: block;
    text-align: center;
    font-size: 10px;
    line-height: 14px;
    font-weight: 600;
    font-family: noto sans,sans-serif;
    margin-top: 4px
}

.zoomContainer {
    z-index: 99
}

.zoomWindow {
    z-index: 99
}

@media only screen and (max-width: 1368px) {
    .slider-nav-thumbnails {
        width:135px
    }

    .slider-nav-thumbnails .slick-next {
        left: 20px
    }

    .slider-nav-thumbnails .slick-prev {
        right: 20px
    }

    .galleries {
        padding: 0 0 0 165px
    }
}

@media only screen and (max-width: 992px) {
    .product-info {
        padding-left:0
    }
}

@media only screen and (max-width: 768px) {
    .galleries {
        padding:0
    }

    .slider-nav-thumbnails {
        width: auto;
        position: relative;
        margin-right: -10px;
        margin-left: -10px
    }

    .slider-nav-thumbnails .slick-slide {
        margin-right: 10px;
        margin-left: 10px
    }

    .slider-nav-thumbnails .slick-prev {
        left: -11px;
        transform: rotateZ(-90deg);
        bottom: auto;
        top: 50%;
        margin-top: -10px;
        right: auto
    }

    .slider-nav-thumbnails .slick-next {
        right: -10px;
        left: auto;
        transform: rotateZ(-90deg);
        bottom: auto;
        top: 50%;
        margin-top: -10px
    }

    .deals-countdown {
        right: -15px
    }

    .product-image-slider {
        min-height: auto;
        line-height: auto
    }

    .btn.btn-tab {
        padding: 11px 12px!important;
        font-size: 13px
    }

    .box-green-2 {
        background-image: none
    }

    .box-green-2 .block-1 {
        display: none
    }

    .box-green-2 .block-2 {
        display: none
    }
}

@media only screen and (max-width: 480px) {
    .detail-extralink .detail-qty {
        max-width:90px
    }

    .box-countdown {
        display: inline-block;
        width: 100%
    }

    .box-processbar {
        width: 100%
    }

    .box-count {
        width: 100%;
        margin-top: 20px
    }

    .countdown-section:first-child {
        margin-left: 0
    }

    .deals-countdown {
        right: -5px
    }

    .slider-nav-thumbnails .slick-next {
        right: 0
    }

    .slider-nav-thumbnails .slick-prev {
        left: 0
    }

    .slider-nav-thumbnails .slick-slide {
        height: 130px;
        line-height: 130px
    }
}

@media only screen and (max-width: 400px) {
    .product-item-1 .product-info {
        padding:20px 0 20px 110px
    }

    .product-item-1 .product-image {
        width: 90px
    }
}

@media(min-width: 1400px) {
    .block-we-do {
        padding-left:40px
    }

    .block-img-we-do {
        padding-right: 30px
    }
}

@media(max-width: 1399.98px) {
    .custom-class {
        display:block
    }

    .banner-hero.banner-2 .block-2 {
        right: -10px
    }
}

@media(max-width: 1199.98px) {
    .custom-class {
        display:block
    }

    .box-newsletter .block-chart {
        bottom: -60px;
        left: 10px;
        max-width: 215px;
        height: 164px
    }

    .list-steps li {
        padding-right: 30px
    }

    .list-steps li.icon-asset1::before {
        height: 30px;
        width: 30px;
        right: 0
    }

    .list-steps li.icon-asset2::before {
        height: 30px;
        width: 30px;
        right: 0
    }

    .list-steps li.icon-asset4::before {
        height: 30px;
        width: 30px;
        right: 0
    }

    .block-pl {
        padding-left: 30px
    }

    .block-pl .mt-20 {
        margin-top: 0!important
    }

    .block-news .right-news {
        padding: 40px 30px
    }

    .block-pricing-3 .block-pricing-left {
        margin-bottom: 30px
    }

    h1.blog-title {
        font-size: 36px!important;
        line-height: 50px
    }

    .blog-content h1,.blog-content h2,.blog-content h3,.blog-content h4,.blog-content h5,.blog-content h6 {
        font-size: 22px;
        line-height: 27px
    }
}

@media(max-width: 991.98px) {
    .list-partners li {
        width:28%
    }

    .panel-box {
        max-height: unset
    }

    .panel-box img {
        max-height: unset
    }

    .block-video .btn-play-video {
        left: 50%;
        margin-left: -68px
    }

    .text-display-2 {
        font-size: 64px;
        line-height: 70px
    }

    .pattern-white {
        padding-left: 30px;
        padding-right: 30px
    }

    .card-grid-style-2 {
        padding: 24px 20px
    }

    .pt-xs-30 {
        padding-top: 30px
    }

    .block-img-we-do {
        margin-bottom: 30px
    }

    .banner-hero {
        max-width: 100%;
        padding: 60px 0
    }

    .banner-hero.banner-3 {
        padding-top: 50px
    }

    .header .main-header .header-right {
        max-width: 265px
    }

    .header .main-header .header-right .block-signin .btn.btn-default {
        padding: 12px 55px 12px 20px;
        font-size: 16px
    }

    .box-newsletter .img-newsletter {
        position: relative;
        bottom: 0;
        max-width: 100%
    }

    .box-newsletter {
        padding: 37px 30px 36px
    }

    .box-newsletter .block-chart {
        bottom: -10px;
        left: 0;
        max-width: 225px
    }

    .burger-icon {
        top: 25px
    }

    .sticky-bar.stick .burger-icon {
        top: 25px
    }

    .text-heading-1 {
        font-size: 46px;
        line-height: 52px
    }

    .block-img-we-do .block-chart {
        bottom: -30px;
        right: -10px
    }

    .block-we-do .inner-image {
        position: relative
    }

    .block-we-do .inner-image .block-image-bottom {
        bottom: -80px;
        right: -30px
    }

    .block-we-do-2 {
        padding-left: 15px
    }

    .box-square {
        height: auto;
        margin-bottom: 30px
    }

    .box-gray-100 {
        padding: 40px
    }

    .banner-hero.bg-about-1 {
        padding-top: 60px
    }

    .footer .width-20 {
        width: 50%
    }

    .footer .width-16 {
        width: 50%
    }

    .list-steps li {
        padding-left: 8px;
        padding-right: 8px;
        width: 49%;
        padding-bottom: 15px
    }

    .list-steps li::before {
        display: none
    }

    .block-pl {
        padding-left: 0
    }

    .block-pl .mt-20 {
        margin-top: 20px!important
    }

    .text-display-3 {
        font-size: 45px;
        line-height: 52px
    }

    .mb-mobile {
        margin-bottom: 0!important
    }

    .list-5-col {
        display: inline-block;
        width: 100%;
        text-align: center
    }

    .list-5-col li {
        width: 33%;
        display: inline-block;
        margin-bottom: 30px;
        vertical-align: top
    }

    .page-service-2 {
        background-size: auto 650px
    }

    .banner-hero.bg-service-2 {
        padding-top: 20px
    }

    .images-lists img {
        margin-bottom: 25px
    }

    .images-lists .img-1 {
        top: -40px
    }

    .images-lists .img-2 {
        bottom: -50px
    }

    .images-lists .img-4 {
        bottom: -60px
    }

    .images-lists .img-5 {
        bottom: 0
    }

    .box-login .login-right {
        padding-bottom: 90px
    }

    .box-login .login-left {
        min-height: 550px
    }

    .page-blog-1 {
        background-size: auto 550px
    }

    .mt-md-0 {
        margin-top: 0!important
    }

    .pl-lg-15 {
        padding-left: 15px!important
    }

    .header-right {
        padding-right: 50px
    }

    h2.section-title {
        font-size: 48px
    }

    .nav.nav-right {
        margin-top: 30px
    }

    .mt-lg-30 {
        margin-top: 30px!important
    }
}

@media(max-width: 767.98px) {
    .icon-wave::before {
        content:none
    }

    .box-optimized {
        padding: 40px
    }

    .text-display-2 {
        font-size: 50px;
        line-height: 58px
    }

    .footer .width-20 {
        width: 100%
    }

    .footer .width-16 {
        width: 100%
    }

    .block-video .btn-paly-video {
        left: 0;
        right: 0;
        margin: auto;
        top: 50%;
        transform: translateY(-50%)
    }

    .pattern-white {
        padding-left: 15px;
        padding-right: 15px
    }

    .btn.btn-select {
        padding: 10px 20px;
        font-size: 14px;
        line-height: 18px
    }

    .burger-icon {
        top: 17px
    }

    .sticky-bar.stick .burger-icon {
        top: 17px
    }

    .block-img-we-do .block-chart {
        right: -5px
    }

    .block-we-do .inner-image .block-image-bottom {
        right: -20px
    }

    .list-partners li {
        width: 24%
    }

    .text-mb-center {
        text-align: center!important
    }

    .page-faqs-1 {
        background-size: auto 560px
    }

    .box-login .login-left {
        min-height: 450px
    }

    .box-comments ul li .item-comment {
        padding: 65px 0 0
    }

    .slider-news {
        padding: 0
    }

    .swiper-button-next-5,.swiper-button-prev-5 {
        display: none!important
    }

    .section-title-large {
        font-size: 42px
    }

    .banner-hero .block-banner {
        padding: 0
    }

    .header-right {
        display: none
    }

    .mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-top {
        padding: 15px 30px 13px;
        border-bottom: 1px solid #101828
    }

    .mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-top .mobile-header-logo a img {
        width: 140px
    }

    .mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area {
        padding: 30px
    }

    .nav.nav-right {
        margin-top: 30px
    }

    .box-head-single h3 {
        font-size: 36px;
        line-height: 1.2
    }

    .social-share {
        margin-top: 25px
    }

    .social-share .btn-sm {
        padding: 10px 15px;
        vertical-align: middle
    }

    .job-overview {
        padding: 25px!important
    }

    .text-mb-sm-20 {
        margin: 0 0 20px!important;
        display: block
    }

    h1.blog-title {
        font-size: 27px!important;
        line-height: 36px
    }

    .blog-content p {
        font-size: 15px;
        line-height: 26px
    }
}

@media(max-width: 575.98px) {
    .header {
        padding:15px 0
    }

    .header.stick {
        padding: 15px 0
    }

    .text-display-2 {
        font-size: 40px;
        line-height: 48px
    }

    .text-heading-1 {
        font-size: 35px;
        line-height: 44px
    }

    .text-heading-2 {
        font-size: 28px;
        line-height: 32px
    }

    .text-heading-4 {
        font-size: 20px;
        line-height: 26px
    }

    .text-body-lead-large {
        font-size: 20px;
        line-height: 28px
    }

    .box-optimized {
        padding: 20px
    }

    .block-we-do .inner-image .block-image-bottom {
        bottom: -50px;
        right: -5px
    }

    .list-partners li {
        width: 32%;
        padding: 0
    }

    .list-partners li a {
        padding: 10px 15px
    }

    .text-display-3 {
        font-size: 35px;
        line-height: 42px
    }

    .banner-2 .pr-40 {
        padding-right: 0!important
    }

    .banner-2 .ml-40 {
        margin-left: 10px!important;
        margin-top: 15px
    }

    .bg-service-1 .ml-40 {
        margin-left: 10px!important
    }

    .btn-mb {
        margin-left: 0!important
    }

    .box-image .btn-play-middle {
        width: 70px;
        height: 70px;
        background-size: 70px
    }

    .btn {
        padding: 15px 22px
    }

    .btn.icon-arrow-left {
        padding-left: 50px
    }

    .icon-arrow-right-white,.icon-arrow-right {
        padding-right: 45px;
        background-position: center right 20px
    }

    .list-icons .item-icon.none-bd {
        margin-bottom: 10px
    }

    .page-service-2 {
        background-size: auto 550px
    }

    .images-lists img {
        margin-bottom: 25px
    }

    .images-lists .img-1 {
        top: auto
    }

    .images-lists .img-2 {
        bottom: auto
    }

    .images-lists .img-4 {
        bottom: auto
    }

    .images-lists .img-5 {
        bottom: auto
    }

    .box-login .login-left {
        min-height: 400px
    }

    .box-quote {
        padding: 25px 15px
    }

    .box-quote .text-quote {
        font-size: 18px;
        line-height: 32px
    }

    .text-heading-5 {
        font-size: 18px
    }

    .text-heading-3 {
        font-size: 25px;
        line-height: 30px
    }

    .single-detail p {
        font-size: 16px;
        line-height: 30px
    }

    .form-comment .text-end {
        text-align: center!important
    }

    .section-box.mt-70,.section-box.mt-80,.section-box.mt-100,.section-box.mt-40 {
        margin-top: 30px!important
    }

    .header.sticky-bar .col-lg-7 .burger-icon {
        right: 15px
    }

    .banner-hero.hero-1 h1 {
        font-size: 38px
    }

    .banner-hero .block-banner .form-find {
        padding: 15px;
        margin-top: 40px!important
    }

    .banner-hero .block-banner .form-find form {
        display: block
    }

    .banner-hero .block-banner .form-find form input {
        margin-bottom: 15px
    }

    .banner-hero .block-banner .form-find form button {
        margin-top: 15px
    }

    .swiper-button-next,.swiper-button-prev {
        display: none
    }

    h2.section-title {
        font-size: 32px;
        line-height: 48px
    }

    .mt-sm-15 {
        margin-top: 15px!important
    }

    .mt-sm-30 {
        margin-top: 30px!important
    }

    .pt-sm-15 {
        padding-top: 15px
    }

    .swiper-group-6 {
        max-height: 140px
    }

    .box-swiper .swiper-container .item-logo {
        box-shadow: none
    }

    .list-partners li {
        padding: 15px
    }

    .box-newsletter {
        padding: 50px 15px
    }

    .box-newsletter .text-md-newsletter {
        font-size: 22px;
        line-height: 28px
    }

    .box-newsletter .text-lg-newsletter {
        font-size: 32px
    }

    .box-newsletter form {
        display: block
    }

    .footer .col-xs-6 {
        width: 50%
    }

    .footer ul.mt-40 {
        margin-top: 15px!important;
        margin-bottom: 20px!important
    }

    .footer .footer-social {
        margin-top: 15px;
        margin-left: -10px
    }

    .nav-right li {
        margin-bottom: 15px
    }

    .archive-header h3 {
        font-size: 32px;
        line-height: 1.2
    }
}

@media(max-width: 449.98px) {
    .list-steps li {
        padding-left:0;
        padding-right: 0;
        width: 100%
    }

    .list-5-col li {
        width: 49%
    }

    .page-service-2 {
        background-size: auto 650px
    }

    .box-signup .box-form-signup {
        padding: 20px;
        margin-bottom: 120px!important
    }

    .box-line-throught {
        padding: 0 30px
    }

    .box-line-throught::before {
        width: 26px
    }

    .box-line-throught::after {
        width: 26px
    }

    .box-login .login-left {
        min-height: 300px
    }

    .box-login-form .box-signup .box-form-signup {
        margin-bottom: 0!important
    }

    .tag-mb .tag-1 {
        padding: 10px 15px;
        font-size: 12px;
        line-height: 14px
    }

    .block-pricing-3 {
        padding: 15px
    }

    .block-pricing-3 .block-pricing-left {
        margin-bottom: 30px;
        padding: 40px 20px
    }

    .block-pricing-3 .block-price-item {
        padding-left: 70px;
        padding-right: 10px
    }

    .block-pricing-3 .block-price-item .checkbox {
        left: 20px
    }

    .block-pricing-3 .block-price-item .box-info-price {
        position: relative;
        top: auto;
        transform: none;
        right: auto;
        margin-top: 10px
    }
}

@media(min-width: 1400px) {
    .container.wide {
        max-width:1544px
    }

    .box-login-form .box-signup {
        margin: 0
    }
}

@media(min-width: 1200px) {
    .mb-lg-100 {
        margin-bottom:100px
    }

    .mt-lg-100 {
        margin-top: 100px
    }
}

@media(max-width: 1200px) {
    h4.blog-desc {
        font-size:14px
    }
}

@media screen and (min-width: 1200px) and (max-width:1440px) {
    .header-right {
        display:none
    }
}

.banner-hero.banner-2 {
    height: 600px!important
}

@media(max-width: 767px) {
    .banner-hero.banner-2 {
        height:100%!important
    }

    .banner-hero.bg-service-1 {
        height: 100%!important
    }
}

.banner-hero.bg-service-1 {
    height: 600px!important
}

.header-top {
    background: #fff3ea!important
}

.hederimg {
    margin-left: 20px;
    color: #000!important
}

@media only screen and (max-width: 320px) {
    .perfect-scroll {
        height:100vh;
        width: 280px!important;
        position: relative;
        margin-left: 48px!important
    }
}

@media only screen and (max-width: 360px) {
    .perfect-scroll {
        height:100vh;
        width: 280px!important;
        position: relative;
        margin-left: 44px!important;
        margin-top: 20px
    }
}

@media only screen and (max-width: 280px) {
    .perfect-scroll {
        height:100vh;
        width: 233px!important;
        position: relative;
        margin-left: 94px!important;
        margin-top: 20px
    }
}
</style>
<!-- Add the Bootstrap JavaScript and jQuery dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Product /</span> Home</h4>
    @if(Session::has('success'))
   <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
    @endif
  <!-- Users List Table -->
<div class="block-pricing block-pricing-2 mt-50" id="indiashow">
<div class="row">
<div class="col-xl-12 col-lg-12">
<div class="row">
    @if($products)
        @foreach($products as $product)
                    <div class="col-xl-3  col-lg-6 col-md-6 wow animate__ animate__fadeIn animated" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                    <div class="box-pricing-item hover-up">
                    <div class="box-info-price">
                    <span class="text-heading-3 for-month display-month">{{$currency->prefix}} {{ $product->price}} </span> <span class="text-month for-month text-body-small color-gray-400 display-month">/@if($product->product_plan == 1) Month @else Year @endif</span>
                    </div>
                    <div class="line-bd-bottom">
                    <h4 class="text-heading-5 mb-15">{{$product->product_name}}</h4>
                    </div>
                    <ul class="list-package-feature">
                    <!-- <li>Intel Gold / Intel Silver / AMD Epyc 4 Core Processor</li> -->
                    <li>{{$product->description}}</li>
                    <!-- <li>100 GB NVME Storage</li>
                    <li>1 Ip Address</li>
                    <li>1 GBPS Uplink Bandwidth</li>
                    <li>Sophos Intercept X Advanced</li>
                    <li>Managed Services</li> -->
                    </ul>
                    <div>
                    <a class="btn btn-black text-body-lead icon-arrow-right-white" href="{{url('user/get-related-datas/add-cart')}}?action=add&amp;pid={{$product->id}}&amp;currency={{$currency->id}}">
                    Get Started
                    </a></div>
                    </div>
                    </div>
        @endforeach
    @endif


<div class="clearfix product-box-hr"></div> </div>
</div>
</div></div>
</div>
                     
<script>
    $(document).ready(function () {

        $(".delete_debtcase").click(function (e) {
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            e.preventDefault();
            bootbox.confirm({
                message: "Are you sure?",
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
                        window.location.href = url;
                    }
                }
            });
        });
    });
</script>

@endsection