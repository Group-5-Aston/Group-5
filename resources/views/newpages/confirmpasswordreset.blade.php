<x-newheader>
    <section style="padding-top: 48px; font-family: 'Poppins', Arial, sans-serif; background-color: #ffefbe6; padding-bottom: 48px;">
        <div style="max-width: 400px; margin: 0 auto; text-align: center;">
            <!-- Password Reset Form -->
            <form action="{{ route('password.store') }}" method="POST" style="border: 1px solid #4B7C47; padding: 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="email" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$request->email}}" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="password" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="password_confirmation" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Confirm Password</label>
                    <input type="password" class="form-control" id=password_confirmation" name="password_confirmation" required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <button type="submit" style="width: 100%" class="filter-btn">
                    Reset Password
                </button>
            </form>
        </div>
    </section>

    <!-- Include Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    @include('components.newcompactfooter')
</x-newheader>
