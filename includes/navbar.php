<nav class="bg-white shadow-sm sticky top-0 z-50">

    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">

        <!-- Logo -->
        <a href="index.php" class="flex items-center gap-3 text-xl md:text-2xl font-bold text-blue-600">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="w-8 h-8">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 21h16.5M5.25 21V7.5A2.25 2.25 0 017.5 5.25h9A2.25 2.25 0 0118.75 7.5V21M9 9h.008v.008H9V9zm0 3h.008v.008H9V12zm0 3h.008v.008H9V15zm6-6h.008v.008H15V9zm0 3h.008v.008H15V12zm0 3h.008v.008H15V15z"/>

            </svg>

            Hotel Reservation

        </a>

        <!-- Menu Desktop -->
        <div class="hidden md:flex items-center space-x-6">

            <a href="index.php" class="text-gray-700 hover:text-blue-600">
                Home
            </a>

            <a href="#kamar" class="text-gray-700 hover:text-blue-600">
                Kamar
            </a>

            <a href="tentang.php" class="text-gray-700 hover:text-blue-600">
                Tentang
            </a>

            <a href="login.php"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">

                Login

            </a>

        </div>

        <!-- Hamburger -->
        <button id="menuBtn" class="md:hidden">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-8 h-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"/>

            </svg>

        </button>

    </div>

</nav>

<!-- Overlay -->
<div id="overlay"
    class="fixed inset-0 bg-black/40 hidden z-40"></div>

<!-- Sidebar Mobile -->
<div id="mobileMenu"
    class="fixed top-0 right-0 h-full w-72 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-50">

    <div class="flex justify-between items-center p-5 border-b">

        <h2 class="text-lg font-bold">
            Menu
        </h2>

        <button id="closeBtn">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-7 h-7"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"/>

            </svg>

        </button>

    </div>

    <div class="flex flex-col p-6 space-y-5">

        <a href="index.php">Home</a>

        <a href="#kamar">Kamar</a>

        <a href="tentang.php">Tentang</a>

        <a href="login.php"
            class="bg-blue-600 text-white text-center py-3 rounded-lg">

            Login

        </a>

    </div>

</div>

<script>

const menu = document.getElementById('mobileMenu');
const overlay = document.getElementById('overlay');

document.getElementById('menuBtn').onclick = function () {
    menu.classList.remove('translate-x-full');
    overlay.classList.remove('hidden');
}

document.getElementById('closeBtn').onclick = closeMenu;
overlay.onclick = closeMenu;

function closeMenu() {
    menu.classList.add('translate-x-full');
    overlay.classList.add('hidden');
}

</script>