<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sıralama Yükseltici</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at 0% 100%, rgba(150, 0, 255, 0.12), transparent 40%),
                radial-gradient(circle at 100% 100%, rgba(0, 100, 255, 0.15), transparent 40%),
                #05071a;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow: hidden;
            position: relative;
        }

        .container {
            max-width: 980px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 5rem;

        }

        .left-column {
            flex-basis: 55%;
            z-index: 2;
        }

        h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.25;
            color: #ffffff;
        }

        p.subtitle {
            font-size: 1.125rem;
            margin-bottom: 2.5rem;
            color: #aeb9e1;
            max-width: 400px;
        }

        .rank-checker-form {
            background: rgba(33, 41, 70, 0.2);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            padding: 1.75rem;
            border-radius: 18px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .inputs-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #828ca9;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem 1rem;
            background: rgba(16, 21, 45, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: white;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
        }

        .form-group input:focus {
            outline: none;
            border-color: rgba(125, 211, 252, 0.5);
        }

        button.check-button {
            width: 100%;
            margin-top: 1.5rem;
            padding: 1rem;
            background: #172433;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button.check-button:hover {
            background: #213647;
        }

        .right-column {
            position: relative;
        }

        .result-box {
            background: rgba(33, 41, 70, 0.25);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            padding: 2.5rem 3.5rem;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
        }

        .result-box .rank {
            font-size: 3.5rem;
            font-weight: 700;
            color: #7dd3fc;
            line-height: 1;
        }

        .result-box .rank sup {
            font-size: 2rem;
            font-weight: 600;
            vertical-align: super;
            margin-left: -0.25em;
        }

        .result-box .on-google {
            color: #aeb9e1;
            margin-top: 0.75rem;
            font-size: 1.125rem;
        }

        .timeline-line {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: -100vh;       /* 100vh kadar yukarı taşı */
            height: 200vh;     /* toplamda +100vh→−100vh = 200vh boyunda */
            width: 1px;
            background: linear-gradient(to bottom, rgba(255,255,255,0.3), transparent);
            z-index: -1;
        }


        .timeline-line::after {
            content: '';
            position: absolute;
            top: calc(50% - 100px);
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 15px 2px rgba(255, 255, 255, 0.4);
        }

        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                gap: 3rem;
                text-align: center;
            }
            .left-column {
                display: flex;
                flex-direction: column;
                align-items: center;
                flex-basis: auto;
            }
            .timeline-line {
                display: none;
            }
        }

        @media (max-width: 500px) {
            .inputs-wrapper {
                grid-template-columns: 1fr;
            }
            h1 {
                font-size: 2.2rem;
            }
            p.subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="left-column">
        <h1>Elevate Your Search Rankings</h1>
        <p class="subtitle">Instantly check your keyword position on Google.</p>

        <form class="rank-checker-form">
            <div class="inputs-wrapper">
                <div class="form-group">
                    <label for="domain">DOMAIN</label>
                    <input type="text" id="domain" value="example.com" />
                </div>
                <div class="form-group">
                    <label for="keyword">KEYWORD</label>
                    <input type="text" id="keyword" value="prompt" />
                </div>
            </div>
            <button type="submit" class="check-button">Check position</button>
        </form>
    </div>

    <div class="right-column">
        <div class="result-box">
            <span class="rank">12 <sup>th</sup></span>
            <p class="on-google">on Google</p>
        </div>
        <div class="timeline-line"></div>
    </div>
</div>

<script>
    document.querySelector('.rank-checker-form').addEventListener('submit', function(e) {
        e.preventDefault();
    });
</script>
</body>
</html>
