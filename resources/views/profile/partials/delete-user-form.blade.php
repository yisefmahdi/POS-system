<section>
    <header>
        <h2 class="text-xl font-semibold text-gray-800">
            Account verwijderen
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            Zodra uw account wordt verwijderd, worden alle bijbehorende gegevens en resources permanent verwijderd.
            Download eventuele gegevens of informatie die u wilt behouden voordat u uw account verwijdert.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white rounded-xl px-4 py-2"
    >
        Account verwijderen
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Weet u zeker dat u uw account wilt verwijderen?
            </h2>

            <p class="text-sm text-gray-600">
                Zodra uw account wordt verwijderd, worden alle gegevens en resources permanent verwijderd.
                Voer uw wachtwoord in om te bevestigen dat u uw account permanent wilt verwijderen.
            </p>

            <div class="mt-4">
                <x-input-label for="password" value="Wachtwoord" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-500 focus:outline-none"
                    placeholder="Wachtwoord"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Annuleren
                </x-secondary-button>

                <x-danger-button class="bg-red-600 hover:bg-red-700 text-white rounded-xl px-4 py-2">
                    Account verwijderen
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
