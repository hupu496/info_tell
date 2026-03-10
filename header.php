<?php
if (!isset($pageTitle)) {
    $pageTitle = "INFO TELL";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="img/logo2.png" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .inline-content { display: flex; align-items: center; gap: 10px; }
        .inline-content img { display: block; }
        .display-5 { margin: 0; }

        /* Brand container - allow it to take space but not overflow */
        .navbar-brand {
            max-width: none;
            flex-shrink: 1;
            margin-right: auto;
        }

        /* Title styling - nowrap on desktop, wraps on mobile */
        .inline-content h1 {
            white-space: nowrap;
            line-height: 1.2;
            font-size: clamp(1.2rem, 3vw, 2.2rem);
            text-transform: uppercase;
            margin: 0;
        }

        /* On tablets and below, allow wrapping and adjust size */
        @media (max-width: 992px) {
            .inline-content h1 {
                white-space: normal;
                font-size: clamp(1rem, 2.5vw, 1.8rem);
            }
        }

        /* Scale logo on smaller screens */
        @media (max-width: 768px) {
            .inline-content img {
                width: 100px;
            }
        }
        @media (max-width: 576px) {
            .inline-content img {
                width: 70px;
            }
            .inline-content h1 {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="index.php" class="navbar-brand ms-lg-5">
        <span class="inline-content">
            <img src="img/logo2.png" width="150px" alt="Logo">
            <h1 class="display-5 m-0 text-primary">INFOTELL SUPPLIES & SOLUTIONS</h1>
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="index.php" class="nav-item nav-link <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>">Home</a>
            <a href="about.php" class="nav-item nav-link <?php echo ($currentPage == 'about.php') ? 'active' : ''; ?>">About</a>
            <a href="service.php" class="nav-item nav-link <?php echo ($currentPage == 'service.php') ? 'active' : ''; ?>">Service</a>
            <a href="contact.php" class="nav-item nav-link <?php echo ($currentPage == 'contact.php') ? 'active' : ''; ?>">Contact</a>
           <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle <?php echo (in_array($currentPage, ['quotation_form.php','id-card.php'])) ? 'active' : ''; ?>" 
       href="#" 
       id="productDropdown" 
       role="button" 
       data-bs-toggle="dropdown" 
       aria-expanded="false">
        Product
    </a>

    <ul class="dropdown-menu" aria-labelledby="productDropdown">
        <li>
            <a class="dropdown-item <?php echo ($currentPage == 'quotation_form.php') ? 'active' : ''; ?>" 
               href="quotation_form.php">
               Quotation Form
            </a>
        </li>

     <li>
    <a class="dropdown-item <?php echo ($currentPage == 'id-card.php') ? 'active' : ''; ?>" 
       href="id-card.php">
       ID-Card
    </a>
</li>
    </ul>
</li>
        <!-- Phone number: single line, full number, with compact pill and icon -->
<a href="tel:+917903037977" class="nav-item nav-link nav-contact bg-secondary text-white py-2 px-4 rounded-pill me-3" style="display: inline-flex; align-items: center; gap: 0.4rem;">
    <i class="bi bi-telephone-outbound"></i>
    <span>+917903037977</span>
</a>
        </div>
    </div>
</nav>
<!-- Navbar End -->