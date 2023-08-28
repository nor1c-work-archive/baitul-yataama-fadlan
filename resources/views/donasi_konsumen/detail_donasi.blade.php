@extends('template.base')
@section('title',$data_donasi->subject)
@section('meta-title',$data_donasi->subject)
@section('meta-description',$data_donasi->cerita)
@section('meta-keywords','Donasi, Amal, Kaum Duafa, Yayasan, Hubungi Yayasan, Yatim, Baitul Yataama Fadlan')
@php
$image_location = asset('storage/donasi_file/'.$data_donasi->gambar);
@endphp
@section('userStyle')
<style type="text/css">
	.breadcrumb_bg2{
		background-image: url("{{$image_location}}");
	}

	.text-dana-masuk{
		color:#4caf50 !important;
		font-size: 20px !important;
		font-weight: bold;
	}

	.text-terkumpul-dari{
		color:black;
	}

	.btn-donasi{
		width: 100%;
		text-align: center;
	}

	.div-cerita{
		text-align: left;
	}

	.div-tanggal-cerita{
		text-align: right;
	}

	.card-custom{
		padding:5px 0px 5px 0px;
		margin:5px 0px 5px 0px;
		border: 1px solid #e0e0e0;
	}

	.nav-link{
		color: #4caf50;
	}
