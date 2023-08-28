@extends('voyager::master')
@section('page_title','Tambah Kabar Donasi')

@section('page_header')
<h1 class="page-title">
	<i class="icon voyager-news"></i>
	Tambah Kabar Donasi
</h1>
@include('voyager::multilingual.language-selector')
@stop

@section('css')
<style type="text/css">
	.div_donasi{
		height: 300px;
		max-height: 300px;
		overflow-y: scroll;
	}
</style>
@endsection
@section('content')
<div class="page-content container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Tambah Kabar Donasi</h3>
					<div class="panel-actions">
						<a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
					</div>
				</div>
				<div class="panel-body">
					<form action="{{route('donasi.kabar.save')}}" class="form-kabar-donasi" role="form" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
						<input type="hidden" name="id_donasi" value="{{$id_donasi}}">
						<input type="hidden" name="id_kabar_donasi" value="{{$id_kabar_donasi}}">
						<div class="form-group">
							<label for="subjectKabarDonasi">Subject (Judul)</label>
							<input type="text" class="form-control" id="subjectKabarDonasi" name="subjectKabarDonasi" placeholder="Subject (judul)">
						</div>
						<div class="form-group">
							<label for="tanggalKabarDonasi">Tanggal</label>
							<input type="text" class="form-control datepicker" id="tanggalKabarDonasi" name="tanggalKabarDonasi" placeholder="Tanggal">
						</div>
						<div class="form-group">
							<label for="tipeKabarDonasi">Tipe Kabar</label>
							<select id="tipeKabarDonasi" name="tipeKabarDonasi" class="form-control">
								<option value="penarikan_dana">Penarikan Dana</option>
								<option value="kabar_biasa">Kabar Biasa</option>
							</select>
						</div>
						<div class="form-group div-jumlah-penarikan">
							<label for="jumlahPenarikan">Jumlah Penarikan Donasi</label>
							<input type="text" class="form-control" id="jumlahPenarikan" name="jumlahPenarikan" placeholder="Jumlah Penarikan Dana">
						</div>
						<div class="form-group">
							<label for="ceritaDonasi">Isi Kabar</label>
							<textarea class="form-control richTextBox" id="isiKabarDonasi" name="isiKabarDonasi" placeholder="Tulis Kabar Donasi ..."></textarea>
						</div>

						<div class="form-group">
							<a href="{{route('donasi.detail_data',[$id_donasi])}}" class="btn btn-danger">Back to Donasi</a>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
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
	$("#tipeKabarDonasi").on('change',function(){
		var value = $(this).val();
		if(value != "penarikan_dana"){
			$(".div-jumlah-penarikan").css('visibility','hidden');
		}else{
			$(".div-jumlah-penarikan").css('visibility','visible');
		}
	});
</script>
@endsection
