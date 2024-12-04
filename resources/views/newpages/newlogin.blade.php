<x-newheader>
    <section style="padding-top: 48px; font-family: 'Poppins', Arial, sans-serif; background-color: #fff9e6; padding-bottom: 48px;">
        <div style="max-width: 400px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 12px; color: #000;">LOG IN</h2>
            <p style="font-size: 16px; margin-bottom: 24px; color: #333;">Access your account to explore exclusive offers and manage your orders.</p>
            <form action="/login" method="POST" style="background-color: #ffffff; padding: 24px; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="email" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" required>
                </div>
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="password" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" required>
                    <span id="togglePassword" style="font-size: 12px; color: #426b1f; cursor: pointer; display: block; margin-top: 6px;">Show</span>
                </div>
                <div style="margin-bottom: 16px; text-align: left;">
                    <label>
                        <input type="checkbox" name="keep_logged_in" style="margin-right: 6px;"> Keep me logged in
                    </label>
                </div>
                <button type="submit" style="width: 100%; padding: 12px; background-color: #426b1f; color: #ffffff; border: none; border-radius: 4px; font-size: 16px; font-weight: 600; cursor: pointer;">Log in</button>
            </form>
            <p style="margin-top: 16px; font-size: 14px; color: #000;">
                <a href="" style="color: #426b1f; text-decoration: none;">Forgot username?</a> |
                <a href="" style="color: #426b1f; text-decoration: none;">Forgot password?</a>
            </p>
            <p style="margin-top: 16px; font-size: 14px; color: #000;">Don't have an account? <a href="{{ route('signup') }}" style="color: #426b1f; text-decoration: none;">Sign up here.</a></p>
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
