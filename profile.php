<?php

if (!isset($_GET["id"])) {
    echo "404 Not Found!";
    exit;
}

include("./admin/config/conn.php");

$db = new database();
$db->connect();

$slug = $_GET["id"];



$sql = "SELECT * FROM `user` WHERE `slug` = '$slug' AND `is_enabaled` = '1'";

if ($db->sql($sql)) {
    $result = $db->result();
    $numrows = $db->numrows();
} else {
    die("Internal Server Error");
}

if ($numrows == 0) {
    echo "404 Not Found!!";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en" style="--primary-color: <?= !empty($result[0]['card_color']) ? $result[0]['card_color'] : '#000' ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $result[0]['full_name'] ?></title>
    <link rel="stylesheet" href="css/app.css" />
        <link rel="shortcut icon" href="assets/febble.png" />
</head>

<body>
    <div class="container">
        <div class="card_profileWrapper">
             <?php 
                  if (!empty($result[0]['banner_img'])) { 
                      ?>
            <div class="card__bacgoundImgWrapper">
                <img src="assets/profile/banner/<?= $result[0]['banner_img'] ?>" alt="Image"
                    class="card__bacgoundImg" />
            </div>
                  <?php
                  }else{  ?>
                  <div class="card__bacgoundImgWrapper" style="background-color:#f5f5f5;">
                      </div>
                  <?php }
                    ?>
            <div class="card_profileImgWrapper">
                <div class="card_profileImgWrapperRe">
                  <?php 
                  if (!empty($result[0]['profile_img'])) { 
                      ?>
                       <img src="assets/profile/picture/<?= $result[0]['profile_img'] ?>" alt="Image"
                        class="card_profileImg" />
                      <?php
                  }else{  ?>

                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Image"
                        class="card_profileImg" />
                  <?php }
                    ?>
                   
                    <?php if (!empty($result[0]['company_img'])) { ?>
                    <img src="assets/profile/company/<?= $result[0]['company_img'] ?>" alt="Image"
                        class="card_profileImg -hover" />
                    <?php     } ?>
                </div>
            </div>
        </div>
        <div class="card_profilebio">
            <h3 class="card_profileName"><?= $result[0]['full_name'] ?></h3>
            <?php if (!empty($result[0]['occupation'])) {  ?>
            <p class="card_profileDesination"><?= $result[0]['occupation'] ?></p>
            <?php  }
            if (!empty($result[0]['company'])) { ?>
            <p class="card_profileCompanyName">
                <?= $result[0]['company'] ?>
                <?php if (!empty($result[0]['isVerified']) && $result[0]['isVerified'] == 1) { ?>
                <span tooltip="Verified by febble spot" flow="down"><img src="assets/vectors/verify.svg"
                        class="card_profileBadge" alt="" /></span>
                <?php     } ?>
            </p>
            <?php } ?>
        </div>
        <div class="profile__contactgroup">
            <?php if (!empty($result[0]['whats_number'])) {  ?>
            <a href="whatsapp://send?phone=91<?= $result[0]['whats_number'] ?>&text=Hi, I used your digital business card to get in touch"
                class="button profile__contactCta">
                <img src="assets/vectors/whats.svg" class="profile__contactCtaIcon" alt="" />
            </a>
            <?php  }
            if (!empty($result[0]['mobile'])) { ?>
            <a href="tel:<?= $result[0]['mobile'] ?>" class="button profile__contactCta">
                <img src="assets/vectors/call-outline.svg" class="profile__contactCtaIcon" alt="" />
            </a>
            <?php  }
            if (!empty($result[0]['email'])) { ?>
            <a href="mailto:<?= $result[0]['email'] ?>" class="button profile__contactCta">
                <img src="assets/vectors/email-outline.svg" class="profile__contactCtaIcon" alt="" />
            </a>
            <?php  } ?>
            <button type="button" id="shareButton" class="button profile__contactCta">
                <img src="assets/vectors/share-outline.svg" class="profile__contactCtaIcon" alt="" />
            </button>

        </div>
        <div class="save__group">
            <button type="button" class="button button__fill save__btn" id="save-btn">
                Save Contact
            </button>
        </div>
        <?php if (!empty($result[0]['self_bio'])) { ?>
        <div class="paragraph-container self_bio">
            <div class="paragraph" id="read-more-paragraph">
                <?= html_entity_decode($result[0]['self_bio']) ?>
            </div>
            <div class="buttons">
                <button id="read-more-button">Read More</button>
                <button id="read-less-button" style="display: none">
                    Read Less
                </button>
            </div>
        </div>
        <?php } ?>

        <div>
            <ul class="bio_container">
                <?php if (!empty($result[0]['mobile'])) {  ?>
                <li>
                    <label for="">Mobile</label>
                    <p><?= $result[0]['mobile'] ?></p>
                </li>
                <?php  }
                if (!empty($result[0]['work_number'])) {  ?>
                <li>
                    <label for="">Work</label>
                    <p><?= $result[0]['work_number'] ?></p>
                </li>
                <?php  }
                if (!empty($result[0]['email'])) {  ?>

                <li>
                    <label for="">Email</label>
                    <p><?= $result[0]['email'] ?></p>
                </li>
                <?php  }
                if (!empty($result[0]['site_link'])) {  ?>

                <li>
                    <label for="">Website</label>
                    <a href="<?= $result[0]['site_link'] ?>" target="_blank"><?= $result[0]['site_link'] ?></a>
                </li>
                <?php  }
                if (!empty($result[0]['gst'])) {  ?>

                <li>
                    <label for="">GST No.</label>
                    <p><?= $result[0]['gst'] ?></p>
                </li>
                <?php  }
                if (!empty($result[0]['address'])) {  ?>

                <li>
                    <label for="">Address</label>
                    <a href="<?= $result[0]['address_link'] ?>" target="_blank">
                        <?= html_entity_decode($result[0]['address']) ?>
                    </a>
                </li>
                <?php  }
                if (!empty($result[0]['bank_details'])) {  ?>

                <li>
                    <label for="">Bank details</label>
                    <p>
                        <?= html_entity_decode($result[0]['bank_details']) ?>
                    </p>
                </li>
                <?php  }  ?>

            </ul>
        </div>
        <?php
         if (!empty($result[0]['yt_link']) || !empty($result[0]['fb_link']) || !empty($result[0]['insta_link']) || !empty($result[0]['twitter_link']) || !empty($result[0]['ln_link'])){
             ?>
             
             <p class="social_Heading">Connect with us</p>
        <div class="profile__contactgroup -social">
            <?php
            if (!empty($result[0]['fb_link'])) {  ?>
            <a href="<?= $result[0]['fb_link'] ?>" class="button profile__contactCta" target="_blank">
                <img src="assets/vectors/fb.svg" class="profile__contactCtaIcon" alt="" />
            </a>
            <?php  }
            if (!empty($result[0]['insta_link'])) {  ?>
            <a href="<?= $result[0]['insta_link'] ?>" class="button profile__contactCta" target="_blank">
                <img src="assets/vectors/insta.svg" class="profile__contactCtaIcon" alt="" />
            </a>
            <?php  }
            if (!empty($result[0]['twitter_link'])) {  ?>
            <a href="<?= $result[0]['twitter_link'] ?>" class="button profile__contactCta" target="_blank">
                <img src="assets/vectors/twitter.svg" class="profile__contactCtaIcon" alt="" />
            </a>
            <?php  }
            if (!empty($result[0]['ln_link'])) {  ?>
            <a href="<?= $result[0]['ln_link'] ?>" class="button profile__contactCta" target="_blank">
                <img src="assets/vectors/ln.svg" class="profile__contactCtaIcon" alt="" />
            </a>
            <?php  }
            if (!empty($result[0]['yt_link'])) {  ?>
            <a href="<?= $result[0]['yt_link'] ?>" class="button profile__contactCta" target="_blank">
                <img src="assets/vectors/yt.svg" class="profile__contactCtaIcon" alt="" />
            </a>
            <?php  }
            ?>
        </div>

             <?php
         }
        ?>
        
        <div class="copyright">
            <p>Powered by</p> <a href="http://febble.in/" target="_blank"><img src="assets/febble-logo.png" width="120"
                    style="padding-top: 10px;" alt=""></a>

        </div>
        <script src="js/app.js"></script>

        <script>
        var saveBtn = document.getElementById("save-btn");
        saveBtn.addEventListener("click", function() {
            // Get the contact information from the website
            var contact = {
                name: "<?= $result[0]['full_name'] ?>",
                phone: "<?= $result[0]['mobile'] ?>",
                email: "<?= $result[0]['email'] ?>",
            };
            // create a vcard file
            var vcard =
                "BEGIN:VCARD\nVERSION:4.0\nFN:" +
                contact.name +
                "\nTEL;TYPE=work,voice:" +
                contact.phone +
                "\nEMAIL:" +
                contact.email +
                "\nEND:VCARD";
            var blob = new Blob([vcard], {
                type: "text/vcard"
            });
            var url = URL.createObjectURL(blob);

            const newLink = document.createElement("a");
            newLink.download = contact.name + ".vcf";
            newLink.textContent = contact.name;
            newLink.href = url;

            newLink.click();
        });

        let toggleprofile = document.querySelector('.card_profileImgWrapperRe');
        // console.log(toggleprofile);
        toggleprofile.addEventListener('click', () => {
            toggleprofile.classList.toggle('hover');
        })
        </script>
</body>

</html>