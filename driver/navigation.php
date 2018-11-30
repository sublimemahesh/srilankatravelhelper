<div class="navigation col-md-3 col-sm-3">
    <div class="profile-img">
        <?php
        if (empty($DRIVER->profile_picture)) {
            ?>
            <img src="../upload/driver/driver.png" alt="Profile Picture"/>
            <?php
        } else {
            if ($DRIVER->facebookID && substr($DRIVER->profile_picture, 0, 5) === "https") {
                ?>
                <img src="<?php echo $DRIVER->profile_picture; ?>"  alt="Profile Picture"/>
                <?php
            } else {
                ?>
                <img src="../upload/driver/<?php echo $DRIVER->profile_picture; ?>"  alt="Profile Picture"/>
                <?php
            }
        }
        ?>

    </div>
    <div class="pro-details">
        <p class="driver-name"><?php echo $DRIVER->name; ?></p>
        <p><?php echo $DRIVER->email; ?></p>
    </div>
    <div class="navigation-list">
        <div class="nav1">
            <div class="icon-box">
                <i class="fa fa-tachometer"></i>
            </div>
            <div class="icon-text">
                Dashboard
            </div>


        </div>
        <a href="profile.php">
            <div class="nav1">
                <div class="icon-box">
                    <i class="fa fa-user" id="differ-icon"></i>
                </div>
                <div class="icon-text">
                    My Profile
                </div>
            </div>
        </a>
        <a href="manage-photos.php">
            <div class="nav1">
                <div class="icon-box">
                    <i class="fa fa-male" id="differ-icon"></i>
                </div>
                <div class="icon-text">
                    Manage Photos
                </div>
            </div>
        </a>
        <a href="manage-bookings.php">
            <div class="nav1">
                <div class="icon-box">
                    <i class="fa fa-male" id="differ-icon"></i>
                </div>
                <div class="icon-text">
                    My Bookings
                </div>
            </div>
        </a>
        <a href="manage-offers.php">
            <div class="nav1">
                <div class="icon-box">
                    <i class="fa fa-gift" id="differ-icon"></i>
                </div>
                <div class="icon-text">
                    My Offers
                </div>
            </div>
        </a>
    </div>
</div>
