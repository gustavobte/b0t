<?php
define('BOT_TOKEN', '429f88cdcb871e8fb963fceb971ce990');
define('VERIFY_TOKEN', 'EAANxK09okKABAIkuNdcaT0y2owiNoWTYJUS3lpWsIB4DZCeKKqO2tPbU8JIjmzWty2hTkF4QLmhq93qXsDxKgIjr6BWo22teziYIpffjtVLgOOgGMib2lyD7oMZA8ZAhpg6EmpV53gZB5LVfQFqiKHn2QYM3pMpdUZCsrgy46HAZDZD');
define('API_URL', 'https://graph.facebook.com/v2.6/me/messages?access_token='.BOT_TOKEN);

$hub_verify_token = null;

function processMessage($message) {
  // processa a mensagem recebida
  
  $sender = $message['sender']['id'];
  $text = $message['message']['text'];//texto recebido na mensagem
  
  if (isset($text)) {
		if ($text === "Mega-Sena") {
		  sendMessage(array('recipient' => array('id' => $sender), 'message' => array("text" => getResult('megasena', $text))));
		} else if ($text === "Quina") {
		  sendMessage(array('recipient' => array('id' => $sender), 'message' => array("text" => getResult('quina', $text))));
		} else if ($text === "Lotomania") {
		  sendMessage(array('recipient' => array('id' => $sender), 'message' => array("text" => getResult('lotomania', $text))));
		} else if ($text === "Lotof�cil" || $text === "Lotofacil") {
		  sendMessage(array('recipient' => array('id' => $sender), 'message' => array("text" => getResult('lotofacil', $text))));
		} else {
		  sendMessage(array('recipient' => array('id' => $sender), 'message' => array('text' => 'Ol�! Eu sou um bot que informa os resultados das loterias da Caixa. Ser� que voc� ganhou dessa vez? Para come�ar, digite o nome do jogo para o qual deseja ver o resultado')));
		}
  } 
}

function sendMessage($parameters) {
  $options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => json_encode($parameters),
    'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
    )
);

$context  = stream_context_create( $options );
file_get_contents(API_URL, false, $context );
}

//-----VEFICA O WEBHOOK-----//
if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}
if ($hub_verify_token === VERIFY_TOKEN) {
    echo $challenge;
}
//-----FIM VERIFICA��O-----//


?>