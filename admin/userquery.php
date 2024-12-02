<?php
require('inc/essentials.php');
require('inc/dbconfig.php');
adminlogin();


if (isset($_GET['seen'])) {
    $frm_data = filteration($_GET);

    if ($frm_data['seen'] == 'all') {
        $q = "UPDATE userquery SET seen=?";
        $values = [1];
        if (update($q, $values, 'i')) {
            alert('success', 'Marked  all as Read!');
        } else {
            alert('error', 'Operation Failed!');
        }
    } else {
        $q = "UPDATE userquery SET seen=?  WHERE srno=?";
        $values = [1, $frm_data['seen']];
        if (update($q, $values, 'ii')) {
            alert('success', 'Marked as Read!');
        } else {
            alert('error', 'Operation Failed!');
        }

    }
}


if (isset($_GET['del'])) {
    $frm_data = filteration($_GET);

    if ($frm_data['del'] == 'all') {
        $q = "DELETE FROM userquery";
        if (mysqli_query($con, $q)) {
            alert('success', ' All Data Deleted!');
        } else {
            alert('error', 'Operation Failed!');
        }


    } else {
        $q = "DELETE FROM userquery WHERE srno=?";
        $values = [$frm_data['del']];
        if (deleteOperation($q, $values, 'i')) {
            alert('success', 'Data Deleted!');
        } else {
            alert('error', 'Operation Failed!');
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel UserQuery</title>
    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">UserQuery/Messages</h3>



                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm">
                                <i class="bi bi-check-square-fill"></i> Mark as Read</a>
                            <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm">
                                <i class="bi bi-trash"></i> Delete All</a>

                        </div>

                        <div class="table-responsive-md" style="height:550px; overflow-y:scroll">
                            <table class="table table-hover border">
                                <thead class="">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">srno</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" width="20%">Subject</th>
                                        <th scope="col" width="20%">Message</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q = "SELECT * FROM userquery ORDER BY srno DESC";
                                    $data = mysqli_query($con, $q);
                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($data)) {
                                        $seen = '';
                                        if ($row['seen']!= 1) {
                                            $seen= "<a href='?seen=$row[srno]' class='btn btn-sm rounded-pill btn-success'>Mark as Read</a><br>";
                                        }
                                        $seen.= "<a href='?del=$row[srno]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";

                                        echo "<tr>
                                                <td>$i</td>
                                                <td>{$row['name']}</td>
                                                <td>{$row['email']}</td>
                                                <td>{$row['subject']}</td>
                                                <td>{$row['message']}</td>
                                                <td>{$row['date']}</td>
                                                <td>$seen</td>
                                            </tr>";

                                        $i++;
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <?php require('inc/scripts.php') ?>

</body>

</html>