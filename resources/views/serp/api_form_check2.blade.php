<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERP Sıra Kontrol</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.x/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="bg-white p-6 rounded shadow-md w-full max-w-md">
    <h1 class="text-xl font-semibold mb-4">Domain Sıra Sorgulama</h1>

    @if($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('serp.rank') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">Domain (URL)</label>
            <input type="url" name="domain" value="{{ old('domain', $domain ?? '') }}"
                   class="w-full border rounded px-3 py-2" placeholder="https://example.com">
        </div>
        <div>
            <label class="block mb-1">Anahtar Kelime</label>
            <input type="text" name="keyword" value="{{ old('keyword', $keyword ?? '') }}"
                   class="w-full border rounded px-3 py-2" placeholder="ör. laravel tutorial">
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Sorgula</button>
        <input type="hidden" name="timezone" id="timezone">
    </form>

    @isset($rank)
        <div class="mt-6 p-4 bg-green-100 rounded">
            @if($rank)
                “{{ $domain }}” domaini için “{{ $keyword }}” anahtar kelimesi Google’da **#{{ $rank }}**’ncı sırada.
            @else
                “{{ $domain }}” domaini için “{{ $keyword }}” anahtar kelimesi ilk 100 sonuç arasında bulunamadı.
            @endif
        </div>
    @endisset
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () { <!--Tarayıcıdan Timezone almak için yazıldı.-->
        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        document.getElementById('timezone').value = timezone;
    });
</script>
</body>
</html>
