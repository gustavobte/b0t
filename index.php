<?php
define('BOT_TOKEN', '429f88cdcb871e8fb963fceb971ce990');
define('VERIFY_TOKEN', 'EAANxK09okKABAIkuNdcaT0y2owiNoWTYJUS3lpWsIB4DZCeKKqO2tPbU8JIjmzWty2hTkF4QLmhq93qXsDxKgIjr6BWo22teziYIpffjtVLgOOgGMib2lyD7oMZA8ZAhpg6EmpV53gZB5LVfQFqiKHn2QYM3pMpdUZCsrgy46HAZDZD');
$hub_verify_token = null;
//-----VEFICA O WEBHOOK-----//
if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}
if ($hub_verify_token === VERIFY_TOKEN) {
    echo $challenge;
}
//-----FIM VERIFICAÇÃO-----//
?>