<!--ywsiwyg-->
<?php
include_once("model/Category.php");
include_once("model/News.php");

$lsCategory = Category::getList();

if (isset($_REQUEST["categoryid"])) {
    $categoryID = $_REQUEST["categoryid"]; 
    $lsNews = News::getListByCategory($categoryID);
} else {
    $keyWord = null;
    if (strpos($_SERVER['REQUEST_URI'], "search")) {
      $keyWord = $_REQUEST['search'];      
    }
    $lsNews = News::getList($keyWord);
} 
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section-other">
        <div class="container-fluid">
            <div class="logo">
                <a href="index.php"><img src="img/little-logo.png" alt=""></a>
            </div>
            <div class="nav-menu">
                <nav class="main-menu mobile-menu">
                    <ul>
                        <!--=================CATEGORY================-->
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="#">Categories</a>
                            <ul class="sub-menu">
                            <?php foreach ($lsCategory as $key => $value) {?>
                                <li><a href="index.php?categoryid=<?php echo $value->ID?>"><?php echo $value->name?></a></li>
                            <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <div class="hero-search set-bg" data-setbg="img/search-bg.jpg">
        <div class="container">
            <div class="filter-table">
                <!--=================SEARCH================-->
                <form action="index.php" class="filter-search">
                    <input type="text" name="search" placeholder="Search recipe" value="<?php echo $_REQUEST["search"] ?? ""; ?>">
                </form>
            </div>
        </div>
    </div>
    <section class="recipe-section spad">
        <div class="container">
            <div class="row">
                <!--=================NEWS================-->
                <?php foreach ($lsNews as $key => $value) {
                    $category = Category::getCategoryByID($value->categoryID);
                    ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="recipe-item">
                        <a href="detail.php?ID=<?php echo $value->ID?>"><img src="<?php echo $value->image?>" alt=""></a>
                        <div class="ri-text">
                            <div class="cat-name"><?php echo $category->name?></div>
                            <a href="detail.php?ID=<?php echo $value->ID?>">
                                <h4><?php echo $value->title?></h4>
                            </a>
                            <p><?php echo $value->subtitle?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Recipe Section End -->

    <!-- Categories Feature Recipe Section Begin -->
    <section class="categories-feature-recipe spad">
        <div class="section-title">
            <h5>Categories</h5>
        </div>
        <div class="container po-relative">
            <div class="row">
                <div class="col-lg-7">
                    <div class="cfr-item">
                        <div class="cfr-item-img set-bg" data-setbg="img/cat-feature/big-1.jpg">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="cfr-item-text">
                            <div class="cat-name">Vegan</div>
                            <a href="#">
                                <h4>One Pot Weeknight Lasagna Soup Recipe</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="cfr-item">
                        <div class="cfr-item-img set-bg" data-setbg="img/cat-feature/big-2.jpg">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="cfr-item-text">
                            <div class="cat-name">Meat Lover</div>
                            <a href="#">
                                <h4>Veggie soup with Mushrooms</h4>
                            </a>
                            <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                aliqua. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    <div class="cfr-item">
                        <div class="cfr-item-img set-bg" data-setbg="img/cat-feature/big-3.jpg">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="cfr-item-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Caramel Ice Cream with Berries</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="cfr-item">
                        <div class="cfr-item-img set-bg" data-setbg="img/cat-feature/big-4.jpg">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="cfr-item-text">
                            <div class="cat-name">Desert</div>
                            <a href="#">
                                <h4>Freash Octopuse with lime juice</h4>
                            </a>
                            <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit
                                amet, consectetur adipiscing.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-1.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>One Pot Weeknight Lasagna Soup Recipe</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-2.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Lava Cake with a Tone of Chocolate</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-3.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>One Pot Weeknight Lasagna Soup Recipe</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-4.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Smoked Salmon mini Sandwiches with Onion</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-5.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Asparagus with Pork Loin and Vegetables</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-6.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Dry Cookies with Corn</h6>
                        </div>
                    </div>
                    <div class="cfr-small-item">
                        <a href="#"><img src="img/cat-feature/small-7.jpg" alt=""></a>
                        <div class="cfr-small-text">
                            <div class="cat-name">Vegan</div>
                            <h6>Italian Tiramisu with Coffe</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>