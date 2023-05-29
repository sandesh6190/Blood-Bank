<?php
require_once('includes/functions.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Web App Landing Page Website Tempalte | Smarteyeapps.com</title>
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/plugins/grid-gallery/css/grid-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <header class="continer-fluid ">
        <div class="header-top">
            <div class="container">
                <div class="row col-det">
                    <div class="col-6 d-none d-lg-block">
                        <ul class="ulleft">
                            <li>
                                <i class="far fa-envelope"></i>
                                sales@smarteyeapps.com
                                <span>|</span>
                            </li>
                            <li>
                                <i class="far fa-clock"></i>
                                Service Time : 12:AM
                            </li>
                        </ul>
                    </div>
                    <div class="col-5 ">

                    </div>
                    <div class="col-1 pe-1">
                        <ul class="ulright">
                            <li>
                                <a href="/login.php" class="btn btn-secondary text-danger "><i class="fas fa-user"></i>
                                    Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu-jk" class="header-bottom">
            <div class="container">

                <div class="row nav-row">
                    <div class="col-md-2 logo d-flex align-items-center">
                        <img src="assets/images/logo.jpg" alt="">
                    </div>
                    <div class="col-md-9 nav-col">
                        <nav class="navbar navbar-expand-lg navbar-light">

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#donors">Donors</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#about">About Us</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#gallery">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#process">Process</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- <div class="col-md-1 d-flex align-items-center">
                        <a href="/login.php" style="color: red;"><i class="fas fa-user"></i>
                            Login</a>
                    </div> -->
                </div>
            </div>
        </div>
    </header>


    <!-- ################# Slider Starts Here#######################--->

    <div class="slider-detail">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="assets/images/slider/slide-02.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class=" bounceInDown">Donate Blood & Save a Life</h5>
                        <p class=" bounceInLeft">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam justo
                            neque, <br>
                            aliquet sit amet elementum vel, vehicula eget eros. Vivamus arcu metus, mattis <br>
                            sed sagittis at, sagittis quis neque. Praesent.</p>

                        <div class=" vbh">

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Join uS
                            </button>
                        </div>
                    </div>
                </div>

                <!-- <div class="carousel-item">
                    <img class="d-block w-100" src="assets/images/slider/slide-03.jpg" alt="Third slide">
                    <div class="carousel-caption vdg-cur d-none d-md-block">
                        <h5 class=" bounceInDown">Donate Blood & Save a Life</h5>
                        <p class=" bounceInLeft">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam justo
                            neque, <br>
                            aliquet sit amet elementum vel, vehicula eget eros. Vivamus arcu metus, mattis <br>
                            sed sagittis at, sagittis quis neque. Praesent.</p>

                        <div class=" vbh">

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Join US
                            </button>
                        </div>
                    </div>
                </div> -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <form action="/registerMember.php" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i
                                            class="bi bi-person-lines-fill"></i> Member Registration</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="inputName" class="form-label">Name</label>
                                                <input type="text" class="form-control" name="inputName" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="inputAddress" class="form-label">Address</label>
                                                <input type="text" class="form-control" name="inputAddress" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="inputEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="inputEmail" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="inputPhone" class="form-label">Phone Number</label>
                                                <input type="number" class="form-control" name="inputPhone" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="inputGender" class="form-label">Gender</label><br>

                                                <input class="form-check-input" type="radio" name="inputGender" id=""
                                                    radio value="Male">
                                                <label for="inputGender" class="form-label"> Male</label>

                                                <input class="form-check-input" type="radio" name="inputGender" id=""
                                                    radio value="Female">
                                                <label for="inputGender" class="form-label"> Female</label>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="inputBloodGroup" class="form-label">Blood Group</label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="inputBloodGroup" required>
                                                    <option selected value="">Blood Group</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputDate" class="form-label">Last Date</label>
                                                <input type="date" class="form-control" name="inputLastDate" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary text-danger"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-info"> Register</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> -->
        </div>
    </div>

    <!--*************** Donors Starts Here ***************-->
    <?php
    require_once('includes/themeheader.php');
    // require_once('../../includes/navbar.php');
    require_once('includes/connection.php');


    $search = getParam("search");
    $searchbloodgroup = getParam("searchBloodGroup");
    function getSearchData()
    {
        $search = getParam("search");
        $searchbloodgroup = getParam("searchBloodGroup");
        $Status = "Approved";
        $connection = ConnectionHelper::getConnection();
        $query = "select * from tbl_member where ((:search is null) or (Name like concat('%', :search, '%')) or (Address like concat('%', :search, '%')) or (Email like concat('%', :search, '%'))) and ((:bloodgroup is null) or (BloodGroup = :bloodgroup)) and ((Status = :status))";
        $statement = $connection->prepare($query);
        $statement->bindParam('search', $search);
        $statement->bindParam('bloodgroup', $searchbloodgroup);
        $statement->bindParam('status', $Status);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    $result = getSearchData();

    ?>
    <section id="donors" class="container-fluid about-us">
        <div class="container-fluid mt-2">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3 p-3">
                            <h4 class="card-title">List of members</h4>
                        </div>
                    </div>


                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-7">

                        </div>
                        <div class="col-5">
                            <form class="d-flex align-items-stretch my-2" action="" method="get">


                                <select class="form-select me-sm-2" aria-label="Default select example"
                                    name="searchBloodGroup">

                                    <option <?= $searchbloodgroup == '' ? "selected" : "" ?> value="">Blood Group</option>
                                    <option <?= $searchbloodgroup == 'A+' ? "selected" : "" ?> value="A+">A+</option>
                                    <option <?= $searchbloodgroup == 'A-' ? "selected" : "" ?> value="A-">A-</option>
                                    <option <?= $searchbloodgroup == 'B+' ? "selected" : "" ?> value="B+">B+</option>
                                    <option <?= $searchbloodgroup == 'B-' ? "selected" : "" ?> value="B-">B-</option>
                                    <option <?= $searchbloodgroup == 'AB+' ? "selected" : "" ?> value="AB-">AB-</option>
                                    <option <?= $searchbloodgroup == 'AB-' ? "selected" : "" ?> value="AB+">AB+</option>
                                    <option <?= $searchbloodgroup == 'O+' ? "selected" : "" ?> value="O+">O+</option>
                                    <option <?= $searchbloodgroup == 'O-' ? "selected" : "" ?> value="O-">O-</option>
                                </select>


                                <input class="form-control me-sm-2" type="search" placeholder="Search" name="search"
                                    value="<?= $search ?>">
                                <button class="btn btn-warning my-2 my-sm-0" type="submit" style="color: red;"><i
                                        class="bi bi-search"></i></button>
                        </div>
                        </form>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered ">

                            <thead class="table-danger">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Blood Group</th>
                                    <th scope="col">Last Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody class="table-light">
                                <?php
                                $sn = 0;
                                foreach ($result as $member):
                                    ?>
                                    <tr class="">
                                        <td>
                                            <?= ++$sn ?>
                                        </td>
                                        <td>
                                            <?= $member['Name'] ?>
                                        </td>
                                        <td>
                                            <?= $member['Address'] ?>
                                        </td>
                                        <td>
                                            <?= $member['Phone'] ?>
                                        </td>
                                        <td>
                                            <?= $member['Email'] ?>
                                        </td>
                                        <td>
                                            <?= $member['Gender'] ?>
                                        </td>
                                        <td>
                                            <?= $member['BloodGroup'] ?>
                                        </td>
                                        <td>
                                            <?= $member['LastDate'] ?>
                                        </td>
                                        <td class="d-flex">

                                            <?php
                                            if ($member['Status'] == "Requested") {
                                                ?>
                                                <form action="approve.php" method="POST" class="" style="display:inline">
                                                    <input type="hidden" name="id" value="<?= $member['ID'] ?>" id="">
                                                    <button class="btn btn-info  me-sm-2 d-flex"><i
                                                            class="bi bi-check-square"></i>
                                                        Approve</button>
                                                </form>
                                                <?php
                                            }
                                            ?>
                                            <a class="btn btn-success  me-sm-2" href="edit.php?id=<?= $member['ID'] ?>"> <i
                                                    class="bi bi-pencil-square"></i></a>
                                            <form action="delete.php" method="POST" class="" style="display:inline">
                                                <input type="hidden" name="id" value="<?= $member['ID'] ?>" id="">
                                                <button class="btn btn-danger  me-sm-2"><i
                                                        class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--*************** About Us Starts Here ***************-->
    <section id="about" class="contianer-fluid about-us">
        <div class="container">
            <div class="row session-title">
                <h2>About Us</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has</p>
            </div>
            <div class="row">
                <div class="col-md-6 text">
                    <h2>About Blood Doners</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    <p> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.</p>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                        alteration in some formhumour, or randomised words which don't look even slightly believable. If
                        you are going to use a passage. industry's standard dummy has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    <p>Industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                        type and scrambled it to make a type specimen book. It has survived not only five centuries, but
                        also the leap into electronic typesetting, remaining essentially unchanged.</p>
                </div>
                <div class="col-md-6 image">
                    <img src="assets/images/about.jpg" alt="">
                </div>
            </div>
        </div>
    </section>



    <!-- ################# Gallery Start Here #######################--->

    <div id="gallery" class="gallery container-fluid">
        <div class="container">
            <div class="row session-title">
                <h2>Checkout Our Gallery</h2>
            </div>
            <div class="gallery-row row">
                <div id="gg-screen"></div>
                <div class="gg-box">
                    <div class="gg-element">
                        <img src="assets/images/gallery/g1.jpg">
                    </div>
                    <div class="gg-element">
                        <img src="assets/images/gallery/g2.jpg">
                    </div>
                    <div class="gg-element">
                        <img src="assets/images/gallery/g3.jpg">
                    </div>
                    <div class="gg-element">
                        <img src="assets/images/gallery/g4.jpg">
                    </div>
                    <div class="gg-element">
                        <img src="assets/images/gallery/g5.jpg">
                    </div>
                    <div class="gg-element">
                        <img src="assets/images/gallery/g6.jpg">
                    </div>
                    <div class="gg-element">
                        <img src="assets/images/gallery/g7.jpg">
                    </div>
                    <div class="gg-element">
                        <img src="assets/images/gallery/g8.jpg">
                    </div>
                    <div class="gg-element">
                        <img src="assets/images/gallery/g9.jpg">
                    </div>
                    <div class="gg-element">
                        <img src="assets/images/gallery/g10.jpg">
                    </div>


                </div>
            </div>
        </div>
    </div>



    <!-- ################# Donation Process Start Here #######################--->

    <section id="process" class="donation-care">
        <div class="container">
            <div class="row session-title">
                <h2>Donation Process</h2>
                <p>The donation process from the time you arrive center until the time you leave</p>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 vd">
                    <div class="bkjiu">
                        <img src="assets/images/gallery/g1.jpg" alt="">
                        <h4><b>1 - </b>Registration</h4>
                        <p>Ut wisi enim ad minim veniam, quis laore nostrud exerci tation ulm hedi corper turet suscipit
                            lobortis</p>
                        <button class="btn btn-sm btn-danger">Readmore <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 vd">
                    <div class="bkjiu">
                        <img src="assets/images/gallery/g2.jpg" alt="">
                        <h4><b>2 - </b>Seeing</h4>
                        <p>Ut wisi enim ad minim veniam, quis laore nostrud exerci tation ulm hedi corper turet suscipit
                            lobortis</p>
                        <button class="btn btn-sm btn-danger">Readmore <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 vd">
                    <div class="bkjiu">
                        <img src="assets/images/gallery/g3.jpg" alt="">
                        <h4><b>3 - </b>Donation</h4>
                        <p>Ut wisi enim ad minim veniam, quis laore nostrud exerci tation ulm hedi corper turet suscipit
                            lobortis</p>
                        <button class="btn btn-sm btn-danger">Readmore <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 vd">
                    <div class="bkjiu">
                        <img src="assets/images/gallery/g4.jpg" alt="">
                        <h4><b>4 - </b>Save Life</h4>
                        <p>Ut wisi enim ad minim veniam, quis laore nostrud exerci tation ulm hedi corper turet suscipit
                            lobortis</p>
                        <button class="btn btn-sm btn-danger">Readmore <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>


        </div>
    </section>






    <!--*************** Footer  Starts Here *************** -->
    <footer id="contact" class="container-fluid text-center py-2 mt-4">&copy; Copyright 2022 | Blood Bank
        Management
        System <br> Developed by Sandesh
        Limbu, Shisir Jabegu and Tanuja Agrawal
    </footer>


</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/grid-gallery/js/grid-gallery.min.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="assets/js/script.js"></script>

</html>