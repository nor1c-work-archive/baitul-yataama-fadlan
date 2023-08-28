@extends('template.base')
@section('title','Yayasan Baitul Yataama Fadlan - Berita')
@section('meta-title','Yayasan Baitul Yataama Fadlan - Berita')
@section('meta-description','Berita Yayasan Baitul Yataama Fadlan')
@section('meta-keywords','Donasi, Amal, Kaum Duafa, Yayasan, Program 1000 Yatim ,Program Donasi')
@section('userStyle')
@endsection
@section('content')
<section class="breadcrumb breadcrumb_bg2 align-items-center">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-sm-6">
                <div class="breadcrumb_tittle text-left">
                    <h2>Berita / Kabar</h2>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="breadcrumb_content text-right">
                    <p>Beranda<span>/</span>Berita</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog_part section_padding">
	<div class="container">
		<div class="row ">
			<div class="col-xl-7">
				<div class="section_tittle title_kabar_program">
					<h2>Berita / Kabar Terbaru</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 mb-5 mb-lg-0">
				<div class="blog_left_sidebar">
					@foreach($berita as $value4)
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
					<div>
						{{ $berita->links() }}
					</div>
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