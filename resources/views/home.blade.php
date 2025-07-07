<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Domain Sıralama Kontrol</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <!-- El yazısı fontu -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet"/>
    <style>
        .font-handwriting { font-family: 'Dancing Script', cursive; }

        /* Gradient arkaplan: koyu lacivert → orta mavi → açık mavi */
        body {
            background: linear-gradient(
                135deg,
                #0d1117 0%,
                #22303c 50%,
                #4b6eaf 100%
            );
        }

        /* particles.js canvas */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -10;
        }
    </style>
</head>
<body class="relative min-h-screen overflow-hidden">

<!-- Particles.js container -->
<div id="particles-js"></div>

<!-- Kart container -->
<div x-data="wizard()"
     class="relative bg-white bg-opacity-80 backdrop-blur-md rounded-2xl shadow-xl
              p-8 py-12 w-full max-w-md md:max-w-lg lg:max-w-xl mx-auto mt-20 mb-20"
>
    <div class="text-gray-800 mb-4 text-center">
        <div class="text-sm">Step <span x-text="step"></span> / <span x-text="total"></span></div>
        <h1 class="text-2xl font-semibold mt-1" x-text="questions[step-1]"></h1>
    </div>
    <input
        type="text"
        x-model="answers[step-1]"
        :placeholder="placeholders[step-1]"
        class="w-full text-lg font-handwriting border-b-2 border-gray-400
             focus:outline-none focus:border-indigo-500 px-2 py-1 mb-6"
    />
    <div class="text-center">
        <button
            @click="next()"
            :disabled="loading"
            class="inline-flex items-center bg-indigo-600 text-white px-6 py-2
               rounded-full shadow hover:bg-indigo-700 transition disabled:opacity-50"
        >
            <span x-show="!loading" x-text="step < total ? 'Next →' : 'Submit'"></span>
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: "#ffffff" },
                shape: { type: "circle", stroke: { width: 0 } },
                opacity: { value: 0.7, anim: { enable: true, speed: 1, opacity_min: 0.2 } },
                size: { value: 4, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#89a6c9",
                    opacity: 0.5,
                    width: 1
                },
                move: { enable: true, speed: 2, direction: "none", out_mode: "bounce" }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: { enable: true, mode: "grab" },
                    onclick: { enable: true, mode: "push" }
                },
                modes: {
                    grab: { distance: 200, line_linked: { opacity: 0.6 } },
                    push: { particles_nb: 4 }
                }
            },
            retina_detect: true
        });
    });

    function wizard() {
        return {
            step: 1,
            total: 2,
            loading: false,
            questions: [
                "What's your domain?",
                "What's your keyword?"
            ],
            placeholders: [
                "example.com",
                "laravel tutorial"
            ],
            answers: ["",""],
            next() {
                if (this.step < this.total) {
                    this.loading = true;
                    setTimeout(() => { this.loading = false; this.step++ }, 300);
                } else {
                    console.log("Gönderiliyor:", this.answers);
                }
            }
        }
    }
</script>
</body>
</html>
