<x-guest-layout>
    <div class="flex min-h-screen flex-col md:flex-row">
        <!-- Left Blue Section -->
        <div
             class="flex w-full flex-col items-center justify-center bg-gradient-to-br from-blue-900 to-blue-700 p-10 text-white md:w-1/2">
            <h2 class="mb-6 text-3xl font-semibold tracking-wide">E-Bursary</h2>

            <div class="flex w-56 items-center justify-center rounded-xl bg-white p-4 shadow-lg">
                <img src="{{ asset('assets/images/nictm_logo.png') }}"
                     alt="NICTM Logo"
                     class="h-20 object-contain">
            </div>

            <h3 class="mt-6 text-2xl font-medium">Forgot Password?</h3>
            <p class="mt-2 max-w-sm text-center text-sm text-gray-200">
                No worries — reset your password easily and regain access to your account.
            </p>
        </div>

        <!-- Right White Section -->
        <div class="flex w-full items-center justify-center bg-gray-50 md:w-1/2">
            <div class="mx-4 my-10 w-full max-w-md rounded-2xl bg-white p-10 shadow-lg md:my-0">

                <!-- Page Info -->
                <h2 class="mb-2 text-center text-2xl font-bold text-gray-800">
                    Reset Your Password
                </h2>
                <p class="mb-6 text-center text-sm text-gray-500">
                    Enter your email address and we’ll send you a link to reset your password.
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4"
                                       :status="session('status')" />

                <!-- Form -->
                <form method="POST"
                      action="{{ route('password.email') }}"
                      class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email"
                               class="mb-1 block text-sm font-medium text-gray-700">Email Address</label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               class="block w-full rounded-lg border border-gray-300 py-2.5 pl-3 text-gray-900 placeholder-gray-400 focus:border-blue-700 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                               placeholder="Enter your registered email">
                        <x-input-error :messages="$errors->get('email')"
                                       class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit"
                                class="w-full rounded-lg bg-blue-900 px-4 py-2.5 font-semibold text-white transition-all duration-200 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            Email Password Reset Link
                        </button>
                    </div>

                    <!-- Back to Login -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('login') }}"
                           class="text-sm text-blue-700 hover:underline">
                            Back to Login
                        </a>
                    </div>
                </form>

                <!-- Footer -->
                <p class="mt-8 text-center text-sm text-gray-500">
                    © {{ date('Y') }} NICTM. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
