<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pup&Purr | Payment</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    
    <x-newheader>
       
    

    <!-- payment section -->
    <section class="payment_section layout_padding" style="padding-top: 48px">
        <div class="container">
            <div class="heading_container">
                <h2>Payment Information</h2>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="card-number">Card Number</label>
                            <input type="text" id="card-number" name="card_number" class="form-control" placeholder="Enter Card Number" required>
                        </div>
                        <div class="form-group">
                            <label for="expiry-date">Expiry Date</label>
                            <input type="text" id="expiry-date" name="expiry_date" class="form-control" placeholder="MM/YY" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" class="form-control" placeholder="CVV" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Pay Now</button>
                    </form>
                </div>
            </div>

            <!-- Payment status message -->
            @if (isset($paymentStatus))
                @if ($paymentStatus === 'success')
                    <div class="alert alert-success mt-4">
                        <strong>Payment Successful!</strong> Your order has been processed. Thank you for shopping with us.
                    </div>
                @elseif ($paymentStatus === 'failure')
                    <div class="alert alert-danger mt-4">
                        <strong>Payment Failed!</strong> Please try again or check your payment details.
                    </div>
                @else
                    <div class="alert alert-info mt-4">
                        <strong>Processing payment...</strong> Please wait while we process your payment.
                    </div>
                @endif
            @endif
        </div>
    </section>
    <!-- end payment section -->

    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="https://html.design/">Pup&Purr</a>
            </p>
        </div>
    </footer>
    <!-- footer section -->

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    </x-newheader>

</body>

</html>
