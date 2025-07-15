<!DOCTYPE html>
<html lang="en" x-data>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Admin | Home</title>

    <!-- Tailwind CSS via Vite -->
    @vite('resources/css/app.css')

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="relative bg-white">

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 flex items-center justify-center bg-white z-50 transition-opacity duration-500">
        <div class="flex space-x-2">
            <div class="w-4 h-4 bg-indigo-600 rounded-full animate-bounce"></div>
            <div class="w-4 h-4 bg-indigo-600 rounded-full animate-bounce delay-150"></div>
            <div class="w-4 h-4 bg-indigo-600 rounded-full animate-bounce delay-300"></div>
        </div>
    </div>

    <!-- Preloader Script -->
    <script>
        let pageLoaded = false;
        let timerDone = false;

        window.addEventListener('load', () => {
            pageLoaded = true;
            hidePreloader();
        });

        setTimeout(() => {
            timerDone = true;
            hidePreloader();
        }, 1000); // 1 second minimum

        function hidePreloader() {
            if (pageLoaded && timerDone) {
                const preloader = document.getElementById('preloader');
                if (preloader) {
                    preloader.classList.add('opacity-0', 'pointer-events-none');
                    setTimeout(() => preloader.remove(), 500); // fade out
                }
            }
        }
    </script>

</body>
</html>
