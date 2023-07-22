<?php
session_start();
error_reporting(0);

require_once('cs/includes/database.php');


$keyword1 = null;
$keyword2 = null;
$search_text = null;

if (isset($_POST['search']) && $_POST['specialization'] && $_POST[''] && $_POST['searchdata']) {
    $doctorsList = null;

    $word = $_POST['searchdata'];
    $id = intval($_POST['searchdata']);
    $word .= '%';

    $query = "SELECT * FROM doctor WHERE user_accepted=1 AND specialization='" . $_POST['specialization'] . "' AND  Like '%" . $_POST[''] . "%' AND ( email LIKE '{$word}' 
    OR   first_name LIKE '{$word}'  
    OR  last_name LIKE '{$word}'
    OR   address LIKE '{$word}'
    OR   phone_number  LIKE '{$word}'
    OR   doctor_id LIKE $id) ";
    $doctorsList = mysqli_query($connection, $query);
} else if (isset($_POST['search']) && $_POST['specialization']) {
    $doctorsList = null;
    $query = "SELECT * FROM doctor WHERE user_accepted=1 AND specialization='" . $_POST['specialization'] . "';";
    $doctorsList = mysqli_query($connection, $query);
} else if (isset($_POST['search']) && $_POST['']) {

    $doctorsList = null;
    $query = "SELECT * FROM doctor WHERE user_accepted=1 AND  Like '%" . $_POST[''] . "%';";
    $doctorsList = mysqli_query($connection, $query);
} else if (isset($_POST['search']) && $_POST['searchdata']) {

    $word = $_POST['searchdata'];
    $id = intval($_POST['searchdata']);
    $word .= '%';

    $doctorsList = null;
    $query = "SELECT * FROM doctor WHERE user_accepted =1 AND ( email LIKE '{$word}' 
    OR   first_name LIKE '{$word}'  
    OR  last_name LIKE '{$word}'
    OR   address LIKE '{$word}'
    OR   phone_number  LIKE '{$word}'
    OR   doctor_id LIKE $id )";
    $doctorsList = mysqli_query($connection, $query);
} else if (isset($_POST['search']) && $_POST['searchdata'] && $_POST['']) {

    $word = $_POST['searchdata'];
    $id = intval($_POST['searchdata']);
    $word .= '%';

    $doctorsList = null;
    $query = "SELECT * FROM doctor WHERE user_accepted =1 AND   Like '%" . $_POST[''] . "%'  AND( email LIKE '{$word}' 
    OR   first_name LIKE '{$word}'  
    OR  last_name LIKE '{$word}'
    OR   address LIKE '{$word}'
    OR   phone_number  LIKE '{$word}'
    OR   doctor_id LIKE $id )";
    $doctorsList = mysqli_query($connection, $query);
} else if (isset($_POST['search']) && $_POST['searchdata'] && $_POST['specialization']) {

    $word = $_POST['searchdata'];
    $id = intval($_POST['searchdata']);
    $word .= '%';

    $doctorsList = null;
    $query = "SELECT * FROM doctor WHERE user_accepted =1 AND  specialization Like '%" . $_POST['specialization'] . "%' AND ( email LIKE '{$word}' 
    OR   first_name LIKE '{$word}'  
    OR  last_name LIKE '{$word}'
    OR   address LIKE '{$word}'
    OR   phone_number  LIKE '{$word}'
    OR   doctor_id LIKE $id )";
    $doctorsList = mysqli_query($connection, $query);
} else {

    $doctorsList = null;
    $query = "SELECT * FROM doctor WHERE user_accepted=1";
    $doctorsList = mysqli_query($connection, $query);
}

if (isset($_POST['specialization'])) {
    $keyword1 = $_POST['specialization'];
}

if (isset($_POST[''])) {
    $keyword2 = $_POST[''];
}

if (isset($_POST['searchdata'])) {
    $search_text = $_POST['searchdata'];
}


?>



<!doctype html>
<html lang="cs">
    

<head>
    <title>Lékař ihned - Objednejte se</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/owl.carousel.min.css" rel="stylesheet">

    <link href="css/owl.theme.default.min.css" rel="stylesheet">

    <link href="css/templatemo-medic-care.css" rel="stylesheet">
    <link rel="stylesheet" href="cs/views/assets/css/custome/calendar.css">

    <script>

    </script>
</head>

