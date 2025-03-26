<x-newheader>
    <!-- Sign-Up Form Section -->
    <section
        style="padding-top: 48px; font-family: 'Poppins', Arial, sans-serif; background-color: #fff9e6; padding-bottom: 48px;">
        <div style="max-width: 500px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 12px; color: #000;">CREATE AN ACCOUNT</h2>
            <p style="font-size: 16px; margin-bottom: 24px; color: #333;">Join Pup&Purr for exclusive offers and
                tailored services for your pets.</p>
            <form id="signupForm" action="{{route('register')}}" method="POST"
                  style="border: 1px solid #4B7C47; padding: 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                @csrf

                <!-- Name box -->
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="name"
                           style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;"></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name*"
                           value="{{ old('name') }}" style="width: 100%;" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email box -->
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="email"
                           style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;"></label>
                    <input type="email" id="email" class="form-control" name="email" placeholder="Email*"
                           value="{{ old('email') }}" style="width: 100%;" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone box  -->
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="phone"
                           style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;"></label>
                    <input type="text" id="phone" class="form-control" name="phone" placeholder="Phone Number"
                           value="{{ old('phone') }}" style="width: 100%;">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Address box -->
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="address"
                           style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;"></label>
                    <input type="text" id="address" class="form-control" name="address" placeholder="Address*"
                           value="{{ old('address') }}" style="width: 100%;" required>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Password box -->
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="password"
                           style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;"></label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password*"
                           style="width: 100%;" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password box -->
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="password_confirmation"
                           style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;"></label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                           placeholder="Confirm Password*" style="width: 100%;" required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Terms and Privacy Policy Checkbox -->
                <div style="margin-bottom: 16px; text-align: left;">
                    <label style="font-size: 14px; color: #000;">
                        <input type="checkbox" name="terms" {{ old('terms') ? 'checked' : '' }}>
                        I agree to the
                        <a href="{{ route('terms') }}" target="_blank" style="color: #426b1f;">Terms of Service</a> and
                        <a href="{{ route('privacy') }}" target="_blank" style="color: #426b1f;">Privacy Policy</a>
                    </label>
                    <x-input-error :messages="$errors->get('terms')" class="mt-2" />
                </div>


                <button type="submit" class="filter-btn" style="width: 100%;">Sign Up</button>
            </form>
            <p style="margin-top: 16px; font-size: 14px; color: #000;">Already have an account? <a
                    href="{{route('loginpage')}}" style="color: #426b1f; text-decoration: none;">Log in here.</a></p>
        </div>
    </section>

    <!-- Include Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        document.getElementById('signupForm').addEventListener('submit', function (event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const errorMessage = document.getElementById('error-message');

            if (password !== confirmPassword) {
                errorMessage.style.display = 'block';
                event.preventDefault(); // Prevent form submission
            } else {
                errorMessage.style.display = 'none';
            }
        });
    </script>
    @include('components.newcompactfooter')
</x-newheader>
