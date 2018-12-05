<div class="navigation col-md-3 col-sm-4">
    <div class="profile-img">
        <?php
        if (empty($VISITOR->profile_picture)) {
            ?>
            <img src="../upload/visitor/visitor.png" alt="Profile Picture"/>
            <?php
        } else {
            if ($VISITOR->facebookID && substr($VISITOR->profile_picture, 0, 5) === "https") {
                ?>
                <img src="<?php echo $VISITOR->profile_picture; ?>"  alt="Profile Picture"/>
                <?php
            } else {
                ?>
                <img src="../upload/visitor/<?php echo $VISITOR->profile_picture; ?>"  alt="Profile Picture"/>
                <?php
            }
        }
        ?>

    </div>
    <div class="pro-details">
        <p class="driver-name1"><?php echo $VISITOR->name; ?></p>
        <p><?php echo $VISITOR->email; ?></p>
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
        <a href="manage-reviews.php">
            <div class="nav1">
                <div class="icon-box">
                    <i class="fa fa-male" id="differ-icon"></i>
                </div>
                <div class="icon-text">
                    Driver Reviews
                </div>
            </div>
        </a>
        <a href="manage-tour-package-reviews.php">
            <div class="nav1">
                <div class="icon-box">
                    <i class="fa fa-male" id="differ-icon"></i>
                </div>
                <div class="icon-text icon-text1">
                    Tour Package Reviews
                </div>
            </div>
        </a>
        <a href="manage-destination-reviews.php">
            <div class="nav1">
                <div class="icon-box">
                    <i class="fa fa-male" id="differ-icon"></i>
                </div>
                <div class="icon-text icon-text1">
                    Destination Reviews
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
        <a href="visitor-message.php">
            <div class="nav1">
                <div class="icon-box">
                    <i class="fa fa-envelope" id="differ-icon"></i>
                </div>
                <div class="icon-text">
                    Messages
                </div>
            </div>
        </a>
    </div>
</div>
