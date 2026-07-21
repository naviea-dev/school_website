<?php
// config/certificates.php

use App\Models\AgeStipend;
use App\Models\AgricultureCard;
use App\Models\BirthCertificate;
use App\Models\CertificateCitizen;
use App\Models\CertificatePermanentResident;
use App\Models\CertificateOrphan;
use App\Models\CertificateCommunity;
use App\Models\CertificateChildless;
use App\Models\CertificateMarriage;
use App\Models\CertificateUnmarried;
use App\Models\CertificateNationality;
use App\Models\CertificateLandless;
use App\Models\CertificateCharacter;
use App\Models\CertificateDisability;
use App\Models\CertificateHeirship;
use App\Models\CertificateNoObjection;
use App\Models\CertificateProttoyon;
use App\Models\CertificateTradeLicense;
use App\Models\CertificateDgfCard;
use App\Models\FamilyCard;
use App\Models\HoldingTax;
use App\Models\LeaseIjara;
use App\Models\VehicleLicense;
use App\Models\WaterConnection;
use App\Models\WidowedAllowance;

return [
    'family-card' => [
        'table' => FamilyCard::class,
        'type' => 1,
        'validation' => [
            // ঠিকানার তথ্য
            'current_address'        => 'required|string|max:500',
            'permanent_address'      => 'required|string|max:500',
            'district'               => 'required|string',
            'thana'                  => 'required|string',
            'ward'                   => 'required|string',

            // অর্থনৈতিক ও যোগ্যতা যাচাই (নতুন ফিল্ডস)
            'monthly_income'         => 'required|numeric|min:0',
            'land_amount'            => 'required|numeric|min:0|max:1000',
            'house_type'             => 'required|in:kacha,semi-pucca,pucca',
            'has_livestock'          => 'required|in:yes,no',
            'has_tv_fridge'          => 'required|in:yes,no',
            'has_vehicle'            => 'required|in:yes,no',
            'has_disabled_member'    => 'required|in:yes,no',
            'is_allowance_receiver'  => 'required|in:yes,no',

            // প্রয়োজনীয় কাগজপত্র
            'nid_file'               => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'birth_certificate_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'passport_file'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ],
    ],
    'agriculture-card' => [
        'table' => AgricultureCard::class,
        'type' => 1,
        'validation' => [

            // Address
            'current_address'        => 'required|string|max:500',
            'permanent_address'      => 'required|string|max:500',
            'district'               => 'required|string',
            'thana'                  => 'required|string',
            'ward'                   => 'required|string',

            // Agriculture
            'total_land'             => 'required|string|max:100',
            'land_ownership'         => 'required|in:owned,sharecropping,lease',
            'land_type'              => 'required|in:crop,fish,livestock',
            'agri_income'            => 'required|numeric|min:0',
            'farmer_category'        => 'required|in:landless,marginal,small,medium,large',
            'family_members'         => 'required|integer|min:1|max:50',
            'other_income_source'    => 'nullable|string|max:255',
            'payment_account'        => 'required|string|max:255',

            // Files
            'nid_file'               => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'land_document'          => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'birth_certificate_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'passport_file'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ],
    ],
    'age-stipend' => [
        'table' => AgeStipend::class,
        'type' => 1,
        'validation' => [

            // Address
            'current_address'        => 'required|string|max:500',
            'permanent_address'      => 'required|string|max:500',
            'district'               => 'required|string',
            'thana'                  => 'required|string',
            'ward'                   => 'required|string',

            // Stipend Info
            'age'                    => 'nullable|integer|min:65', // auto field
            'family_members'         => 'required|integer|min:1|max:50',
            'monthly_income'         => 'required|numeric|min:0',
            'land_amount'            => 'required|string|max:100',
            'other_allowance'        => 'required|in:no,widow,disability,old_age',
            'is_disabled'            => 'required|in:yes,no',
            'spouse_alive'           => 'required|in:yes,no',
            'payment_account'        => 'required|string|max:255',

            // Files
            'nid_file'               => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'birth_certificate_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'passport_file'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ],
    ],
    'widowed-allowance' => [
        'table' => WidowedAllowance::class,
        'type' => 1,

        'validation' => [

            // Address
            'current_address'   => 'required|string|max:500',
            'permanent_address' => 'required|string|max:500',
            'district'          => 'required|string|max:150',
            'thana'             => 'required|string|max:150',
            'ward'              => 'required|string|max:50',

            // Allowance Type
            'allowance_type'    => 'required|in:widow,abandoned',

            // Husband info (optional depending on type)
            'husband_name'      => 'nullable|string|max:255',
            'husband_nid'       => 'nullable|string|max:50',
            'death_date'        => 'nullable|date',
            'death_certificate_info' => 'nullable|string|max:255',

            // Family info
            'children_count'    => 'nullable|integer|min:0',
            'family_members'    => 'required|integer|min:1|max:50',
            'income'            => 'nullable|string|max:100',
            'land_amount'       => 'nullable|string|max:100',

            // Others
            'other_allowance'   => 'required|in:no,old_age,disability,widow',
            'health_status'     => 'required|in:healthy,weak,disabled',

            // Files
            'nid_file'                 => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'                    => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'husband_death_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'abandonment_certificate'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'birth_certificate_file'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'local_certificate'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'payment_account_doc'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'passport_file'           => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ],
    ],
    'birth-certificate' => [
        'table' => BirthCertificate::class,
        'type' => 1,
        'validation' => [
            'current_address'   => 'required|string',
            'permanent_address' => 'required|string',
            'district'          => 'required|string',
            'thana'             => 'required|string',
            'ward'              => 'required|string',
            'nid_file'              => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'birth_certificate_file' => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'citizenship-certificate' => [
        'table' => CertificateCitizen::class,
        'type' => 1,
        'validation' => [
            'current_address'        => 'required|string|max:500',
            'permanent_address'      => 'required|string|max:500',
            'district'               => 'required|string',
            'thana'                  => 'required|string',
            'ward'                   => 'required|string',
            'nid_file'               => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'birth_certificate_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'utility_bill_file'      => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'recommendation_file'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Fixed passport_file structure
            'passport_file'          => 'required|array|min:1',
            'passport_file.*'        => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'heirship-certificate' => [
        'table' => CertificateHeirship::class,
        'type' => 2,
        'validation' => [
            'deceased_name_bn'         => 'required|string',
            'deceased_name_en'         => 'nullable|string',
            'deceased_father_name'     => 'nullable|string',
            'deceased_mother_name'     => 'nullable|string',
            'death_date'               => 'required|date',
            'deceased_nid'             => 'nullable|string',
            'relation'                 => 'required|string',
            'land_area'                => 'nullable|string',
            'dag_no'                   => 'nullable|string',
            'khatian_no'               => 'nullable|string',
            'mouza'                    => 'nullable|string',
            'heirs'                    => 'nullable|array',
            'heirs.*.name'             => 'required_with:heirs|string',
            'heirs.*.relation'         => 'required_with:heirs|string',
            'heirs.*.nid'              => 'nullable|string',
            'heirs.*.mobile'           => 'nullable|string',
            'applicant_nid_copy'       => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'deceased_death_certificate' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'recommendation_letter'    => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'land_document'            => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],


    'trade-license' => [
        'table' => CertificateTradeLicense::class,
        'type' => 3,
        'validation' => [

            // Address
            'current_address'   => 'required|string|max:500',
            'permanent_address' => 'required|string|max:500',
            'district'          => 'required|string|max:150',
            'thana'             => 'required|string|max:150',
            'ward'              => 'required|string|max:50',

            // Business Info
            'business_type'   => 'required|string|max:50',
            'start_date'      => 'nullable|date',
            'ownership_type'  => 'required|in:sole,partnership,company',
            'occupation'      => 'nullable|string|max:255',
            'annual_income'   => 'nullable|string|max:100',
            'employee_count'  => 'nullable|integer|min:0|max:1000',
            'shop_type'       => 'required|in:owned,rented',

            // Files (required core docs)
            'nid_file'         => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'            => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'shop_photo'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'union_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',

            // Optional / conditional docs
            'rent_agreement'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'fire_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'tin_certificate'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'bsti_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'passport_file'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

        ],
    ],
    'dgf-card' => [
        'table' => CertificateDgfCard::class,
        'type' => 4,
        'validation' => [
            'head_name' => 'required|string|max:255',
            'father_or_husband_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'nid_number' => 'required|numeric|digits_between:10,17|unique:certificate_dgf_cards,nid_number',
            'ward_number' => 'required|integer|min:1|max:9',
            'birth_date' => 'required|date',
            'mobile_number' => 'required|regex:/^01[3-9]\d{8}$/|digits:11',
            'address' => 'required|string',
            'card_type' => 'required|in:general,senior,disabled,widow',
            'conditions' => 'required|array|min:4',
            'doc_nid_copy' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'doc_recommendation' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'doc_disability_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'doc_husband_death_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ],
    ],
    'nationality-certificate' => [
        'table' => CertificateNationality::class,
        'type' => 5,
        'validation' => [
            'village'           => 'required|string|max:255',
            'ward'              => 'required|string|max:50',
            'post_office'       => 'required|string|max:255',
            'upazila'           => 'required|string|max:255',
            'district'          => 'required|string|max:255',
            'permanent_address' => 'nullable|string|max:1000',
            'years_in_bd'                => 'required|integer|min:0',
            'previous_foreign_citizen'   => 'required|in:yes,no',
            'application_reason'         => 'required|string|max:1000',
            'applicant_nid_or_birth'         => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'                           => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'previous_citizenship_documents' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'characteristic-certificate' => [
        'table' => CertificateCharacter::class,
        'type' => 6,
        'validation' => [
            'village'            => 'required|string|max:255',
            'ward'               => 'required|string|max:50',
            'post_office'        => 'required|string|max:255',
            'upazila'            => 'required|string|max:255',
            'district'           => 'required|string|max:255',
            'permanent_address'  => 'nullable|string|max:1000',
            'social_status'      => 'required|string|max:255',
            'character_status'   => 'required|string|max:255',
            'application_reason' => 'required|string|max:1000',
            'applicant_nid_or_birth' => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'                  => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'supporting_documents'   => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'landless-certificate' => [
        'table' => CertificateLandless::class,
        'type' => 7,
        'validation' => [
            'village'            => 'required|string|max:255',
            'ward'               => 'required|string|max:50',
            'post_office'        => 'required|string|max:255',
            'upazila'            => 'required|string|max:255',
            'district'           => 'required|string|max:255',
            'permanent_address'  => 'nullable|string|max:1000',
            'total_family_members' => 'required|integer|min:1',
            'profession'           => 'required|string|max:255',
            'has_residence'        => 'required|in:yes,no',
            'has_agri_land'        => 'required|in:yes,no',
            'has_other_property'   => 'required|in:yes,no',
            'application_reason'   => 'nullable|string|max:1000',
            'applicant_nid_or_birth' => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'spouse_nid'             => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'                  => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'supporting_documents'   => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'single-certificate' => [
        'table' => CertificateUnmarried::class,
        'type' => 8,
        'validation' => [
            'village'           => 'required|string|max:255',
            'ward'              => 'required|string|max:50',
            'post_office'       => 'required|string|max:255',
            'upazila'           => 'required|string|max:255',
            'district'          => 'required|string|max:255',
            'permanent_address' => 'nullable|string|max:1000',
            'unmarried_status'   => 'required|in:yes,no',
            'application_reason' => 'required|string|max:1000',
            'nid_or_birth'          => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'                 => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'supporting_documents'  => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],



    'disability-certificate' => [
        'table' => CertificateDisability::class,
        'type' => 9,
        'validation' => [
            'village'            => 'required|string|max:255',
            'ward'               => 'required|string|max:50',
            'post_office'        => 'required|string|max:255',
            'upazila'            => 'required|string|max:255',
            'district'           => 'required|string|max:255',
            'permanent_address'  => 'nullable|string|max:1000',
            'disability_type'       => 'required|string|max:255',
            'disability_percentage' => 'nullable|numeric|min:0|max:100',
            'main_issue'            => 'required|string|max:1000',
            'medical_details'       => 'nullable|string|max:2000',
            'applicant_nid_or_birth' => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'medical_certificate'    => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'                  => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ],
    ],
    'marriage-certificate' => [
        'table' => CertificateMarriage::class,
        'type' => 10,
        'validation' => [
            'spouse_name'     => 'required|string|max:255',
            'father_name'     => 'required|string|max:255',
            'mother_name'     => 'required|string|max:255',
            'dob'             => 'required|date',
            'spouse_nid'      => 'required|string|max:50',
            'spouse_mobile'   => 'required|string|regex:/^01[0-9]{9}$/',
            'present_village'      => 'required|string|max:255',
            'present_ward'         => 'required|string|max:50',
            'present_post_office'  => 'required|string|max:255',
            'present_upazila'      => 'required|string|max:255',
            'present_district'     => 'required|string|max:255',
            'permanent_address'    => 'nullable|string|max:1000',
            'marriage_date'         => 'required|date',
            'marriage_registration' => 'nullable|string|max:255',
            'marriage_place'        => 'required|string|max:500',
            'marriage_process'      => 'required|in:Islamic,Hindu,Christian,Buddhist,Civil',
            'applicant_nid'             => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'spouse_nid_file'           => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'marriage_certificate_file' => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'photos' => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            // 'photos'                    => 'required|array|min:2',
            // 'photos.*'                  => 'mimes:jpg,jpeg,png,pdf|max:2048',
        ],
    ],
    'certificate' => [
        'table' => CertificateProttoyon::class,
        'type' => 11,
        'validation' => [
            'village'      => 'required|string|max:255',
            'ward'         => 'required|string|max:50',
            'post_office'  => 'required|string|max:255',
            'upazila'      => 'required|string|max:255',
            'district'     => 'required|string|max:255',
            'certification_subject' => 'required|string|max:1000',
            'certification_purpose' => 'required|string|max:1000',
            'nid_or_birth'         => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'                => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'supporting_documents' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'childless-certificate' => [
        'table' => CertificateChildless::class,
        'type' => 12,
        'validation' => [
            'present_village'      => 'required|string|max:255',
            'present_ward'         => 'required|string|max:50',
            'present_post_office'  => 'required|string|max:255',
            'present_upazila'      => 'required|string|max:255',
            'present_district'     => 'required|string|max:255',
            'permanent_address'    => 'nullable|string|max:1000',
            'marriage_duration'    => 'required|integer|min:0',
            'childless_status'     => 'required|in:yes,no',
            'reason_childless'     => 'nullable|string|max:1000',
            'application_reason'   => 'required|string|max:1000',
            'applicant_nid_or_birth' => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'spouse_nid'             => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'                  => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'marriage_certificate'   => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'community-certificate' => [
        'table' => CertificateCommunity::class,
        'type' => 13,
        'validation' => [
            'present_village'      => 'required|string|max:255',
            'present_ward'         => 'required|string|max:50',
            'present_post_office'  => 'required|string|max:255',
            'present_upazila'      => 'required|string|max:255',
            'present_district'     => 'required|string|max:255',
            'permanent_address'    => 'nullable|string|max:1000',
            'religion'             => 'required|in:Islam,Hindu,Christian,Buddhist,Others',
            'community_identity'   => 'required|string|max:255',
            'years_residing'       => 'required|integer|min:0',
            'nid_or_birth'         => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'                => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'supporting_documents' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'no-objection-letter' => [
        'table' => CertificateNoObjection::class,
        'type' => 14,
        'validation' => [
            'present_village'     => 'required|string|max:255',
            'present_ward'        => 'required|string|max:50',
            'present_post_office' => 'required|string|max:255',
            'present_upazila'     => 'required|string|max:255',
            'present_district'    => 'required|string|max:255',
            'permanent_address'   => 'nullable|string|max:500',
            'purpose'             => 'required|string|max:1000',
            'reason'              => 'required|string|max:1000',
            'organization_name'   => 'required|string|max:255',
            'nid_or_birth'        => 'required|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB
            'photo'               => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
            'supporting_docs'   => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ],
    ],
    'orphan-certificate' => [
        'table' => CertificateOrphan::class,
        'type' => 15,
        'validation' => [
            'father_name'       => 'required|string|max:255',
            'mother_name'       => 'required|string|max:255',
            'guardian_name'     => 'required|string|max:255',
            'guardian_address'  => 'required|string|max:500',
            'village'           => 'required|string|max:255',
            'ward'              => 'required|string|max:50',
            'post_office'       => 'required|string|max:255',
            'upazila'           => 'required|string|max:255',
            'district'          => 'required|string|max:255',
            'child_nid_or_birth'   => 'required|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB
            'guardian_nid'         => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
            'photo'                => 'required|mimes:jpg,jpeg,png,pdf|max:5120',
            'death_certificate'    => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ],
    ],
    'permanent-resident-ertificate' => [
        'table' => CertificatePermanentResident::class,
        'type' => 16,
        'validation' => [
            'current_address'   => 'required|string|max:1000',
            'permanent_address' => 'nullable|string|max:1000',
            'union_name'        => 'required|string|max:255',
            'religion'          => 'required|string|max:100',
            'occupation'        => 'required|string|max:255',
            'education'         => 'nullable|string|max:255',
            'residence_years'   => 'required|integer|min:0',
            'nid_or_birth_file'     => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo_file'            => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'address_proof_file'    => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'water-connection' => [
        'table' => WaterConnection::class,
        'type' => 1,
        'validation' => [
            'applicant_name'      => 'required|string|max:255',
            'guardian_name'       => 'required|string|max:255',
            'holding_no'          => 'required|string|max:100',
            'full_address'        => 'required|string|max:1000',

            'user_type'           => 'required|in:family,commercial',
            'connection_type'     => 'required|in:residential,commercial,industrial',
            'pipe_diameter'       => 'required|string|max:10',
            'consumer_id'         => 'nullable|string|max:100',

            'bill_month'          => 'required|date',
            'bill_amount'         => 'required|numeric|min:0',
            'due_amount'          => 'required|numeric|min:0',
            'rate_type'           => 'required|in:residential,commercial',

            'nid_copy'            => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'photo'               => 'required|mimes:jpg,jpeg,png|max:2048',
            'tax_receipt'         => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'holding-tax' => [
        'table' => HoldingTax::class,
        'type' => 2,
        'validation' => [
            'holding_no'        => 'required|string|max:100',
            'owner_name'        => 'required|string|max:255',
            'nid'               => 'required|string|max:20',
            'mobile'            => 'required|string|max:20',

            'land_amount'       => 'required|numeric|min:0',
            'structure_type'    => 'required|in:pucca,semi_pucca,kacha',
            'floor_count'       => 'required|integer|min:0',

            'ward_no'           => 'required|string|max:10',
            'address'           => 'required|string|max:1000',

            'due_tax'           => 'required|numeric|min:0',
            'current_tax'       => 'required|numeric|min:0',
            'generate_receipt'  => 'nullable|in:yes,no',

            'ownership_deed'    => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'tax_receipt_file'  => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'lease-ijara' => [
        'table' => LeaseIjara::class,
        'type' => 3,
        'validation' => [
            'applicant_name'     => 'required|string|max:255',
            'nid'                => 'required|string|max:20',
            'mobile'             => 'required|string|max:20',
            'address'            => 'required|string|max:1000',

            'property_name'      => 'required|string|max:255',
            'location'           => 'required|string|max:255',
            'ward_no'            => 'required|string|max:10',

            'lease_duration'     => 'required|in:1_year,3_year,5_year',
            'bid_amount'         => 'required|numeric|min:0',

            'citizenship'        => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'chairman_cert'      => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'land_record'        => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
    'vehicle-license' => [
        'table' => VehicleLicense::class,
        'type' => 4,
        'validation' => [
            'application_type'   => 'required|in:new,renew',

            'name_bn'           => 'required|string|max:255',
            'name_en'           => 'required|string|max:255',
            'dob'               => 'required|date',
            'birth_reg_no'     => 'required|string|max:50',
            'nid'              => 'required|string|max:20',

            'gender'           => 'required|in:male,female,other',
            'marital_status'   => 'nullable|in:single,married',

            'father_or_husband' => 'required|string|max:255',
            'wife_name'        => 'nullable|string|max:255',

            'present_address'  => 'required|string|max:1000',
            'permanent_address' => 'required|string|max:1000',
            'holding_no'       => 'nullable|string|max:100',

            'vehicle_type'     => 'required|in:rickshaw,van,auto_rickshaw',
            'vehicle_no'       => 'nullable|string|max:100',
            'vehicle_model'    => 'nullable|string|max:255',

            // renewal only
            'old_license_no'   => 'nullable|string|max:100',
            'due_fee'          => 'nullable|numeric|min:0',

            'photo'            => 'required|mimes:jpg,jpeg,png|max:2048',
            'nid_copy'         => 'required|mimes:jpg,jpeg,png,pdf|max:4096',
            'holding_tax'      => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ],
    ],
];
