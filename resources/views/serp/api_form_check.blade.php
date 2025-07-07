<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Ranking Checker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0f1115;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .lamp {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 80px;
        }

        .lamp::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 40px;
            background: #444;
        }

        .lamp::after {
            content: "";
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 20px;
            background: #222;
            border-radius: 50% 50% 0 0;
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.05);
        }

        .container-box {
            background: #1a1c22;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 0 60px rgba(0, 255, 170, 0.05);
            width: 100%;
            max-width: 700px;
            margin: 100px auto 0;
            position: relative;
        }

        h2 {
            font-weight: 300;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .form-control {
            background-color: #101215;
            border: 1px solid #444;
            color: #fff;
        }

        .form-control::placeholder {
            color: #777;
        }

        .btn-check {
            background-color: #00ffaa;
            color: #000;
            font-weight: bold;
            border: none;
        }

        .btn-check:hover {
            background-color: #00e69d;
        }

        .result-card {
            background: #121417;
            border-radius: 12px;
            border: 1px solid #00ffaa22;
            padding: 30px;
            min-width: 200px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 255, 170, 0.05);
        }

        .neon-result {
            font-size: 40px;
            color: #00ffaa;
            text-shadow: 0 0 8px #00ffaa, 0 0 16px #00ffaa;
        }

        .neon-arrow {
            font-size: 24px;
            color: #00ffaa;
            margin-top: 10px;
            text-shadow: 0 0 6px #00ffaa;
        }
    </style>
</head>
<body>
<div class="lamp"></div>
<div class="container-box text-center">
    <h2>Search Ranking Checker</h2>
    <div class="row justify-content-center g-4">
        <div class="col-md-5">
            <input type="text" id="domain" class="form-control mb-3" placeholder="example.com">
            <input type="text" id="keyword" class="form-control mb-3" placeholder="search tool">
            <button class="btn btn-check w-100" onclick="getPosition()">CHECK</button>
        </div>
        <div class="col-md-4 d-flex align-items-center justify-content-center">
            <div class="result-card">
                <div class="text-muted">RESULT</div>
                <div id="rankOutput" class="neon-result">—</div>
                <div class="neon-arrow">↑</div>
            </div>
        </div>
    </div>
</div>

<script>
    function getPosition() {
        const domain = document.getElementById('domain').value;
        const keyword = document.getElementById('keyword').value;

        // Simüle edilen demo veri — gerçek API'ye entegre edilecek
        document.getElementById('rankOutput').innerText = '5';
    }
</script>
</body>
</html>
