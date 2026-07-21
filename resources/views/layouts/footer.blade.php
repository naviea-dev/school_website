<img src="{{ asset('frontend/images/footer-bg.png') }}" alt="" style="width: 100%; height:auto; margin-bottom:-4px">

<footer class="gov-footer">
    <div class="container">
        <div class="footer-grid">

            <div class="footer-box text-center text-md-start">
                <a class="footer-logo mb-4 d-inline-block" href="{{ route('home') }}">
                    <img src="{{ asset('frontend/images/logo.png') }}"
                        alt="logo" class="img-fluid" style="max-width: 180px;">
                </a>

                <div class="footer-content">
                    <p class="text-white large mb-4">
                        {{ $commonData['school_name'] }}<br>
                        মানসম্পন্ন ইসলামী ও আধুনিক শিক্ষার প্রতিষ্ঠান।
                    </p>
                </div>
            </div>

            <div class="footer-box">
                <h4>প্রয়োজনীয় লিংক</h4>
                <ul>
                    <li><a href="https://moedu.gov.bd/" target="_blank">শিক্ষা মন্ত্রণালয়</a></li>
                    <li><a href="https://www.educationboard.gov.bd/" target="_blank">শিক্ষা বোর্ড</a></li>
                    <li><a href="https://www.islamicfoundation.gov.bd/" target="_blank">ইসলামিক ফাউন্ডেশন</a></li>
                    <li><a href="https://www.bmeb.gov.bd/" target="_blank">বাংলাদেশ মাদরাসা শিক্ষা বোর্ড</a></li>
                </ul>
            </div>

            <div class="footer-box">
                <h4>দ্রুত লিংক</h4>
                <ul>
                    @foreach ($commonData['footer_menus'] as $menu)
                    <li>
                        <a href="{{ route('websitecontent.slug', [$menu->uri]) }}">
                            {{ $menu->title }}
                        </a>
                    </li>
                    @endforeach
                    <li><a href="{{ route('notice') }}">সর্বশেষ নোটিশ</a></li>
                </ul>
            </div>

            <div class="footer-box">
                <h4>যোগাযোগ</h4>
                <div class="contact-info text-white small mb-3">
                    <p class="mb-2">
                        <ion-icon name="location-outline" class="me-1"></ion-icon>
                        ৩৭৪, কাওলার (নামাপাড়া, ওয়াটার পাম্পের পশ্চিমে), দক্ষিণখান, ঢাকা-১২২৯
                    </p>
                    <p class="mb-2">
                        <ion-icon name="call-outline" class="me-1"></ion-icon>
                        <a href="tel:01873049090" class="text-white text-decoration-none">01873-049090</a>
                    </p>
                    <p class="mb-2">
                        <ion-icon name="mail-outline" class="me-1"></ion-icon>
                        <a href="mailto:info.rqmm@gmail.com" class="text-white text-decoration-none">info.rqmm@gmail.com</a>
                    </p>
                </div>

                <div class="map-container rounded overflow-hidden" style="height: 180px;">
                    <iframe src="https://maps.google.com/maps?q=Kawlar+Namapara+Dakshinkhan+Dhaka+Bangladesh&output=embed"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="socials d-flex gap-3 mt-3">
                    <a href="https://maps.app.goo.gl/r39wsxE7mByxnEwW7" target="_blank" class="social-icon fb"><ion-icon name="location-outline"></ion-icon></a>
                    <a href="mailto:info.rqmm@gmail.com" class="social-icon yt"><ion-icon name="mail-outline"></ion-icon></a>
                    <a href="tel:01873049090" class="social-icon tw"><ion-icon name="call-outline"></ion-icon></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom text-center py-4">
            <p class="mb-1">© {{ date('Y') }} {{ $commonData['school_name'] }} | সর্বস্বত্ব সংরক্ষিত</p>
            <div id="footerClock" class="text-white-50" style="font-size: 14px; line-height: 1.6;">
                লোড হচ্ছে...
            </div>
        </div>
    </div>
</footer>

<a href="https://wa.me/8801700000000" target="_blank" rel="noopener" id="whatsappFloat" class="shadow-lg" title="হোয়াটসঅ্যাপে যোগাযোগ করুন"
    style="position: fixed; bottom: 148px; right: 25px; z-index: 9999; width: 55px; height: 55px; background: #25D366; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;">
    <ion-icon name="logo-whatsapp" style="font-size: 32px; color: #fff;"></ion-icon>
</a>

