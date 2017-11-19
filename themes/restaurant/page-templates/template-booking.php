<?php
/*
Template Name: half width template
*/
get_header(); ?>
    <main class="book-table">
        <div class="row">
            <div class="col-md-6 col-no-pad-r">
                <div class="book-table__img" style="background-image: url(<?php echo get_the_post_thumbnail_url() ?>)">
                </div>
            </div>
            <div class="col-md-6">
                <div class="book-table__form-wrapper">
                    <form action="" class="book-table book-table__form" id="book-table">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="restaurant">
                                    I'd like a table at</label>
                                <select id="restaurant_1" class="order-restaurant">
                                    <option value="34">SHOOK</option>
                                    <option value="35">FISHERMAN’S COVE</option>
                                    <option value="80">SENTIDOS GASTROBAR & DINING</option>
                                    <option value="36">PAK LOH CHIU CHOW</option>
                                    <option value="37">LUK YU TEA HOUSE</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="time">at</label>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker3'>
                                        <input type='text' class="order-date" id="date_1"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <!--                            <div class="col-md-3">-->
                            <!--                                <label for="date">on</label>-->
                            <!--                                <div class="form-group">-->
                            <!--                                    <div class='input-group date' id='datetimepicker2'>-->
                            <!--                                        <input type='text' class="form-control" id="time_1"/>-->
                            <!--                                        <span class="input-group-addon">-->
                            <!--                                            <span class="glyphicon glyphicon-time"></span>-->
                            <!--                                        </span>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="people">for</label>
                                <select id="people_1" name="people_1" class="order-size">
                                    <?php for ($i = 1; $i < 20; $i++) { ?>
                                        <?php if ($i == 1) { ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?> person</option>
                                        <?php } ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?> people</option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="fe-button" data-toggle="modal" data-target="#modal">book
                                    now
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-6">
                            <p>All prices include VAT and a discretionary 12.5% service charge will be added to your
                                bill. (Exc.
                                Leeds)</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Group Booking</strong>
                            <p>
                                Reservations for up to 12 people before6pm can be made via the form above.
                            </p>
                            <p>
                                For dinner bookings of 9 or more peopleplease use our group enquiry form.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal" data-target="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Book table for</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="book-table__form-box">

                        <div class="fe-errors"><p class="fe-errors__item"></p></div>
                        <form class="book-table book-table__form">
                            <label for="restaurant">
                                I'd like a table at</label>
                            <select id="restaurant_2" class="order-restaurant">
                                <option value="34">SHOOK</option>
                                <option value="35">FISHERMAN’S COVE</option>
                                <option value="80">SENTIDOS GASTROBAR & DINING</option>
                                <option value="36">PAK LOH CHIU CHOW</option>
                                <option value="37">LUK YU TEA HOUSE</option>
                            </select>
                            <label class="label" for="b_covers">Diners</label>
                            <select name="persons" id="people_2" class="order-size">
                                <?php for ($i = 1; $i < 20; $i++) { ?>
                                    <?php if ($i == 1) { ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?> person</option>
                                    <?php } ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?> people</option>

                                <?php } ?>
                            </select>
                            <label class="" for="bb_date">Date</label>
                            <div class="form-group">
                                <div class='input-group daypicker' id="daypicker">
                                    <input type='text' class="order-date" id="date_2"/>
                                    <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                </div>
                            </div>
                            <!--                            <label class="" for="b_band">Time</label>-->
                            <!--                            <div class="form-group">-->
                            <!--                                <div class='input-group date timepicker' id="timepicker">-->
                            <!--                                    <input type='text' class="form-control" id="time_2"/>-->
                            <!--                                    <span class="input-group-addon">-->
                            <!--                        <span class="glyphicon glyphicon-time"></span>-->
                            <!--                    </span>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="fe-timeslots">
                                <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button type="submit" class="fe-button"
                                    id="fe-findTable">Find a table
                            </button>
                        </form>
                    </div>
                    <div class="booking-confirm-form-wrapper">
                        <h5>Book table for <span>The <span class="restaurant-name"></span> Restaurant<span></span></span></h5>
                        <form novalidate class="booking-confirm-form" id="booking-confirm-form">
                            <h2 class="">Review yourchoice</h2>
                            <ul class="booking-data-list">
                                <li class="clearfix">
                                    <b class="">Number of people</b>
                                    <span class="fe-people"></span>
                                </li>
                                <li class="clearfix">
                                    <b>Date</b>
                                    <span class="fe-date"></span>
                                </li>
                                <li class="clearfix">
                                    <b class="">Booking time</b>
                                    <span class="fe-time"></span>
                                </li>
                            </ul>
                            <p>
                                <a href="#" class="fe-change-booking">Change booking</a>
                            </p>
                            <h2 class=>Book your choice</h2>
                            <label for="customer_title_id">Select title</label>
                            <select name="customer_title_id" id="customer_title_id">
                                <option value=""></option>
                                <option value="1">Mr.</option>
                                <option value="2">Ms.</option>
                                <option value="3">Mrs.</option>
                                <option value="4">Dr.</option>
                                <option value="5">Prof.</option>
                                <option value="6">Dato</option>
                                <option value="7">Datuk</option>
                                <option value="8">Datin</option>
                                <option value="9">Dato Sri</option>
                                <option value="10">Datuk Sri</option>
                                <option value="11">Datin Sri</option>
                                <option value="12">Tan Sri</option>
                                <option value="13">Puan Sri</option>
                                <option value="14">Tun</option>
                                <option value="15">Toh Puan</option>
                                <option value="16">Y.B.</option>
                                <option value="17">Y.A.M.</option>
                                <option value="18">D.Y.M.M.</option>
                                <option value="19">Puan</option>
                                <option value="20">Madame</option>
                            </select>
                            <div class="">
                                <label class="" for="booking_firstname">First name</label>
                                <input type="text" class="" name="customer_first_name"
                                       id="booking_firstname" value="">
                                <p class="with-errors"></p>
                            </div>
                            <div class="">
                                <label for="booking_lastname">Last name</label>
                                <input type="text" name="customer_last_name" id="booking_lastname" required="">
                                <p class="with-errors"></p>
                            </div>
                            <div class="">
                                <label for="booking_email_address">Email</label>
                                <input type="email" class="" name="booking_email_address" id="booking_email_address"
                                       required="">
                                <p class="with-errors"></p>
                            </div>
                            <div class="">
                                <label for="booking_phone">Phone number</label>
                                <input type="text" class="" name="booking_phone" id="booking_phone"
                                       required="">
                                <p class="with-errors"></p>
                            </div>
                            <div>
                                <label for="reservation_purpose">Purpose</label>
                                <select id="reservation_purpose" name="reservation_purpose">
                                    <option value=""></option>
                                    <option value="TYPE_FRIEND">Friends</option>
                                    <option value="TYPE_DATING">Dating</option>
                                    <option value="TYPE_BUSINESS">Business meeting</option>
                                    <option value="TYPE_FAMILY">Family Gathering</option>
                                    <option value="TYPE_BIRTHDAY">Birthday</option>
                                    <option value="TYPE_ANNIVERSARY">Anniversary</option>
                                </select>
                            </div>
                            <div>
                                <label for="reservation_request">Request</label>
                                <textarea class="" id="reservation_request" name="reservation_request"
                                          placeholder="Please inform us if you have any allergies or religious restrictions"></textarea>
                                <p class="with-errors"></p>

                            </div>
                            <button type="submit" class="fe-button" id="booking_submit">Book now</button>
                        </form>
                    </div>
                    <div class="fe-booking-result" id="fe-booking-result">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();
