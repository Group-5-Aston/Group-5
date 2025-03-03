<x-newheader>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #faf8f2;
        }

        .container {
            display: flex;
            width: 900px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .sidebar {
            width: 220px;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            padding: 12px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar ul li:hover, .sidebar ul li.active {
            background-color: #e0e0e0;
        }

        .content {
            flex: 1;
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
            border: 1px solid #ddd;
            border-radius: 5px;
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
            border: 3px solid #7b8e4e;
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
            background-color: #7b8e4e;
            color: white;
        }

        .save-btn:hover {
            background-color: #426b1f;
        }

        .delete-btn {
            background-color: red;
            color: white;
        }

        .delete-btn:hover {
            background-color: darkred;
        }

        .hidden-input {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li onclick="showSection('profile')" class="active">Profile</li>
                <li onclick="showSection('account-payment')">Account & Payment</li>
                <li onclick="showSection('security')">Security</li>
            </ul>
        </div>
        <div class="content">
            <!-- Profile Section -->
            <div id="profile" class="section">
                <h2>Profile</h2>
                <div class="profile-picture">
                    <img id="profile-img" src="account.png" alt="Profile Picture">
                    <input type="file" id="profile-upload" class="hidden-input" accept="image/*">
                </div>
                <form>
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" value="aston">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" value="Example">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="aston.uni@example.com">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="+44 1234 567 890">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="Aston University">
                    </div>
                    <div class="buttons">
                        <button type="button" class="save-btn">Save</button>
                    </div>
                </form>
            </div>

            <!-- Account & Payment Section -->
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
                <form>
                    <div class="form-group">
                        <label>Two-Factor Authentication</label>
                        <select>
                            <option>Enabled</option>
                            <option>Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new-password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password">
                    </div>
                    <div class="buttons">
                        <button type="button" class="save-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => section.classList.add('hidden'));
            document.getElementById(sectionId).classList.remove('hidden');
            document.querySelectorAll('.sidebar ul li').forEach(item => item.classList.remove('active'));
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
    </script>
</body>
@include('components.newcompactfooter')
</x-newheader>
