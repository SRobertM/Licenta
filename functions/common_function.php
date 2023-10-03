<?php
//include connect file
//include('./includes/connect.php');
//getting taskers   
function gettaskers()
{
    global $con;
    //condition to check isset or not
    if (!isset($_GET['Locatie'])) {
        if (!isset($_GET['Categorie'])) {
            $select_query = "SELECT * FROM `vanzatori` ORDER BY rand() LIMIT 0,9";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $tasker_id = $row['ID_Vanzator'];
                $tasker_title = $row['Nume_Vanzator'];
                $tasker_description = substr($row['Descriere_Vanzator'], 0, 90) . '...';
                $tasker_keywords = $row['Keyword_Vanzator'];
                $tasker_image1 = $row['tasker_image1'];
                $tasker_price = $row['Pret'];
                $tasker_category = $row['ID_Categorie'];
                $tasker_location = $row['ID_Locatie'];
                echo " <div class='col-md-4 mb-4'>
        <div class='card' style='width: 23rem; '>
            <img class='card-img-top' src='./images/$tasker_image1' alt='Card image cap'>
            <div class='card-body'>
                <h5 class='card-title'>$tasker_title</h5>
                <p class='card-text'>$tasker_description</p>
                <p class='card-text'>Pret: $tasker_price Euro</p>
                <a href='index.php?add_to_cart=$tasker_id' class='btn btn-primary'>Alege-ma</a>
                <a href='tasker_details.php?Vanzator=$tasker_id' class='btn btn-primary'>Detalii</a>
            </div>
        </div>
    </div>";
            }
        }
    }
}

// get all taskers
function get_all_taskers()
{
    global $con;
    //condition to check isset or not
    if (!isset($_GET['Locatie'])) {
        if (!isset($_GET['Categorie'])) {
            $select_query = "SELECT * FROM `vanzatori` ORDER BY rand()";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $tasker_id = $row['ID_Vanzator'];
                $tasker_title = $row['Nume_Vanzator'];
                $tasker_description = substr($row['Descriere_Vanzator'], 0, 10) . '...';
                $tasker_keywords = $row['Keyword_Vanzator'];
                $tasker_image1 = $row['tasker_image1'];
                $tasker_price = $row['Pret'];
                $tasker_category = $row['ID_Categorie'];
                $tasker_location = $row['ID_Locatie'];
                echo " <div class='col-md-4 mb-4'>
        <div class='card' style='width: 23rem; '>
            <img class='card-img-top' src='./images/$tasker_image1' alt='Card image cap'>
            <div class='card-body'>
                <h5 class='card-title'>$tasker_title</h5>
                <p class='card-text'>$tasker_description</p>
                <p class='card-text'>Pret: $tasker_price Euro</p>
                <a href='index.php?add_to_cart=$tasker_id' class='btn btn-primary'>Alege-ma</a>
                <a href='tasker_details.php?Vanzator=$tasker_id' class='btn btn-primary'>Detalii</a>
            </div>
        </div>
    </div>";
            }
        }
    }
}

//view details

function get_tasker_details()
{
    global $con;

    if (isset($_GET['Vanzator'])) {
        $tasker_id = $_GET['Vanzator'];
        $select_query = "SELECT * FROM `vanzatori` where ID_Vanzator=$tasker_id";
        $result_query = mysqli_query($con, $select_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
            $tasker_id = $row['ID_Vanzator'];
            $tasker_title = $row['Nume_Vanzator'];
            $tasker_description = $row['Descriere_Vanzator'];
            $tasker_keywords = $row['Keyword_Vanzator'];
            $tasker_image1 = $row['tasker_image1'];
            $tasker_image2 = $row['tasker_image2'];
            $tasker_image3 = $row['tasker_image3'];
            $tasker_price = $row['Pret'];
            $tasker_category = $row['ID_Categorie'];
            $tasker_location = $row['ID_Locatie'];
            echo " <div class='col-md-4 mb-4'>
           
            <div class='card' style='width: 1700px;'>
            <div style='display: flex;'>
                <div style='padding-right: 7px;'>
                    <img class='card-img-top' src='./images/$tasker_image1' style='height: 600px;' alt='Card image cap'>
                </div>
                <div style='padding-right: 7px;'>
                    <img class='card-img-top' src='./images/$tasker_image2' style='height: 600px;' alt='Card image cap'>
                </div>
                <div style='padding-right: 7px;'>
                    <img class='card-img-top' src='./images/$tasker_image3' style='height: 600px;' alt='Card image cap'>
                </div>
            </div>
            <div class='card-body' style='padding: 1rem;'>
                <h5 class='card-title'>$tasker_title</h5>
                <p class='card-text' style='height: 150px; overflow: auto;'>$tasker_description</p>
                <p class='card-text'>Pret: $tasker_price Euro</p>
                <a href='index.php?add_to_cart=$tasker_id' class='btn btn-primary'>Alege-ma</a>
                <a href='index.php' class='btn btn-primary'>Acasa</a>
            </div>
        </div>
    </div>";
        }
    }
}





