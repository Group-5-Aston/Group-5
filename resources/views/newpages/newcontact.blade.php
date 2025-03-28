<x-newheader>
    @include('components.validation-alert')

    <section class="contact_section layout_padding">
        <div class="container px-0">
            <div class="heading_container ">
                <h2 class="">
                    Contact Us
                </h2>
            </div>
        </div>
        <div class="container container-bg">
            <div class="row">
                <div class="col-lg-7 col-md-6 px-0">
                    <div class="map_container">
                        <div class="map-responsive">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2429.5812611410106!2d-1.8908280874464007!3d52.486717038576245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bc9ae4f2e4b3%3A0x9a670ba18e08a084!2sAston%20University!5e0!3m2!1sen!2suk!4v1732194681429!5m2!1sen!2suk"
                                width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 px-0">
                    <form method="POST" action="{{ route ('submitContact' )}}">
                        @csrf
                        <div>
                            <input type="text" class="form-control" placeholder="Name" name="name" required/>
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" name="email" required/>
                        </div>
                        <div>
                            <input type="text" class="form-control" placeholder="Phone" name="phone"/>
                        </div>
                        <div>
                            <textarea class="form-control" name="message" placeholder="Message" required rows="3" cols="60"></textarea>
                        </div>
                        <div class="d-flex">
                            <button class="filter-btn">
                                SEND
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('components.newfooter')
</x-newheader>
