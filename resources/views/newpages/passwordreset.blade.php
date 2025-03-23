<x-newheader>
    <section style="padding-top: 48px; font-family: 'Poppins', Arial, sans-serif; background-color: #ffefbe6; padding-bottom: 48px;">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div style="max-width: 400px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 12px; color: #000;">RESET PASSWORD</h2>
            <p style="font-size: 16px; margin-bottom: 24px; color: #333;">Enter your email to reset your password.</p>

            <!-- Password Reset Form -->
            <form action="{{ route('password.email') }}" method="POST" style="border: 1px solid #4B7C47; padding: 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                @csrf
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="email" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <button type="submit" style="width: 100%" class="filter-btn">
                    Send Reset Link
                </button>
            </form>

            <p style="margin-top: 16px; font-size: 14px; color: #000;">
                <a href="{{ route('login') }}" style="color: #426b1f; text-decoration: none;">Back to Login</a>
            </p>
        </div>
    </section>
    @include('components.newcompactfooter')
</x-newheader>
