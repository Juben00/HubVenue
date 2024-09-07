<nav class="bg-neutral-800 text-neutral-100 shadow-xl ">
    <div class="container mx-auto px-8 flex items-center justify-between ">
        <!-- Logo -->
        <a href="#" class="flex items-center">
            <img src="../public/images/white_transparent (1).ico" alt="Logo" class="h-24">
        </a>

        <!-- Hamburger Icon (visible on small screens) -->
        <button id="menu-toggle"
            class="block lg:hidden p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <!-- Links (hidden on small screens, visible on larger screens) -->
        <ul class="hidden lg:flex space-x-4">
            <li><a href="#" class="hover:underline hover:underline-offset-2">Services</a></li>
            <li><a href="#" class="hover:underline hover:underline-offset-2">About</a></li>
            <li><a href="#" class="hover:underline hover:underline-offset-2">Contact</a></li>
            <li><a href="logout.php" class="hover:underline hover:underline-offset-2">Logout</a></li>
        </ul>

        <!-- Mobile Menu (hidden by default, shown when the hamburger icon is clicked) -->
        <ul id="mobile-menu"
            class="hidden flex-col space-y-2 bg-neutral-800 p-4 z-50 absolute top-16 left-0 right-0 lg:hidden text-center">
            <li><a href="#" class="block py-2 hover:underline hover:underline-offset-2">Services</a></li>
            <li><a href="#" class="block py-2 hover:underline hover:underline-offset-2">About</a></li>
            <li><a href="#" class="block py-2 hover:underline hover:underline-offset-2">Contact</a></li>
            <li><a href="logout.php" class="block py-2 hover:underline hover:underline-offset-2">Logout</a></li>
        </ul>
    </div>
</nav>

<script>
    // JavaScript to toggle the mobile menu
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>