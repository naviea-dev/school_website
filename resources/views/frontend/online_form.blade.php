@extends('layouts.app')

@section('title', 'অনলাইন ভর্তি ফর্ম')

@section('content')
<style>
    .form-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,.07);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .form-section-header {
        padding: 14px 22px;
        font-weight: 700;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
    }
    .section-personal  { background: linear-gradient(90deg,#667eea,#764ba2); }
    .section-academic  { background: linear-gradient(90deg,#11998e,#38ef7d); color:#1a1a2e !important; }
    .section-parent    { background: linear-gradient(90deg,#f093fb,#f5576c); }
    .section-address   { background: linear-gradient(90deg,#4facfe,#00f2fe); color:#1a1a2e !important; }
    .form-section-body { padding: 22px 22px 8px; }
    .form-label-req::after { content: ' *'; color: #dc3545; }
    .photo-preview-wrap {
        position: relative;
        width: 130px;
        height: 130px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px dashed #ccc;
        cursor: pointer;
        background: #f8f8f8;
    }
    .photo-preview-wrap img { width:100%;height:100%;object-fit:cover; }
    .photo-preview-wrap input { position:absolute;top:0;left:0;width:100%;height:100%;opacity:0;cursor:pointer; }
    .photo-overlay {
        position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,.45);color:#fff;
        text-align:center;font-size:11px;padding:4px 0;
    }
</style>

<div class="container my-5">

    @if(session('success'))
    <div class="alert alert-success" style="border-radius:8px;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger" style="border-radius:8px;">{{ session('error') }}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger" style="border-radius:8px;">
        <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
    </div>
    @endif

    <h2 class="text-center fw-bold mb-4" style="color: #198754;">অনলাইন ভর্তি আবেদন ফর্ম</h2>

    <form action="{{ route('online-form.submit') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf

        {{-- ── PERSONAL INFO ─────────────────────────────────────────── --}}
        <div class="form-section">
            <div class="form-section-header section-personal">
                <ion-icon name="person-circle-outline"></ion-icon> ব্যক্তিগত তথ্য
            </div>
            <div class="form-section-body">
                <div class="row">

                    <div class="col-md-2 mb-3 d-flex flex-column align-items-center">
                        <label class="col-form-label mb-2">ছবি</label>
                        <div class="photo-preview-wrap" title="ছবি আপলোড করতে ক্লিক করুন">
                            <img id="photo_preview" src="{{ asset('assets/front/images/defaultlogo.png') }}" alt="Preview">
                            <input type="file" name="photo" id="photo_input" accept="image/*">
                            <div class="photo-overlay"><ion-icon name="camera-outline"></ion-icon> আপলোড</div>
                        </div>
                        <small class="text-muted mt-1" style="font-size:11px;">JPG/PNG, max 2MB</small>
                        @error('photo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label form-label-req">শিক্ষার্থীর পূর্ণ নাম</label>
                                <input type="text" name="student_name" class="form-control @error('student_name') is-invalid @enderror"
                                    placeholder="যেমন: মোঃ রফিকুল ইসলাম" value="{{ old('student_name') }}">
                                @error('student_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label form-label-req">জন্ম তারিখ</label>
                                <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label form-label-req">লিঙ্গ</label>
                                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">নির্বাচন করুন</option>
                                    <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>ছেলে</option>
                                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>মেয়ে</option>
                                </select>
                                @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="col-form-label">রক্তের গ্রুপ</label>
                                <select name="blood_group" class="form-control">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                                    <option value="{{ $bg }}" {{ old('blood_group') === $bg ? 'selected' : '' }}>{{ $bg }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="col-form-label">ধর্ম</label>
                                <select name="religion" class="form-control">
                                    <option value="">নির্বাচন করুন</option>
                                    @foreach(['Islam' => 'ইসলাম', 'Hinduism' => 'হিন্দু', 'Christianity' => 'খ্রিস্টান', 'Buddhism' => 'বৌদ্ধ', 'Other' => 'অন্যান্য'] as $val => $text)
                                    <option value="{{ $val }}" {{ old('religion') === $val ? 'selected' : '' }}>{{ $text }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="col-form-label">জাতীয়তা</label>
                                <input type="text" name="nationality" class="form-control" value="{{ old('nationality', 'Bangladeshi') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="col-form-label">জন্ম নিবন্ধন নম্বর</label>
                                <input type="text" name="birth_certificate_no" class="form-control"
                                    placeholder="১৭ সংখ্যার নম্বর" value="{{ old('birth_certificate_no') }}">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── ACADEMIC INFO ─────────────────────────────────────────── --}}
        <div class="form-section">
            <div class="form-section-header section-academic">
                <ion-icon name="school-outline"></ion-icon> শিক্ষাগত তথ্য
            </div>
            <div class="form-section-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="col-form-label form-label-req">যে শ্রেণিতে ভর্তি হতে চান</label>
                        <input type="text" name="applying_for_class" class="form-control @error('applying_for_class') is-invalid @enderror"
                            placeholder="যেমন: ষষ্ঠ শ্রেণি" value="{{ old('applying_for_class') }}">
                        @error('applying_for_class')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="col-form-label">পূর্ববর্তী প্রতিষ্ঠানের নাম</label>
                        <input type="text" name="previous_school_name" class="form-control"
                            placeholder="যদি থাকে" value="{{ old('previous_school_name') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="col-form-label">পূর্ববর্তী শ্রেণি</label>
                        <input type="text" name="previous_class" class="form-control"
                            placeholder="যেমন: পঞ্চম শ্রেণি" value="{{ old('previous_class') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="col-form-label">পূর্ববর্তী ফলাফল</label>
                        <input type="text" name="previous_result" class="form-control"
                            placeholder="যেমন: ৫.০০" value="{{ old('previous_result') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="col-form-label">পাসের সাল</label>
                        <input type="text" name="previous_passing_year" class="form-control"
                            placeholder="যেমন: ২০২৪" maxlength="4" value="{{ old('previous_passing_year') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- ── PARENT & GUARDIAN INFO ────────────────────────────────── --}}
        <div class="form-section">
            <div class="form-section-header section-parent">
                <ion-icon name="people-outline"></ion-icon> অভিভাবকের তথ্য
            </div>
            <div class="form-section-body">
                <div class="row">
                    <div class="col-12 mb-2"><strong style="color:#888;font-size:13px;text-transform:uppercase;letter-spacing:.5px;">পিতা</strong></div>
                    <div class="col-md-3 mb-3">
                        <label class="col-form-label">পিতার নাম</label>
                        <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}" placeholder="পূর্ণ নাম">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="col-form-label">পিতার এনআইডি নম্বর</label>
                        <input type="text" name="father_nid" class="form-control" value="{{ old('father_nid') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="col-form-label">পিতার পেশা</label>
                        <input type="text" name="father_occupation" class="form-control" value="{{ old('father_occupation') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="col-form-label">পিতার মোবাইল</label>
                        <input type="text" name="father_phone" class="form-control" value="{{ old('father_phone') }}" placeholder="০১XXXXXXXXX">
                    </div>

                    <div class="col-12 mb-2 mt-1"><strong style="color:#888;font-size:13px;text-transform:uppercase;letter-spacing:.5px;">মাতা</strong></div>
                    <div class="col-md-3 mb-3">
                        <label class="col-form-label">মাতার নাম</label>
                        <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name') }}" placeholder="পূর্ণ নাম">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="col-form-label">মাতার এনআইডি নম্বর</label>
                        <input type="text" name="mother_nid" class="form-control" value="{{ old('mother_nid') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="col-form-label">মাতার পেশা</label>
                        <input type="text" name="mother_occupation" class="form-control" value="{{ old('mother_occupation') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="col-form-label">মাতার মোবাইল</label>
                        <input type="text" name="mother_phone" class="form-control" value="{{ old('mother_phone') }}" placeholder="০১XXXXXXXXX">
                    </div>

                    <div class="col-12 mb-2 mt-1"><strong style="color:#888;font-size:13px;text-transform:uppercase;letter-spacing:.5px;">অভিভাবক (পিতা-মাতা ব্যতীত হলে)</strong></div>
                    <div class="col-md-4 mb-3">
                        <label class="col-form-label">অভিভাবকের নাম</label>
                        <input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name') }}" placeholder="ঐচ্ছিক">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="col-form-label">শিক্ষার্থীর সাথে সম্পর্ক</label>
                        <input type="text" name="guardian_relation" class="form-control" value="{{ old('guardian_relation') }}" placeholder="যেমন: চাচা">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="col-form-label">অভিভাবকের মোবাইল</label>
                        <input type="text" name="guardian_phone" class="form-control" value="{{ old('guardian_phone') }}" placeholder="০১XXXXXXXXX">
                    </div>
                </div>
            </div>
        </div>

        {{-- ── ADDRESS ───────────────────────────────────────────────── --}}
        <div class="form-section">
            <div class="form-section-header section-address">
                <ion-icon name="location-outline"></ion-icon> ঠিকানা
            </div>
            <div class="form-section-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="col-form-label">বর্তমান ঠিকানা</label>
                        <textarea name="present_address" class="form-control" rows="3"
                            placeholder="গ্রাম/রোড, ইউনিয়ন/ওয়ার্ড, উপজেলা, জেলা">{{ old('present_address') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="col-form-label">স্থায়ী ঠিকানা</label>
                        <textarea name="permanent_address" class="form-control" rows="3"
                            placeholder="গ্রাম/রোড, ইউনিয়ন/ওয়ার্ড, উপজেলা, জেলা">{{ old('permanent_address') }}</textarea>
                        <div class="form-check mt-1">
                            <input type="checkbox" class="form-check-input" id="same_address">
                            <label class="form-check-label" for="same_address" style="font-size:13px;">বর্তমান ঠিকানার মতোই</label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="col-form-label">অতিরিক্ত তথ্য</label>
                        <textarea name="remarks" class="form-control" rows="2"
                            placeholder="যেকোনো অতিরিক্ত তথ্য...">{{ old('remarks') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 text-center mt-4 mb-5">
            <button type="submit" class="custom-submit">আবেদন জমা দিন</button>
        </div>

    </form>
</div>

@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var photoInput = document.getElementById('photo_input');
    var photoPreview = document.getElementById('photo_preview');
    if (photoInput) {
        photoInput.addEventListener('change', function () {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) { photoPreview.setAttribute('src', e.target.result); };
                reader.readAsDataURL(file);
            }
        });
    }

    var sameAddress = document.getElementById('same_address');
    var present = document.querySelector('textarea[name=present_address]');
    var permanent = document.querySelector('textarea[name=permanent_address]');
    if (sameAddress && present && permanent) {
        sameAddress.addEventListener('change', function () {
            if (this.checked) permanent.value = present.value;
        });
        present.addEventListener('input', function () {
            if (sameAddress.checked) permanent.value = present.value;
        });
    }

    setTimeout(function () {
        var alert = document.querySelector('.alert');
        if (alert) alert.style.display = 'none';
    }, 5000);
});
</script>
@endpush
