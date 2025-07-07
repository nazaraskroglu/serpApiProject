{{-- resources/views/wizard.blade.php --}}
    <!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SERP Sıralama Kontrol Wizard</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Alpine.js CDN --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Elle yazı tipi (isteğe bağlı) --}}
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
    <style>
        .font-handwriting {
            font-family: 'Dancing Script', cursive;
        }
    </style>
</head>
<body class="bg-gray-900">

<div x-data="wizard()" class="flex h-screen overflow-hidden">
    {{-- Sol yarı: adım içeriği --}}
    <div class="w-1/2 flex flex-col justify-center items-center bg-white p-10">
        {{-- Adım göstergesi --}}
        <div class="text-gray-600 mb-2 text-sm">
            Step <span x-text="step"></span> / <span x-text="total"></span>
        </div>

        {{-- Soru --}}
        <h2 class="text-2xl font-semibold mb-6" x-text="questions[step-1]"></h2>

        {{-- Cevap inputu --}}
        <input
            type="text"
            x-model="answers[step-1]"
            :placeholder="placeholders[step-1]"
            class="w-full text-xl font-handwriting border-b-2 border-gray-300 focus:outline-none focus:border-indigo-500 px-2 mb-8"
        />

        {{-- İleri butonu --}}
        <button
            @click="next()"
            class="inline-flex items-center bg-indigo-600 text-white px-6 py-2 rounded-full shadow hover:bg-indigo-700 transition disabled:opacity-50"
            :disabled="step >= total || loading"
        >
            <span x-show="!loading">Next →</span>
            <svg
                x-show="loading"
                class="animate-spin h-5 w-5"
                xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
            </svg>
        </button>
    </div>

    {{-- Sağ yarı: domain temalı arkaplan --}}
    <div
        class="w-1/2 bg-center bg-cover"
        style="background-image: url('https://source.unsplash.com/collection/190727/1600x900');"
    ></div>
</div>

<script>
    function wizard() {
        return {
            step: 1,
            total: 4,
            loading: false,
            questions: [
                "What's your name?",
                "What's your domain?",
                "What's your favorite keyword?",
                "Review your info"
            ],
            placeholders: [
                "John Doe",
                "example.com",
                "laravel tutorial",
                ""
            ],
            answers: ["", "", "", "],

                next() {
                    if (this.step < this.total) {
            this.loading = true;
            setTimeout(() => {
                this.loading = false;
                this.step++;

                // 4. adımdaysa isterseniz sonuçları burada işleyebilirsiniz:
                if (this.step === this.total) {
                    console.log("Cevaplar:", this.answers);
                }
            }, 300);
        }
    }
    }
    }
</script>

</body>
</html>
