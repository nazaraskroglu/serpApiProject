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
        const button = document.querySelector('.check-button');

        rankElement.classList.add('loading');
        rankElement.textContent = '';
        button.disabled = true;
        button.style.opacity = '0.6';
        button.style.cursor = 'not-allowed';

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
                button.disabled = false;
                button.style.opacity = '';
                button.style.cursor = '';

                if (response.rank !== undefined && response.rank !== null) {
                    rankElement.style.display = 'block';
                    rankElement.innerHTML = '<p class="on-google">Google\'da</p>' + response.rank + '. sırada';
                } else {
                    rankElement.style.display = 'none';

                    Swal.fire({
                        icon: 'info',
                        title: 'Sıralama Bulunamadı',
                        html: `🔍 <b>${formData.get('keyword')}</b> kelimesi için <b>${formData.get('domain')}</b> domainine ait sıralama bulunamadı.<br><br>
               Lütfen bilgileri kontrol ederek tekrar deneyin.`,
                        confirmButtonText: 'Tamam',
                        background: '#1e293b',
                        color: '#cbd5e1',
                    }).then(() => {
                        showInitialRankMessage();
                    });
                }

            },
            error: xhr => {
                rankElement.classList.remove('loading');
                button.disabled = false;
                button.style.opacity = '';
                button.style.cursor = '';

                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    let errorMessages = Object.values(xhr.responseJSON.errors).map(arr => arr.join('<br>')).join('<br><br>');

                    Swal.fire({
                        icon: 'error',
                        title: 'Geçersiz Giriş',
                        html: errorMessages,
                        confirmButtonText: 'Tamam',
                        background: '#1e293b',
                        color: '#cbd5e1',
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Sıralama Bulunamadı',
                        html: `🔍 <b>${formData.get('keyword')}</b> kelimesi için <b>${formData.get('domain')}</b> domainine ait sıralama bulunamadı.<br><br>
           Lütfen bilgileri kontrol ederek tekrar deneyin.`,
                        confirmButtonText: 'Tamam',
                        background: '#1e293b',
                        color: '#cbd5e1',
                    }).then(() => {
                        showInitialRankMessage();
                    });
                }
            }

        });
    }


    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('timezone').value = Intl.DateTimeFormat().resolvedOptions().timeZone;
        showInitialRankMessage();
    });

    function showInitialRankMessage() {
        const rankElement = document.querySelector('.rank');
        rankElement.innerHTML = `
        <div class="initial-state-animated">
            <div class="search-icon-wrapper">
                <div class="pulse-circle"></div>
                <div class="glass-icon">🔍</div>
            </div>
            <p class="title">Henüz Arama Yapılmadı</p>
        </div>
    `;
        rankElement.style.display = 'block';
    }

</script>

@endsection