<body id="top">

    <main>

        <?php include_once('cs/includes/header.php'); ?>

        <section class="section-padding" id="booking">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12 mx-auto">
                        <div class="doctor_search">

                            <h2 class="text-center mb-lg-3 mb-2">Vyhledejte svého doktora</h2>

                                <form role="form" method="post">
                                <div class="row">
                                <div class="col-lg-4"></div>
                                    <div class="col-lg-3 col-6 float-right">
                                        </br>
                                        <input id="searchdata" type="text" name="searchdata" class="form-control" placeholder="Vyhledejte konkrétního doktora">
                                    </div>


                                    <div class="col-lg-3 col-6 ">
                                        <button type="submit" class="form-control" name="search" id="submit-button">Search</button>
                                    </div>
                                    </div>
                                </div>
                                </form>

                            
                            <div class="row justify-content-center mt-7">
                            <div class="col-8 mt-3">
                                <?php
                                if ($keyword1 == null && $keyword2 == null && $search_text == null) {
                                ?>
                                    <div><span>vyhledané slovo:
                                            <?php echo " " ?>
                                        </span></div>
                                <?php
                                } else {
                                ?>
                                    <div><span>vyhledané slovo:
                                            <?php echo " " . $keyword1 . " " . $keyword2 . " " . $search_text; ?>
                                        </span></div>
                                <?php
                                }
                                ?>
                                </div>
                                <?php

                                foreach ($doctorsList as $doctor) {
                                ?>


                                    <div class="col-8 mt-3">
                                        <div class="card border-info mb-3">
                                            <div class="card-header">
                                                <h5>MUDr.
                                                    <?php echo $doctor['first_name'] . " " . $doctor['last_name'] ?>
                                                </h5>
                                                <p style="font-size:15px">
                                                <?php
                                                    $specialization = '';
                                                    switch ($doctor['specialization']) {
                                                        case 'Cardiologist':
                                                            $specialization = 'Kardiolog';
                                                            break;
                                                        case 'Orthopedist':
                                                            $specialization = 'Ortoped';
                                                            break;
                                                        case 'Internal Medicine':
                                                            $specialization = 'Interní ambulance';
                                                            break;
                                                        case 'Dermatologist':
                                                            $specialization = 'Dermatolog';
                                                            break;
                                                        case 'Pediatrist':
                                                            $specialization = 'Pediatr';
                                                            break;
                                                        case 'ENT':
                                                            $specialization = 'ORL';
                                                            break;
                                                        case 'General Practitioner':
                                                            $specialization = 'Praktický lékař';
                                                            break;
                                                        // Přidejte další případy pro další specializace
                                                        default:
                                                            $specialization = $doctor['specialization'];
                                                            break;
                                                    }
                                                    echo $specialization;
                                                    ?>
                                                </p>
                                                <p style="font-size:15px">
                                                    <?php echo $doctor['address'] . ", " . $doctor['city'] ?>
                                                </p>
                                            </div>
                                            <div class="card-body text-info">



                                                <?php

                                                $currentDate = date('Y-m-d'); // Get the current date
                                                $startOfWeek =  $currentDate;
                                                $endOfWeek =  date("Y-m-d", strtotime($currentDate . "+6 days"));       

                                                $doc_id = $doctor['doctor_id'];

                                                $query = "SELECT DISTINCT available_date, available_time FROM available_dates WHERE doctor_id=$doc_id AND available_date BETWEEN '$startOfWeek' AND '$endOfWeek'  ORDER BY available_time ASC";
                                                $availability = mysqli_query($connection, $query);
                                                $timeSlots = array();

                                                while ($row = mysqli_fetch_assoc($availability)) {
                                                    $date = $row['available_date'];
                                                    $timeSlot = $row['available_time'];
                                                    $timeSlots[$date][] = $timeSlot;
                                                }
                                                ?>



                                                <?php
                                                if (mysqli_num_rows($availability) === 0) {
                                                ?>
                                                    <div class="row justify-content-center">
                                                        <div class="col-4">
                                                            <?php echo "Žádné dostupné dny k objednání."; ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>

                                                    <?php
                                                    if (isset($_GET['week'])) {
                                                        $startOfWeek = $_GET['week'];
                                                        $endOfWeek = date('Y-m-d', strtotime('next Sunday', strtotime($startOfWeek)));

                                                        $currentDate = date('Y-m-d'); // Get the current date
                                                        $doc_id = $doctor['doctor_id'];

                                                        $query = "SELECT DISTINCT available_date, available_time FROM available_dates WHERE doctor_id=$doc_id AND available_date BETWEEN '$startOfWeek' AND '$endOfWeek'  ORDER BY available_time ASC";
                                                        $availability = mysqli_query($connection, $query);
                                                        $timeSlots = array();

                                                        while ($row = mysqli_fetch_assoc($availability)) {
                                                            $date = $row['available_date'];
                                                            $timeSlot = $row['available_time'];
                                                            $timeSlots[$date][] = $timeSlot;
                                                        }
                                                    }
                                                    ?>

                                                    <div class="calendar">
                                                        <div class="header">
                                                            <?php
                                                            $todayDate = date('Y-m-d');

                                                            if (strtotime($todayDate) < strtotime($startOfWeek)) {
                                                            ?>
                                                                <a href="?week=<?php echo date('Y-m-d', strtotime('-1 week', strtotime($startOfWeek))); ?>">Minulý týden</a>
                                                            <?php

                                                            }
                                                            ?>


                                                            <h4>
                                                                <?php echo $startOfWeek . ' to ' . $endOfWeek; ?>
                                                            </h4>
                                                            <a href="?week=<?php echo date('Y-m-d', strtotime('+1 week', strtotime($startOfWeek))); ?>">Další týden</a>
                                                        </div>
                                                        <div class="days">
                                                            <?php
                                                            $currentDate = $startOfWeek;
                                                            while ($currentDate <= $endOfWeek) {
                                                                echo '<div class="day">';
                                                                echo '<h6>' . date('m-d', strtotime($currentDate)) . '</h6>';
                                                                echo '<div class="dayinner">';

                                                                if (isset($timeSlots[$currentDate])) {
                                                                    echo '<ul>'; ?>

                                                                    <?php
                                                                    foreach ($timeSlots[$currentDate] as $timeSlot) {
                                                                    ?>



                                                                        <form role="form" method="post" name="submit-book" action="./cs/views/patient-booking-appointment.php">


                                                                            <input type="hidden" class="form-control" placeholder="d_first_name" name="d_first_name" value="<?php echo $doctor['first_name']; ?>">

                                                                            <input type="hidden" class="form-control" placeholder="d_last_name" name="d_last_name" value="<?php echo $doctor['last_name']; ?>">

                                                                            <input type="hidden" class="form-control" placeholder="specialization" name="specialization" value="<?php echo $doctor['specialization']; ?>">
                                                                            <input type="hidden" class="form-control" placeholder="" name="" value="<?php echo $doctor['']; ?>">
                                                                            <input type="hidden" class="form-control" placeholder="doctor_id" name="doctor_id" value="<?php echo $doctor['doctor_id']; ?>">
                                                                            <input type="hidden" class="form-control" placeholder="email" name="email" value="<?php echo $doctor['email']; ?>">
                                                                            <input type="hidden" class="form-control" placeholder="booking_date" name="booking_date" value="<?php echo $currentDate ?>">
                                                                            <input type="hidden" class="form-control" placeholder="booking_time" name="booking_time" value="<?php echo $timeSlot; ?>">

                                                                            <?php

                                                                            $query_booking_available = "SELECT * FROM available_dates WHERE doctor_id=$doc_id AND available_date='{$currentDate}' AND available_time='{$timeSlot}'";
                                                                            $booking_available = mysqli_query($connection, $query_booking_available);
                                                                            $get_record = mysqli_fetch_assoc($booking_available);

                                                                            if ($get_record['is_booking'] == 1) {
                                                                            ?>
                                                                                <div class="booked_slot">
                                                                                    <?php echo date("H:i", strtotime($timeSlot)) ?>
                                                                                </div>
                                                                                <?php

                                                                            } else {
                                                                                $todayDate = date('Y-m-d');

                                                                                if (strtotime($todayDate) < strtotime($currentDate)) {
                                                                                ?>
                                                                                    <div>
                                                                                        <button type="submit" class="avalable_slot" name="submit-book">
                                                                                            <?php echo date("H:i", strtotime($timeSlot)) ?>
                                                                                        </button>
                                                                                    </div>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <div>
                                                                                        <div class="booked_slot">
                                                                                            <?php echo date("H:i", strtotime($timeSlot)) ?>
                                                                                        </div>
                                                                                    </div>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>


                                                                        </form>









                                                            <?php }
                                                                    echo '</ul>';
                                                                } else {
                                                                    echo '<div class="no_slots">';
                                                                    echo '<p >Žádná volné místa</p>';
                                                                    echo '</div>';
                                                                }
                                                                echo '</div>';
                                                                echo '</div>';
                                                                $currentDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>


                                                <?php }
                                                ?>
                                            </div>
                                        </div>


                                    </div>

                                <?php
                                }

                                ?>

                            </div>
                        </div>


        </section>

    </main>
    <?php include_once('cs/includes/footer.php'); ?>
    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/scrollspy.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>