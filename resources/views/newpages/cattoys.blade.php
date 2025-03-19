<x-newheader>
    <x-newshopshower :products="$products">
        <h2>
            Cat Toys
        </h2>
    </x-newshopshower>
     <!-- Return to Home Button -->
     <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="btn btn-success rounded-pill px-4 py-2" style="background-color: #4B7C47;">
                Return to Homepage
          </a>
        </div>
    @include('components.newfooter')
</x-newheader>