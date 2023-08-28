@extends('template.base')
@section('title','Yayasan Baitul Yataama Fadlan - Hubungi Kami')
@section('meta-title',$berita->seo_title)
@section('meta-description',$berita->meta_description)
@section('meta-keywords',$berita->meta_keywords)
@section('userStyle')
@php
$image_location = asset('storage/'.str_replace('\\', '/', $berita->image));
@endphp
<style type="text/css">
	.breadcrumb_bg2{
		background-image: url("{{$image_location}}");
	}

	.title_kabar_program h2{
		font-size: 20px !important;
	}

	.pagination li{
		float: left;
		list-style-type: none;
		margin:5px;
	}
</style>
@endsection
@section('content')
<section class="breadcrumb breadcrumb_bg2 align-items-center">
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-sm-6">
				<div class="breadcrumb_tittle text-left">
					<h2>{{$berita->title}}</h2>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="breadcrumb_content text-right">
					<p>Beranda<span>/</span>{{$berita->name_categories}}<span>/</span>{{$berita->title}}</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="blog_area single-post-area section_padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 posts-list">
				<div class="single-post">
					<div class="feature-img">
						<img class="img-fluid" src="{{$image_location}}" alt="">
					</div>
					<div class="blog_details">
						<h2>{{$berita->title}}
						</h2>
						<ul class="blog-info-link mt-3 mb-4">
							<li><a href="{{route('program',[$berita->slug_categories])}}"><i class="far fa-user"></i> {{$berita->name_categories}}</a></li>
							<li><a href="#"><i class="far fa-comments"></i> 0 Komentar</a></li>
						</ul>
						{!! $berita->body !!}
					</div>
				</div>
				<div class="blog-author">
					<div class="media align-items-center">
						<img src="{{asset('images/logo.png')}}" alt="">
						<div class="media-body">
							<a href="#">
								<h4>Penulis : Administrator Website</h4>
							</a>
							<p>Mengajak kepada kaum muslimin dan muslimat untuk lebih memperhatikan keadaan anak-anak yatim dari segi agama,materi, mutu pendidikan dan kesejahteraan</p>
						</div>
					</div>
				</div>
				<div class="comments-area">
					<h4>0 Komentar</h4>
				</div>
				<div class="comment-form">
					<h4>Tulis Komentar Kamu</h4>
					<form class="form-contact comment_form" action="#" id="commentForm">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
									placeholder="Komentar"></textarea>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input class="form-control" name="name" id="name" type="text" placeholder="Nama">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input class="form-control" name="email" id="email" type="email" placeholder="Email">
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="button btn_1 button-contactForm">Kirim Komentar</button>
						</div>
					</form>
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