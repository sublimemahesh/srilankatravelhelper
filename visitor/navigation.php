<div class="navigation col-md-3 col-sm-3">
    <div class="profile-img">
        <?php
        if ($VISITOR->profile_picture) {
            ?>
            <img src="../upload/visitor/<?php echo $VISITOR->profile_picture; ?>" alt=""/>
            <?php
        } else {
            ?>
            <img src="../upload/visitor/visitor.png" alt=""/>
            <?php
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
                    Manage Reviews
                </div>
            </div>
        </a>
    </div>
</div>
