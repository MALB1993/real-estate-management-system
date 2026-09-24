@extends('layouts.app')

@section('title', __('messages.home'))

@section('content')

    <div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-6">
            {{ __('messages.system_name') }}
        </h1>

        <div x-data="{ open: false }">

            <button
                @click="open = !open"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg"
            >
                {{ __('messages.home') }}
            </button>

            <div
                x-show="open"
                class="mt-4 p-4 bg-green-100 rounded-lg"
            >
                {{ __('messages.frontend_ready') }}
            </div>

        </div>

    </div>

@endsection