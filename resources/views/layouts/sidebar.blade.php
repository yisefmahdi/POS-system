    <aside id="sidebar"
        class="fixed top-16 left-0 h-full w-60 bg-white shadow-lg py-6 px-4 transform transition-all duration-300 md:translate-x-0 -translate-x-full z-40">

        <ul class="space-y-3">
            <li>
                <a href="/" class="block px-3 py-2 rounded-lg hover:bg-gray-100">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100">
                    Categorieën
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100">Producten</a>
            </li>
            <li>
                <a href="{{ route('discount-codes.index') }}" class="block px-3 py-2 rounded-lg hover:bg-gray-100">
                    Discount Codes
                </a>
            </li>
            <li>
                <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100">Klanten</a>
            </li>
            <li>
                <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100">Rapporten</a>
            </li>
            <li>
                <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100">Instellingen</a>
            </li>
        </ul>

    </aside>
