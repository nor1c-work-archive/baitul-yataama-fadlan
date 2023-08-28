@extends('template.base')
@section('title','Yayasan Baitul Yataama Fadlan - Hubungi Kami')
@section('meta-title','Yayasan Baitul Yataama Fadlan - Hubungi Kami')
@section('meta-description','Hubungi Yayasan Baitul Yataama Fadlan')
@section('meta-keywords','Donasi, Amal, Kaum Duafa, Yayasan, Hubungi Yayasan')
@section('userStyle')
<style type="text/css">
    .youtube_frame{
        width:590px;
        height:325px;
    }

    @media only screen and (max-width: 652px){
         .youtube_frame{
            width:390px;
            height:225px;
        }
    }

    @media only screen and (max-width: 452px){
        .youtube_frame{
            width:370px;
            height:205px;
        }
    }

    @media only screen and (max-width: 386px){
        .youtube_frame{
            width:300px;
            height:185px;
        }
    }
</style>
@endsection
@section('content')
@php
$static_content = App\Http\Controllers\ComproController::getFooterFuction();
@endphp

<section class="breadcrumb breadcrumb_bg2 align-items-center">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-sm-6">
                <div class="breadcrumb_tittle text-left">
                    <h2>Hubungi Kami</h2>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="breadcrumb_content text-right">
                    <p>Beranda<span>/</span>Hubungi Kami</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about_part section_padding padding_bottom">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-6 col-lg-6">
                <div class="about_part_img">
                    <iframe class="youtube_frame" src="https://www.youtube.com/embed/MigqFKJCdWo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-md-6 col-lg-5">
            <div class="about_part_text">
                <h2>Yayasan Baitul Yataama Fadlan</h2>

                <ul>
                    <li>
                        <span class="icon"><img class="icon-web" src="{{asset('images/socialmedia/facebook.svg')}}" alt="Facebook Icon" style="width: 100%; height: auto;"></span>
                        <h3>Facebook</h3>
                        <p><a href="{{$static_content['profil']->facebook}}">{{$static_content['profil']->facebook}}</a></p>
                    </li>
                    <li>
                        <span class="icon"><img class="icon-web" src="{{asset('images/socialmedia/twitter.svg')}}" alt="Twitter Icon" style="width: 100%; height: auto;"></span>
                        <h3>Twitter</h3>
                        <p><a href="{{$static_content['profil']->twitter}}">{{$static_content['profil']->twitter}}</a></p>
                    </li>
                    <li>
                        <span class="icon"><img class="icon-web" src="{{asset('images/socialmedia/instagram.svg')}}" alt="Instagram Icon" style="width: 100%; height: auto;"></span>
                        <h3>Instagram</h3>
                        <p><a href="{{$static_content['profil']->instagram}}">{{$static_content['profil']->instagram}}</a></p>
                    </li>
                    <li>
                        <span class="icon"><img class="icon-web" src="{{asset('images/socialmedia/whatsapp.svg')}}" alt="Whatsapp Icon" style="width: 100%; height: auto;"></span>
                        <h3>Whatsapp</h3>
                        <p><a href="{{'https://api.whatsapp.com/send?phone='.$static_content['profil']->whatsapp.'&text=Assalamaualaikum, saya ingin bertanya'}}">{{$static_content['profil']->whatsapp}}</a></p>
                    </li>
                    <li>
                        <span class="icon"><img class="icon-web" src="{{asset('images/socialmedia/youtube.svg')}}" alt="Youtube Icon" style="width: 100%; height: auto;"></span>
                        <h3>Youtube Channel</h3>
                        <p><a href="{{$static_content['profil']->youtube}}">Yayasan Baitul Yataama Fadlan</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>
@endsection