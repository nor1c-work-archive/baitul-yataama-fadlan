@extends('voyager::master')
@section('page_title','Detail Donasi : '.$data_donasi->subject)

@section('page_header')
<h1 class="page-title">
	<i class="icon voyager-news"></i>
	Detail Donasi : {{$data_donasi->subject}}
</h1>
@include('voyager::multilingual.language-selector')
@stop

@section('css')
<style type="text/css">
	.voyager .progress .progress-bar{
		background-color: #4caf50;
	}
</style>
@endsection
@section('content')
<div class="page-content container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 col-xs-12">
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Data Donasi</h3>
					<div class="panel-actions">
						@if($data_donasi->status == "berjalan")
						<a href="{{route('donasi.edit_data',[$data_donasi->id])}}" class="btn btn-primary">Edit <i class="glyphicon glyphicon-pencil"></i></a>
						<a href="javascript:void(0)" onclick="nonaktif();" class="btn btn-danger">Nonaktifkan Donasi <i class="glyphicon glyphicon-remove"></i></a>
						<a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
						@elseif($data_donasi->status == "nonaktif")
						<a href="{{route('donasi.edit_data',[$data_donasi->id])}}" class="btn btn-primary">Edit <i class="glyphicon glyphicon-pencil"></i></a>
						<a href="{{route('donasi.nonaktif',[$data_donasi->id,'berjalan'])}}" class="btn btn-success">Aktifkan Donasi <i class="glyphicon glyphicon-check"></i></a>
						<a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
						@endif
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-2">
							Subject (Judul)
						</div>
						<div class="col-xs-1">
							:
						</div>
						<div class="col-xs-9">
							{{$data_donasi->subject}}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2">
							Tanggal Posting
						</div>
						<div class="col-xs-1">
							:
						</div>
						<div class="col-xs-9">
							{{date('d M Y H:i:s',strtotime($data_donasi->tanggal))}}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2">
							Tipe Batas Waktu
						</div>
						<div class="col-xs-1">
							:
						</div>
						<div class="col-xs-9">
							@if($data_donasi->tipe_batas_waktu == "unlimited")
							<img src="{{asset('images/infinity.png')}}" width="20px"> Unlimited
							@else
							{{date('d M Y H:i:s',strtotime($data_donasi->tanggal_berakhir))}} (Tanggal Berakhir)
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2">
							Gambar
						</div>
						<div class="col-xs-1">
							:
						</div>
						<div class="col-xs-9">
							<img src="{{asset('storage/donasi_file/'.$data_donasi->gambar)}}" width="300px">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2">
							Status
						</div>
						<div class="col-xs-1">
							:
						</div>
						<div class="col-xs-9">
							@if($data_donasi->status == "berjalan")
							<span class="badge badge-success">Sedang Berjalan</span>
							@elseif($data_donasi->status == "selesai")
							<span class="badge badge-primary">Donasi Selesai</span>
							@elseif($data_donasi->status == "nonaktif")
							<span class="badge badge-danger">Nonaktif</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2">
							Cerita
						</div>
						<div class="col-xs-1">
							:
						</div>
						<div class="col-xs-12">
							{!! $data_donasi->cerita !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-md-offset-4 col-xs-12">
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Berita/Kabar</h3>
					<div class="panel-actions">
						<a href="{{route('donasi.kabar.tambah',[$data_donasi->id])}}" onclick="tambah_kabar();" class="btn btn-primary">Tambah Kabar Data <i class="glyphicon glyphicon-plus"></i></a>
						<a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="dataTable" class="table table-hover">
							<thead>
								<tr>
									<th>Judul</th>
									<th>Jumlah Dana</th>
									<th>Tanggal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data_kabar_donasi as $value2)
								<tr>
									<td>{{$value2->subject}}</td>
									<td>
										@if($value2->tipe_kabar == "penarikan_dana")
										{{"Rp ".number_format($value2->jumlah_penarikan,0,",",".")}}
										@else
										-
										@endif
									</td>
									<td>
										{{date('d M Y',strtotime($value2->tanggal))}}
									</td>
									<td>
										<a href="{{route('donasi.kabar.ubah',[$data_donasi->id,$value2->id])}}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Data Terkumpul & Donatur</h3>
					<div class="panel-actions">
						<a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							Target Dana
						</div>
						<div class="col-xs-1">
							:
						</div>
						<div class="col-xs-7">
							{{"Rp ".number_format($data_donasi->target_dana,0,",",".")}}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							Dana Terkumpul
						</div>
						<div class="col-xs-1">
							:
						</div>
						<div class="col-xs-7">
							<b><i>{{"Rp ".number_format($data_donasi->dana_masuk,0,",",".")}}</i></b>
						</div>
					</div>
					<div class="row">
						@php
						$dana = $data_donasi->dana_masuk;
						$target_dana = $data_donasi->target_dana;
						$percentage = ($dana*100)/$target_dana;
						@endphp
						<div class="col-xs-12">
							<div class="progress">
								<div class="progress-bar bg-success" role="progressbar" style="{{'width:'.$percentage.'%'}}" aria-valuenow="{{$data_donasi->dana_masuk}}" aria-valuemin="0" aria-valuemax="{{$data_donasi->target_dana}}"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<b>Donatur ({{count($data_donatur)}} orang)</b>
						</div>
						<div class="col-xs-1">
							<b>:</b>
						</div>
						<div class="col-xs-12">
							<hr/>
							<div class="div_donasi">
								@if(count($data_donatur) > 0)
								@foreach($data_donatur as $value)
								<div class="card">
									<div class="row">
										<div class="col-md-3">
											<img class="img-circle" src="{{asset('images/donasi_avatar/'.$value->foto)}}" width="70px">
										</div>
										<div class="col-md-9 px-3">
											<div class="card-block px-3">
												<h4 class="card-title" style="color: #4caf50;">{{$value->nama}}</h4>
												<h5><b>{{"Rp ".number_format($value->jumlah_donasi,0,",",".")}}</b> - Via {{$value->metode}}</h5>
												<h6>{{date('d M Y',strtotime($value->tanggal))}}</h6>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modal-nonaktif">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Aksi Optional</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>
					Aksi Apa yang akan anda lakukan?<br>
					<b>Selesaikan Donasi</b> : Donasi telah selesai dan tidak dapat diaktifkan lagi<br>
					<b>Nonaktifkan Donasi</b> : Donasi dinonaktifkan sementara, dapat berjalan lagi kemudian
				</p>
			</div>
			<div class="modal-footer">
				<a href="{{route('donasi.nonaktif',[$data_donasi->id,'selesai'])}}" class="btn btn-primary">Selesaikan Donasi</a>
				<a href="{{route('donasi.nonaktif',[$data_donasi->id,'nonaktif'])}}" class="btn btn-danger">Nonaktifkan Donasi</a>
			</div>
		</div>
	</div>
</div>

<iframe id="form_target" name="form_target" style="display:none"></iframe>
<form id="my_form" action="http://localhost:9000/admin/upload" target="form_target" method="post"
enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
<input name="image" id="upload_file" type="file"
onchange="$('#my_form').submit();this.value='';">
<input type="hidden" name="type_slug" id="type_slug" value="posts">
<input type="hidden" name="_token" value="aglOBySV070bPz00VECpaNF62CBJfiWK3iKiouCR">
</form>
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).ready(function () {
		var table = $('#dataTable').DataTable();

		var rupiah = document.getElementById('jumlahPenarikan');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
	});

	var page = 1;
	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $(document).height()) {
			page++;
			loadMoreData(page);
		}
	});
	function loadMoreData(page){
		$.ajax(
		{
			url: '{{route('donasi.detail_data',[$data_donasi->id])}}'+'?page='+ page,
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

	function nonaktif(){
		$('#modal-nonaktif').modal('show');
	}
</script>
@endsection