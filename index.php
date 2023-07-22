<?php
session_start();

require_once('cs/includes/database.php');


if (isset($_POST['submit'])) {


    if (!isset($_SESSION['email'])) {
        echo '<script>alert("První se musíte přihlásit.")</script>';
        echo "<script>window.location.href ='./views/login.php'</script>";
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $specialization = $_POST['specialization'];
    $doctor_id = $_POST['doctor_id'];
    $message = $_POST['message'];

    $patient_id = $_SESSION['patient_id'];


    $appointment_date = $_POST['date'];
    $cdate = date('Y-m-d');

    if ($appointment_date <= $cdate) {
        echo '<script>alert("Návštěva nemůže být v minulém čase.")</script>';
    } else {

        $query = "INSERT INTO appointment (patient_id,doctor_id,appointment_date,message,status) VALUES('{$patient_id}','{$doctor_id}','{$appointment_date}','{$message}',0)";
        $result_set = mysqli_query($connection, $query);

        $_POST['first_name'] = "";
        $_POST['last_name'] = "";
        $_POST['email'] = "";
        $_POST['phone_number'] = "";
        $_POST['specialization'] = "";
        $_POST['doctor_id'] = "";
        $_POST['message'] = "";

        if ($result_set) {

            echo '<script>alert("Vaše návštěva byla odeslána.")</script>';
        } else {
            echo '<script>alert("Něco se pokazilo, zkuste to prosím znovu.")</script>';
        }
    }
}
?>
<!doctype html>
<html lang="cs">

<head>
    <title>Lékař ihned - Hlavní stránka</title>


    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/owl.carousel.min.css" rel="stylesheet">

    <link href="css/owl.theme.default.min.css" rel="stylesheet">

    <link href="css/templatemo-medic-care.css" rel="stylesheet">
    <script>
    </script>
</head>

<body id="top">

    <main>

        <?php include_once('cs/includes/header.php'); ?>

        <section class="hero" id="hero">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/slider/slider1.png"
                                        class="img-fluid shadow-lg rounded" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slider/slider2.png"
                                        class="img-fluid shadow-lg rounded" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slider/slider3.png"
                                        class="img-fluid shadow-lg rounded" alt="">
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <section class="section-padding" id="about">
            <div class="container">
                <div class="row">

                <div class="col-lg-6 col-md-6 col-12">
                        <h2 class="mb-lg-3 mb-3">O nás</h2>

                        <p>
                        <div>
                            <font color="#202124" face="arial, sans-serif"><b>Naším posláním je Vám nabídnout co nejlepší možnost objednat se online k lékaři.</b></font>
                        </div>
                        <div>
                            <font color="#202124" face="arial, sans-serif"><b><br></b></font>
                        </div>
                        <div>
                            <font color="#202124" face="arial, sans-serif"><b>Vítejte na naších stránkách, které slouží k objednání k lékaři.
                                S naším inovativním přístupem k objednání se k lékaři už Vás nebude muset trápit dlouhé vyčkávání než sestřička zvedne telefon
                                a vy se budete moct objednat. Už nemusíte měnit plány kvůli tomu, že Vám bylo přiřazeno datum, které vám nevyhovuje.
                                Nyní si můžete vy zvolit, kdy a v kolik hodin přijdete, to vše bez jakýchkoliv nutných telenátů.
                                Jsme rádi, že chcete využít našich služeb. 
                            </b></font>
                        </div>
                        </p>
                    </div>

                    <div class="col-lg-4 col-md-5 col-12 mx-auto">
                        <div
                            class="featured-circle bg-white shadow-lg d-flex justify-content-center align-items-center">
                            <p class="featured-text"><span class="featured-number">2</span> roky<br> zkušeností
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="gallery">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-6 ps-0">
                        <img src="images/gallery/medium-shot-man-getting-vaccine.jpg" class="img-fluid galleryImage"
                            alt="get a vaccine" title="get a vaccine for yourself">
                    </div>

                    <div class="col-lg-6 col-6 pe-0">
                        <img src="images/gallery/female-doctor-with-presenting-hand-gesture.jpg"
                            class="img-fluid galleryImage" alt="wear a mask" title="wear a mask to protect yourself">
                    </div>

                </div>
            </div>
        </section>





    </main>
    <?php include_once('cs/includes/footer.php'); ?>
    <!-- JAVASCRIPT FILES -->
    <script>
        function getSecondDropdownValues() {
            var firstDropdownValue = $("#firstDropdown").val();
            return firstDropdownValue;

        }
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/scrollspy.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>