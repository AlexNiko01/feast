<?php


register_endpoint('get_timeslots', 'api_get_timeslots');
register_endpoint('make_reservation', 'api_make_reservation');


function api_get_timeslots()
{

    $dateGet = $_GET['reservation_date'];
    $people = $_GET['reservation_size'];
    $id = $_GET['business_id'];
    $data = curl_init();
    $url = getApiUrl() . 'timeslot?date=' . $dateGet . '&size=' . $people . '&business_id=' . $id;
    //$url = 'https://api.tableapp.com/partner/v1/timeslot?date=2017-05-15&size=4&business_id=34';
    curl_setopt($data, CURLOPT_URL, $url);
    curl_setopt($data, CURLOPT_HTTPHEADER, getApiHeaders());
    curl_setopt($data, CURLOPT_RETURNTRANSFER, true);
    $data_res = curl_exec($data);
    curl_close($data);

    $data_res = json_decode($data_res);
    $data_res->request_url = $url;

    echo json_encode($data_res);
    wp_die();
}

function api_make_reservation()
{

    $options = $_GET;
    $params = '';
    $params .= 'business_id='.$options['business_id'];
    $params .= '&customer_first_name='.$options['customer_first_name'];
    $params .= '&customer_last_name='.$options['customer_last_name'];
    $params .= '&reservation_size='.$options['reservation_size'];
    $params .= '&reservation_date='.$options['reservation_date'];
    $params .= '&reservation_timeslot='.$options['reservation_timeslot'];
    $params .= '&customer_phone='.$options['customer_phone'];

    $data = curl_init(getApiUrl() . 'make-reservation?'.$params);
    curl_setopt($data, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($data, CURLOPT_HTTPHEADER, getApiHeaders());
    curl_setopt($data, CURLOPT_POST, true);
    curl_setopt($data, CURLOPT_POSTFIELDS, $params);
    $data_res = curl_exec($data);
    curl_close($data);

    echo $data_res;
    die();
}

function getApiUrl()
{
    return 'https://api.tableapp.com/partner/v1/';
}

function getApiHeaders()
{
    return array(
        'Authorization: f3eb8b7ebcbc1dd54a8ab36b62ac3e98',
        'Content-Type: application/json'
    );
}

function register_endpoint($action, $callback)
{
    add_action('wp_ajax_' . $action, $callback);
    add_action('wp_ajax_nopriv_' . $action, $callback);
}