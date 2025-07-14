<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin | Home</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>
<body class="relative bg-white">

    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 flex items-center justify-center z-50 transition-opacity duration-500 bg-white">
        <div class="w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
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
        }, 1000); // 1 seconds minimum

        function hidePreloader() {
            if (pageLoaded && timerDone) {
                const preloader = document.getElementById('preloader');
                if (preloader) {
                    preloader.classList.add('opacity-0', 'pointer-events-none');
                    setTimeout(() => preloader.remove(), 500); // After fade-out transition
                }
            }
        }
    </script>

</body>
</html>
