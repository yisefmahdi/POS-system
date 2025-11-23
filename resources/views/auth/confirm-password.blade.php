<!DOCTYPE html>
<html lang="nl" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bevestig Wachtwoord - POS Systeem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-5xl bg-white md:rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <!-- Left Side: Image + Branding -->
        <div class="flex flex-col items-center justify-center bg-indigo-600 text-white p-6 md:p-10 md:order-2">
            <img src="https://cdn-icons-png.flaticon.com/512/3082/3082383.png" class="w-32 md:w-40 mb-4 md:mb-6 opacity-90" />
            <h2 class="text-3xl md:text-4xl font-bold mb-2 md:mb-3 text-center">POS Management</h2>
            <p class="text-center text-base md:text-lg max-w-xs md:max-w-sm opacity-80 leading-relaxed">
                Modern POS-systeem voor voorraad, verkoop en facturering, eenvoudig en efficiënt te gebruiken.
            </p>
        </div>

        <!-- Right Side: Confirm Password Form -->
        <div class="flex flex-col justify-center w-full md:p-10">
            <div class="w-full md:max-w-md mx-auto p-6 md:p-0">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center">Bevestig Wachtwoord</h2>

                <div class="mb-4 text-sm text-gray-600">
                    Dit is een beveiligd gebied van de applicatie. Bevestig uw wachtwoord voordat u verdergaat.
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                    @csrf

                    <!-- Password -->
                    <div>
                        <label class="block mb-1 text-gray-600">Wachtwoord</label>
                        <input id="password" class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                               type="password" name="password" required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl text-lg font-semibold transition">
                        Bevestigen
                    </button>
                </form>
            </div>
        </div>

    </div>

</body>
</html>