//getting category

function getcategory()
{
    global $con;
    $select_categorie = "SELECT * FROM `categorii`";
    $result_categorie = mysqli_query($con, $select_categorie);
    while ($row_data = mysqli_fetch_assoc($result_categorie)) {
        $categorie_name = $row_data['Nume_Categorie'];
        $categorie_id = $row_data['ID_Categorie'];
        echo " <li class='nav-item text-center'>
                        <a href='index.php?Categorie=$categorie_id' class='nav-link text-light'>$categorie_name</a>
                          </li>";
    }
}



//getting unique category


function get_unique_category()
{
    global $con;
    //condition to check isset or not

    if (isset($_GET['Categorie'])) {
        $category_id = $_GET['Categorie'];
        $select_query = "SELECT * FROM `vanzatori` where ID_Categorie=$category_id ";
        $result_query = mysqli_query($con, $select_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
            $tasker_id = $row['ID_Vanzator'];
            $tasker_title = $row['Nume_Vanzator'];
            $tasker_description = substr($row['Descriere_Vanzator'], 0, 10) . '...';
            $tasker_keywords = $row['Keyword_Vanzator'];
            $tasker_image1 = $row['tasker_image1'];
            $tasker_price = $row['Pret'];
            $tasker_category = $row['ID_Categorie'];
            $tasker_location = $row['ID_Locatie'];
            echo " <div class='col-md-4 mb-4'>
        <div class='card' style='width: 23rem; '>
            <img class='card-img-top' src='./images/$tasker_image1' alt='Card image cap'>
            <div class='card-body'>
                <h5 class='card-title'>$tasker_title</h5>
                <p class='card-text'>$tasker_description</p>
                <p class='card-text'>Pret: $tasker_price Euro</p>
                <a href='index.php?add_to_cart=$tasker_id' class='btn btn-primary'>Alege-ma</a>
                <a href='tasker_details.php?Vanzator=$tasker_id' class='btn btn-primary'>Detalii</a>
            </div>
        </div>
    </div>";
        }
    }
}



// display location

function getlocation()
{
    global $con;
    $select_location = "SELECT * FROM `locatie`";
    $result_location = mysqli_query($con, $select_location);
    while ($row_data = mysqli_fetch_assoc($result_location)) {
        $location_name = $row_data['Nume_Locatie'];
        $locatie_id = $row_data['ID_Locatie'];
        echo " <li class='nav-item text-center'>
      <a href='index.php?Locatie=$locatie_id' class='nav-link text-light'>$location_name</a>
  </li>";
    }
}

function get_unique_location()
{
    global $con;
    //condition to check isset or not
    if (isset($_GET['Locatie'])) {
        $location_id = $_GET['Locatie'];
        $select_query = "SELECT * FROM `vanzatori` where ID_Locatie=$location_id ";
        $result_query = mysqli_query($con, $select_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
            $tasker_id = $row['ID_Vanzator'];
            $tasker_title = $row['Nume_Vanzator'];
            $tasker_description = substr($row['Descriere_Vanzator'], 0, 10) . '...';
            $tasker_keywords = $row['Keyword_Vanzator'];
            $tasker_image1 = $row['tasker_image1'];
            $tasker_price = $row['Pret'];
            $tasker_category = $row['ID_Categorie'];
            $tasker_location = $row['ID_Locatie'];
            echo " <div class='col-md-4 mb-4'>
        <div class='card' style='width: 23rem; '>
            <img class='card-img-top' src='./images/$tasker_image1' alt='Card image cap'>
            <div class='card-body'>
                <h5 class='card-title'>$tasker_title</h5>
                <p class='card-text'>$tasker_description</p>
                <p class='card-text'>Pret: $tasker_price Euro</p>
                <a href='index.php?add_to_cart=$tasker_id' class='btn btn-primary'>Alege-ma</a>
                <a href='tasker_details.php?Vanzator=$tasker_id' class='btn btn-primary'>Detalii</a>
            </div>
        </div>
    </div>";
        }
    }
}


