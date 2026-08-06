<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Notice;
use App\Models\Gallery;
use App\Models\NoticeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\BaseController;
use App\Services\SchoolApiClient;
use App\Services\SchoolSassClient;
use Illuminate\Support\Facades\Response;

class Index extends Controller
{
	// e-sheba static info cards for the landing page + their detail pages
	private const E_SHEBA = [
		[
			'slug' => 'library',
			'name' => 'লাইব্রেরি',
			'icon' => 'library-outline',
			'description' => 'প্রতিষ্ঠানের লাইব্রেরিতে পাঠ্যবই, রেফারেন্স বই, ইসলামিক ও সাধারণ জ্ঞানভান্ডারের বিভিন্ন বই রয়েছে। শিক্ষার্থীরা নির্দিষ্ট সময়সূচি অনুযায়ী লাইব্রেরি ব্যবহার করে বই ধার নিতে ও পড়াশোনা করতে পারে।',
		],
		[
			'slug' => 'online-admission',
			'name' => 'অনলাইন ভর্তি',
			'icon' => 'person-add-outline',
			'description' => 'নতুন শিক্ষাবর্ষে ভর্তি ইচ্ছুক শিক্ষার্থীরা অনলাইনে আবেদন করতে পারবে। ভর্তি সংক্রান্ত প্রয়োজনীয় কাগজপত্র, যোগ্যতা ও সময়সূচি সংক্রান্ত তথ্য নোটিশ বোর্ডে প্রকাশ করা হয়।',
			'cta' => ['label' => 'নোটিশ দেখুন', 'route' => 'notice'],
		],
		[
			'slug' => 'teacher-list',
			'name' => 'শিক্ষক তালিকা',
			'icon' => 'people-outline',
			'description' => 'অভিজ্ঞ ও প্রশিক্ষণপ্রাপ্ত শিক্ষকমণ্ডলী শিক্ষার্থীদের শিক্ষাদানে নিয়োজিত। প্রতিষ্ঠানের সকল শিক্ষকের নাম, পদবি ও দায়িত্ব সম্পর্কে বিস্তারিত জানতে নিচের বাটনে ক্লিক করুন।',
			'cta' => ['label' => 'শিক্ষক তালিকা দেখুন', 'route' => 'faculty'],
		],
		[
			'slug' => 'result',
			'name' => 'ফলাফল',
			'icon' => 'bar-chart-outline',
			'description' => 'পরীক্ষার ফলাফল প্রকাশের পর শিক্ষার্থীরা তাদের নিজস্ব অ্যাকাউন্টে লগইন করে ফলাফল দেখতে পারবে। ফলাফল সংক্রান্ত যেকোনো সমস্যায় প্রতিষ্ঠানের কার্যালয়ে যোগাযোগ করুন।',
			'cta' => ['label' => 'লগইন করুন', 'url' => true],
		],
		[
			'slug' => 'e-hajira',
			'name' => 'ই-হাজিরা',
			'icon' => 'finger-print-outline',
			'description' => 'ডিজিটাল হাজিরা ব্যবস্থার মাধ্যমে শিক্ষার্থী ও শিক্ষকদের দৈনিক উপস্থিতি রেকর্ড করা হয়। অভিভাবকগণ তাদের সন্তানের উপস্থিতি সম্পর্কে এসএমএস-এর মাধ্যমে অবগত হতে পারেন।',
		],
		[
			'slug' => 'sms-service',
			'name' => 'এসএমএস সেবা',
			'icon' => 'chatbox-ellipses-outline',
			'description' => 'হাজিরা, ফলাফল ও গুরুত্বপূর্ণ নোটিশ সংক্রান্ত তথ্য সরাসরি অভিভাবকদের মোবাইলে এসএমএস-এর মাধ্যমে পাঠানো হয়, যাতে তারা সন্তানের সার্বিক অবস্থা সম্পর্কে সবসময় অবগত থাকেন।',
		],
		[
			'slug' => 'academic-calendar',
			'name' => 'একাডেমিক ক্যালেন্ডার',
			'icon' => 'calendar-outline',
			'description' => 'শিক্ষাবর্ষের ছুটির দিন, পরীক্ষার সময়সূচি, ভর্তি কার্যক্রম ও গুরুত্বপূর্ণ অনুষ্ঠানের তারিখসমূহ একাডেমিক ক্যালেন্ডারে উল্লেখ থাকে। হালনাগাদ তথ্যের জন্য নোটিশ বোর্ড নিয়মিত দেখুন।',
			'cta' => ['label' => 'নোটিশ দেখুন', 'route' => 'notice'],
		],
	];

	// private $commonData;
	protected $apiService;

	public function __construct(SchoolApiClient $apiService)
	{
		$this->apiService = $apiService;
	}

	public function eSheba(string $slug)
	{
		$item = collect(self::E_SHEBA)->firstWhere('slug', $slug);

		if (!$item) {
			return redirect()->route('home')->with('error', 'Content not found');
		}

		$item = (object) $item;

		return view('frontend.e_sheba_details', compact('item'));
	}

