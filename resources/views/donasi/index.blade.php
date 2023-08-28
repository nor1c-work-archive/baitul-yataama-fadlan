@extends('voyager::master')
@section('page_title','Donasi')

@section('page_header')
<h1 class="page-title">
	<i class="icon voyager-diamond"></i>
	Donasi <a href="{{route('donasi.buat_donasi')}}" class="btn btn-success">Buat Donasi Baru <i class="glyphicon glyphicon-plus"></i></a>
</h1>
@include('voyager::multilingual.language-selector')
@stop

@section('content')
<div class="page-content container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-bordered">
				<div class="panel-body">
					<div class="table-responsive">
						<table id="dataTable" class="table table-hover">
							<thead>
								<tr>
									<th>Judul</th>
									<th>Tanggal Berakhir</th>
									<th>Target Dana</th>
									<th>Dana Terkumpul</th>
									<th>Donatur</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($donasi as $value)
								<tr>
									<td>
										{{$value->subject}}
									</td>
									<td>
										@if($value->tipe_batas_waktu == "unlimited")
											<img src="{{asset('images/infinity.png')}}" width="20px"> Unlimited
										@else
											{{date('d-M-Y H:i:s',strtotime($value->tanggal_berakhir))}}
										@endif
									</td>
									<td>
										{{"Rp ".number_format($value->target_dana,0,",",".")}}
									</td>
									<td>
										<b><i>{{"Rp ".number_format($value->dana_masuk,0,",",".")}}</i></b>
									</td>
									<td>
										{{$value->jumlah_donatur}} Donatur
									</td>
									<td>
										@if($value->status == "berjalan")
											<span class="badge badge-success">Sedang Berjalan</span>
										@elseif($value->status == "selesai")
											<span class="badge badge-primary">Donasi Selesai</span>
										@elseif($value->status == "nonaktif")
											<span class="badge badge-danger">Nonaktif</span>
										@endif
									</td>
									<td>
										<a href="{{route('donasi.detail_data',[$value->id])}}" class="btn btn-primary">Lihat Detail</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
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
	});
</script>
@endsection