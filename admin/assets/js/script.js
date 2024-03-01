(function ($) {

    $(document).ready(function () {
        
        // Show confirmation On click plugin deactivation button on plugin list page
        $(document).on('click', '#deactivate-book-management-system', function (e) {
            e.preventDefault();
            
            let confirmDeactivation = confirm('Are you sure you want to deactivate Book Management System?');
            if (confirmDeactivation) {
                window.location.href = $(this).attr('href');
            }
        });
    });

})(jQuery);