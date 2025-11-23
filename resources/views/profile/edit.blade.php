@extends('layouts.app')
@section('title', 'Profiel')
@section('content')


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mb-[20px]">
        <!-- Update Profile Information -->
        <div class="bg-white shadow-md rounded-xl p-6 md:p-8">
            <div class="space-y-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="bg-white shadow-md rounded-xl p-6 md:p-8">
            <div class="space-y-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete User -->
        <div class="bg-white shadow-md rounded-xl p-6 md:p-8 ">
            <div class="space-y-4 ">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>

@endsection
