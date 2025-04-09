<!-- Navbar Component (resources/views/components/navbar.blade.php) -->



<nav class="bg-white shadow-md py-4">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">

            <a href="/" class="flex items-center">
                <span class="text-2xl font-bold text-primary">med<span class="text-gray-800">Xpert</span></span>
            </a>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-button text-gray-500 hover:text-primary focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{route('home')}}" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
                <a href="{{route('doc')}}" class="text-gray-700 hover:text-blue-600 font-medium">Find Doctors</a>
                <a href="{{route('about')}}" class="text-gray-700 hover:text-blue-600 font-medium">About Us</a>
                <a href="{{route('contact')}}" class="text-gray-700 hover:text-blue-600 font-medium">Contact</a>
            </div>

            <!-- Login/Register Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{route('login')}}" class="px-4 py-2 text-primary font-medium hover:text-primary-dark transition-colors duration-200">Login</a>
                <a href="{{route('register')}}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors duration-200 font-medium shadow-md">Register</a>
                <form action="{{route('logout')}}" method="get"></form>
                <a href="" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors duration-200 font-medium shadow-md">logout</a>
            </div>
        </div>

        <!-- Mobile Menu (hidden by default) -->
        <div class="mobile-menu hidden flex-col mt-4 md:hidden">
            <a href="{{route('home')}}" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
            <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Find Doctors</a>
            <a href="{{route('about')}}" class="text-gray-700 hover:text-blue-600 font-medium">About Us</a>
            <a href="{{route('contact')}}" class="text-gray-700 hover:text-blue-600 font-medium">Contact</a>
            <div class="flex flex-col space-y-2 mt-3 pt-3 border-t border-gray-200">
                <a href="#" class="py-2 text-primary font-medium">Login</a>
                <a href="#" class="py-2 bg-primary text-white rounded-lg text-center">Register</a>
            </div>
        </div>
    </div>
</nav>