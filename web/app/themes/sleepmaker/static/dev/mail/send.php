<?
if(
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&
	!empty($_POST['user']) &&
	!empty($_POST['phone']) &&
	!empty($_POST['region']) &&
	!empty($_POST['distributor'])
){
	
	$sFields = '';
	
	if(!empty($_POST['density'])){
		$sFields .= '<tr>
			<th style="border-bottom: 1px solid #E5E5E5; color: #2E2E2E; font-family: Helvetica; font-weight: 400; padding: 11px 0; text-align: left;">Плотность блока:</th>
			<td class="data-table__data" style="border-bottom: 1px solid #E5E5E5; color: #605F5F; font-family: Helvetica; font-weight: 200; padding: 11px 0; text-align: left;">'.htmlspecialchars($_POST['density']).'</td>
		</tr>';
	}
	
	if(!empty($_POST['size'])){
		$sFields .= '<tr>
		<th style="border-bottom: 1px solid #E5E5E5; color: #2E2E2E; font-family: Helvetica; font-weight: 400; padding: 11px 0; text-align: left;">Размер блока:</th>
		<td class="data-table__data" style="border-bottom: 1px solid #E5E5E5; color: #605F5F; font-family: Helvetica; font-weight: 200; padding: 11px 0; text-align: left;">'.htmlspecialchars($_POST['size']).'</td>
		</tr>';
	}
	
	if(!empty($_POST['count'])){
		$sFields .= '<tr>
			<th style="border-bottom: 1px solid #E5E5E5; color: #2E2E2E; font-family: Helvetica; font-weight: 400; padding: 11px 0; text-align: left;">Количесвто кубов, м3:</th>
			<td class="data-table__data" style="border-bottom: 1px solid #E5E5E5; color: #605F5F; font-family: Helvetica; font-weight: 200; padding: 11px 0; text-align: left;">'.htmlspecialchars($_POST['count']).'</td>
		</tr>';
	}
	
	if(!empty($_POST['region'])){
		$sFields .= '<tr>
			<th style="border-bottom: 1px solid #E5E5E5; color: #2E2E2E; font-family: Helvetica; font-weight: 400; padding: 11px 0; text-align: left;">Регион:</th>
			<td class="data-table__data" style="border-bottom: 1px solid #E5E5E5; color: #605F5F; font-family: Helvetica; font-weight: 200; padding: 11px 0; text-align: left;">'.htmlspecialchars($_POST['region']).'</td>
		</tr>';
	}
	
	if(!empty($_POST['distributor'])){
		$sFields .= '<tr>
			<th style="border-bottom: 1px solid #E5E5E5; color: #2E2E2E; font-family: Helvetica; font-weight: 400; padding: 11px 0; text-align: left;">Дистрибьютер:</th>
			<td class="data-table__data" style="border-bottom: 1px solid #E5E5E5; color: #605F5F; font-family: Helvetica; font-weight: 200; padding: 11px 0; text-align: left;">'.htmlspecialchars($_POST['distributor']).'</td>
		</tr>';
	}
	
	if(!empty($_POST['phone'])){
		$sFields .= '<tr>
			<th style="border-bottom: 1px solid #E5E5E5; color: #2E2E2E; font-family: Helvetica; font-weight: 400; padding: 11px 0; text-align: left;">Телефон:</th>
			<td class="data-table__data" style="border-bottom: 1px solid #E5E5E5; color: #605F5F; font-family: Helvetica; font-weight: 200; padding: 11px 0; text-align: left;">'.htmlspecialchars($_POST['phone']).'</td>
		</tr>';
	}
	
	$sHtml = '
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="format-detection" content="telephone=no"/>
	
	<!--[if (gte mso 9)|(IE)]>
	<style type="text/css">
		table { border-collapse: collapse; }
		.button { padding:0 !important; }
	</style>
	<![endif]-->
</head>

<body style="Margin: 0; background: #e2e2e2; margin: 0; overflow-wrap: break-word; padding: 0; word-wrap: break-word;">
	<div class="body" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; margin: 0 auto; max-width: 600px; min-width: 320px; table-layout: fixed; text-align: center; width: 100%;">
		
    <!--[if (gte mso 9)|(IE)]>
    <table width="600" align="center">
    <tr>
    <td valign="top" width="600" style="padding-left: 50px; padding-right:50px;">
    <![endif]-->

		<table class="layout" cellpadding="0" align="center" style="background-color: #ffffff; border-collapse: collapse; margin: 0 auto; mso-table-lspace: 0; mso-table-rspace: 0; width: 100%;">
			<tr>
				<td class="layout__margin-left" style="padding: 0; width: 10px;"></td>
				<td class="content-header" style="background-color: #D30825; height: 129px; padding: 0;">
					<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; width: 100%;">
	<tr>
		<td class="layout__margin-left" style="padding: 0; width: 30px;"></td>
		<td valign="middle" class="content-header__logo" style="padding: 0; text-align: left;">
			<a href="http://slsgroup.com.ua/" target="_blank" style="color: #000000; display: inline-block; max-width: 130px; text-decoration: none; width: 100%;">
				<img src="http://slsgroup.com.ua/images/logo.png" alt="logotype" style="-ms-interpolation-mode: bicubic; border: 0; display: block; margin: 0; max-width: 100%; padding: 0;">
			</img></a>
		</td>
		
		<td valign="middle" class="content-header__link" style="padding: 0; text-align: right;">
			<table class="contact" border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; margin: 0; mso-table-lspace: 0; mso-table-rspace: 0; text-align: right; width: 100%;">
				<tbody>
					<tr>
						<td style="font-family: "Arial", "helvetica", sans-serif; padding: 0;">
							<a href="tel:+380732295140" class="contact__phone" style="color: #FFFFFF; font-family: Helvetica; font-size: 18px; line-height: 30px; text-align: right; text-decoration: none;">+38 073 229 51 40</a>
						</td>
					</tr>
					<tr>
						<td style="font-family: "Arial", "helvetica", sans-serif; padding: 0;">
							<a href="mailto:glivi@gmail.com" class="contact__mail" style="color: #FFFFFF; font-family: Helvetica; font-size: 15px; line-height: 26px; text-align: right; text-decoration: none;">info@sls.by</a>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td class="layout__margin-right" style="padding: 0; width: 30px;"></td>
	</tr>
</table>

				</td>
				<td class="layout__margin-left" style="padding: 0; width: 10px;"></td>
			</tr>
			<tr>
				<td class="layout__margin-left" style="padding: 0; width: 10px;"></td>
				<td class="content-body" style="padding: 0;">
					
	<table class="content" width="100%" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;">
		<tbody>
			<tr>
				<td class="content__margin-left" style="padding: 0; width: 30px;"></td>
				<td class="content__margin-top" style="font-size: 40px; height: 40px; line-height: 40px; padding: 0;"/>
				<td class="content__margin-right" style="padding: 0; width: 30px;"></td>
			</tr>
			<tr class="message">
				<td class="content__margin-left" style="padding: 0; width: 30px;"></td>
				<td class="data" style="padding: 0;">
					<h1 class="message__title" style="color: #3D3D3D; display: block; font-family: Helvetica; font-size: 34px; font-weight: normal; letter-spacing: normal; line-height: 51px; text-align: left;">Здравствуйте, '.htmlspecialchars($_POST['user']).'!</h1>
					<p class="message__body" style="color: #3D3D3D; display: block; font-family: Helvetica; font-size: 18px; font-weight: lighter; line-height: 30px; text-align: left;">Мы благодаим вас за указанные данные. В ближайшее время с вами свяжется представитель диллера и ответит на интересующие вопросы.</p>
				</td>
				<td class="content__margin-right" style="padding: 0; width: 30px;"></td>
			</tr>
			<tr>
				<td class="content__margin-middle" style="font-size: 50px; height: 50px; line-height: 50px; padding: 0;"/>
			</tr>
			<tr>
				<td class="content__margin-left" style="padding: 0; width: 30px;"></td>
				<td class="data" style="padding: 0;">
					<table border="0" cellspacing="0" cellpadding="0" width="100%" class="data-table" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;">
						<tbody>
							<tr>
								<th class="data-table__title" style="border-bottom: 1px solid #E5E5E5; color: #2E2E2E; font-family: Helvetica; font-size: 20px; font-weight: 400; padding: 11px 0; text-align: left;">Указанные данные:</th>
								<td class="data-table__title" style="border-bottom: 1px solid #E5E5E5; color: #605F5F; font-family: Helvetica; font-size: 20px; font-weight: 200; padding: 11px 0; text-align: left;"/>
							</tr>
							'.$sFields.'
						</tbody>
					</table>
				</td>
				<td class="content__margin-right" style="padding: 0; width: 30px;"></td>
			</tr>
			<tr>
				<td class="content__margin-left" style="padding: 0; width: 30px;"></td>
				<td class="content__margin-bottom" style="font-size: 80px; height: 80px; line-height: 80px; padding: 0;"/>
				<td class="content__margin-right" style="padding: 0; width: 30px;"></td>
			</tr>
		</tbody>
	</table>

				</td>
				<td class="layout__margin-right" style="padding: 0; width: 10px;"></td>
			</tr>
			<tr>
				<td class="layout__margin-left" style="padding: 0; width: 10px;"></td>
				<td class="content-footer" style="background-color: #F2F6FA; padding: 0;">
					<table class="footer" border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0;">
	<tbody>
		<tr>
			<td class="footer__margin-left" style="font-family: Arial, Helvetica, sans-serif; padding: 0; width: 50px;"></td>
			<td style="font-family: Arial, Helvetica, sans-serif; padding: 0;">
				<table class="contact" border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0; width: 100%;">
					<tbody>
						<tr>
							<td class="contact__copyright" style="border-bottom: 1px solid #888888; color: #888888; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 16px; padding: 30px 0;">© SLS Group</td>
							<td class="contact__phone" style="border-bottom: 1px solid #888888; font-family: Arial, Helvetica, sans-serif; padding: 0; text-align: right;">
								<a href="tel:+375295868585" style="color: #888888; font-size: 16px; line-height: 16px; text-decoration: none;">Горячая линия: +375 29 586 85 85</a>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td class="footer__margin-right" style="font-family: Arial, Helvetica, sans-serif; padding: 0; width: 50px;"></td>
		</tr>
		<tr>
			<td class="footer__margin-left" style="font-family: Arial, Helvetica, sans-serif; padding: 0; width: 50px;"></td>
			<td class="footer__notice-text" style="color: #888888; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 20px; padding: 17px 0;"> Это письмо отправлено автоматически. Если вы думаете, что получили его по ошибке, просто игнорируйте его.</td>
			<td class="footer__margin-right" style="font-family: Arial, Helvetica, sans-serif; padding: 0; width: 50px;"></td>
		</tr>
	</tbody>
</table>
				</td>
				<td class="layout__margin-right" style="padding: 0; width: 10px;"></td>
			</tr>
		</table>
		
    <!--[if (gte mso 9)|(IE)]>
    </td>
    </tr>
    </table>
    <![endif]-->

	</div>
</body>

</html> ';
	
	$arDist = array(
		'1' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'2' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'3' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'4' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'5' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'6' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'7' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'8' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'9' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'10' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'11' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'12' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'13' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'14' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'15' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'16' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'17' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'18' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'19' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'20' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'21' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'22' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'23' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'24' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'25' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by',
		'26' => 'p.solomenik@sls.by, i.dolbik@sls.by, Mark.PVN@berezaksi.by'
	);
	$nDist = htmlspecialchars($_POST['distributor']);
	if(array_key_exists ((string)$nDist, $arDist)){
		
		$bFlag = false;
		$arMail = explode(',', $arDist[$nDist]);
		
		foreach($arMail as $val){
			if(!empty($val)){
				$bFlag = mail(
					$val,
					'Письмо с сайта slsgroup.com.ua',
					$sHtml,
					"From: info@sls.by\r\n"
					."Content-type:text/html; charset=utf-8\r\n"
					."X-Mailer:PHP mail script"
				);
			}
		}
		
		if($bFlag){
			echo 'Y';
		}
	} else {
		echo 'N';
	}
	
	die();
} else {
	echo 'N';
}
?>