@extends('template.base')
@section('title','Yayasan Baitul Yataama Fadlan - Donasi')
@section('meta-title','Yayasan Baitul Yataama Fadlan - Donasi')
@section('meta-description','Donasi Yayasan Baitul Yataama Fadlan')
@section('meta-keywords','Donasi, Amal, Kaum Duafa, Yayasan, Hubungi Yayasan, Yatim, Baitul Yataama Fadlan')
@section('userStyle')
<style type="text/css">
	.count-campaign{
		background-color:#fff;
		margin-top: -120px; 
		z-index: 200;
		height: 120px;
		box-shadow: 2px 3px #e0e0e0;
		border-radius: 10px;
	}

	.count-campaign > div {
		text-align: center;
		margin: auto;
		vertical-align: middle;
		padding-top: 20px;
		padding-bottom: 20px;
	}

	.div-jarak{
		margin-top: 60px;
		margin-bottom: 60px;
	}

	.angka-campaign{
		font-size: 35px;
		color: #4caf50;
		font-weight: bold;
	}

	.btn-donasi{
		width: 100%;
		text-align: center;
	}

	@media only screen and (max-width: 600px) {
	  .count-campaign{
			visibility: hidden;
		}
	}
</style>
@endsection
@section('content')
<section class="breadcrumb breadcrumb_bg2 align-items-center">
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-sm-6">
				<div class="breadcrumb_tittle text-left">
					<h2>Donasi</h2>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="breadcrumb_content text-right">
					<p>Beranda<span>/</span>Donasi</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="div-jarak">
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2 count-campaign">
				<div class="row">
					<div class="col-md-4">
						<div class="single_member_counter">
							<span class="counter angka-campaign">{{$count_donasi}}</span>
							<h4> Campaign</h4>
						</div>
					</div>
					<div class="col-md-4">
						<div class="jumlah_uang">
							<span class="angka-campaign">{{"Rp ".number_format($sum_dana,0,",",".")}}</span>
							<h4> Dana Terkumpul</h4>
						</div>
					</div>
					<div class="col-md-4">
						<div class="single_member_counter">
							<span class="counter angka-campaign">{{$count_donatur}}</span>
							<h4> Donatur</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row div-jarak">
			<div class="col-xl-12">
				<div class="text-center">
					<h2>Assalamu'alaikum Sahabat, Tunggu apa lagi?</h2>
					<h3>Ayo berbagi rezeki untuk anak-anak yatim</h3>
				</div>
			</div>
		</div>
		<div class="row div-jarak">
			@foreach($data_donasi as $value)
			@php
				$dana = $value->dana_masuk;
				$target_dana = $value->target_dana;
				$percentage = ($dana*100)/$target_dana;
			@endphp
			<div class="col-md-4">
				<div class="card">
					<img src="{{asset('donasi_file/'.$value->gambar)}}" class="card-img-top" alt="{{$value->subject}}">
					<div class="card-body">
						<h5 class="card-title">{{$value->subject}}</h5>
						<div class="progress" style="height: 10px;">
							<div class="progress-bar bg-success" role="progressbar" style="{{'width:'.$percentage.'%'}}" aria-valuenow="{{$value->dana_masuk}}" aria-valuemin="0" aria-valuemax="{{$value->target_dana}}"></div>
						</div>
						<div class="row" style="margin:10px 0px 50px 0px;">
							<div style="text-align: left; position: absolute; left: 0; margin-left: 20px">
								<span style="font-weight: bold;">Sisa Waktu</span><br/>
								@if($value->tipe_batas_waktu == "unlimited")
									<img src="{{asset('images/infinity.png')}}" width="20px">
								@else
									@php
										  $tanggal_berakhir = new DateTime($value->tanggal_berakhir);
										  $tanggal_sekarang = new DateTime();
										  $difference = $tanggal_berakhir->diff($tanggal_sekarang);
									@endphp
									{{$difference->days}} Hari
								@endif
							</div>
							<div style="text-align: right; position: absolute; right: 0; margin-right: 20px">
								<span style="font-weight: bold;">Terkumpul</span><br/>
								{{"Rp ".number_format($value->dana_masuk,0,",",".")}}
							</div>
						</div>
						<a href="{{route('donasi.konsumen.detail',[$value->key])}}" class="btn btn-success btn-donasi">Donasi Sekarang</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		<div>
			{{ $data_donasi->links() }}
		</div>
	</div>
</section>
@endsection