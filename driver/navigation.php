<div class="navigation col-md-3">
    <div class="profile-img">
        <?php
        if ($DRIVER->profile_picture) {
            ?>
            <img src="../upload/drivers/<?php echo $DRIVER->profile_picture; ?>" alt=""/>
            <?php
        } else {
            ?>
            <img src="../upload/drivers/driver.png" alt=""/>
            <?php
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
    </div>
</div>
