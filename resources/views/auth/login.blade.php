<x-guest-layout>
    <div class="flex min-h-screen flex-col md:flex-row">
        <div
             class="flex w-full flex-col items-center justify-center bg-gradient-to-br from-blue-900 to-blue-700 p-10 text-white md:w-1/2">
            <h2 class="mb-6 text-3xl font-semibold tracking-wide">E-Bursary</h2>

            <div class="flex w-56 items-center justify-center rounded-xl bg-white p-4 shadow-lg">
                <img src="{{ asset('assets/images/nictm_logo.png') }}"
                     alt="NICTM Logo"
                     class="h-20 object-contain">
            </div>

            <h3 class="mt-6 text-2xl font-medium">Welcome Back</h3>
            <p class="mt-2 max-w-sm text-center text-sm text-gray-200">
                Access your E-Bursary portal and manage your records securely.
            </p>
        </div>

        <div class="flex w-full items-center justify-center bg-gray-50 md:w-1/2">
            <div class="mx-4 my-10 w-full max-w-md rounded-2xl bg-white p-10 shadow-lg md:my-0">

                <x-auth-session-status class="mb-4"
                                       :status="session('status')" />

                <h2 class="mb-2 text-center text-2xl font-bold text-gray-800">Login to Account</h2>
                <p class="mb-8 text-center text-sm text-gray-500">
                    Please sign in to your account
                </p>

                <form method="POST"
                      action="{{ route('login') }}"
                      class="space-y-6">
                    @csrf

                    <div>
                        <label for="email"
                               class="mb-1 block text-sm font-medium text-gray-700">
                            Email or Username
                        </label>
                        <div class="relative">
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   class="block w-full rounded-lg border border-gray-300 py-2.5 pl-3 pr-10 text-gray-900 placeholder-gray-400 focus:border-blue-700 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                   placeholder="Enter your email address">
                            {{-- <span class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.5">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M16 12H8m0 0l4-4m-4 4l4 4" />
                                </svg>
                            </span> --}}
                        </div>
                        <x-input-error :messages="$errors->get('email')"
                                       class="mt-2 text-sm text-red-600" />
                    </div>

                    <div>
                        <label for="password"
                               class="mb-1 block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="relative">
                            <input id="password"
                                   type="password"
                                   name="password"
                                   required
                                   class="block w-full rounded-lg border border-gray-300 py-2.5 pl-3 pr-10 text-gray-900 placeholder-gray-400 focus:border-blue-700 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                   placeholder="Enter your password">
                            {{-- <span class="absolute inset-y-0 right-3 flex cursor-pointer items-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.5">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 4.5C7.305 4.5 3.363 7.273 1.5 12c1.863 4.727 5.805 7.5 10.5 7.5s8.637-2.773 10.5-7.5C20.637 7.273 16.695 4.5 12 4.5z" />
                                    <circle cx="12"
                                            cy="12"
                                            r="3" />
                                </svg>
                            </span> --}}
                        </div>
                        <x-input-error :messages="$errors->get('password')"
                                       class="mt-2 text-sm text-red-600" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center text-sm text-gray-700">
                            <input id="remember_me"
                                   type="checkbox"
                                   name="remember"
                                   class="h-4 w-4 rounded border-gray-300 text-blue-700 focus:ring-blue-700">
                            <span class="ml-2">Remember Me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-sm text-blue-700 hover:underline">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full rounded-lg bg-blue-900 px-4 py-2.5 font-semibold text-white transition-all duration-200 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            Login to account
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-center text-sm text-gray-500">
                    © {{ date('Y') }} NICTM. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
