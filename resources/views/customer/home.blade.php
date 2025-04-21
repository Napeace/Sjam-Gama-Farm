<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <title>Home</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .carousel-caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-align: center;
            font-size: 2rem;
        }

        .carousel-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .carousel-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="h-screen overflow-hidden">

    <div id="default-carousel" class="relative w-full h-screen" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-full overflow-hidden rounded-none">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://asset.kompas.com/crops/pwHQ8C7LuHZkioyRQuYhxP8oUio=/107x156:834x640/1200x800/data/photo/2022/09/29/63354297c3995.jpg"
                     class="absolute w-full h-full object-cover top-0 left-0" alt="Hidroponik">
                <div class="carousel-caption">
                    <h3>Hidroponik</h3>
                    <p>Pelajari lebih lanjut tentang hidroponik.</p>
                    <button class="carousel-button">Learn More</button>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://atonergi.com/wp-content/uploads/2023/04/biogas-2919235__340.jpg"
                     class="absolute w-full h-full object-cover top-0 left-0" alt="Biogas">
                <div class="carousel-caption">
                    <h3>Biogas</h3>
                    <p>Temukan potensi energi dari biogas.</p>
                    <button class="carousel-button">Learn More</button>
                </div>
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBp7gzRQ2ZQSPcPF1kuJjTRBHSj6Ev5etD7w&s"
                     class="absolute w-full h-full object-cover top-0 left-0" alt="Peternakan">
                <div class="carousel-caption">
                    <h3>Peternakan</h3>
                    <p>Pelajari tentang peternakan modern.</p>
                    <button class="carousel-button">Learn More</button>
                </div>
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://distan.bulelengkab.go.id/uploads/konten/90_yuk-belajar-mengenal-pupuk.jpg"
                     class="absolute w-full h-full object-cover top-0 left-0" alt="Pupuk">
                <div class="carousel-caption">
                    <h3>Pupuk</h3>
                    <p>Kenali jenis pupuk yang efektif.</p>
                    <button class="carousel-button">Learn More</button>
                </div>
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://asset-a.grid.id//crop/0x0:0x0/700x465/photo/2021/11/23/jenis-perikanan-di-indonesiajpg-20211123100904.jpg"
                     class="absolute w-full h-full object-cover top-0 left-0" alt="Perikanan">
                <div class="carousel-caption">
                    <h3>Perikanan</h3>
                    <p>Explore peluang dalam perikanan.</p>
                    <button class="carousel-button">Learn More</button>
                </div>
            </div>
            <!-- Item 6 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://s3-publishing-cmn-svc-prd.s3.ap-southeast-1.amazonaws.com/article/L_0LCFtvHjXicJvX6F9rv/original/003102700_1525316788-5-Buah-Ini-Harus-Ada-dalam-Menu-Harian-Anda-By-Alexander-Raths-shutterstock.jpg"
                     class="absolute w-full h-full object-cover top-0 left-0" alt="Buah-Buahan">
                <div class="carousel-caption">
                    <h3>Buah-Buahan</h3>
                    <p>Manfaatkan buah-buahan untuk hidup sehat.</p>
                    <button class="carousel-button">Learn More</button>
                </div>
            </div>
        </div>

        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white" aria-current="false" aria-label="Slide 6" data-carousel-slide-to="5"></button>
        </div>

        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
            </span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
