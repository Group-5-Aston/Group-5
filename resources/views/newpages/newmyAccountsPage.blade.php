<x-newheader>
    <head>
        <title>Account Settings</title>
        <style>
            * {
                margin: 0;
                padding: 30;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
            }

            body {
                overflow-x: hidden;
                background-color: #fefbe6;
            }

            :root {
                --primary-color: #426b1f;
                --primary-dark: #426b1f;
                --secondary-color: #fefbe6;
                --border-color: #ddd;
            }

            .container {
                display: flex;
                max-width: 100%;
                width: 900px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                margin: 0 auto;
                padding-top: 40px;
            }

            .sidebar {
                width: 250px;
                min-height: 100vh;
                background-color: rgb(255, 255, 255);
                padding: 20px;
            }

            .sidebar ul {
                list-style: none;
                padding: 0;
                color: #426b1f;
            }

            .sidebar ul li {
                padding: 12px;
                cursor: pointer;
                border-radius: 5px;
                transition: background 0.3s;
            }

            .sidebar ul li:hover, .sidebar ul li.active {
                background-color: var(--secondary-color);
            }

            .content {
                flex: 1;
                min-width: 500px;
                padding: 20px;
            }

            .hidden {
                display: none;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }

            .form-group input, select {
                width: 100%;
                padding: 10px;
                border: 1px solid var(--border-color);
                border-radius: 5px;
                display: block;
            }

            .profile-picture {
                text-align: center;
                margin-bottom: 20px;
            }

            .profile-picture img {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                object-fit: cover;
                cursor: pointer;
                border: 3px solid var(--primary-color);
            }

            .buttons {
                display: flex;
                justify-content: space-between;
                margin-top: 10px;
            }

            .save-btn, .delete-btn {
                padding: 10px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background 0.3s;
            }

            .save-btn {
                background-color: var(--primary-color);
                color: white;
            }

            .save-btn:hover {
                background-color: var(--primary-dark);
            }

            .delete-btn {
                background-color: red;
                color: white;
            }

            .delete-btn:hover {
                background-color: darkred;
            }

            .container.footer-container {
                background-color: transparent !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }

            @media (max-width: 900px) {
                .container {
                    flex-direction: column;
                    width: 100%;
                    max-width: 100%;
                }

                .sidebar {
                    width: 100%;
                    min-height: auto;
                    padding: 10px;
                }

                .content {
                    padding: 20px;
                }
            }

            #overlay {
                display: {{ $errors->userDeletion->has('password') ? 'block' : 'none' }};
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 9999;
            }

            #customPrompt {
                display: {{ $errors->userDeletion->has('password') ? 'block' : 'none' }};
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: white;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>

    <body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li onclick="showSection(event, 'profile')" class="active">Profile</li>
                <li onclick="showSection(event, 'account-payment')">Account & Payment</li>
                <li onclick="showSection(event, 'security')">Security</li>
            </ul>
        </div>

        <div class="content">
            <!-- Profile Section -->
            <div id="profile" class="section">

                <h2>Profile</h2>

                <x-alert type="success" :message="session('success')"/>
                <x-alert type="error" :message="session('error')"/>

                <form method="POST" action="{{route('profile.edit')}}">
                    @csrf
                    @method('PATCH')
                    <!--
                    <div class="profile-picture">
                        <img id="profile-img" src="account.png" alt="Profile Picture">
                        <input type="file" id="profile-upload" name="profile-upload" class="hidden-input" accept="image/*">
                    </div>
                    -->
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="name" value="{{$user->name}}">
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" value="Example">
                    </div>
                    -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{$user->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="{{$user->address}}">
                    </div>
                    <div class="buttons">
                        <button type="submit" class="save-btn">Save</button>
                    </div>
                </form>
            </div>

            <!-- Account & Payment Section -->
            <!-- This section is non functional as we cannot do this for security reasons. -->
            <div id="account-payment" class="section hidden">
                <h2>Account & Payment</h2>
                <form>
                    <div class="form-group">
                        <label for="payment-method">Payment Method</label>
                        <select id="payment-method" name="payment-method">
                            <option>Visa Debit</option>
                            <option>Visa Credit</option>
                            <option>Mastercard</option>
                            <option>Klarna</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="card-number">Card Number</label>
                        <input type="text" id="card-number" name="card-number" placeholder="**** **** **** 1234">
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123">
                    </div>
                    <div class="form-group">
                        <label for="billing-address">Billing Address</label>
                        <input type="text" id="billing-address" name="billing-address" placeholder="123 Main Street">
                    </div>
                    <div class="buttons">
                        <button type="button" class="save-btn">Save</button>
                    </div>
                </form>
            </div>

            <!-- Security Section -->
            <div id="security" class="section hidden">
                <h2>Security</h2>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')
                    <!--
                    <div class="form-group">
                        <label>Two-Factor Authentication</label>
                        <select>
                            <option>Enabled</option>
                            <option>Disabled</option>
                        </select>
                    </div>
                    -->
                    <div class="form-group">
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" name="current_password">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="password_confirmation">
                    </div>
                    <div class="buttons">
                        <button type="submit" class="save-btn">Save</button>
                        <!-- Delete Account Button -->
                        <button type="button" class="delete-btn" id="delete-account" onclick="openPrompt()">Delete
                            Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="overlay">
        <div id="customPrompt"
             style="">
            <h5>Are you sure you want to delete your account? This action cannot be undone.</h5>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted.
                Before deleting your account, please download any data or information that you wish to retain.</p>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <input type="password" id="promptInput" name="password" placeholder="Password">
                    @if($errors->userDeletion->has('password'))
                        <span class="error" style="color: red;">
                    {{ $errors->userDeletion->first('password') }}
                </span>
                    @endif
                </div>
                <div class="buttons">
                    <button type="submit" class="save-btn">OK</button>
                    <button type="button" onclick="closePrompt()" class="delete-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function showSection(event, sectionId) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(section => section.classList.add('hidden'));

            // Show the selected section
            document.getElementById(sectionId).classList.remove('hidden');

            // Remove 'active' class from all sidebar items
            document.querySelectorAll('.sidebar ul li').forEach(item => item.classList.remove('active'));

            // Add 'active' class to the clicked item
            event.target.classList.add('active');
        }

        document.getElementById('profile-img').addEventListener('click', function () {
            document.getElementById('profile-upload').click();
        });

        document.getElementById('profile-upload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profile-img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        function openPrompt() {
            document.getElementById("customPrompt").style.display = "block";
            document.getElementById('overlay').style.display = 'block';
        }

        function closePrompt() {
            document.getElementById("customPrompt").style.display = "none";
            document.getElementById('overlay').style.display = 'none';
        }


    </script>
    </body>
    @include('components.newcompactfooter')
</x-newheader>
