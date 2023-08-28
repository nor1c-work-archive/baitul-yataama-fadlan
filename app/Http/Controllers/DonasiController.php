<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataDonasi;
use App\DataDonatur;
use App\DataKabarDonasi;
use Illuminate\Support\Facades\Auth;
use DB;

class DonasiController extends Controller
{	

    function index(){
    	$data['donasi'] = DataDonasi::leftJoin('tbl_donatur', 'tbl_donasi.id', '=', 'tbl_donatur.id_donasi')
     ->select('tbl_donasi.*',DB::raw('COUNT(tbl_donatur.id) as jumlah_donatur'))
     ->orderBy('tbl_donasi.id','desc')
     ->groupBy('tbl_donasi.id','tbl_donasi.subject','tbl_donasi.gambar','tbl_donasi.tanggal','tbl_donasi.tanggal_berakhir','tbl_donasi.tipe_batas_waktu','tbl_donasi.target_dana','tbl_donasi.dana_masuk','tbl_donasi.cerita','tbl_donasi.status','tbl_donasi.key')
     ->get();

     return view('donasi.index',$data);
 }

 function buatDonasi(){
     return view('donasi.buat_donasi');
 }

 function simpanDonasi(Request $request){
     $id_donasi = $request->id_donasi;
     $subject_donasi = $request->subjectDonasi;
     $target_nominal = $request->targetNominal;
     $cerita_donasi = $request->ceritaDonasi;
     $tanggal_donasi = $request->tanggalDonasi;
     $tipe_batas_waktu = $request->tipeBatasWaktu;
     $tanggal_berakhir = $request->tanggalBerakhir;
     $status = 'berjalan';

    	//create nama image
     $uploadName = $request->gambarDonasi == null ? null : sprintf("%s.%s", date('Ymdhis'), $request->gambarDonasi->getClientOriginalExtension());
     $pictureName = $uploadName == null ? '' : $uploadName;

     if (!empty($pictureName)){
         $request->gambarDonasi->move(storage_path('app/public/donasi_file'), $pictureName);
         $data = array(
          'subject' => $subject_donasi,
          'key' => $this->generateRandomKeyDonasi(10),
          'gambar' => $pictureName,
          'tanggal' => date('Y-m-d H:i:s',strtotime($tanggal_donasi)),
          'tanggal_berakhir' => date('Y-m-d H:i:s',strtotime($tanggal_berakhir)),
          'tipe_batas_waktu' => $tipe_batas_waktu,
          'target_dana' => preg_replace("/[^0-9]/", '', $target_nominal),
          'cerita' => $cerita_donasi,
          'status' => $status,
      );
     }else{
      $data = array(
          'subject' => $subject_donasi,
          'key' => $this->generateRandomKeyDonasi(10),
          'tanggal' => date('Y-m-d H:i:s',strtotime($tanggal_donasi)),
          'tanggal_berakhir' => date('Y-m-d H:i:s',strtotime($tanggal_berakhir)),
          'tipe_batas_waktu' => $tipe_batas_waktu,
          'target_dana' => preg_replace("/[^0-9]/", '', $target_nominal),
          'cerita' => $cerita_donasi,
          'status' => $status,
      );
  } 

  if(!empty($id_donasi)){
    $update = DataDonasi::where('id',$id_donasi)->update($data);
    if($update){
       return redirect()->route('donasi.detail_data',[$id_donasi]);
    }else{
         return redirect()->route('donasi.detail_data',[$id_donasi]);
    }
}else{
    $data['dana_masuk'] = 0;
    $insert = DataDonasi::insert($data);
    if($insert){
      return redirect()->route('donasi.index');
    }else{
        return redirect()->route('donasi.index');
    }
}

}

function detailDonasi(Request $request,$id){
    $donatur = DataDonatur::where('id_donasi',$id)->where('status','berhasil')->orderBy('id','desc')->paginate(3);
    if ($request->ajax()) {
        $view = view('donasi.component_scroll_donatur',compact('donatur'))->render();
        return response()->json(['html'=>$view]);
    }

    if(empty($id)){
        return redirect()->route('donasi.index');
    }else{
        $data_donasi = DataDonasi::where('id',$id);
        if($data_donasi->count() > 0){
            $data['data_donasi'] = $data_donasi->first();
            $data['data_donatur'] = $donatur;
            $data['data_kabar_donasi'] = DataKabarDonasi::where('id_donasi',$id)->orderBy('id','desc')->get();

            return view('donasi.detail_donasi',$data);
        }else{
            return redirect()->route('donasi.index');
        }
    }
}

function editDonasi($id){
    if(empty($id)){
        return redirect()->route('donasi.index');
    }else{
        $data_donasi = DataDonasi::where('id',$id);
        if($data_donasi->count() > 0){
            $data['data_donasi'] = $data_donasi->first();
            return view('donasi.edit_donasi',$data);
        }else{
            return redirect()->route('donasi.index');
        }
    }
}

function nonaktifDonasi($id,$status){
    $ubah = DataDonasi::where('id',$id)->update(array('status' => $status));
    if($ubah){
        return redirect()->route('donasi.index');
    }
}

// ---------- Kabar Donasi ----------

function tambahKabarDonasi($id_donasi){
    $data['id_donasi'] = $id_donasi;
    $data['id_kabar_donasi'] = 0;
    return view('donasi/tambah_kabar_donasi',$data);
}

function ubahKabarDonasi($id_donasi,$id_kabar_donasi){
    $data['id_donasi'] = $id_donasi;
    $data['id_kabar_donasi'] = $id_kabar_donasi;
    $data['kabar_donasi'] = DataKabarDonasi::where('id',$id_kabar_donasi)->first();
    return view('donasi/ubah_kabar_donasi',$data);
}

function generateRandomKeyDonasi($n) { 
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 

function simpanKabarDonasi(Request $request){
      $id_donasi = $request->id_donasi;
      $id_kabar_donasi = $request->id_kabar_donasi;
      $subject_kabar_donasi = $request->subjectKabarDonasi;
      $tanggal_kabar_donasi = $request->tanggalKabarDonasi;
      $tipe_kabar_donasi = $request->tipeKabarDonasi;

      if($tipe_kabar_donasi == "kabar_biasa"){
          $jumlah_penarikan = 0;
      }else{
          $jumlah_penarikan = $request->jumlahPenarikan;
      }

      $isi_kabar_donasi = $request->isiKabarDonasi;

      if($id_kabar_donasi == 0){
          $data = array(
              'id_donasi' => $id_donasi,
              'subject' => $subject_kabar_donasi,
              'tanggal' => date('Y-m-d H:i:s',strtotime($tanggal_kabar_donasi)),
              'tipe_kabar' => $tipe_kabar_donasi,
              'jumlah_penarikan' => preg_replace("/[^0-9]/", '', $jumlah_penarikan),
              'isi' => $isi_kabar_donasi,
              'status' => 'tampilkan'
          );
          $insert = DataKabarDonasi::insert($data);
          return redirect()->route('donasi.detail_data',[$id_donasi]);
      }else{
          $data = array(
              'id_donasi' => $id_donasi,
              'subject' => $subject_kabar_donasi,
              'tipe_kabar' => $tipe_kabar_donasi,
              'jumlah_penarikan' => preg_replace("/[^0-9]/", '', $jumlah_penarikan),
              'isi' => $isi_kabar_donasi,
              'status' => 'tampilkan'
          );
          $update = DataKabarDonasi::where('id',$id_kabar_donasi)->update($data);
          return redirect()->route('donasi.detail_data',[$id_donasi]);
      }
  }

  function donasiKonsumen(){
    $data_donasi = DataDonasi::where('status','berjalan')
                  ->orderBy('id','desc');
    $data['data_donasi'] = $data_donasi->paginate(6);
    $data['count_donasi'] = $data_donasi->count();
    $data['count_donatur'] = DataDonatur::count();
    $data['sum_dana'] = $data_donasi->get()->sum('dana_masuk');

    return view('donasi_konsumen.index',$data);
  }

  function donasiKonsumenDetail(Request $request,$key){
    $donasi_data = DataDonasi::where('key',$key)->first();
    $donatur = DataDonatur::where('id_donasi',$donasi_data->id)->where('status','berhasil')->orderBy('id','desc')->paginate(10);
    if ($request->ajax()) {
        $view = view('donasi_konsumen.component_scroll_donatur',compact('donatur'))->render();
        return response()->json(['html'=>$view]);
    }

    if(empty($key)){
        return redirect()->route('donasi.konsumen');
    }else{
        if($donasi_data->count() > 0){
            $data['data_donasi'] = $donasi_data;
            $data['data_donatur'] = $donatur;
            $data['data_kabar_donasi'] = DataKabarDonasi::where('id_donasi',$donasi_data->id)->orderBy('id','desc')->get();

            return view('donasi_konsumen.detail_donasi',$data);
        }else{
            return redirect()->route('donasi.konsumen');
        }
    }
  }

  function buatDonasiKonsumen($key){
    $data['data_donasi'] = DataDonasi::where('key',$key)->first();

    return view('donasi_konsumen.buat_donasi',$data);
  }


  //--------- payment gateway ------------

  function submitDonasi(Request $request){
    $nominal = preg_replace("/[^0-9]/","",$request->nominal);
    $donatur = $request->donatur;
    $no_telpon = $request->no_telpon; 
    $doa_donatur = $request->doa_donatur;
    $anonim = $request->anonim;
    $key_donasi = $request->key_donasi;
    $order_id = rand();
    $avatar_donatur = $request->avatarDonatur;

    $data_donasi = DataDonasi::where('key',$key_donasi)->first();

    $data = array(
      'id_donasi' => $data_donasi->id,
      'nama' => $donatur,
      'no_telpon' => $no_telpon,
      'jumlah_donasi' => $nominal,
      'doa' => $doa_donatur,
      'foto' => $avatar_donatur,
      'tanggal' => date('Y-m-d H:i:s'),
      'metode' => 'null',
      'status' => 'pending',
      'anonim' => $anonim,
      'order_id' => $order_id
    );

    $insert = DataDonatur::insert($data);
    if($insert){
        \Midtrans\Config::$serverKey = "SB-Mid-server-c4BtMQBEUVC6QKDs0KzPvtyU";
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $transaction = array(
          'transaction_details' => array(
              'order_id' => $order_id,
              'gross_amount' => $nominal
          ),
          'callbacks' => array(
            'finish' => 'https://baitulyataamafadlan.org/web/donasi/result/callback',
            'error' => 'https://baitulyataamafadlan.org/web/donasi/result/callback'
          ),
          "gopay" => array(
            "enable_callback" => true,
            "callback_url" => "https://baitulyataamafadlan.org/web/donasi/result/callback"
          )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($transaction);

        return json_encode(array('status' => 'success','token_transaction' => $snapToken));
    }else{
        return json_encode(array('status' => 'failed'));
    }
  }

  function donasiCallback(){
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$serverKey = 'SB-Mid-server-c4BtMQBEUVC6QKDs0KzPvtyU';

    $order = $_GET['order_id'];
    $notif = \Midtrans\Transaction::status($order);

    $transaction = $notif->transaction_status;
    $type = $notif->payment_type;
    $order_id = $notif->order_id;
    $fraud = $notif->fraud_status;

    if($transaction == "settlement" || $transaction == "capture"){
      if($type == 'credit_card'){
        if($fraud != 'challenge'){
          $donatur_detail = DataDonasi::join('tbl_donatur','tbl_donatur.id_donasi','=','tbl_donasi.id')
                                    ->select('tbl_donasi.key as key','tbl_donasi.dana_masuk as dana_masuk')
                                    ->where('tbl_donatur.order_id',$order_id)->first();

          $dana_masuk = (int)$donatur_detail->dana_masuk+intval($notif->gross_amount);
          $update_dana_masuk = DataDonasi::where('key',$donatur_detail->key)->update(array('dana_masuk' => $dana_masuk));
          $data = array(
            'payment_status' => $transaction,
            'metode' => $type,
            'status' => 'berhasil'
          );
        }
      }else{
        $donatur_detail = DataDonasi::join('tbl_donatur','tbl_donatur.id_donasi','=','tbl_donasi.id')
                                    ->select('tbl_donasi.key as key','tbl_donasi.dana_masuk as dana_masuk')
                                    ->where('tbl_donatur.order_id',$order_id)->first();

          $dana_masuk = (int)$donatur_detail->dana_masuk+intval($notif->gross_amount);
          $update_dana_masuk = DataDonasi::where('key',$donatur_detail->key)->update(array('dana_masuk' => $dana_masuk));

        $data = array(
          'payment_status' => $transaction,
          'metode' => $type,
          'status' => 'berhasil'
        );
      }
    }else{
      $data = array(
        'payment_status' => $transaction,
        'metode' => $type,
        'status' => 'gagal'
      );
    }

    $update = DataDonatur::where('order_id',$order_id)->update($data);
    if($update){
      $donatur_detail = DataDonasi::join('tbl_donatur','tbl_donatur.id_donasi','=','tbl_donasi.id')
                                    ->select('tbl_donasi.key as key')
                                    ->where('tbl_donatur.order_id',$order_id)->first();
      return redirect()->route('donasi.konsumen.detail',[$donatur_detail->key]);
    }else{
      $donatur_detail = DataDonasi::join('tbl_donatur','tbl_donatur.id_donasi','=','tbl_donasi.id')
                                    ->select('tbl_donasi.key as key')
                                    ->where('tbl_donatur.order_id',$order_id)->first();
      return redirect()->route('donasi.konsumen.detail',[$donatur_detail->key]);
    }
  }
}
