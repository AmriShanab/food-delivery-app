<?php
include "layouts/header.php";
?>

<div class="container">
    <div class="row justify-content-center">
        <h3 class="heading-r my-5 text-center">Our Restaurants</h3>

        <?php
        $restaurants = [
            ["id" => 1, "image" => "assets/images/tuans.jpeg", "name" => "Tuan's Food Bowl"],
            ["id" => 2, "image" => "assets/images/yummize.png", "name" => "Yumize"],
            ["id" => 3, "image" => "assets/images/kandiah-THUMBNAIL.jpg", "name" => "Kandiah Restaurant"],
            ["id" => 4, "image" => "assets/images/ice-talk.png", "name" => "ICE Talk"],
            ["id" => 5, "image" => "assets/images/jollybee.png", "name" => "Jollybee"],
            ["id" => 6, "image" => "assets/images/kfc-new-logo-design-2018-1024x683.webp", "name" => "KFC"],
            ["id" => 7, "image" => "assets/images/Pizza-Hut-Logo.webp", "name" => "Pizza Hut"],
            ["id" => 8, "image" => "assets/images/dynamic.avif", "name" => "Dynamic"],
            ["id" => 9, "image" => "assets/images/MUMS-FOOD.jpg", "name" => "Mum's Food"],
        ];
        

        foreach ($restaurants as $restaurant) {
            echo '<div class="col-lg-4 col-md-6 col-sm-12">';
            echo '  <div class="card mx-auto">';
            echo '      <img src="'.$restaurant["image"].'" class="card-img-top" alt="'.$restaurant["name"].'">';
            echo '      <div class="card-body text-center">';
            echo '          <h5 class="card-title">'.$restaurant["name"].'</h5>';
            echo '          <a href="menu.php?restaurant_id='.$restaurant["id"].'" class="btn btn-primary button-color">See Menu</a>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<?php include "layouts/footer.php"; ?>
