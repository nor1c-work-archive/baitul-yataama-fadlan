@foreach($donatur as $value)
<div class="card-custom">
	<div class="row" style="margin:auto;">
		<div class="col-xs-3">
			<img class="img-circle" src="{{asset('images/donasi_avatar/'.$value->foto)}}" width="70px">
		</div>
		<div class="col-xs-9 px-3">
			<div class="card-block px-3">
				<h5>{{$value->nama}} - <b>{{"Rp ".number_format($value->jumlah_donasi,0,",",".")}}</b></h5>
				<span style="color:black;font-size: 10px;">{{date('d M Y',strtotime($value->tanggal))}}</span>
				<p class="card-text">{{$value->doa}}</p>
			</div>
		</div>
	</div>
</div>
@endforeach