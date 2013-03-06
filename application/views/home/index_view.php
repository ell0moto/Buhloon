<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

 <div class="container">
        <div id="myCarousel" class="carousel slide" data-interval="0"> <!-- Carousel -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>
      <!-- Carousel items -->
            <div class="carousel-inner">
                <div class="active item">
                    <div class="vertical">
                        <div class="centered">
                            <h1>A tool to</h1>
                            <h1>encourage children</h1>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="vertical">
                        <div class="centered">
                                <!-- Start of forms -->
                                <?= form_open($form_destination, array('class' => 'form-horizontal')) ?>
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-user"></i></span>
                                                <input type="text" id="form_username" name="set_username" placeholder="Enter a username" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-lock"></i></span>
                                                <input type="text" id="form_password" name="set_password" placeholder="Enter a password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions"> <!-- button -->
                                        <button type="submit" class="btn btn-primary" name="submit">Register</button>
                                    </div>
                                </fieldset>
                            </form>
                                <!-- End of forms -->
                        </div>
                    </div>
                </div>
            </div>
      <!-- Carousel nav -->
            <!-- <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a> -->
            <a class="carousel-control right" href="#myCarousel" data-slide="next"><p>Get started</p><p> it's free &rsaquo;</p></a>
        </div>
    </div> <!-- End of Carousel -->

    <div class="home-section2"> <!-- Start of second section -->
        <div class="top-bottom-pattern">
            <div class="vertical_horizontal">
                <div class="centered">
                    <h1>Why?</h1>
                    <h2>We value the importance of teaching delayed gratification</h2>
                </div>
            </div>
        </div>
    </div>  <!-- End of second section -->

    <div class="home-section3"> <!-- Start of third section -->
        <div class="vertical">
            <div class="centered">
                <h1>How it works</h1>
                <ul class="three-icons">
                    <li><img src="<?= base_url() ?>/img/create_icon.png" /></li>
                    <li><img src="<?= base_url() ?>/img/encourage_icon.png" /></li>
                    <li><img src="<?= base_url() ?>/img/reward_icon.png" /></li>
                </ul>
            </div>
        </div>
    </div> <!-- End of third section -->
