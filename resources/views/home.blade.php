@extends('template.base')
@section('title','Yayasan Baitul Yataama Fadlan - Yayasan Yatim Piatu & Kaum Duafa')
@section('meta-title','Yayasan Baitul Yataama Fadlan - Yayasan Yatim Piatu & Kaum Duafa')
@section('meta-description','Yayasan Baitul Yataama Fadlan merupakan lembaga sosial yang berdiri sejak Januari tahun 2011. Tujuan utama yayasan ini berdiri yaitu, untuk membantu dan memajukan kehidupan anak-anak yatim dengan program yang efektif dan berkesinambungan untuk kehidupan yang lebih baik.')
@section('meta-keywords','Yayasan Yatim Piatu, Yatim, Donasi, Amal, Kaum Duafa, Yayasan')
@section('userStyle')
<style type="text/css">
	.banner_part {
		background-image: none !important;
	}

	.jk-slider{
		width:100%;
	}
	/*          Hero Headers        */
	/********************************/
	.hero {
		position: absolute;
		top: 50%;
		left: 50%;
		z-index: 3;
		color: #fff !important;
		text-align: center;
		vertical-align: bottom;
		/*text-transform: uppercase;*/
		text-shadow: 1px 1px 0 rgba(0,0,0,.75);
		-webkit-transform: translate3d(-50%,-50%,0);
		-moz-transform: translate3d(-50%,-50%,0);
		-ms-transform: translate3d(-50%,-50%,0);
		-o-transform: translate3d(-50%,-50%,0);
		transform: translate3d(-50%,-50%,0);
	}
	.hero h1 {
		font-size: 6em;    
		font-weight: bold;
		margin: 0;
		padding: 0;
	}

	.hero h3 {
		color: #fff;
		bottom: 0;
		top: auto;
	}
	.fade-carousel .carousel-inner .item .hero {
		opacity: 0;
		-webkit-transition: 2s all ease-in-out .1s;
		-moz-transition: 2s all ease-in-out .1s; 
		-ms-transition: 2s all ease-in-out .1s; 
		-o-transition: 2s all ease-in-out .1s; 
		transition: 2s all ease-in-out .1s; 
	}
	.fade-carousel .carousel-inner .item.active .hero {
		opacity: 1;
		-webkit-transition: 2s all ease-in-out .1s;
		-moz-transition: 2s all ease-in-out .1s; 
		-ms-transition: 2s all ease-in-out .1s; 
		-o-transition: 2s all ease-in-out .1s; 
		transition: 2s all ease-in-out .1s;    
	}
	/********************************/
	/*            Overlay           */
	/********************************/
	.overlay {
		position: absolute;
		width: 100%;
		height: 100%;
		z-index: 2;
		background-color: #080d15;
		opacity: 0.5;
	}

	.carousel-control-prev{
		z-index: 16 !important;
	}

	.carousel-control-next{
		z-index: 16 !important;
	}

	.single_member_counter h4{
		font-size: 20px !important;
	}
</style>
@endsection
@section('content')
<section>
	<section class="jk-slider">
		<div id="carousel-yayasan" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				@php
				$no = 0;
				@endphp
				@foreach($slider as $value)
				<li data-target="#carousel-yayasan" data-slide-to="{{$no}}" @if($no == 0) class="active" @endif></li>
				@php
				$no++;
				@endphp
				@endforeach
			</ol>

			<div class="carousel-inner">
				@php
				$no2 = 0;
				@endphp
				@foreach($slider as $value2)
				<div class="carousel-item @if($no2 == 0) active @endif">
					<a href="#"><img src="{{asset('storage/'.$value2->image)}}" style="width: 100% !important;height: auto;" /></a>
				</div>
				@php
				$no2++;
				@endphp
				@endforeach
			</div>

			<a class="carousel-control-prev" href="#carousel-yayasan" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#carousel-yayasan" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
		</div>
	</section>
	<!-- banner part start-->

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
							<a href="{{route('program',[$value3->slug])}}" class="btn_3">Lihat Detail</a>
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

	<section class="blog_part section_padding">
		<div class="container">
			<div class="row ">
				<div class="col-xl-5">
					<div class="section_tittle ">
						<h2>Berita / Kabar</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="blog_left_sidebar">
						@foreach($berita_yayasan as $value4)
						<article class="blog_item">
							<div class="blog_item_img">
								<img class="card-img rounded-0" src="{{asset('storage/'.$value4->image)}}" alt="{{$value4->title}}">
								<a href="{{route('detail.berita',[$value4->slug])}}" class="blog_item_date">
									<h3>{{date('d',strtotime($value4->created_at))}}</h3>
									<p>{{date('M',strtotime($value4->created_at))}}</p>
								</a>
							</div>

							<div class="blog_details">
								<a class="d-inline-block" href="{{route('detail.berita',[$value4->slug])}}">
									<h2>{{$value4->title}}</h2>
								</a>
								{!! substr($value4->body,0,300) !!}...
								<ul class="blog-info-link">
									<li><a href="javascript:void(0)"><i class="far fa-user"></i>{{$value4->name_categories}}</a></li>
									<li><a href="javascript:void(0)"><i class="far fa-comments"></i> 0 Komentar</a></li>
								</ul>
							</div>
						</article>
						@endforeach
					</div>
				</div>
				<div class="col-lg-4">
					<div class="blog_right_sidebar">
						<aside class="single_sidebar_widget post_category_widget">
							<h4 class="widget_title">Kategori Program</h4>
							<ul class="list cat-list">
								@foreach($summary_category as $value5)
								<li>
									<a href="{{route('program',[$value5->slug])}}" class="d-flex">
										<p>{{$value5->name_categories}}</p>
										<p>({{$value5->jumlah}})</p>
									</a>
								</li>
								@endforeach
								
							</ul>
						</aside>

						<aside class="single_sidebar_widget popular_post_widget">
							<h3 class="widget_title">Rekomendasi Berita</h3>
							@foreach($berita_yayasan_recent as $value5)
							<div class="media post_item">
								<img src="{{asset('storage/'.$value5->image)}}" alt="post" style="width: 70px; height: auto;">
								<div class="media-body">
									<a href="{{route('detail.berita',[$value5->slug])}}">
										<h3>{{$value5->title}}</h3>
									</a>
									<p>{{date('d M Y',strtotime($value5->created_at))}}</p>
								</div>
							</div>
							@endforeach
						</aside>
					</div>
				</div>
			</div>
		</div>
	</section>

	@endsection