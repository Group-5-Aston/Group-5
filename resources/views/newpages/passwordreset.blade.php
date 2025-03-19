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
            <form action="{{ route('password.email') }}" method="POST" style="background-color: #ffffff; padding: 24px; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
                @csrf
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="email" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <button type="submit" style="width: 100%; padding: 12px; background-color: #426b1f; color: #ffffff; border: none; border-radius: 4px; font-size: 16px; font-weight: 600; cursor: pointer;">
                    Send Reset Link
                </button>
            </form>

            <p style="margin-top: 16px; font-size: 14px; color: #000;">
                <a href="{{ route('login') }}" style="color: #426b1f; text-decoration: none;">Back to Login</a>
            </p>
        </div>
    </section>

    <!-- Include Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    @include('components.newcompactfooter')
</x-newheader>
