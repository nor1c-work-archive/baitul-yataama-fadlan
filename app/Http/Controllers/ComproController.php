<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SliderGambar;
use App\TentangYayasan;
use App\ProgramYayasan;
use App\BeritaYayasan;
use App\CabangYayasan;
use DB;

class ComproController extends Controller
{
    //

	function home(){
		$data['slider'] = $this->getSlider();
		$data['tentang_yayasan'] = $this->getVisiMisi();
		$data['program_yayasan'] = $this->getProgramYayasan();
		$data['berita_yayasan'] = $this->getBeritaYayasan('urut');
		$data['summary_category'] = $this->getSummaryCategoriPost();
		$data['berita_yayasan_recent'] = $this->getBeritaYayasan('random');

		return view('home',$data);
	}

	function getSlider(){
    	//option1 = 'tampilkan'
		$slider = SliderGambar::where('status','option1')->get();
		return $slider;
	}

	function getVisiMisi(){
		$tentang = TentangYayasan::orderBy('id','desc')->first();
		return $tentang;
	}

	function getProgramYayasan(){
		$program = ProgramYayasan::orderBy('id','asc')->get();
		return $program;
	}

	function getBeritaYayasan($tipe){
		$berita = BeritaYayasan::leftJoin('categories','posts.category_id','=','categories.id')
		->select('posts.*','categories.name as name_categories')
		->orderBy('posts.id','desc')
		->limit(5)
		->where('posts.status','PUBLISHED');

		if($tipe == 'urut'){
			return $berita->get();
		}else{	
			return $berita->inRandomOrder()->get();
		}
	}

	function getSummaryCategoriPost(){
		$summary = BeritaYayasan::rightJoin('categories','posts.category_id','=','categories.id')
		->select(DB::raw('count(posts.id) as jumlah,categories.name as name_categories,categories.slug as slug'))
		->groupBy('categories.name','categories.slug')
		->get();
		return $summary;
	}

	function getCabangYayasan($tipe){
		if($tipe == 'utama'){
			$cabang = CabangYayasan::where('cabang_utama',1)->first();
			return $cabang;
		}else{
			$cabang = CabangYayasan::get();
			return $cabang;
		}
	}

	public static function getFooterFuction(){
		$compro = new ComproController();
		$data = array();
		$data['cabang'] = $compro->getCabangYayasan('utama');
		$data['profil'] = $compro->getVisiMisi();
		$data['program_menu'] = $compro->getProgramYayasan();

		return $data;
	}

    //tentang kami page
	function tentangKami(){
		$data = array();
		$data['tentang_yayasan'] = $this->getVisiMisi();
		$data['program_yayasan'] = $this->getProgramYayasan();

		return view('about',$data);
	}

	//program kami
	function programKami($slug){
		$program = ProgramYayasan::where('slug',$slug)->first();
		if(empty($program) || empty($slug)){
			return redirect()->route('home');
		}else{
			$berita = BeritaYayasan::leftJoin('categories','posts.category_id','=','categories.id')
						->select('posts.*','categories.name as name_categories')
						->where('categories.id',$program->id)
						->orderBy('posts.id','desc')
						->where('posts.status','PUBLISHED')
						->paginate(5);

			$data = array();
			$data['program'] = $program;
			$data['berita'] = $berita;
			$data['summary_category'] = $this->getSummaryCategoriPost();
			$data['berita_yayasan_recent'] = $this->getBeritaYayasan('random');
			return view('program',$data);
		}
	}

	//berita kabar
	function beritaKabar(){
		$data = array();
		$data['berita'] = BeritaYayasan::leftJoin('categories','posts.category_id','=','categories.id')
					->select('posts.*','categories.name as name_categories')
					->orderBy('posts.id','desc')
					->where('posts.status','PUBLISHED')
					->paginate(5);

		$data['summary_category'] = $this->getSummaryCategoriPost();
		$data['berita_yayasan_recent'] = $this->getBeritaYayasan('random');
		return view('berita',$data);
	}

	function detailBerita($slug){
		$data = array();
		$berita = BeritaYayasan::leftJoin('categories','posts.category_id','=','categories.id')
						->select('posts.*','categories.name as name_categories','categories.slug as slug_categories')
						->where('posts.slug',$slug)
						->first();

		if(empty($berita)){
			return redirect()->route('home');
		}else{
			$data['berita'] = $berita;
			$data['summary_category'] = $this->getSummaryCategoriPost();
			$data['berita_yayasan_recent'] = $this->getBeritaYayasan('random');
			return view('detail_berita',$data);
		}
	}

	//hubungi kami
	function hubungiKami(){
		return view('contact');
	}	
}