	public function index()
	{
		$data = $this->apiService->request('home');
		$eShebaCards = collect(self::E_SHEBA)->map(fn($e) => (object) $e);

		$managements = collect(json_decode(json_encode(app(SchoolSassClient::class)->management())))
			->map(fn($m) => (object) [
				'name' => $m->name ?? '',
				'position' => $m->designation ?? '',
				'designation' => $m->designation ?? '',
				'image' => $m->image ?? null,
				'details' => $m->details ?? '',
			]);

		$teachers = collect(json_decode(json_encode(app(SchoolSassClient::class)->teachers())))
			->map(fn($t) => (object) [
				'name' => $t->name ?? '',
				'position' => $t->designation->name ?? '',
				'designation' => $t->designation->name ?? '',
				'image' => $t->image ?? null,
			]);

		$videoGalleries = collect(app(SchoolSassClient::class)->videoGallery())
			->take(8)
			->map(fn($v) => (object) $v);

		return view('frontend.home', [
			'banners' => $data->banners ?? [],
			'allNotices' => $data->notices ?? [],
			'noticetypes' => $data->notice_types ?? [],
			'photoGalleries' => collect($data->photo_gallery ?? []),
			'faculties' => collect($data->faculty ?? []),
			'managements' => $managements,
			'teachers' => $teachers,
			'videoGalleries' => $videoGalleries,
			'stats' => $data->stats ?? (object) [],
			'schoolClasses' => $data->classes ?? [],
			'eShebaCards' => $eShebaCards,
		]);
	}

	public function contents($slug, $slug2 = null)
	{
		try {

			$uri = $slug2 ? "{$slug}/{$slug2}" : $slug;

			$response = $this->apiService->request("contents/{$uri}");

			if (empty($response->status) || !$response->status || empty($response->content)) {
				return view('frontend.article', [
					'articles' => null
				]);
			}

			$articles = (object) $response->content;

			return view('frontend.article', compact('articles'));
		} catch (\Throwable $e) {

			return view('frontend.article', [
				'articles' => null
			]);
		}
	}


	public function photos(Request $req)
	{
		$photos = $this->apiService->request('photo-gallery');

		return view('frontend.photos', compact('photos'));
	}



	public function videos(Request $req)
	{
		$videos = collect(app(SchoolSassClient::class)->videoGallery())->map(fn($v) => (object) $v);

		return view('frontend.videos', compact('videos'));
	}


	public function messages($id)
	{
		$record = collect(app(SchoolSassClient::class)->management())->firstWhere('id', (int) $id);
		$messages = $record ? (object) $record : null;

		return view('frontend.message_details', compact('messages'));
	}

	public function notice()
	{
		$all = collect(app(SchoolSassClient::class)->notices())->sortByDesc('id')->values()->map(fn($n) => (object) $n);
		$perPage = 50;
		$page = (int) request()->get('page', 1);
		$notices = new \Illuminate\Pagination\LengthAwarePaginator(
			$all->forPage($page, $perPage),
			$all->count(),
			$perPage,
			$page,
			['path' => request()->url(), 'query' => request()->query()]
		);

		return view('frontend.notice', compact('notices'));
	}
	public function notice_details($id)
	{
		$all = collect(app(SchoolSassClient::class)->notices())->map(fn($n) => (object) $n);
		$notices = $all->firstWhere('id', (int) $id);

		if (!$notices) {
			abort(404);
		}

		$relnotices = $all;

		return view('frontend.notice_details', compact('notices', 'relnotices'));
	}

	public function management(Request $req)
	{
		$managements = collect(app(SchoolSassClient::class)->management())->map(fn($m) => (object) $m);

		return view('frontend.management', compact('managements'));
	}

	public function faculty(Request $req)
	{
		$faculties = collect(app(SchoolSassClient::class)->faculty())
			->sortBy('sequence')
			->values()
			->map(fn($f) => (object) $f);

		return view('frontend.faculty', compact('faculties'));
	}

	public function employee(Request $req)
	{
		$allemployee = collect(json_decode(json_encode(app(SchoolSassClient::class)->teachers())))
			->map(fn($t) => (object) [
				'id' => $t->id ?? null,
				'name' => $t->name ?? '',
				'designation' => $t->designation->name ?? '',
				'image' => $t->image ?? null,
				'mobile' => $t->mobile ?? '',
				'email' => $t->email ?? '',
			]);

		return view('frontend.employee', compact('allemployee'));
	}
	public function employee_details($id)
	{
		$employee = collect(json_decode(json_encode(app(SchoolSassClient::class)->teachers())))
			->map(fn($t) => (object) [
				'id' => $t->id ?? null,
				'name' => $t->name ?? '',
				'designation' => $t->designation->name ?? '',
				'image' => $t->image ?? null,
				'bio' => $t->bio ?? '',
			])
			->firstWhere('id', (int) $id);

		return view('frontend.employee_details', compact('employee'));
	}


	public function getDownload($name, $files)
	{
		$file = "uploads/report/" . $files;
		$headers = array('Content-Type: application/pdf');
		return Response::download($file, $files, $headers);
	}




	public function results()
	{
		return view('frontend.results');
	}

	public function admissionInfo()
	{
		return view('frontend.admission_info');
	}
}
