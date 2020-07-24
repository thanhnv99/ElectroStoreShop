<!DOCTYPE html>
<html lang="zxx">

<head>
    <base href="<?php echo $_SERVER['SCRIPT_NAME']; ?>"/>
    <title>Electro Store</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8"/>
    <meta name="keywords"
          content="Electro Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
    />
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta tag Keywords -->

    <!-- Custom-Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Bootstrap css -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/fontawesome-all.css">
    <!-- Font-Awesome-Icons-CSS -->
    <link href="assets/css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- pop-up-box -->
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- menu style -->
    <!-- //Custom-Files -->

    <!-- web fonts -->
    <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext"
          rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
          rel="stylesheet">
    <!-- //web fonts -->

</head>

<body>

<?php
require_once 'views/layouts/header.php';
?>

<!--Main container start  CONTENT -->
<main class="container">
    <!--  hiển thị sẵn các lỗi liên quan đến session hoặc validate, các thông báo liên quan đến session sucess -->
    <?php
    if (isset($_SESSION['error'])) {
        //hiển thị mảng theo key trong 1 chuỗi mà ko cần nối chuỗi
        //sử dụng ký tự {} bao lấy mảng đó
        echo "<div class='alert alert-danger'>
        {$_SESSION['error']}
        </div>";
        unset($_SESSION['error']);
    }
    if (!empty($this->error)) {
        echo "<div class='alert alert-danger'>
        $this->error
        </div>";
    }
    if (isset($_SESSION['success'])) {
        //hiển thị mảng theo key trong 1 chuỗi mà ko cần nối chuỗi
        //sử dụng ký tự {} bao lấy mảng đó
        echo "<div class='alert alert-success'>
        {$_SESSION['success']}
        </div>";
        unset($_SESSION['success']);
    }
    ?>

    <?php
    //hiển thị nội dung động tương ứng của từng view
    echo $this->content;
    ?>
    <!--MAIN CONTENT-->
    <!--<h1>Nội dung động content nằm ở đây</h1>-->
</main>

<!-- FOOTER -->
<?php
require_once 'views/layouts/footer.php';
?>
<!-- //footer -->

<!-- js-files -->
<!-- jquery -->
<script src="assets/js/jquery-2.2.3.min.js"></script>
<!-- //jquery -->

<!-- nav smooth scroll -->
<script>
    $(document).ready(function () {
        $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                $(this).toggleClass('open');
            },
            function () {
                $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                $(this).toggleClass('open');
            }
        );
    });
</script>
<!-- //nav smooth scroll -->

<!-- popup modal (for location)-->
<script src="assets/js/jquery.magnific-popup.js"></script>
<script>
    $(document).ready(function () {
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });

    });
</script>
<!-- //popup modal (for location)-->

<!-- cart-js -->
<script src="assets/js/minicart.js"></script>
<!--<script>-->
<!--    paypals.minicarts.render(); //use only unique class names other than paypals.minicarts.Also Replace same class name in css and minicart.min.js-->
<!---->
<!--    paypals.minicarts.cart.on('checkout', function (evt) {-->
<!--        var items = this.items(),-->
<!--            len = items.length,-->
<!--            total = 0,-->
<!--            i;-->
<!---->
<!--        // Count the number of each item in the cart-->
<!--        for (i = 0; i < len; i++) {-->
<!--            total += items[i].get('quantity');-->
<!--        }-->
<!---->
<!--        if (total < 3) {-->
<!--            alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');-->
<!--            evt.preventDefault();-->
<!--        }-->
<!--    });-->
<!--</script>-->
<!-- //cart-js -->

<!-- password-script -->
<script>
    window.onload = function () {
        document.getElementById("password1").onchange = validatePassword;
        document.getElementById("password2").onchange = validatePassword;
    }

    function validatePassword() {
        var pass2 = document.getElementById("password2").value;
        var pass1 = document.getElementById("password1").value;
        if (pass1 != pass2)
            document.getElementById("password2").setCustomValidity("Passwords Don't Match");
        else
            document.getElementById("password2").setCustomValidity('');
        //empty string means no validation error
    }
</script>
<!-- //password-script -->

<!-- imagezoom -->
<script src="assets/js/imagezoom.js"></script>
<!-- //imagezoom -->

<!-- flexslider -->
<link rel="stylesheet" href="assets/css/flexslider.css" type="text/css" media="screen" />
<script src="assets/js/jquery.flexslider.js"></script>
<script>
    // Can also be used with $(document).ready()
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });
</script>

<!-- scroll seller -->
<script src="assets/js/scroll.js"></script>
<!-- //scroll seller -->

<!-- smoothscroll -->
<script src="assets/js/SmoothScroll.min.js"></script>
<!-- //smoothscroll -->

<!-- start-smooth-scrolling -->
<script src="assets/js/move-top.js"></script>
<script src="assets/js/easing.js"></script>
<script>
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();

            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
    });
</script>
<!-- //end-smooth-scrolling -->

<!-- smooth-scrolling-of-move-up -->
<script>
    $(document).ready(function () {
        /*
        var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
        };
        */
        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>
<!-- //smooth-scrolling-of-move-up -->

<!-- for bootstrap working -->
<script src="assets/js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- //js-files -->
</body>

</html>