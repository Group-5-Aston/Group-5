<x-newheader>
    @include('components.validation-alert')

    <!-- payment section -->
    <section class="payment_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>Payment Information</h2>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('payment.process') }}">
                        @csrf
                        <div class="form-group">
                            <label for="card-number" style="">Card Number</label>
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
                        <button type="submit" class="filter-btn btn-success btn-block">Pay Now</button>
                    </form>
                </div>
            </div>

            <!-- Payment status message -->
           {{-- @if (isset($paymentStatus))
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
            --}}
        </div>
    </section>
    @include('components.newcompactfooter')

</x-newheader>
