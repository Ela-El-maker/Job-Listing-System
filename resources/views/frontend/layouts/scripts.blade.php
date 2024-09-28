<script>
    /**
     * --------------------------------
     * START : Third party plugin initalization
     * --------------------------------
     *
     */
    // Create an instance of Notyf
    var notyf = new Notyf();


    // date picker

    $('.datepicker').datepicker({
        format: 'yyyy-m-d',
    });

    // year picker

    $('.yearpicker').datepicker({
        format: 'yyyy',
        viewMode: 'years',
        minViewMode: 'years'
    });


    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });


    /**
     * --------------------------------
     * END : Third party plugin initalization
     * --------------------------------
     *
     */

    function showLoader()
    {
        $('.preloader_demo').removeClass('d-none');
    }

    function hideLoader()
    {
        $('.preloader_demo').addClass('d-none');
    }
</script>
