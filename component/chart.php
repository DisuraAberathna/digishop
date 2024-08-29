<!DOCTYPE html>
<html>

<body>
    <?php

    $thisyear = date("Y");

    $m_1_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-01-%'");
    $m_1_num = $m_1_rs->num_rows;
    $m_2_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-02-%'");
    $m_2_num = $m_2_rs->num_rows;
    $m_3_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-03-%'");
    $m_3_num = $m_3_rs->num_rows;
    $m_4_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-04-%'");
    $m_4_num = $m_4_rs->num_rows;
    $m_5_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-05-%'");
    $m_5_num = $m_5_rs->num_rows;
    $m_6_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-06-%'");
    $m_6_num = $m_6_rs->num_rows;
    $m_7_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-07-%'");
    $m_7_num = $m_7_rs->num_rows;
    $m_8_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-08-%'");
    $m_8_num = $m_8_rs->num_rows;
    $m_9_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-09-%'");
    $m_9_num = $m_9_rs->num_rows;
    $m_10_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-10-%'");
    $m_10_num = $m_10_rs->num_rows;
    $m_11_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-11-%'");
    $m_11_num = $m_11_rs->num_rows;
    $m_12_rs = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%" . $thisyear . "-12-%'");
    $m_12_num = $m_12_rs->num_rows;

    ?>

    <input type="text" class="d-none" value="<?php echo $m_1_num; ?>" id="1">
    <input type="text" class="d-none" value="<?php echo $m_2_num; ?>" id="2">
    <input type="text" class="d-none" value="<?php echo $m_3_num; ?>" id="3">
    <input type="text" class="d-none" value="<?php echo $m_4_num; ?>" id="4">
    <input type="text" class="d-none" value="<?php echo $m_5_num; ?>" id="5">
    <input type="text" class="d-none" value="<?php echo $m_6_num; ?>" id="6">
    <input type="text" class="d-none" value="<?php echo $m_7_num; ?>" id="7">
    <input type="text" class="d-none" value="<?php echo $m_8_num; ?>" id="8">
    <input type="text" class="d-none" value="<?php echo $m_9_num; ?>" id="9">
    <input type="text" class="d-none" value="<?php echo $m_10_num; ?>" id="10">
    <input type="text" class="d-none" value="<?php echo $m_11_num; ?>" id="11">
    <input type="text" class="d-none" value="<?php echo $m_12_num; ?>" id="12">

    <div class="col-12 rounded-2 bg-white p-3">
        <canvas id="myChart-2" width="400" height="100"></canvas>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script src="script.js"></script>
    <script>
        var ctx_2 = document.getElementById("myChart-2").getContext('2d');
        var m1 = document.getElementById("1").value;
        var m2 = document.getElementById("2").value;
        var m3 = document.getElementById("3").value;
        var m4 = document.getElementById("4").value;
        var m5 = document.getElementById("5").value;
        var m6 = document.getElementById("6").value;
        var m7 = document.getElementById("7").value;
        var m8 = document.getElementById("8").value;
        var m9 = document.getElementById("9").value;
        var m10 = document.getElementById("10").value;
        var m11 = document.getElementById("11").value;
        var m12 = document.getElementById("12").value;


        var myChart = new Chart(ctx_2, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [{
                    label: 'Monthly Sellings',
                    data: [m1, m2, m3, m4, m5, m6, m7, m8, m9, m10, m11, m12],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>