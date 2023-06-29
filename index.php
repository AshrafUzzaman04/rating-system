<?php
include_once("./conn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratings</title>
    <link rel="icon" href="./assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/style.min.css?<?php echo time() ?>">
</head>

<body>
    <div class="alert alert-dismissible fade show d-none" role="alert">
        <span id="error_msg"></span>
    </div>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <main>
            <div class="row flip">
                <div class="m-auto p-5 form_div">
                    <form method="POST" id="ratingForm">
                        <div class="col-12 text-center">
                            <h2 class="text-center">Give us your rating.</h2>
                        </div>
                        <div class="col-12">
                            <div id="rateYo" class="mx-auto"></div>
                            <input type="hidden" name="rating" id="rateValue">
                        </div>
                        <div class="col-12">
                            <button id="getRating" name="rateSub124" type="button" class="ripple-btn">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="m-auto p-5 success_div">
                    <div>
                        <img src="./assets/img/undraw_agree_re_hor9.svg" alt="" class="img-fluid" width="200px">
                        <h4 id="success_msg"></h4>
                    </div>
                </div>
            </div>
        </main>
        <?php
        $selctAll = $conn->query("SELECT * FROM `ratings`");
        $avgQuery = "SELECT AVG(value) AS avg_value FROM ratings";
        $result = mysqli_query($conn, $avgQuery);
        $row = mysqli_fetch_object($result);
        $avgValue = $row->avg_value;
        if ($selctAll->num_rows > 0) {
        ?>
            <footer>
                <div>
                    <i class="fa-solid fa-star" style="color: #00596b;"></i>
                    <h4><?= round($avgValue, 1) ?? null ?></h4>
                    <span class="tooltiptext">Total Average Ratings!</span>
                </div>
            </footer>
        <?php
        }
        ?>
    </div>
</body>

<!-- boostrap cdn -->
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<!-- jquery cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<!-- written js -->
<script src="./assets/js/script.js?<?= time() ?>"></script>

</html>