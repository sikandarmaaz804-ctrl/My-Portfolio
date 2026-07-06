@extends('main')

@section('main-container')

<!--================ BLOG MODAL =================-->
<div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

        <div class="modal-content shadow-lg rounded-lg">

            <!-- HEADER -->
            <div class="modal-header bg-dark text-white">

                <h5 class="modal-title">Blog Details</h5>

                <!-- CLOSE BUTTON (FIXED) -->
                <button type="button"
                        class="close text-white"
                        data-dismiss="modal"
                        aria-label="Close"
                        style="font-size:28px; opacity:1;">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body"
                 style="max-height:80vh; overflow-y:auto; padding:20px;">

                <div id="blogModalContent">

                    <div class="text-center p-5">
                        <h4>Loading...</h4>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<!--================ END MODAL =================-->

@endsection


<!--================ SCRIPTS (FIXED ORDER) =================-->

<!-- jQuery (MUST FIRST) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 4 Bundle (MUST SECOND) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function () {

    $(document).on('click', '.openBlogModal', function () {

        let blogId = $(this).data('id');

        $('#blogModal').modal('show');

        $('#blogModalContent').html(`
            <div class="text-center p-5">
                <h4>Loading...</h4>
            </div>
        `);

        $.ajax({
            url: "/blog/" + blogId + "/popup",
            type: "GET",
            success: function (response) {
                $('#blogModalContent').html(response);
            },
            error: function () {
                $('#blogModalContent').html(`
                    <div class="text-center p-5 text-danger">
                        <h4>Failed to load blog</h4>
                    </div>
                `);
            }
        });

    });

});
</script>