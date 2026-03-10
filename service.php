<?php $pageTitle = "INFO TELL || Services"; ?>
<?php include 'db_config.php'; ?>
<?php include 'header.php'; ?>

<!-- Hero Start -->
<div class="container-fluid bg-primary p-5 hero-header mb-5">
    <div class="row py-5">
        <div class="col-12 text-center">
            <h1 class="display-1 text-white animated zoomIn">Service</h1>
            <a href="index.php" class="h4 text-white">Home</a>
            <i class="far fa-circle text-white px-2"></i>
            <a href="service.php" class="h4 text-white">Service</a>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Services Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h5 class="text-primary text-uppercase" style="letter-spacing: 5px;">Services</h5>
            <h1 class="display-5 mb-0">Our Excellent CCTV Security Services</h1>
        </div>
        <div class="row g-5">
            <!-- Service Item 1 -->
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                <div class="service-item bg-light border-bottom border-5 border-primary rounded">
                    <div class="position-relative p-5">
                        <img src="img/cctv_service.png">
                        <h5 class="text-primary mb-0">CCTV</h5>
                        <h3 class="mb-3">Installation</h3>
                        <p>Kasd dolor no lorem sit tempor at justo rebum rebum stet justo elitr dolor amet sit</p>
                        <a type="button" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle text-white Service"
                           data-bs-toggle="modal" data-bs-target="#exampleModal1"
                           data-regarding="Service" data-service="CCTV Installation">
                            <i class="fa fa-shopping-cart me-2"></i>Book Now
                        </a>
                    </div>
                </div>
            </div>
            <!-- Service Item 2 -->
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                <div class="service-item bg-light border-bottom border-5 border-primary rounded">
                    <div class="position-relative p-5">
                        <img src="img/repair_sales_cctv.png" width="300px">
                        <h5 class="text-primary mb-0">CCTV</h5>
                        <h3 class="mb-3">Repair & Service</h3>
                        <p>Kasd dolor no lorem sit tempor at justo rebum rebum stet justo elitr dolor amet sit</p>
                        <a type="button" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle text-white Service"
                           data-bs-toggle="modal" data-bs-target="#exampleModal1"
                           data-regarding="Service" data-service="CCTV(Repair & sales)">
                            <i class="fa fa-shopping-cart me-2"></i>Book Now
                        </a>
                    </div>
                </div>
            </div>
            <!-- Continue with other service items... (keep all your existing service HTML) -->
            <!-- ... -->
        </div>
    </div>
</div>
<!-- Services End -->

<!-- Offer Start -->
<div class="container-fluid bg-offer my-5 py-5 wow zoomIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="text-center mx-auto mb-4" style="max-width: 600px;">
                    <h5 class="text-white text-uppercase" style="letter-spacing: 5px;">Special Offer</h5>
                    <h1 class="display-5 text-white">Save 30% On All Items Your First Order</h1>
                </div>
                <p class="text-white mb-4">Eirmod sed tempor lorem ut dolores sit kasd ipsum. Dolor ea et dolore et at sea ea at dolor justo ipsum duo rebum sea. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo lorem. Elitr ut dolores magna sit. Sea dolore sed et.</p>
                <a type="button" class="btn btn-primary py-md-3 px-md-5 me-3 Service"
                   data-bs-toggle="modal" data-bs-target="#exampleModal1"
                   data-regarding="Offer 30%" data-service="CCTV(Sales & Installation)">Order Now</a>
                <a href="service.php" class="btn btn-secondary py-md-3 px-md-5">Read More</a>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->

<!-- Booking Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal1Label">INFO TELL Service Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Important: give this form a unique ID (different from footer's sheetdb-forms) -->
                <form action="https://script.google.com/macros/s/AKfycbws8GV5VoAUkWLueTbda6xwHMpdTSVcmzmyIkJX1n0TiBKskFdBj0wxNEN9j18k9J3w/exec" method="post" id="service-booking-form">
                    <div class="mb-3">
                        <input type="hidden" id="dates" class="form-control" name="Date">
                        <input type="hidden" class="form-control" id="regarding" name="Regarding">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" name="Name">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" name="Email">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Mobile No:</label>
                        <input type="text" class="form-control" name="Mobile">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Services:</label>
                        <input type="text" class="form-control" id="service" name="services" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="message"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" value="Submit" id="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Page-specific JavaScript (placed before footer) -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    // Set today's date in the hidden field
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date().toISOString().split('T')[0];
        const dateInput = document.getElementById("dates");
        if (dateInput) dateInput.value = today;
    });

    // Form submission handler for the booking modal
    var form = document.getElementById('service-booking-form');
    if (form) {
        form.addEventListener("submit", e => {
            e.preventDefault();
            fetch(form.action, {
                method: "POST",
                body: new FormData(form),
            })
            .then(response => response.json())
            .then(data => {
                swal("Order Successfully!", "Service Provided Soon!", "success");
            })
            .catch(error => {
                swal("Error", "Something went wrong. Please try again.", "error");
            });
        });
    }

    // Fill service field when "Service" button is clicked
    $(document).ready(function(){
        $('body').on('click', '.Service', function(){
            $('#service').val($(this).data('service'));
            $('#regarding').val($(this).data('regarding'));
        });
    });
</script>

<?php include 'footer.php'; ?>