function getTaskersName()
{
    global $con;
    $select_seller = "SELECT * FROM `vanzatori`";
    $result_seller = mysqli_query($con, $select_seller);
    while ($row_data = mysqli_fetch_assoc($result_seller)) {
        $vanzator_name = $row_data['Nume_Vanzator'];
        $vanzator_id = $row_data['ID_Vanzator'];
        echo "<li class='nav-item text-center'>
                  <a href='tasker_details.php?Vanzator=$vanzator_id' class='nav-link text-light'>$vanzator_name</a>
              </li>";
    }
}




// searching product functions

function searchproduct()
{
    global $con;
    if (isset($_GET['search_data'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "SELECT * FROM `vanzatori` WHERE `Keyword_Vanzator` LIKE '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
            $tasker_id = $row['ID_Vanzator'];
            $tasker_title = $row['Nume_Vanzator'];
            $tasker_description = substr($row['Descriere_Vanzator'], 0, 10) . '...';
            $tasker_keywords = $row['Keyword_Vanzator'];
            $tasker_image1 = $row['tasker_image1'];
            $tasker_price = $row['Pret'];
            $tasker_category = $row['ID_Categorie'];
            $tasker_location = $row['ID_Locatie'];
            echo " <div class='col-md-4 mb-4'>
        <div class='card' style='width: 23rem; '>
            <img class='card-img-top' src='./images/$tasker_image1' alt='Card image cap'>
            <div class='card-body'>
                <h5 class='card-title'>$tasker_title</h5>
                <p class='card-text'>$tasker_description</p>
                <p class='card-text'>Pret: $tasker_price Euro</p>
                <a href='index.php?add_to_cart=$tasker_id' class='btn btn-primary'>Alege-ma</a>
                <a href='#' class='btn btn-primary'>Detalii</a>
            </div>
        </div>
    </div>";
        }
    }
}

// get ip adress function

function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


// cart function

function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_add = getIPAddress();
        $get_tasker_id = $_GET['add_to_cart'];

        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add' AND ID_Vanzator=$get_tasker_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);

        if ($num_of_rows > 0) {
            echo "<script>alert('Produsul se afla deja in cos deja.')</script>";
            echo "<script>window.open('index.php')</script>";
        } else {
            // Set the initial quantity to 1 when adding a new item
            $insert_query = "INSERT INTO `cart_details` (ID_Vanzator, ip_address, quantity) VALUES ($get_tasker_id, '$get_ip_add', 1)";
            $result_insert = mysqli_query($con, $insert_query);
            echo "<script>alert('Produsul a fost adaugat in cos.')</script>";
            echo "<script>window.open('index.php')</script>";
        }
    }
}


// cart function to get numbers
function cart_item()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_add = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        global $con;
        $get_ip_add = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}


function total_cart_price()
{
    global $con;
    $get_ip_add = getIPAddress();
    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    $total_price = 0; // Initialize total price to 0
    while ($row = mysqli_fetch_array($result)) {
        $tasker_id = $row['ID_Vanzator'];
        $select_products = "SELECT * FROM `vanzatori` WHERE ID_Vanzator='$tasker_id'";
        $result_products = mysqli_query($con, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['Pret']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }
    echo $total_price;
}

function get_user_order_details()
{
    global $con;
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $get_details = "SELECT * FROM `user_table` WHERE username='$username'";
        $result_query = mysqli_query($con, $get_details);

        if (mysqli_num_rows($result_query) > 0) {
            $row_query = mysqli_fetch_assoc($result_query);
            $user_id = $row_query['user_id'];

            if (!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_account'])) {
                $get_orders = "SELECT * FROM `user_orders` WHERE user_id=$user_id AND order_status='pending'";
                $result_order_query = mysqli_query($con, $get_orders);
                $row_count = mysqli_num_rows($result_order_query);

                if ($row_count > 0) {
                    echo "<h3 class='text-center text-success mt-5 mb-2'>Ai <span class='text-danger'>$row_count</span> comenzi in asteptare</h3>
                    <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Detalii Comanda<a/></p>";
                } else {
                    echo "<h3 class='text-center text-success mt-5 mb-2'>Nu ai comenzi in asteptare</h3>";
                    echo "<p class='text-center'><a href='../index.php' class='text-dark'>Exploreaza optiunile</a></p>";
                }
            }
        }
    }
}




























?>