@extends('template.base')
@section('title',$data_donasi->subject)
@section('meta-title',$data_donasi->subject)
@section('meta-description',$data_donasi->cerita)
@section('meta-keywords','Donasi, Amal, Kaum Duafa, Yayasan, Hubungi Yayasan, Yatim, Baitul Yataama Fadlan')
@section('userStyle')
<style type="text/css">
	/* HIDE RADIO */
[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + img {
  outline: 2px solid #28a745;
}
</style>
@endsection
@section('content')
<div class="row">
	<div class="col-md-4 offset-md-4">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-2">
						<a href="{{route('donasi.konsumen.detail',[$data_donasi->key])}}" class="btn btn-default"><i class="ti ti-arrow-left"></i></a>
					</div>
					<div class="col-sm-10">
						<label style="font-weight: bold;font-size: 16px; margin-top: 5px;">Isi Informasi Donasi</label>
					</div>
				</div>
				<hr/>
				<div class="row" style="margin-top: 20px;">
					<div class="col-md-12">
						<div class="form-group">
							<label for="nominalDonasi">Nominal Donasi</label>
							<input type="text" class="form-control money" id="nominalDonasi" name="nominalDonasi" aria-describedby="nominalHelp" placeholder="Masukan Nominal Donasi">
							<small id="nominalHelp" class="form-text text-muted">Minimal nominal donasi adalah Rp 1.000</small>
						</div>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" class="form-control" id="namaDonatur" name="namaDonatur" aria-describedby="namaDonatur" placeholder="Nama Donatur">
							<small id="namaDonatur" class="form-text text-muted">Masukan nama lengkap anda atau nama panggilan</small>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="namaDonatur" name="noTelponDonatur" aria-describedby="noTelponDonatur" placeholder="No Telepon">
							<small id="noTelponDonatur" class="form-text text-muted">Masukan no telepon anda</small>
						</div>
						<div class="form-group">
							@php
								$file_character_a = asset('images/donasi_avatar/character_a.png');
								$file_character_b = asset('images/donasi_avatar/character_b.png');
								$file_character_c = asset('images/donasi_avatar/character_c.png');
								$file_character_d = asset('images/donasi_avatar/character_d.png');
								$file_character_e = asset('images/donasi_avatar/character_e.png');
								$file_character_f = asset('images/donasi_avatar/character_f.png');
								$file_character_g = asset('images/donasi_avatar/character_g.png');
								$file_character_h = asset('images/donasi_avatar/character_h.png');
								$file_character_i = asset('images/donasi_avatar/character_i.png');
							@endphp
							<label>
							  <input type="radio" name="radioAvatarDonasi" value="character_a.png" checked>
							  <img src="{{$file_character_a}}" style="width: 40px;">
							</label>

							<label>
							  <input type="radio" name="radioAvatarDonasi" value="character_b.png">
							  <img src="{{$file_character_b}}" style="width: 40px;">
							</label>

							<label>
							  <input type="radio" name="radioAvatarDonasi" value="character_c.png">
							  <img src="{{$file_character_c}}" style="width: 40px;">
							</label>

							<label>
							  <input type="radio" name="radioAvatarDonasi" value="character_d.png">
							  <img src="{{$file_character_d}}" style="width: 40px;">
							</label>

							<label>
							  <input type="radio" name="radioAvatarDonasi" value="character_e.png">
							  <img src="{{$file_character_e}}" style="width: 40px;">
							</label>

							<label>
							  <input type="radio" name="radioAvatarDonasi" value="character_f.png">
							  <img src="{{$file_character_f}}" style="width: 40px;">
							</label>

							<label>
							  <input type="radio" name="radioAvatarDonasi" value="character_g.png">
							  <img src="{{$file_character_g}}" style="width: 40px;">
							</label>

							<label>
							  <input type="radio" name="radioAvatarDonasi" value="character_h.png">
							  <img src="{{$file_character_h}}" style="width: 40px;">
							</label>

							<label>
							  <input type="radio" name="radioAvatarDonasi" value="character_i.png">
							  <img src="{{$file_character_i}}" style="width: 40px;">
							</label>
							<small id="selectAvatar" class="form-text text-muted">Pilih Avatar/Icon Anda</small>
						</div>
	
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="checkAnonimDonatur" id="checkAnonimDonatur" value="anonim">
								<label class="form-check-label" for="checkAnonimDonatur">
									Sembunyikan Nama Saya (tampilkan sebagai Anonim) 
								</label>
							</div>
						</div>
						<div class="form-group">
							<textarea class="form-control" id="doaDonatur" name="doaDonatur" placeholder="Beri doa, dukungan anda disini"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<a href="javascript:void(0)" class="btn btn-success btn-donasi" onclick="submit_donasi();" style="width:100%;">Kirim Donasi Sekarang</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('userScript')
<script src="{{asset('jquery-mask/dist/jquery.mask.min.js')}}"></script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-LMU1MaatFJNYSpLv"></script> 
<script type="text/javascript">
	$(document).ready(function(){
		$('.money').mask('000.000.000.000.000', {reverse: true});
	});

	function submit_donasi(){
		var nominalDonasi = $("[name='nominalDonasi']").val();
		var namaDonatur = $("[name='namaDonatur']").val();
		var noTelponDonatur = $("[name='noTelponDonatur']").val();
		var checkAnonimDonatur = document.getElementById("checkAnonimDonatur");
		var doaDonatur = $("[name='doaDonatur']").val();
		var anonimString;
		var avatarDonatur = $("[name='radioAvatarDonasi']:checked").val();

		if (checkAnonimDonatur.checked == true){
			anonimString = "true";
		} else {
			anonimString = "false";
		}

		var data = {_token:'{{csrf_token()}}',nominal:nominalDonasi,donatur:namaDonatur,no_telpon:noTelponDonatur,doa_donatur:doaDonatur,anonim:anonimString,key_donasi:'{{$data_donasi->key}}',avatarDonatur:avatarDonatur};
		$.ajax({
			url: '{{route('donasi.submitdonasi')}}',
			type: "POST",
			data : data,
			dataType : "JSON",
			success : function(data){
				if(data.status == "success"){
					console.log("success");
					snap.pay(data.token_transaction);
				}else{
					console.log("failed");
				}
			}
		});


	}
</script>
@endsection