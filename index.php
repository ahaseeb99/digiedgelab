<html lang="en" class="lenis lenis-smooth" style="--sectionColor: #D5FF63;">

<head>

   <meta charset="utf-8">
   <title>Digiedge Lab — Designing The Future For Businesses</title>

   <link rel="shortcut icon" href="/fav.jpg" type="image/x-icon" />

   <!-- START META ROBOT, TAGS, CONTENT -->

   <meta content="A leading Web Development and Design agency, offering UI/UX Design, Branding, Web Design, Social Media Marketing, Digital Marketing, and Content Writing Services. Serving the UK and US, we combine digital mastery with artistic flair to help your business succeed. Get in touch today to speak to our experts." name="description">

   <meta content="Digiedge Lab — Designing The Future For Businesses" property="og:title">

   <meta content="A leading Web Development and Design agency, offering UI/UX Design, Branding, Web Design, Social Media Marketing, Digital Marketing, and Content Writing Services. Serving the UK and US, we combine digital mastery with artistic flair to help your business succeed. Get in touch today to speak to our experts." property="og:description">

   <meta content="https://cdn.prod.website-files.com/65154ab83c0a0a692c41a432/65c0e53cba04957cab45eb47_homepage-th.png" property="og:image">

   <meta content="Digiedge Lab — Designing The Future For Businesses" property="twitter:title">

   <meta content="A leading Web Development and Design agency, offering UI/UX Design, Branding, Web Design, Social Media Marketing, Digital Marketing, and Content Writing Services. Serving the UK and US, we combine digital mastery with artistic flair to help your business succeed. Get in touch today to speak to our experts." property="twitter:description">

   <meta content="https://cdn.prod.website-files.com/65154ab83c0a0a692c41a432/65c0e53cba04957cab45eb47_homepage-th.png" property="twitter:image">

   <meta property="og:type" content="website">
   <meta content="summary_large_image" name="twitter:card">

   <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height">

   <!-- END META ROBOT, TAGS, CONTENT -->


<?php

function get_IP_address()
{
    foreach (array('HTTP_CLIENT_IP',
                   'HTTP_X_FORWARDED_FOR',
                   'HTTP_X_FORWARDED',
                   'HTTP_X_CLUSTER_CLIENT_IP',
                   'HTTP_FORWARDED_FOR',
                   'HTTP_FORWARDED',
                   'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $IPaddress){
                $IPaddress = trim($IPaddress); // Just to be safe

                if (filter_var($IPaddress,
                               FILTER_VALIDATE_IP,
                               FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
                    !== false) {

                    return $IPaddress;
                }
            }
        }
    }
}

$ip = get_IP_address();

$loc = file_get_contents("http://ip-api.com/json/$ip");
$loc_data = json_decode($loc, true); // Decode JSON string into an associative array


if ($loc_data && isset($loc_data['country'])) {
    global $country;
    $country = $loc_data['country'];
}

 if($country == "United Kingdom") { ?>

<script defer="defer" src="static/js/main-landing-uk.js"></script>

<?php }else{ ?> 

   <script defer="defer" src="static/js/main-landing.js"></script>

<?php } ?>

   

   <link href="static/css/main.css" rel="stylesheet">

</head>

<body>

   <div id="root"></div>

</body>

</html>