@extends('layouts.app')
@section('content')
<div class="container">
    <div class="left-column">
        <h1>Google Zirvesine Ulaşın!</h1>
        <p class="subtitle">Domaininizin Google’daki sırasını anında öğrenin.</p>

        <form id="check_form" class="rank-checker-form">
            @csrf
            <div class="inputs-wrapper">
                <div class="form-group">
                    <label for="domain">DOMAIN</label>
                    <input type="text" id="domain" name="domain" placeholder="example.com" />
                </div>
                <div class="form-group">
                    <label for="keyword">KEYWORD</label>
                    <input type="text" id="keyword" name="keyword" placeholder="keyword" />
                </div>
            </div>
            <input type="hidden" name="timezone" id="timezone">
        </form>
        <button type="button" onclick="check()" class="check-button">Sıranı Öğren</button>
    </div>

    <div class="right-column">
        <div class="result-box">
            <p class="on-google">Google'da</p>
            <span class="rank"></span>
        </div>
        <div class="timeline-line"></div>
    </div>
</div>
<script>
    document.querySelector('.rank-checker-form').addEventListener('submit', function(e) {
        e.preventDefault();
    });

    function check(){
        const form = document.getElementById('check_form');
        const formData = new FormData(form);
        const rankElement = document.querySelector('.rank');

        rankElement.classList.add('loading');
        rankElement.textContent = '';

        $.ajax({
            method: "POST",
            url: "{!! route('serp.check') !!}",
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: response => {
                rankElement.classList.remove('loading');
                if (response.rank !== undefined && response.rank !== null) {
                    rankElement.innerHTML = response.rank + '<sup>. sırada</sup>';
                } else {
                    rankElement.textContent = "Sıra bilgisi bulunamadı";
                }
            },
            error: xhr => {
                rankElement.classList.remove('loading');
                rankElement.textContent = "Hata oluştu";
                console.error(xhr);
            }
        });
    }


    document.addEventListener("DOMContentLoaded", function () {   <!--Tarayıcıdan Timezone almak için yazıldı.-->
        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        document.getElementById('timezone').value = timezone;
    });

</script>

@endsection
