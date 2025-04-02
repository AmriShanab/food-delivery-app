<?php
include "layouts/header.php";
?>

<div class="container">
    <div class="row justify-content-center">
        <h3 class="heading-r my-5 text-center">Our Restaurants</h3>

        <?php
        $restaurants = [
            ["image" => "assets/images/tuans.jpeg", "name" => "Tuan's Food Bowl"],
            ["image" => "assets/images/yummize.png", "name" => "Yumize"],
            ["image" => "assets/images/kandiah-THUMBNAIL.jpg", "name" => "Kandiah Restaurant"],
            ["image" => "assets/images/ice-talk.png", "name" => "ICE Talk"],
            ["image" => "assets/images/jollybee.png", "name" => "Jollybee"],
            ["image" => "assets/images/kfc-new-logo-design-2018-1024x683.webp", "name" => "KFC"],
            ["image" => "assets/images/Pizza-Hut-Logo.webp", "name" => "Pizza Hut"],
            ["image" => "assets/images/dynamic.avif", "name" => "Dynamic"],
            ["image" => "assets/images/MUMS-FOOD.jpg", "name" => "Mum's Food"],
        ];

        foreach ($restaurants as $restaurant) {
            echo '<div class="col-lg-4 col-md-6 col-sm-12">';
            echo '  <div class="card mx-auto">';
            echo '      <img src="'.$restaurant["image"].'" class="card-img-top" alt="'.$restaurant["name"].'">';
            echo '      <div class="card-body text-center">';
            echo '          <h5 class="card-title">'.$restaurant["name"].'</h5>';
            echo '          <a href="#" class="btn btn-primary button-color">See Menu</a>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }
        ?>
    </div>
</div>
