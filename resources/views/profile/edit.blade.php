@extends('layouts.admin')

@section('page_title', 'Account Settings')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Update Profile Info Card -->
    <div class="p-6 sm:p-8 bg-white rounded-2xl shadow border border-slate-100">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Update Password Card -->
    <div class="p-6 sm:p-8 bg-white rounded-2xl shadow border border-slate-100">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete Account Card -->
    <div class="p-6 sm:p-8 bg-white rounded-2xl shadow border border-slate-100">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
