$(document).ready(function() {
    // Search bar functionality
    $('.filter-btn').click(function() {
        var category = $(this).data('category');
        if (!category) {
            return;
        }
        window.location.href = '{{ route('
        product.filter
        ') }}?' + 'category=' + category;
    });
});