</style>
<link rel="stylesheet" type="text/css" href="{{asset('timeline/style.css')}}">
@endsection
@section('content')
<div class="row">
	<div class="col-md-4 offset-md-4">
		<div class="card">
			@php
			$dana = $data_donasi->dana_masuk;
			$target_dana = $data_donasi->target_dana;
			$percentage = ($dana*100)/$target_dana;
			@endphp
			<img src="{{asset('storage/donasi_file/'.$data_donasi->gambar)}}" class="card-img-top" alt="{{$data_donasi->subject}}">
			<div class="card-body">
				<h4 class="card-title">{{$data_donasi->subject}}</h4>
				<span class="text-dana-masuk">{{"Rp ".number_format($data_donasi->dana_masuk,0,",",".")}}</span><span class="text-terkumpul-dari"> terkumpul dari {{"Rp ".number_format($data_donasi->target_dana,0,",",".")}}</span>
				<div class="progress" style="height: 10px;">
					<div class="progress-bar bg-success" role="progressbar" style="{{'width:'.$percentage.'%'}}" aria-valuenow="{{$data_donasi->dana_masuk}}" aria-valuemin="0" aria-valuemax="{{$data_donasi->target_dana}}"></div>
				</div>
				<div class="row" style="margin:10px 0px 50px 0px;">
					<div style="text-align: left; position: absolute; left: 0; margin-left: 20px">
						<span style="font-weight: bold;">Sisa Waktu</span><br/>
						@if($data_donasi->tipe_batas_waktu == "unlimited")
						<img src="{{asset('images/infinity.png')}}" width="20px">
						@else
						@php
						$tanggal_berakhir = new DateTime($data_donasi->tanggal_berakhir);
						$tanggal_sekarang = new DateTime();
						$difference = $tanggal_berakhir->diff($tanggal_sekarang);
						@endphp
						{{$difference->days}} Hari
						@endif
					</div>
					<div style="text-align: right; position: absolute; right: 0; margin-right: 20px">
						<span style="font-weight: bold;">Donasi</span><br/>
						{{count($data_donatur)}}
					</div>
				</div>
				<a href="{{route('donasi.konsumen.buat_donasi',[$data_donasi->key])}}" class="btn btn-success btn-donasi">Donasi Sekarang</a>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<ul class="nav nav-tabs" id="tabDonasi" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="cerita-tab" data-toggle="tab" href="#cerita" role="tab" aria-controls="home" aria-selected="true">Cerita</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="infoTerbaru-tab" data-toggle="tab" href="#infoTerbaru" role="tab" aria-controls="profile" aria-selected="false">Info Terbaru</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="donasi-tab" data-toggle="tab" href="#donasi" role="tab" aria-controls="contact" aria-selected="false">Donasi</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="cerita" role="tabpanel" aria-labelledby="cerita-tab">
						{!! $data_donasi->cerita !!}
					</div>
					<div class="tab-pane fade" id="infoTerbaru" role="tabpanel" aria-labelledby="infoTerbaru-tab">
						<div class="qa-message-list" id="wallmessages">
							@if(count($data_kabar_donasi) > 0)
							@foreach($data_kabar_donasi as $value_kabar)
							<div class="message-item">
								<div class="message-inner">
									<div class="message-head clearfix">
										<div class="avatar pull-left"><a href="#"><img src="{{asset('images/logo.png')}}" class="icon-timeline"></a></div>
										<div class="user-detail">
											<h5 class="handle">
												{{$value_kabar->subject}}
											</h5>
											<div class="post-meta">
												<div class="asker-meta">
													<span class="qa-message-what"></span>
													<span class="qa-message-when">
														<span class="qa-message-when-data">{{date('d M Y',strtotime($value_kabar->tanggal))}}</span>
													</span>
													<span class="qa-message-who">
														<span class="qa-message-who-pad">by </span>
														<span class="qa-message-who-data"><a href="#">Administrator Website</a></span>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="qa-message-content">
										Penarikan Dana Sejumlah {{"Rp ".number_format($value_kabar->jumlah_penarikan,0,",",".")}} - {{$value_kabar->isi}}
									</div>
								</div>
							</div>
							@endforeach
							@else
								<div style="margin: auto;right: 0;left: 0;text-align: center;">
									<img src="{{asset('images/heart.png')}}" alt="Kosong">
									<h4>Belum ada kabar/berita untuk campaign ini</h4>
								</div>
							@endif
						</div>
					</div>
					<div class="tab-pane fade" id="donasi" role="tabpanel" aria-labelledby="donasi-tab">
						<div class="div_donasi">
							@if(count($data_donatur) > 0)
							@foreach($data_donatur as $value)
							<div class="card-custom">
								<div class="row" style="margin:auto;">
									<div class="col-xs-3">
										<img class="img-circle" src="{{asset('images/donasi_avatar/'.$value->foto)}}" width="70px">
									</div>
									@if($value->anonim == "true")
										@php
										$nama_tampil = "Anonim";
										@endphp
									@else
										@php
										$nama_tampil = $value->nama;
										@endphp
									@endif
									<div class="col-xs-9 px-3">
										<div class="card-block px-3">
											<h5>{{$nama_tampil}} - <b>{{"Rp ".number_format($value->jumlah_donasi,0,",",".")}}</b></h5>
											<span style="color:black;font-size: 10px;">{{date('d M Y',strtotime($value->tanggal))}}</span>
											<p class="card-text">{{$value->doa}}</p>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							@else
							<p>Belum Ada Donatur</p>
							@endif
						</div>

						<div class="ajax-load text-center" style="display: none;">
							<img src="{{asset('images/loading.gif')}}" alt="Loading" width="100px">
						</div>
						<a href="javascript:void(0)" onclick="tampilkanLebihBanyak()" class="btn btn-success btn-donasi">Tampilkan Lebih Banyak</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('userScript')

<script type="text/javascript">
	var page = 1;

	function tampilkanLebihBanyak(){
		page++;
		loadMoreData(page);
	}

	function loadMoreData(page){
		$.ajax(
		{
			url: '{{route('donasi.konsumen.detail',[$data_donasi->key])}}'+'?page='+ page,
			type: "get",
			beforeSend: function()
			{
				$('.ajax-load').css('display','inline');
			}
		})
		.done(function(data)
		{
			if(data.html == " "){
				$('.ajax-load').html("No more records found");
				return;
			}
			$('.ajax-load').css('display','none');
			$(".div_donasi").append(data.html);
		})
		.fail(function(jqXHR, ajaxOptions, thrownError)
		{
		});
	}
</script>
@endsection