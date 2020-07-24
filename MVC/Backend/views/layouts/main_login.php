<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumino - Dashboard</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/datepicker3.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div>
    <div class="message-wrap content-wrap content-wrapper">
        <!-- VALIDATE -->
        <section class="content-header">
            <!--         Nếu có lỗi validate thì mới hiển thị ra   -->
            <?php if (!empty($this->error)): ?>
                <div class="alert alert-danger">
                    <?php echo $this->error; ?>
                </div>
            <?php endif ?>
            <!--         Nếu có lỗi session error thì mới hiển thị ra   -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif ?>
            <!--         Nếu có session success thì mới hiển thị ra   -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif ?>
        </section>
    </div>

    <!-- CONTENT -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!--            Nội dung hiển thị ở đây-->
            <?php
            //thuộc tính content này sẽ nằm trong class controller
            //            cha, chính là nội dung động theo từng view cụ thể
            echo $this->content;
            ?>
        </section>
        <!-- /.content -->
    </div>

</div>	<!--/.main-->
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/chart-data.js"></script>
<script src="assets/js/easypiechart.js"></script>
<script src="assets/js/easypiechart-data.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/ckeditor/ckeditor.js"></script>
<script src="assets/js/script.js"></script>
<script>
    window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };
</script>

</body>
</html>