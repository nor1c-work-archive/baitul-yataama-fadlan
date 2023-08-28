@foreach($donatur as $value)
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