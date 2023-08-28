@extends('template.base')
@section('title','Yayasan Baitul Yataama Fadlan - Tentang Kami')
@section('meta-title','Yayasan Baitul Yataama Fadlan - Tentang Kami')
@section('meta-description','Mengajak kepada kaum muslimin dan muslimat untuk lebih memperhatikan keadaan anak-anak yatim dari segi agama,materi, mutu pendidikan dan kesejahteraan')
@section('meta-keywords','Donasi, Amal, Kaum Duafa, Yayasan, Tentang Kami')
@section('userStyle')
<style type="text/css">
    .single_member_counter h4{
        font-size: 20px !important;
    }
</style>
@endsection
@section('content')
<section class="breadcrumb breadcrumb_bg align-items-center">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-sm-6">
                <div class="breadcrumb_tittle text-left">
                    <h2>Tentang Kami</h2>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="breadcrumb_content text-right">
                    <p>Beranda<span>/</span>Tentang Kami</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about part start-->
<section class="about_part section_padding">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-6 col-lg-6">
                <div class="about_part_img">
                    <img src="{{asset('storage/'.$tentang_yayasan->image)}}" alt="">
                </div>
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="about_part_text">
                    <h2>Yayasan Baitul Yataama Fadlan</h2>
                    {!! $tentang_yayasan->tentang !!}
                    <ul>
                        <li>
                            <span class="icon"><img class="icon-web" src="{{asset('images/visi.svg')}}" alt="Visi Icon" style="width: 100%; height: auto;"></span>
                            <h3>Visi</h3>
                            <p>{!! $tentang_yayasan->visi !!}</p>
                        </li>
                        <li>
                            <span class="icon"><img class="icon-web" src="{{asset('images/misi.svg')}}" alt="Visi Icon" style="width: 100%; height: auto;"></span>
                            <h3>Misi</h3>
                            {!! $tentang_yayasan->misi !!}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about part end-->

<!-- our_service start-->
<section class="our_service padding_top">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="section_tittle">
                    <h2>Program Kami</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($program_yayasan as $value3)
            <div class="col-sm-6 col-xl-4">
                <div class="single_feature">
                    <div class="single_service">
                        <span class="icon"><img class="icon-web" src="{{asset('images/program.svg')}}" alt="Visi Icon" style="width: 100%; height: auto;"></span>
                        <h4>{{$value3->name}}</h4>
                        <p>{{substr($value3->description,0,140)}}...</p>
                        <a href="#" class="btn_3">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- our_service part end-->

<section class="member_counter padding_bottom padding_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single_counter_icon">
                    <img src="{{asset('images/binaan.svg')}}" alt="">
                </div>
                <div class="single_member_counter">
                    <span class="counter">166</span>
                    <h4> <span>Lebih Yatim</span>Binaan</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_counter_icon">
                    <img src="{{asset('images/luar_binaan.svg')}}" alt="">
                </div>
                <div class="single_member_counter">
                    <span class="counter">300</span>
                    <h4> <span>Lebih Yatim</span>Luar Binaan</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_counter_icon">
                    <img src="{{asset('images/kegiatan.svg')}}" alt="">
                </div>
                <div class="single_member_counter">
                    <span class="counter">230</span>
                    <h4><span>Lebih Total</span> Kegiatan</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_counter_icon">
                    <img src="{{asset('images/kecamatan.svg')}}" alt="">
                </div>
                <div class="single_member_counter">
                    <span class="counter">70</span>
                    <h4> <span>Lebih Cakupan</span> Daerah</h4>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection