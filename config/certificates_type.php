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
    'family_card' => FamilyCard::class,
    'agriculture_card' => AgricultureCard::class,
    'age_stipend' => AgeStipend::class,
    'widowed_allowance' => WidowedAllowance::class,
    'birth_certificate' => BirthCertificate::class,
    'citizenship_certificate' => CertificateCitizen::class,
    'heirship_certificate' => CertificateHeirship::class,
    'dgf_card' => CertificateDgfCard::class,
    'nationality_certificate' => CertificateNationality::class,
    'character_certificate' => CertificateCharacter::class,
    'landless_certificate' => CertificateLandless::class,
    'single_certificate' => CertificateUnmarried::class,
    'disability_certificate' => CertificateDisability::class,
    'marriage_certificate' => CertificateMarriage::class,
    'general_certificate' => CertificateProttoyon::class,
    'childless_certificate' => CertificateChildless::class,
    'community_certificate' => CertificateCommunity::class,
    'no_objection_letter' => CertificateNoObjection::class,
    'orphan_certificate' => CertificateOrphan::class,
    'permanent_resident_certificate' => CertificatePermanentResident::class,
    'trade_license' => CertificateTradeLicense::class,
    'water_connection' => WaterConnection::class,
    'holding_tax' => HoldingTax::class,
    'lease_ijara' => LeaseIjara::class,
    'vehicle_license' => VehicleLicense::class,
];