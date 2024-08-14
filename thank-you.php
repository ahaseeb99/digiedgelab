<?php



include_once('include/cl_db.php');



$db = new DB;
$db->open();


if (isset($_POST['submit'])) {


   $to = 'info@digiedgelab.com';
   $subject = "New Lead";

   $ip = $db->get_client_ip();
   $getLocationByIp = $db->getLocationByIp();
   $country = $getLocationByIp['countryCode'];

   $fname = $_POST["fname"];
   $lname = $_POST["lname"];
   $phone = $_POST["phone"];
   $email = $_POST["email"];
   $message = $_POST["message"];

   $user_name = $fname . ' ' . $lname;

   $db->insertLead($user_name, $email, $phone, $message, $ip, $country);


   $headers = "From: " . strip_tags($email) . "\r\n";
   $headers .= "MIME-Version: 1.0\r\n";

   // For single user
   $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   $messages = ' <table width="100%" border="1" style="font-size:14px; font-family:arial;" cellspacing="0" cellpadding="3">
<tr>
<td>First Name</td>
<td>' . $fname . '</td>
</tr>
<tr>
<td>Last Name</td>
<td>' . $lname . '</td>
</tr>
<tr>
<td>Email</td>
<td>' . $email . '</td>
</tr>
<tr>
<td>Country</td>
<td>' . $country . '</td>
</tr>
<tr>
<td>IP</td>
<td>' . $ip . '</td>
</tr>
<tr>
<td>Mobile Number</td>
<td>' . $phone . '</td>
</tr>
<tr>
<td>Message</td>
<td>' . $message . '</td>
</tr>

</table>';

   $mail = mail($to, $subject, $messages, $headers);

   if ($mail) {
   }
}

?>

<html lang="en" class="lenis lenis-smooth" style="--sectionColor: #D5FF63;">

<head>
   <meta charset="utf-8">
   <title>Thank You — Digiedge Lab</title>

   <link rel="shortcut icon" href="/fav.jpg" type="image/x-icon" />

   <!-- START META ROBOT, TAGS, CONTENT -->

   <meta content="A leading Web Development and Design agency, offering UI/UX Design, Branding, Web Design, Social Media Marketing, Digital Marketing, and Content Writing Services. Serving the UK and US, we combine digital mastery with artistic flair to help your business succeed. Get in touch today to speak to our experts." name="description">

   <meta content="Thank You — Digiedge Lab" property="og:title">

   <meta content="A leading Web Development and Design agency, offering UI/UX Design, Branding, Web Design, Social Media Marketing, Digital Marketing, and Content Writing Services. Serving the UK and US, we combine digital mastery with artistic flair to help your business succeed. Get in touch today to speak to our experts." property="og:description">

   <meta content="https://cdn.prod.website-files.com/65154ab83c0a0a692c41a432/65c0e53cba04957cab45eb47_homepage-th.png" property="og:image">

   <meta content="Thank You — Digiedge Lab" property="twitter:title">

   <meta content="A leading Web Development and Design agency, offering UI/UX Design, Branding, Web Design, Social Media Marketing, Digital Marketing, and Content Writing Services. Serving the UK and US, we combine digital mastery with artistic flair to help your business succeed. Get in touch today to speak to our experts." property="twitter:description">

   <meta content="https://cdn.prod.website-files.com/65154ab83c0a0a692c41a432/65c0e53cba04957cab45eb47_homepage-th.png" property="twitter:image">

   <meta property="og:type" content="website">
   <meta content="summary_large_image" name="twitter:card">

   <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height">

   <!-- END META ROBOT, TAGS, CONTENT -->

   <script defer="defer" src="static/js/thanks.js"></script>
   <link href="static/css/main.css" rel="stylesheet">

   <style>
      @media (min-width: 47.99875em) {
         .menu {
            bottom: 3.4375rem;
         }
      }
   </style>

</head>

<body>

   <div id="thanks--root"></div>

</body>

</html>