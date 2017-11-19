;
(function ($) {
    $(document).ready(function () {
        var body = $('body');
        var iter = 1;
        var $grid = $('.grid-gallery').masonry({
            itemSelector: '.grid-gallery-item',
            columnWidth: 250,
            gutter: 10,
            originLeft: false

        });
        body.on('click', '#load-more', function (e) {
            e.preventDefault();
            var data = {
                action: 'load_more',
                iter: iter,
                id: id
            };
            $.ajax({
                type: "GET",
                url: global.url,
                data: data,
                dataType: 'json',
                success: function (res) {
                    var $rozmetka = $(res.markup);
                    var $finished = res.finished;
                    $grid.append($rozmetka).masonry('appended', $rozmetka);
                    iter++;
                    if($finished == true){
                        $('#load-more').slideUp();
                    }
                }
            });
        });

        body.on('change', '#restaurant-gallery', function () {
           var restID = $(this).val();
            var data = {
                action: 'load_more',
                iter: 0,
                id: id,
                restID: restID
            };
            $.ajax({
                type: "GET",
                url: global.url,
                data: data,
                dataType: 'json',
                success: function (res) {
                    var $rozmetka = $(res.markup);
                    var $finished = res.finished;
                    $('#grid').html('');
                    $grid.append($rozmetka).masonry('appended', $rozmetka).masonry('layout');
                    iter = 1;
                    if($finished == true){
                        $('#load-more').slideUp();
                    }
                }
            });
        });

        //////////////////////////////////////////////////////////////////

        var order = {
            business_id: '',
            customer_title_id: '',
            customer_first_name: '',
            customer_last_name: '',
            customer_phone: '',
            customer_email: '',
            reservation_size: '',
            reservation_date: '',
            reservation_purpose: '',
            reservation_request: '',
            reservation_timeslot: '',
            merchant_remark: null,
            reservation_promotion_id: 1
        };
        var timeslot = new Timeslot();

        body.on('submit', '.book-table', function () {
            $('#fe-booking-result').html('');
            $('.book-table__form-box').show();
            var $container = $('.fe-timeslots');
            $container.html('<div class="text-center"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></div>');
            order.reservation_date = $(this).find('.order-date').val();
            order.business_id = $(this).find('.order-restaurant').val();
            order.reservation_size = $(this).find('.order-size').val();
            $('#restaurant_2').val(order.business_id);
            $('#date_2').val(order.reservation_date);
            $('#time_2').val(order.reservation_timeslot);
            $('#people_2').val(order.reservation_size);

            var restName = $('option[value*=' + order.business_id + ']').text();

            $('.restaurant-name').html(restName);

            timeslot.getTimeslot(order)
                .done(function (response) {

                    if (response.success) {
                        var $result_list = $('<div class="form-group" />');
                        response.data.forEach(function (el) {
                            if (el.size !== 0) {
                                var $newElement = '<button data-timeslot="' + el.timeslot + '" data-require="' + el.require_payment + '" class="btn btn-secondary available-date">';
                                $newElement += el.formatted_timeslot;
                                $newElement += '</button>';
                                $result_list.append($newElement);
                            }

                        });
                        $container.html($result_list);
                    } else {
                        $container.html('<div class="result-message error">' + response.data[0].Sorry + '</div>')
                    }
                })
                .fail(function (error) {

                });

            return false;
        });

        body.on('click', '.available-date', function () {

            var required = $(this).data('require');
            order.reservation_timeslot = $(this).data('timeslot');
            if (required) {
                var url = 'https://www.tableapp.com/partner/dininginthedarkkl-changkat-bukit-bintang/reservation/detail?';
                url += 'd=' + order.reservation_date;
                url += '&t=' + order.reservation_timeslot;
                url += '&s=' + order.reservation_size;
                url += '&sa=' + order.business_id;
                url += '&sc=0';
                var win = window.open(url, '_blank');
                win.focus();
            } else {
                $('.book-table__form-box').slideUp();
                $('.booking-confirm-form-wrapper').slideDown();
                $('.fe-people').html(order.reservation_size);
                $('.fe-date').html(order.reservation_date);
                $('.fe-time').html(order.reservation_timeslot);
            }

        });

        body.on('click', '.fe-change-booking', function (e) {
            e.preventDefault();

            $('.book-table__form-box').slideDown();
            $('.booking-confirm-form-wrapper').slideUp();
        });


        body.on('submit', '#booking-confirm-form', function () {
            var errors = validationForm();
            order.customer_first_name = $('#booking_firstname').val();
            order.customer_last_name = $('#booking_lastname').val();
            order.customer_email = $('#booking_email_address').val();
            order.customer_phone = $('#booking_phone').val();
            order.customer_title_id = $('#customer_title_id').val();
            order.reservation_purpose = $('#reservation_purpose').val();
            order.reservation_request = $('#reservation_request').val();
            var self = $(this);
            if (!errors) {
                timeslot.makeReservation(order)
                    .done(function (response) {
                        if (response.success) {

                            $('#booking_firstname').val('');
                            $('#booking_lastname').val('');
                            $('#booking_email_address').val('');
                            $('#booking_phone').val('');
                            $('#customer_title_id').val('');
                            $('#reservation_purpose').val('');
                            $('#reservation_request').val('');
                            var markUp = '<ul class="result-message success"><li>Your order is successfully issued</li></ul>';
                            $('#fe-booking-result').html(markUp);
                        } else {
                            $('#fe-booking-result').html(getResultMessage(response.data, 'error'))
                        }
                        self.parent().slideUp();
                    })
                    .fail(function (error) {

                    });
            }
            return false;
        });
    });

    var getResultMessage = function (data, extra_class) {
        var $result = $('<ul class="result-message ' + extra_class + '" />');
        Object.keys(data).forEach(function (key) {
            $result.append('<li>' + data[key] + '</li>');
        });
        return $result;
    };

    var Timeslot = function () {
        this.apiUrl = global.url;
        var self = this;
        this.callApi = function (data) {
            return $.ajax({
                url: self.apiUrl,
                type: 'GET',
                data: data,
                dataType: 'json'
            });
        };
        this.getTimeslot = function (data) {
            data['action'] = 'get_timeslots';
            return self.callApi(data);
        };

        this.makeReservation = function (data) {
            data['action'] = 'make_reservation';
            return self.callApi(data);
        }
    };

})(jQuery);