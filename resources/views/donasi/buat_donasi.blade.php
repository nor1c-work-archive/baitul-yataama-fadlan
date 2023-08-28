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
	<form action="{{route('donasi.save')}}" class="form-add-donasi" role="form" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-8">
				<div class="panel">
					{{csrf_field()}}
					<div class="panel-heading">
						<h3 class="panel-title">Data Donasi</h3>
						<div class="panel-actions">
							<a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
						</div>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="subjectDonasi">Subject (Judul)</label>
							<input type="text" class="form-control" id="subjectDonasi" name="subjectDonasi" placeholder="Subject (judul)">
						</div>
						<div class="form-group">
							<label for="targetNominal">Target Nominal</label>
							<input type="text" class="form-control" id="targetNominal" name="targetNominal" placeholder="Target Nominal">
						</div>
						<div class="form-group">
							<label for="ceritaDonasi">Cerita Donasi</label>
							<textarea class="form-control richTextBox" id="ceritaDonasi" name="ceritaDonasi" placeholder="Tulis Cerita Donasi ..."></textarea>
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
								<label for="gambarDonasi">Gambar Donasi</label>
								<input type="file" class="form-control" id="gambarDonasi" name="gambarDonasi" placeholder="Gambar Donasi">
							</div>
							<div class="form-group">
								<label for="tanggalDonasi">Tanggal Buat</label>
								<input type="text" class="form-control datepicker" id="tanggalDonasi" name="tanggalDonasi" placeholder="Tanggal Buat">
							</div>
							<div class="form-group">
								<label for="tipeBatasWaktu">Tipe Batas Waktu</label>
								<select id="tipeBatasWaktu" name="tipeBatasWaktu" class="form-control">
									<option value="tanggal">Tanggal Berakhir</option>
									<option value="unlimited">Unlimited (Tanpa Batas Waktu)</option>
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
</script>
@endsection