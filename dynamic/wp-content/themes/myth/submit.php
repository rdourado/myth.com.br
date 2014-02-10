<?php 

require( '../../../wp-load.php' );

// E-mail válido para envio

$emailsender = get_field( 'admin_email' );

// Valida CNPJ

function validaCNPJ($cnpj) { 
	if (strlen($cnpj) <> 18) return 0; 
	$soma1 = ($cnpj[0] * 5) + 

	($cnpj[1] * 4) + 
	($cnpj[3] * 3) + 
	($cnpj[4] * 2) + 
	($cnpj[5] * 9) + 
	($cnpj[7] * 8) + 
	($cnpj[8] * 7) + 
	($cnpj[9] * 6) + 
	($cnpj[11] * 5) + 
	($cnpj[12] * 4) + 
	($cnpj[13] * 3) + 
	($cnpj[14] * 2); 
	$resto = $soma1 % 11; 
	$digito1 = $resto < 2 ? 0 : 11 - $resto; 
	$soma2 = ($cnpj[0] * 6) + 

	($cnpj[1] * 5) + 
	($cnpj[3] * 4) + 
	($cnpj[4] * 3) + 
	($cnpj[5] * 2) + 
	($cnpj[7] * 9) + 
	($cnpj[8] * 8) + 
	($cnpj[9] * 7) + 
	($cnpj[11] * 6) + 
	($cnpj[12] * 5) + 
	($cnpj[13] * 4) + 
	($cnpj[14] * 3) + 
	($cnpj[16] * 2); 
	$resto = $soma2 % 11; 
	$digito2 = $resto < 2 ? 0 : 11 - $resto; 
	return (($cnpj[16] == $digito1) && ($cnpj[17] == $digito2)); 
} 

// Confere tentativa de SPAM

if ( isset( $_POST['gotcha'] ) && !empty( $_POST['gotcha'] ) )
	wp_die( 'A robot may not injure a human being or, through inaction, allow a human being to come to harm.', 'First Law of Robotics' );

// Confere campos obrigatórios

$errors = array();

if ( isset( $_POST['nome'] ) && empty( $_POST['nome'] ) )
	$errors[] = 'nome';
if ( (isset( $_POST['email'] ) && empty( $_POST['email'] )) && !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) )
	$errors[] = 'email';
if ( isset( $_POST['cidade'] ) && empty( $_POST['cidade'] ) )
	$errors[] = 'cidade';
if ( isset( $_POST['assunto'] ) && empty( $_POST['assunto'] ) )
	$errors[] = 'assunto';
if ( isset( $_POST['mensagem'] ) && empty( $_POST['mensagem'] ) )
	$errors[] = 'mensagem';

if ( isset( $_POST['endereco'] ) && empty( $_POST['endereco'] ) )
	$errors[] = 'endereco';
if ( isset( $_POST['cidade'] ) && empty( $_POST['cidade'] ) )
	$errors[] = 'cidade';
if ( isset( $_POST['estado'] ) && empty( $_POST['estado'] ) )
	$errors[] = 'estado';
if ( (isset( $_POST['cnpj'] ) && empty( $_POST['cnpj'] )) && !validaCNPJ( $_POST['cnpj'] ) )
	$errors[] = 'cnpj';
if ( isset( $_POST['sobre'] ) && empty( $_POST['razao-sobre'] ) )
	$errors[] = 'sobre';

if ( !empty( $errors ) ) {
	if ( is_ajax() )
		echo json_encode( array( 'ok' => 0, 'errors' => $errors ) );
	else
		header( 'Location: ' . $_POST['redirect'] . '?ok=0&errors=' . implode( ',', $errors ) . '#error' );
	exit;
}

// Envia e-mail

$emaildestinatario = $emailsender;
$assunto = (isset( $_POST['assunto'] ) && $_POST['assunto']) ? '[Myth] ' . $_POST['assunto'] : '[Myth] Franquia';
$quebra_linha = "\n";

$headers  = "MIME-Version: 1.1" . $quebra_linha;
$headers .= "Content-type: text/plain; charset=iso-8859-1" . $quebra_linha;
$headers .= "Reply-To: " . $_POST['email'] . $quebra_linha;

$msg = array();
foreach ( $_POST as $var => $value ) 
	if ( $var != 'gotcha' && $var != 'redirect' )
		$msg[] = strtoupper( $var ) . ": " . $value;
$mensagemHTML = implode( $quebra_linha, $msg );

if ( !($ok = mail( $emaildestinatario, $assunto, $mensagemHTML, $headers ,"-r".$emailsender )) ) {
	$headers .= "Return-Path: " . $emailsender . $quebra_linha;
	$ok = mail( $emaildestinatario, $assunto, $mensagemHTML, $headers );
}

if ( $ok ) {
	if ( is_ajax() )
		echo json_encode( array( 'ok' => 1 ) );
	else
		header( 'Location: ' . $_POST['redirect'] . '?ok=1' );
}
