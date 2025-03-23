<x-newheader>
    <section
        style="font-family: 'Poppins', Arial, sans-serif; background-color: #ffefbe6; padding-bottom: 48px;">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div style="max-width: 400px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 12px; color: #000;">LOG IN</h2>
            <p style="font-size: 16px; margin-bottom: 24px; color: #333;">Access your account to explore exclusive
                offers and manage your orders.</p>
            <form action="{{ route('login') }}" method="POST"
                style="border: 1px solid #4B7C47; padding: 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                @csrf
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="email"
                        style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="password"
                        style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <span id="togglePassword"
                        style="font-size: 12px; color: #426b1f; cursor: pointer; display: block; margin-top: 6px;">Show</span>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div style="margin-bottom: 16px; text-align: left;">
                    <label>
                        <input type="checkbox" id="remember_me" name="remember" style="margin-right: 6px;"> Keep me
                        logged in
                    </label>
                </div>
                <button type="submit" class="filter-btn"
                    style="width: 100%">Log
                    in</button>
            </form>
            <p style="margin-top: 16px; font-size: 14px; color: #000;">
                <a href="{{ route('password.request') }}" style="color: #426b1f; text-decoration: none;">Forgot password?</a>
            </p>
            <p style="margin-top: 16px; font-size: 14px; color: #000;">Don't have an account? <a
                    href="{{ route('signup') }}" style="color: #426b1f; text-decoration: none;">Sign up here.</a></p>
        </div>
    </section>

    <!-- Include Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- JavaScript for Show/Hide Password -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        togglePassword.addEventListener('click', () => {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                togglePassword.textContent = 'Hide';
            } else {
                passwordField.type = 'password';
                togglePassword.textContent = 'Show';
            }
        });
    </script>
    @include('components.newcompactfooter')
</x-newheader>
