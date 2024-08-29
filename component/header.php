    <nav class="navbar navbar-expand-lg bg-light background background-2">
        <div class="container-fluid">
            <a class="navbar-brand text-uppercase fw-bolder fs-3" href="home.php" style="letter-spacing: 1px; background-size: contain;">
                <img src="resource/logo.png" alt="Logo" width="54" height="42" class="d-inline-block align-text-top"> Digi Shop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <div class="offset-lg-8 col-lg-4">
                    <ul class="navbar-nav">
                        <li class="nav-item me-4 t p-1">
                            <a class="nav-link fs-5 fw-bold" aria-current="page" href="cart.php">Cart</a>

                            <?php

                            session_start();

                            if (isset($_SESSION["user"])) {

                                $email = $_SESSION["user"]["email"];

                                $cart_rs = Database::search("SELECT SUM(`qty`) FROM `cart` WHERE `user_email`='" . $email . "'");
                                $cart_num = $cart_rs->num_rows;

                                if ($cart_num != 0) {

                                    $cart_data = $cart_rs->fetch_assoc();

                            ?>

                                    <span class="position-absolute top-0 start-100 translate-middle badge" style="background-color:#e53456; cursor: pointer;"><?php echo implode(" ", $cart_data); ?></span>

                            <?php

                                }
                            }

                            ?>

                        </li>
                        <li class="nav-item me-4 t p-1">
                            <a class="nav-link fs-5 fw-bold" href="watchlist.php">Watchlist</a>

                            <?php

                            if (isset($_SESSION["user"])) {

                                $watch_rs = Database::search("SELECT * FROM `watchlist` where `user_email`='" . $email . "'");
                                $watch_num = $watch_rs->num_rows;

                                if ($watch_num != 0) {

                            ?>

                                    <span class="position-absolute top-0 start-100 translate-middle badge" style="background-color:#e53456; cursor: pointer;"><?php echo $watch_num; ?></span>

                            <?php

                                }
                            }

                            ?>

                        </li>

                        <?php

                        if (isset($_SESSION["user"])) {

                        ?>

                            <li class="nav-item me-4 t p-1">
                                <a class="nav-link fs-5 fw-bold" href="userProfile.php">Profile</a>
                            </li>

                        <?php

                        } else {

                        ?>

                            <li class="nav-item me-4 t p-1">
                                <a class="nav-link fs-5 fw-bold" href="index.php" style="color: white;">Sign In</a>
                            </li>

                        <?php

                        }

                        ?>

                        <li class="nav-item dropdown me-3 p-1 t">
                            <a class="nav-link dropdown-toggle fw-bold fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true" style="text-decoration: none; color: black;">Digi Shop</a>
                            <div class="dropdown-menu">

                                <a class="dropdown-item fs-6 fw-bold" href="sellerProducts.php">Seller's Products</a>
                                <a class="dropdown-item fs-6 fw-bold" href="purchasingHistory.php">Purchase History</a>
                                <a class="dropdown-item fs-6 fw-bold" href="message.php">Message with Seller</a>
                                <a class="dropdown-item fs-6 fw-bold" href="messageAdmin.php">Message with Admin</a>
                                <div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>