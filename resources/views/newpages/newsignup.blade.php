<x-newheader>
    <!-- Sign-Up Form Section -->
    <section style="padding-top: 48px; font-family: 'Poppins', Arial, sans-serif; background-color: #fff9e6; padding-bottom: 48px;">
        <div style="max-width: 500px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 12px; color: #000;">CREATE AN ACCOUNT</h2>
            <p style="font-size: 16px; margin-bottom: 24px; color: #333;">Join Pup&Purr for exclusive offers and tailored services for your pets.</p>
            <form id="signupForm" action="/register" method="POST" style="background-color: #ffffff; padding: 24px; border-radius: 8px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="fullName" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Full Name</label>
                    <input type="text" id="fullName" name="fullName" placeholder="Full Name" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" required>
                </div>
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="email" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" required>
                </div>
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="password" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" required>
                </div>
                <div style="margin-bottom: 16px; text-align: left;">
                    <label for="confirmPassword" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block; color: #000;">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;" required>
                </div>
                <button type="submit" style="width: 100%; padding: 12px; background-color: #426b1f; color: #ffffff; border: none; border-radius: 4px; font-size: 16px; font-weight: 600; cursor: pointer;">Sign Up</button>
            </form>
            <p style="margin-top: 16px; font-size: 14px; color: #000;">Already have an account? <a href="{{route('loginpage')}}" style="color: #426b1f; text-decoration: none;">Log in here.</a></p>
        </div>
    </section>

    <!-- Include Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(event) {
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