<div id="calendarTrigger" class="floating-clock-plugin shadow-lg" title="ক্যালেন্ডার, বঙ্গাব্দ ও হিজরি তারিখ দেখতে ক্লিক করুন">
    <div id="closeClock" class="close-clock-btn">
        <ion-icon name="close-circle"></ion-icon>
    </div>
    <div class="clock-text-wrapper">
        <div id="floatingClock" class="bengali-font">
            <div id="timeLine">লোড হচ্ছে...</div>
            <div id="dateLine"></div>
        </div>
    </div>
    <input type="text" id="hiddenPicker" style="visibility: hidden; position: absolute; height: 0; width: 0; opacity: 0; border: none;">
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        let selectedDate = null;

        const bnDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        const toBn = (num) => num.toString().replace(/\d/g, d => bnDigits[d]);

        function getBengaliDate(date) {
            const d = new Date(date);
            const months = ['বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন',
                'কার্তিক', 'অগ্রহায়ণ', 'পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র'];
            const start = new Date(d.getFullYear(), 3, 14);
            let year = d.getFullYear() - 593;
            if (d < start) year--;
            let diff = Math.floor((d - start) / 86400000);
            if (diff < 0) diff += 365;
            const monthDays = [31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29, 30];
            let month = 0;
            while (diff >= monthDays[month]) { diff -= monthDays[month]; month++; }
            return `${toBn(diff + 1)} ${months[month]} ${toBn(year)}`;
        }

        function getHijriDate(date) {
            const d = new Date(date);
            d.setDate(d.getDate() - 1);
            let jd = Math.floor((d - new Date(1970, 0, 1)) / 86400000) + 2440588;
            let l = jd - 1948440 + 10632;
            let n = Math.floor((l - 1) / 10631);
            l = l - 10631 * n + 354;
            let j = (Math.floor((10985 - l) / 5316)) * (Math.floor((50 * l) / 17719)) +
                (Math.floor(l / 5670)) * (Math.floor((43 * l) / 15238));
            l = l - (Math.floor((30 - j) / 15)) * (Math.floor((17719 * j) / 50)) -
                (Math.floor(j / 16)) * (Math.floor((15238 * j) / 43)) + 29;
            let month = Math.floor((24 * l) / 709);
            let day = l - Math.floor((709 * month) / 24);
            let year = 30 * n + j - 30;
            const months = ['মুহাররম', 'সফর', 'রবিউল আউয়াল', 'রবিউস সানি',
                'জুমাদাল উলা', 'জুমাদাল আখিরা', 'রজব', 'শাবান',
                'রমজান', 'শাওয়াল', 'জিলকদ', 'জিলহজ'];
            return `${toBn(day)} ${months[month-1]} ${toBn(year)}`;
        }

        function updateCalendarInfo(date) {
            const infoDiv = document.querySelector('#calendarExtraInfo');
            if (infoDiv) {
                infoDiv.innerHTML = `
                <div class="text-success"><b>হিজরি:</b> ${getHijriDate(date)}</div>
                <div class="text-primary"><b>বঙ্গাব্দ:</b> ${getBengaliDate(date)}</div>
            `;
            }
        }

        function updateClock() {
            const now = new Date();
            const baseDate = selectedDate ? new Date(selectedDate) : new Date();
            baseDate.setHours(now.getHours(), now.getMinutes(), now.getSeconds());
            const days = ['রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার'];
            const h = toBn(baseDate.getHours() % 12 || 12).padStart(2, '০');
            const m = toBn(baseDate.getMinutes()).padStart(2, '০');
            const s = toBn(baseDate.getSeconds()).padStart(2, '০');
            const ampm = baseDate.getHours() >= 12 ? 'অপরাহ্ন' : 'পূর্বাহ্ণ';
            const timeString = `${days[baseDate.getDay()]} | ${h}:${m}:${s} ${ampm}`;
            const enDate = baseDate.toLocaleDateString('en-GB', { day: '2-digit', month: 'long', year: 'numeric' });
            const bnDate = getBengaliDate(baseDate);
            const hijriDate = getHijriDate(baseDate);
            document.getElementById('timeLine').innerText = timeString;
            document.getElementById('dateLine').innerHTML = `${enDate} <br> বঙ্গাব্দ: ${bnDate} <br> হিজরি: ${hijriDate}`;
            const footerEl = document.getElementById('footerClock');
            if (footerEl) {
                footerEl.innerHTML = `${timeString} <br><span style="font-size:13px;">${enDate} <br> বঙ্গাব্দ: ${bnDate} | হিজরি: ${hijriDate}</span>`;
            }
        }

        const picker = flatpickr("#hiddenPicker", {
            locale: "bn",
            position: "top right",
            dateFormat: "Y-m-d",
            disableMobile: true,
            onChange: function(selectedDates) {
                selectedDate = selectedDates[0];
                updateClock();
                updateCalendarInfo(selectedDate);
            },
            onReady: function(selectedDates, dateStr, instance) {
                const infoDiv = document.createElement('div');
                infoDiv.id = "calendarExtraInfo";
                infoDiv.className = "p-2 bg-light border-top small";
                instance.calendarContainer.appendChild(infoDiv);
                updateCalendarInfo(selectedDate || new Date());
            }
        });

        document.getElementById('calendarTrigger').addEventListener('click', () => picker.open());
        setInterval(updateClock, 1000);
        updateClock();
    });

    document.addEventListener("DOMContentLoaded", function() {
        const trigger = document.getElementById('calendarTrigger');
        const closeBtn = document.getElementById('closeClock');
        closeBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            trigger.style.transition = "opacity 0.4s, transform 0.4s";
            trigger.style.opacity = "0";
            trigger.style.transform = "scale(0.8) translateY(20px)";
            setTimeout(() => { trigger.style.display = "none"; }, 400);
        });
    });
</script>
