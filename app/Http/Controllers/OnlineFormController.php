<?php

namespace App\Http\Controllers;

use App\Services\SchoolApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OnlineFormController extends BaseController
{
    protected SchoolApiClient $apiService;

    public function __construct(SchoolApiClient $apiService)
    {
        $this->apiService = $apiService;
    }

    public function show()
    {
        return view('frontend.online_form');
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_name'          => 'required|string|max:255',
            'date_of_birth'         => 'required|date',
            'gender'                => 'required|in:Male,Female',
            'applying_for_class'    => 'required|string|max:100',
            'blood_group'           => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'religion'              => 'nullable|string|max:100',
            'nationality'           => 'nullable|string|max:100',
            'birth_certificate_no'  => 'nullable|string|max:100',
            'father_name'           => 'nullable|string|max:255',
            'father_phone'          => 'nullable|string|max:20',
            'father_nid'            => 'nullable|string|max:50',
            'father_occupation'     => 'nullable|string|max:100',
            'mother_name'           => 'nullable|string|max:255',
            'mother_phone'          => 'nullable|string|max:20',
            'mother_nid'            => 'nullable|string|max:50',
            'mother_occupation'     => 'nullable|string|max:100',
            'guardian_name'         => 'nullable|string|max:255',
            'guardian_phone'        => 'nullable|string|max:20',
            'guardian_relation'     => 'nullable|string|max:50',
            'previous_school_name'  => 'nullable|string|max:255',
            'previous_class'        => 'nullable|string|max:100',
            'previous_result'       => 'nullable|string|max:100',
            'previous_passing_year' => 'nullable|integer',
            'present_address'       => 'nullable|string',
            'permanent_address'     => 'nullable|string',
            'remarks'               => 'nullable|string',
            'photo'                 => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fields = $validator->validated();
        unset($fields['photo']);

        $result = $this->apiService->preAdmission(
            $fields,
            $request->file('photo')
        );

        if (!$result['success']) {
            return redirect()->back()
                ->withInput()
                ->with('error', $result['message'] ?? 'আবেদন জমা দেওয়া যায়নি। পরে আবার চেষ্টা করুন।');
        }

        return redirect()->route('online-form')->with('success', 'আবেদন সফলভাবে জমা হয়েছে।');
    }
}
