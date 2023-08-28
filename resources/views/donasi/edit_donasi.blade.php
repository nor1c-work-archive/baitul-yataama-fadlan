@extends('voyager::master')
@section('page_title','Buat Donasi')

@section('page_header')
<h1 class="page-title">
	<i class="icon voyager-edit"></i>
	Buat Donasi
</h1>
@include('voyager::multilingual.language-selector')
@stop
@section('content')
<div class="page-content container-fluid">
	<form action="{{route('donasi.save')}}" class="form-edit-donasi" role="form" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-8">
				<div class="panel">
					{{csrf_field()}}
					<input type="hidden" name="id_donasi" value="{{$data_donasi->id}}">
					<div class="panel-heading">
						<h3 class="panel-title">Data Donasi</h3>
						<div class="panel-actions">
							<a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
						</div>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="subjectDonasi">Subject (Judul)</label>
							<input type="text" class="form-control" id="subjectDonasi" name="subjectDonasi" placeholder="Subject (judul)" value="{{$data_donasi->subject}}">
						</div>
						<div class="form-group">
							<label for="targetNominal">Target Nominal</label>
							<input type="text" class="form-control" id="targetNominal" name="targetNominal" placeholder="Target Nominal" value="{{$data_donasi->target_dana}}">
						</div>
						<div class="form-group">
							<label for="ceritaDonasi">Cerita Donasi</label>
							<textarea class="form-control richTextBox" id="ceritaDonasi" name="ceritaDonasi" placeholder="Tulis Cerita Donasi ...">{{$data_donasi->cerita}}</textarea>
						</div>
					</div>

				</div>
			</div>
			<div class="col-md-4">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Tanggal & Gambar Donasi</h3>
						<div class="panel-actions">
							<a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
						</div>
					</div>

					<div class="panel-body">
						<div class="panel-body">
							<div class="form-group">
								<img src="{{asset('storage/donasi_file/'.$data_donasi->gambar)}}" width="300px">
							</div>
							<div class="form-group">
								<label for="gambarDonasi">Ganti Gambar Donasi</label>
								<input type="file" class="form-control" id="gambarDonasi" name="gambarDonasi" placeholder="Gambar Donasi">
							</div>
							<div class="form-group">
								<label for="tanggalDonasi">Tanggal Buat</label>
								<input type="text" class="form-control" id="tanggalDonasi" name="tanggalDonasi" placeholder="Tanggal Buat" value="{{$data_donasi->tanggal}}" readonly>
							</div>
							<div class="form-group">
								<label for="tipeBatasWaktu">Tipe Batas Waktu</label>
								<select id="tipeBatasWaktu" name="tipeBatasWaktu" class="form-control">
									<option value="tanggal" @if($data_donasi->tipe_batas_waktu == "tanggal") selected @endif>Tanggal Berakhir</option>
									<option value="unlimited" @if($data_donasi->tipe_batas_waktu == "unlimited") selected @endif>Unlimited (Tanpa Batas Waktu)</option>
								</select>
							</div>
							<div class="form-group div-berakhir">
								<label for="tanggalBerakhir">Tanggal Berakhir Donasi</label>
								<input type="text" class="form-control datepicker" id="tanggalBerakhir" name="tanggalBerakhir" placeholder="Tanggal Berakhir Donasi">
							</div>
							<button type="submit" class="btn btn-success">Simpan Donasi</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
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
	$('document').ready(function () {
		var rupiah = document.getElementById('targetNominal');
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

	$("#tipeBatasWaktu").on('change',function(){
		var value = $(this).val();
		if(value == "unlimited"){
			$(".div-berakhir").css('visibility','hidden');
		}else{
			$(".div-berakhir").css('visibility','visible');
		}
	});

	@if($data_donasi->tipe_batas_waktu == "tanggal")
		$(".div-berakhir").css('visibility','visible');
	@else
		$(".div-berakhir").css('visibility','hidden');
	@endif
</script>
@endsection