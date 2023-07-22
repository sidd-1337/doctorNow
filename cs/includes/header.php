<nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
    <div class="container">
        <a class="navbar-brand mx-auto d-lg-none" href="index.php">
            Lékař ihned
            <strong class="d-block">Online objednávání</strong>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand d-none d-lg-block" href="index.php">
        Lékař ihned
            <strong class="d-block">Online objednávání</strong>
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Domů</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php#about">O nás</a>
                </li>



               <!-- <a class="navbar-brand d-none d-lg-block" href="index.php">
                    Doctor Appointment
                    <strong class="d-block">Management System</strong>
                </a> -->

                <li class="nav-item">
                    <a class="nav-link" href="check-appointment.php">Objednat se</a>
                </li>


                
                
                <!-- < ?php
                if (!isset($_SESSION['email'])) {
                    echo "<li class='nav-item'><a class='nav-link' href='#contact'>Kontakty</a></li>";
                } else {
                    echo "<li class='nav-item active' ><a class='nav-link' href='./views/patient-dashboard.php'><i class='bi bi-speedometer2' style='padding:0px; font-size:25px'></i><span class='username'></span></a></li>";
                }
                ?> -->
               <?php if (!isset($_SESSION['email'])) {?>
                    <p><p>
                <?php }else if (($_SESSION["type"] =="patient")) { ?>
                     <li class='nav-item active'><a class='nav-link' href='cs/views/patient-dashboard.php'>
                    <i class='bi bi-person-circle'></i><span class='username'>Uživatelský panel</span></a>
                    </li>
                <?php }else if (($_SESSION["type"] =="doctor")) { ?>
                     <li class='nav-item active'><a class='nav-link' href='cs/views/dashboard.php'>
                    <i class='bi bi-person-circle'></i><span class='username'>Uživatelský panel</span></a>
                    </li>
                 <?php } else{
                 echo "";
                    }
                ?>

                <?php
                if (!isset($_SESSION['email'])) {
                    echo "<li class='nav-item active'><a class='nav-link' href='cs/views/login.php'>Přihlášení/Registrace</a></li>";
                } else {
                    echo "<li class='nav-item active'><a class='nav-link' href='cs/views/logout.php'>Odhlásit se</a></li>";
                }
                ?>

            </ul>
        </div>
        <div class="dropdown">
            <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                data-bs-toggle="dropdown" aria-expanded="false">Language - Jazyk<img src="https://flagcdn.com/w20/cz.png"></a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="index.php" data-code="cs">Czech - čeština</a></li>
                <li><a class="dropdown-item" href="index_en.php" data-code="en">English</a></li>
            </ul>
        </div>
    </div>
</nav>



