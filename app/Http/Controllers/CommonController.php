<?php

namespace App\Http\Controllers;

use DB;
use Redirect;
use Validator;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Employee;

class CommonController extends Controller
{
	public function deletedata(Request $req)
	{
		$id = $req->id;
		$deletetype = $req->deletetype;
		$deleteimage = $req->deleteimage;
		$tablename = $req->tablename;

		if ($deletetype == 'single') {
			//$menuItem = Administration::find($id)->delete();
			DB::table($tablename)->where('id', $id)->delete();
		} elseif ($deletetype == 'multiple') {
			//$menuItem = Administration::whereIn('id', $id)->delete();
			DB::table($tablename)->whereIn('id', $id)->delete();
		}
		return $id;
	}


	public function permissions(Request $req)
	{
		$approve_val = $req->approve_val;
		$valuearray = explode(',', $approve_val);
		//dd($valuearray);
		$tablename = $req->tablename;
		$status = $req->status;

		$arrayuval =  array(
			'status' => $status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

		return Redirect::back();
	}
	public function adminPermissions(Request $req)
	{
		$approve_val = $req->approve_val;
		$valuearray = explode(',', $approve_val);
		//dd($valuearray);
		$tablename = $req->tablename;
		$status = $req->status;

		$arrayuval =  array(
			'active' => $status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

		return Redirect::back();
	}



	public function changestatus(Request $req)
	{
		$approve_val = $req->approve_val;
		$valuearray = explode(',', $approve_val);
		$tablename = $req->tablename;
		$status = $req->status;

		$arrayuval =  array(
			'member_type' => $status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

		return Redirect::back();
	}


	public function updateSlug(Request $req)
	{
		//////////////// Update Slug /////////////////

		/*$allDatas = DB::table('hospitals')->whereNull('email')->get();
		$i=0;
		foreach($allDatas as $datas){
			$i++;
			$makeemail = 'bd-icu'.$i.'@bd-icu.com';
			//echo $makeemail;
			//$arrayvals = array('email'=>$makeemail);
			$arrayvals = array('email'=>$makeemail);
			DB::table('hospitals')->where('id', $datas->id)->update($arrayvals);
			DB::table('hospital_users')->where('hospital_id', $datas->id)->update($arrayvals);
		}*/

		/*$allDatas = DB::table('icutypes')->get();
		$i=0;
		foreach($allDatas as $datas){
			$i++;
			$icuvals = array('icutype_val'=>$datas->name);
			$bedyvals = array('bedtype_val'=>$datas->name);
			
			DB::table('icu_reports')->where('icutype', $datas->id)->update($icuvals);
			DB::table('bed_reports')->where('bedtype', $datas->id)->update($bedyvals);
		}*/

		$getDatas = DB::table('news_events')->get();
		foreach ($getDatas as $gData) {
			$expval = explode(' ', $gData->name);
			$impval = implode('-', $expval);
			$slug   = str_replace([',', "'", '"', '/', '|', '.', '`'], '', $impval);

			$menuUpdate = array(
				'url' => strtolower($slug),
				'updated_at' => date('Y-m-d H:i:s')
			);

			DB::table('news_events')->where('id', $gData->id)->update($menuUpdate);
		}

		/*$allDatas = DB::table('divisions')->get();
		$i=0;
		foreach($allDatas as $datas){
			$i++;
			$icuvals = array('division_id'=>$datas->name);
			
			DB::table('icu_reports')->where('division_id', $datas->id)->update($icuvals);
			DB::table('bed_reports')->where('division_id', $datas->id)->update($icuvals);
		}*/
	}

	/*public function updateSlug()
	{
		$getDatas = DB::table('gift_card_groups')->get();		
		foreach($getDatas as $gData){
			$expval=explode(' ',$gData->name);
			$impval=implode('-',$expval);
			$slug   = str_replace([',', "'",'"', '/','|','.','`'],'' , $impval);
			
			 $menuUpdate = array(
				'slug'=> $slug
				'updated_at'=> date('Y-m-d H:i:s')
			 );
	
			DB::table('gift_card_groups')->where('id',$gData->id)->update($menuUpdate);		
		}
	}*/






	public function sampleFileDownload(Request $request)
	{
		$getFile = $request->filename . '.csv';
		$filePath = public_path("samplefiles/" . $getFile);
		$headers = ['Content-Type: application/csv'];
		return response()->download($filePath, $getFile, $headers);
	}


	public function import(Request $req)
	{
		if ($req->hasFile('importfile')) {
			$validator = Validator::make(
				[
					'file'      => $req->importfile,
					'extension' => strtolower($req->importfile->getClientOriginalExtension()),
				],
				[
					'file'          => 'required',
					'extension'      => 'required|in:csv,xlsx,xls',
				]
			);

			$file = $req->file('importfile');

			$file->move(public_path('import-directory'), $file->getClientOriginalName());


			$files = $file->getClientOriginalName();

			$filename = pathinfo($files, PATHINFO_FILENAME);
			$extension = pathinfo($files, PATHINFO_EXTENSION);
			$importfiles = $filename . '.' . $extension;
			if ($extension == 'csv' || $extension == 'xlsx' || $extension == 'xls') {

				$path = public_path('import-directory') . '/' . $importfiles;
				if ($req->filename == 'employee') {
					(new FastExcel)->import($path, function ($line) {
						Employee::create([
							'institute_name' => $line['Institute Name'],
							'propitor_name' => $line['Owner Name'],
							'fname' => $line['Father Name'],
							'address' => $line['Address'],
							'shop_type' => $line['Shop Type'],
							'mobileno' => $line['Mobile'],
							'budget' => $line['Budget'],
							'assigned' => $line['Amount of tax'],
							'budget_year' => $line['Tax Year']
						]);
					});
				}

				return redirect()->back();
			} else {
				return redirect()->back()->with('error', 'Please select excel or csv file only');
			}
		} else {
			return redirect()->back()->with('error', 'Please select excel file');
		}
	}


	public function getRelationalData(Request $req)
	{
		$value = $req->value;
		$column = $req->column;
		$table = $req->table;
		$placement = $req->placement;
		$query = DB::table($table)->where($column, $value)->get();

		$str = '<select class="form-control" name="' . $placement . '_id" id="' . $placement . '_id" required>';
		foreach ($query as $row) {
			$str .= '<option value="' . $row->id . '">' . $row->name . '</option>';
		}
		$str .= '</select>';
		return $str;
	}

}
