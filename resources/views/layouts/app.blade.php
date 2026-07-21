<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $commonData['school_name'])</title>
    <meta name="description" content="{{ $commonData['school_name'] }} — মানসম্পন্ন ইসলামী ও আধুনিক শিক্ষার প্রতিষ্ঠান">
    <meta name="keywords" content="মাদরাসা, {{ $commonData['school_name'] }}, ইসলামী শিক্ষা, ভর্তি, বাংলাদেশ">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="{{ $commonData['school_name'] }}" />
    <meta property="og:description" content="মানসম্পন্ন ইসলামী ও আধুনিক শিক্ষার প্রতিষ্ঠান" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ $commonData['logo'] }}" />
    <meta name="twitter:title" content="{{ $commonData['school_name'] }}" />
    <meta name="twitter:description" content="মানসম্পন্ন ইসলামী ও আধুনিক শিক্ষার প্রতিষ্ঠান" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="theme-color" content="#ffffff">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="icon" href="{{ $commonData['logo'] }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/bn.js"></script>
</head>

<body>
    @include('layouts/nav')
    @yield('content')
    @include('layouts/footer')

    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('active');
        }

        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            zoomable: true,
            autoplayVideos: true
        });

        const swiper = new Swiper(".mySwiper", {
            loop: true,
            speed: 800,
            autoplay: { delay: 4000 },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            pagination: { el: ".swiper-pagination", clickable: true },
        });
    </script>
    <script>
        $(document).ready(function() {
            function toBengaliNumber(number) {
                const bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                return number.toString().replace(/\d/g, function(digit) {
                    return bengaliDigits[digit];
                });
            }

            function addHeirRow() {
                const rowCount = $('#heirsTable tbody tr').length;
                const bengaliSerial = toBengaliNumber(rowCount + 1);
                const newRow = `
          <tr>
            <td class="serial-no">${bengaliSerial}</td>
            <td><input type="text" class="form-control" name="heirs[${rowCount}][name]" placeholder="" required></td>
            <td>
              <select class="form-select" name="heirs[${rowCount}][relation]" required>
                <option value="">পছন্দ করুন</option>
                <option value="son">পুত্র</option>
                <option value="daughter">কন্যা</option>
                <option value="wife">স্ত্রী</option>
                <option value="husband">স্বামী</option>
                <option value="father">পিতা</option>
                <option value="mother">মাতা</option>
                <option value="brother">ভাই</option>
                <option value="sister">বোন</option>
                <option value="other">অন্যান্য</option>
              </select>
            </td>
            <td><input type="number" class="form-control" name="heirs[${rowCount}][nid]" placeholder=""></td>
            <td><input type="text" class="form-control" name="heirs[${rowCount}][mobile]" maxlength="11" placeholder=""></td>
            <td><input type="text" class="form-control" name="heirs[${rowCount}][address]" placeholder=""></td>
            <td class="action-cell">
              <button type="button" class="remove-heir-btn" title="Remove">&times;</button>
            </td>
          </tr>
        `;
                $('#heirsTable tbody').append(newRow);
            }

            addHeirRow();
            addHeirRow();

            $('#addHeirBtn').click(function() { addHeirRow(); });

            $(document).on('click', '.remove-heir-btn', function() {
                if ($('#heirsTable tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                    $('#heirsTable tbody tr').each(function(index) {
                        $(this).find('.serial-no').text(toBengaliNumber(index + 1));
                    });
                } else {
                    alert('কমপক্ষে একটি সারি রাখতে হবে।');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
