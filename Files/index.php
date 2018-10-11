<?php 
$pgtitle = "Home";
include('header.php');
$hometxt = @mysql_fetch_array(mysql_query("SELECT head, htext FROM general_setting WHERE id='1'"));
?>



    <!--start-slider-section-->
    <section class="slider">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php
                    $i = 1;
                    $slistmt = mysql_query('SELECT img, stext FROM slider_home ORDER BY RAND()');
                    while($slider = mysql_fetch_array($slistmt)){
                        $pic = $fronturl . '/slider/' . $slider[0];
                ?>
                <div class="item<?php echo ($i==1)?' active':''; ?>">
                    <img src="<?php echo $pic; ?>" alt="slider-img">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row">
                            <div class="banner-content">
                                <div class="container">
                                    <div class="row">
                                        <?php echo $slider[1]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;} ?>
                <!-- Controls -->
                <a class="left carousel-control1" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control2" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!--end-slider-section-->

    <!--start about section-->
    <section class="about-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-heading">
                        <h2>about<span>us</span></h2>
                        <div class="head-img">
                            <img src="asset/images/header.png" alt="header-img">
                        </div>
                    </div>
                    <div class="about-content">
                        <p>
                            <?php echo $about['text']; ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img padding-top">
                        <img style="max-width: 818px;max-height: 300px;" src="asset/images/about.png" alt="about-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end about section-->

    <!--start feature section-->
    <section class="feature-section">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="section-heading">
                        <h2>our<span>features</span></h2>
                        <div class="head-img">
                            <img src="asset/images/header.png" alt="header-img">
                        </div>
                    </div>
                    <div class="section-wrapper">
                        <?php
                            $featstmt = mysql_query('SELECT name, stext, icon FROM features ORDER BY RAND() LIMIT 4');
                            while($feature = mysql_fetch_array($featstmt)){
                        ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="feature-item">
                                <div class="feature-icon"><i class="fa <?php echo $feature[2]; ?>" aria-hidden="true"></i></div>
                                <h3><?php echo $feature[0]; ?></h3>
                                <p><?php echo $feature[1]; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end feature section-->

    <!--start service section-->
    <section class="service-section section-padding">
        <div class="container">
            <div class="row">
                <div class="section-heading">
                    <h2>our<span>services</span></h2>
                    <div class="head-img">
                        <img src="asset/images/header.png" alt="header-img">
                    </div>
                </div>
                <div class="section-wrapper">

                    <?php
                        $serstmt = mysql_query('SELECT name, stext, icon FROM services ORDER BY RAND() LIMIT 6');
                        while($service = mysql_fetch_array($serstmt)){
                    ?>

                    <div class="col-md-4 col-sm-6">
                        <div class="service-item">
                            <div class="service-icon"><i class="fa <?php echo $service[2]; ?>" aria-hidden="true"></i></div>
                            <h3><?php echo $service[0]; ?></h3>
                            <p><?php echo $service[1]; ?> </p>
                        </div>
                    </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <!--end service section-->

    <!--start team section-->
    <section class="team-section">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="section-heading">
                        <h2>our perect<span>team</span></h2>
                        <div class="head-img">
                            <img src="asset/images/header.png" alt="header-img">
                        </div>
                    </div>
                    <div class="section-wrapper">

                        <?php
                            $teamstmt = mysql_query('SELECT name, position, about, img, social FROM team ORDER BY RAND() LIMIT 4');
                            $social = null;
                            while($mem = mysql_fetch_array($teamstmt)){
                                $social = unserialize($mem[4]);
                        ?>

                        <div class="col-md-3 col-sm-6">
                            <div class="person-item">
                                <div class="person-img">
                                    <a><img src="asset/images/<?php echo $mem[3]; ?>" alt="person-img"></a>
                                </div>
                                <div class="person-info">
                                    <a>
                                        <h3><?php echo $mem[0]; ?></h3>
                                    </a>
                                    <h4><?php echo $mem[1]; ?></h4>
                                    <p><?php echo $mem[2]; ?></p>
                                    <div class="social-icon">
                                        <ul>
                                            <?php
                                                foreach($social as $key => $value){
                                            ?>
                                            <li><a href="<?php echo $value; ?>"><i class="fa fa-<?php echo $key; ?>" aria-hidden="true"></i></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end team section-->

    <!--start-counter-section-->
    <section class="counter-section">
        <div class="overlay">
            <div class="container">
                <div class="row">

                    <?php
                        $t_us = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM users'));
                        $t_pus = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM users WHERE paid_status=\'1\''));
                        $t_fus = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM users WHERE paid_status=\'0\''));
                    ?>

                    <div class="col-md-4 col-sm-6">
                        <div class="counter-up">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="counter-value" data-count="<?php echo $t_us[0]; ?>"><?php echo $t_us[0]; ?>+</span>
                            <p>TOTAL USERS</p>
                            <div class="count-img">
                                <img src="asset/images/count.png" alt="counter-img">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="counter-up">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="counter-value" data-count="<?php echo $t_pus[0]; ?>"><?php echo $t_pus[0]; ?>+</span>
                            <p>TOTAL PAID USER</p>
                            <div class="count-img">
                                <img src="asset/images/count.png" alt="counter-img">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="counter-up">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="counter-value" data-count="<?php echo $t_fus[0]; ?>"><?php echo $t_fus[0]; ?>+</span>
                            <p>TOTAL FREE USER</p>
                            <div class="count-img">
                                <img src="asset/images/count.png" alt="counter-img">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--end-counter-section-->

    <!--start-client-section-->
    <section class="client-section">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div id="slider" class="flexslider">
                        <ul class="slides">

                            <?php
                                $teststmt = mysql_query('SELECT name, stext, rate FROM testimonial ORDER BY id DESC LIMIT 6');
                                while($test = mysql_fetch_array($teststmt)){
                            ?>

                            <li>
                                <div class="person-info">
                                    <div class="person-info-inner">
                                        <h3><?php echo $test[0]; ?></h3>

                                        <div class="ratting">
                                            <?php for($i = 0;$i <= $test[2];$i++){ ?>
                                            <i class="fa fa-star"></i>
                                            <?php } ?>
                                        </div>

                                        <p><?php echo $test[1]; ?></p>
                                    </div>
                                </div>
                            </li>

                            <?php
                                }
                            ?>

                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">

                            <?php
                                $testistmt = mysql_query('SELECT img FROM testimonial ORDER BY id DESC LIMIT 6');
                                while($testi = mysql_fetch_array($testistmt)){
                            ?>

                            <li>
                                <div class="client-img">
                                    <img src="asset/images/<?php echo $testi[0]; ?>" alt="client-img">
                                </div>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end-client-section-->
<?php 
include('footer.php');
?>