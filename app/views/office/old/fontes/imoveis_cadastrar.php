<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fIdu(0, $_GET["idu"]) : NULL;
$vgetIDFRANQUIA = isset($_GET["idf"]) ? $_GET["idf"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;
$vgetNIVEL = isset($_GET["n"]) ? $_GET["n"] : NULL;
$vgetIDVENDEDOR = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vgetACAO = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

$vSALVAR = "N";

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { 
	$vBotaoVoltar = 1;
	
} else {
	$vBotaoVoltar = ((int)$vBotaoVoltar + 1);
	
}

$vTituloSecao = "CADASTRAR IMÓVEL";

include("fckeditor/fckeditor.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <script language="JavaScript" type="text/javascript" src="js/funcoes_geral.js"></script>
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
	
    <style type="text/css">
    <!--
	a:link    {color: #ff0000; text-decoration: none}
    a:visited {color: #ff0000; text-decoration: none}
    a:hover   {color: #bbad00; text-decoration: underline}
    -->	
    </style>
	
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
	
</head>
  
<body>
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;
	
	include "_submenus.php";
	?>
	
	<div align="center" id="boxEIXO">
		<div id="form-cadastros" class="widthVAR">
			<a href="javascript: history.go(-<?php echo $vBotaoVoltar ?>)"><div class="botao-voltar"><img src="images/botao_voltar.gif" height="30" /></div></a><div align="center" class="form-cadastros-head"><?php echo $vTituloSecao ?></div>
			
			<div class="clear">&nbsp;</div>
			
			<div align="center">

			
<!-- --------------------------- INÍCIO DA TABELA CORPO -->

				<form action="salvar_imoveis.php?local=<?php echo $getLOCAL ?>&idu=<?php echo fIdu(1, $vgetIDUSUARIO) ?>&idf=<?php echo $vgetIDFRANQUIA ?>&tp=<?php echo $vgetTIPO ?>&r=<?php echo $vgetROTINAS ?>" method="post" name="frmAnuncio" target="target_" onSubmit="return fValidarDados()" style="margin: 20px;">
					<input type="hidden" name="formACAO" value="salvar" />
					
					<div align="left" class="borda_titulo">Dados Iniciais</div>	
					
					<table width="100%" border="0" cellspacing="1" cellpadding="1" class="letras_">
						<tr>
							<td width="100">Tipo do Im&oacute;vel:</td>
							<td>
								<select name="formTIPO" class="form_" onchange="">
									<option value="">Selecione</option>
									<option value="Apartamento">Apartamento</option>
									<option value="Casa">Casa</option>
									<option value="Flat">Flat</option>
									<option value="Galp&#227;">Galp&#227;o</option>
									<option value="Loja">Loja</option>
									<option value="Escrit&#243;rio">Escrit&#243;rio</option>
									<option value="Terreno">Terreno</option>
									<option value="Im&#243;vel Rural">Im&#243;vel Rural</option>
									<option value="Pr&#233;dio Inteiro">Pr&#233;dio Inteiro</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Finalidade:</td>
							<td>
								<select name="formFINALIDADE" class="form_" onchange="">
									<option value="">Selecione</option>
									<option value="Revenda">Revenda</option>
									<option value="Locação">Locação</option>
									<option value="Temporada">Temporada</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Cidade:</td>
							<td>
								<select name="formCIDADE" class="form_" onchange="">
									<option value="4">PETROLINA</option>
								</select>
							</td>
						</tr>
					</table>
					
					<div class="clear">&nbsp;</div>
					<div class="clear">&nbsp;</div>

					<!-- INÍCIO DA TABELA ENDEREÇO DO IMÓVEL -->
					
					<div align="left" class="borda_titulo">Endereço do Im&oacute;vel</div>
					
					<table width="100%" border="0" cellspacing="1" cellpadding="1" class="letras_">
						<tr>
							<td width="100">CEP do Im&oacute;vel:</td>
							<td colspan="3"><input name="formCEP" type="text" maxlength="8" class="form_" Size="8"></td>
						</tr>
						<tr>
							<td>Endere&ccedil;o:</td>
							<td colspan="3" ><input name="formENDERECO" type="text" value="" maxlength="150" class="form_" size="80"></td>
						</tr>
						<tr>
							<td>N&uacute;mero:</td>
							<td colspan="3" ><input name="formENDERECO_NUMERO" type="text" maxlength="10" class="form_" size="10"></td>
						</tr>
						<tr>
							<td class="LabelLateral">Complemento:</td>
							<td><input name="formCOMPLEMENTO" type="text" maxlength="50" class="form_" size="21"></td>
						</tr>
						<tr>
							<td class="LabelLateral">Bairro:</td>
							<td><input name="formBAIRRO" type="text" maxlength="80" class="form_" Size="40"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input name="formMAPA" type="checkbox" value="S" checked="checked"> quero apresentar o mapa de localiza&ccedil;&atilde;o do meu im&oacute;vel.</td>
						</tr>
					</table>

					<div class="clear">&nbsp;</div>
					<div class="clear">&nbsp;</div>

					<!-- INÍCIO DA TABELA CARACTERÍSTICAS DO IMÓVEL -->
					
					<div class="borda_titulo">Caracter&iacute;sticas do Im&oacute;vel</div>
					
					<table width="100%" border="0" cellspacing="1" cellpadding="1" class="letras_">
						<tr>
							<td width="100">N&deg; de Quartos:</td>
							<td>
								<select name="formCARACT_QUARTOS" class="form_">
									<option value="">Selecione</option>
									<option value="0">0 dormit&#243;rios (Loft/Studio)</option>
									<option value="1">1 dormit&#243;rio</option>
									<option value="2">2 dormit&#243;rios</option>
									<option value="3">3 dormit&#243;rios</option>
									<option value="4">4 dormit&#243;rios</option>
									<option value="5">5 dormit&#243;rios</option>
									<option value="6">6 dormit&#243;rios</option>
									<option value="7">7 dormit&#243;rios</option>
									<option value="8">8 dormit&#243;rios</option>
									<option value="9">9 dormit&#243;rios</option>
									<option value="10">10 dormit&#243;rios</option>
									<option value="11">11 dormit&#243;rios</option>
									<option value="12">12 dormit&#243;rios</option>
									<option value="13">13 dormit&#243;rios</option>
									<option value="14">14 dormit&#243;rios</option>
									<option value="15">15 dormit&#243;rios</option>
									<option value="16">16 dormit&#243;rios</option>
									<option value="17">17 dormit&#243;rios</option>
									<option value="18">18 dormit&#243;rios</option>
									<option value="19">19 dormit&#243;rios</option>
									<option value="20">20 dormit&#243;rios</option>
									<option value="21">mais de 20 dormit&#243;rios</option>
								</select>
							</td>
							<td>N&deg; de Su&iacute;tes:</td>
							<td>
								<select name="formCARACT_SUITES" class="form_">
									<option value="">Selecione</option>
									<option value="0">0 su&#237;tes</option>
									<option value="1">1 su&#237;te</option>
									<option value="2">2 su&#237;tes</option>
									<option value="3">3 su&#237;tes</option>
									<option value="4">4 su&#237;tes</option>
									<option value="5">5 su&#237;tes</option>
									<option value="6">6 su&#237;tes</option>
									<option value="7">7 su&#237;tes</option>
									<option value="8">8 su&#237;tes</option>
									<option value="9">9 su&#237;tes</option>
									<option value="10">10 su&#237;tes</option>
									<option value="11">mais de 10 su&#237;tes</option>
								</select>
							</td>	
						</tr>
						<tr>
							<td>N&deg; de Banheiros:</td>
							<td>
								<select name="formCARACT_BANHEIROS" class="form_">
									<option value="">Selecione</option>
									<option value="0">0 banheiros</option>
									<option value="1">1 banheiro</option>
									<option value="2">2 banheiros</option>
									<option value="3">3 banheiros</option>
									<option value="4">4 banheiros</option>
									<option value="5">5 banheiros</option>
									<option value="6">6 banheiros</option>
									<option value="7">7 banheiros</option>
									<option value="8">8 banheiros</option>
									<option value="9">9 banheiros</option>
									<option value="10">10 banheiros</option>
									<option value="11">mais de 10 banheiros</option>
								</select>
							</td>
							<td>Vagas na Garagem:</td>
							<td>
								<select name="formCARACT_VAGAS" class="form_">
									<option value="">Selecione</option>
									<option value="0">0 vagas</option>
									<option value="1">1 vaga</option>
									<option value="2">2 vagas</option>
									<option value="3">3 vagas</option>
									<option value="4">4 vagas</option>
									<option value="5">5 vagas</option>
									<option value="6">6 vagas</option>
									<option value="7">7 vagas</option>
									<option value="8">8 vagas</option>
									<option value="9">9 vagas</option>
									<option value="10">10 vagas</option>
									<option value="11">mais de 10 vagas</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>&Aacute;rea &uacute;til:</td>
							<td><input name="formCARACT_AREA" type="text" maxlength="6" class="form_"><strong>m<sup>2</sup></strong></td>
							<td width="120">Metragem da Frente:</td>
							<td><input name="formCARACT_METRAGEM" type="text" maxlength="6" class="form_"><strong>m<sup>2</sup></strong></td>
						</tr>
						<tr>
							<td>Localização:</td>
							<td>
								<select name="formCARACT_LOCALIZACAO" class="form_">
									<option value="">Selecione</option>
									<option value="Via P&#250;blica">Via P&#250;blica</option>
									<option value="Condom&#237;nio">Condom&#237;nio</option>
									<option value="Vila">Vila</option>
								</select>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
			  
					<div class="clear">&nbsp;</div>
					<div class="clear">&nbsp;</div>

					<!-- INÍCIO DA TABELA PREÇOS E CONDIÇÕES -->
			
					<div class="borda_titulo">Pre&ccedil;os e Condi&ccedil;&otilde;es</div>
					
					<table width="100%" border="0" cellspacing="1" cellpadding="1" class="letras_">
						<tr>
							<td colspan="2">
								<span style="font-size: 16px">Pre&ccedil;o de Revenda:&nbsp;&nbsp;<strong>R$</strong></span>
								<input name="formCONDICAO_PRECO" type="text" maxlength="8" class="form_"><br><br>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="checkbox" name="formCONDICAO_PERMUTA" value="S">Aceita Permuta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="formCONDICAO_FINANCIAMENTO" value="S">Aceita financiamento&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="formCONDICAO_CARTAOCREDITO" value="S">Aceita carta de crédito&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="formCONDICAO_TRANSFERENCIA" value="S">Transferência de financiamento<br><br>
							</td>
						</tr>
						<tr>
							<td nowrap="nowrap">Valor do IPTU:</td>
							<td width="100%">
								<input name="formCONDICAO_IPTU" type="text" maxlength="5" value="0" class="form_" size="10">
								<strong>,00 anual</strong>&nbsp;&nbsp;&nbsp;
								<span style="color: #ff0000"><i>(Entre com R$ 0 caso seja isento)</i></span>
							</td>
						</tr>
						<tr>
							<td nowrap="nowrap">&Aacute;rea do Terreno:</td>
							<td width="200"><input name="formCONDICAO_TERRENO" type="text" maxlength="6" class="form_" size="10" onkeypress="return fApenasNumero(event);"><strong>m<sup>2</sup></strong></td>
						</tr>
						<tr>
							<td nowrap="nowrap">&Aacute;rea Constru&iacute;da:</td>
							<td><input name="formCONDICAO_CONSTRUIDA" type="text" maxlength="6" class="form_" size="10" onkeypress="return fApenasNumero(event);"><strong>m<sup>2</sup></strong></td>
						</tr>
						<tr id="CondominioValor">
							<td nowrap="nowrap">Valor do Condom&iacute;nio:</td>
							<td>
								<input name="formCONDICAO_VLRCONDOMINIO" type="text" maxlength="5" class="form_" size="10" onkeypress="return fApenasNumero(event);">
								<strong>,00 mensal</strong>&nbsp;&nbsp;
								<span style="color: #ff0000"><i>Entre com R$ 0 caso seja isento</i></span>
							</td>
						</tr>
						<tr>
							<td nowrap="nowrap">Ano de constru&ccedil;&atilde;o:</td>
							<td><input name="formCONDICAO_ANO" type="text" maxlength="4" class="form_" size="4" onkeypress="return fApenasNumero(event);"></td>
						</tr>
						<tr>
							<td nowrap="nowrap">N&uacute;mero de Pavimentos:&nbsp;</td>
							<td><input name="formCONDICAO_PAVIMENTOS" type="text" maxlength="2" class="form_" size="10" onkeypress="return fApenasNumero(event);"></td>
						</tr>
						<tr>
							<td nowrap="nowrap">Tipo do Im&oacute;vel:</td>
							<td>
								<select name="formCONDICAO_TIPO" class="form_">
									<option selected="selected" value="Selecione">Selecione</option>
									<option value="33554432">Casa T&#233;rrea</option>
									<option value="16777216">Sobrado/Duplex</option>
								</select>
							</td>
						</tr>
						<tr>
							<td nowrap="nowrap">Zoneamento:</td>
							<td><input name="formCONDICAO_ZONEAMENTO" type="text" maxlength="50" class="form_" size="15"></td>
						</tr>
						<tr>
							<td nowrap="nowrap">Nome do Condom&iacute;nio:</td>
							<td><input name="formCONDICAO_CONDOMINIO" type="text" size="60" maxlength="100" class="form_"></td>
						</tr>
					</table>

					<div class="clear">&nbsp;</div>
					<div class="clear">&nbsp;</div>

					<!-- INÍCIO DA TABELA CARCATERÍSTICAS DA PLANTA -->
					
					<div class="borda_titulo">Caracter&iacute;sticas da Planta</div>

					<table cellspacing="0" cellpadding="0" border="0" class="letras_">
						<tr>
							<td width="215"><input type="checkbox" name="formCARACTERISTICAS[]" value="Adega" />Adega</td>
							<td width="215"><input type="checkbox" name="formCARACTERISTICAS[]" value="Área de serviço" />Área de serviço</td>
							<td width="215"><input type="checkbox" name="formCARACTERISTICAS[]" value="Canil" />Canil</td>
							<td width="215"><input type="checkbox" name="formCARACTERISTICAS[]" value="Casa de caseiro" />Casa de caseiro</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Closet" />Closet</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Copa" />Copa</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Cozinha americana" />Cozinha americana</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Cozinha independente" />Cozinha independente</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Deck" />Deck</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Dependência de empregados" />Dependência de empregados</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Despensa" />Despensa</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Edícula" />Edícula</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Entrada lateral" />Entrada lateral</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Entrada de serviço" />Entrada de serviço</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Escritório" />Escritório</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Frente para o mar" />Frente para o mar</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Garagem" />Garagem</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Lareira" />Lareira</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Lavab" />Lavabo</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Lavanderia" />Lavanderia</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Mesanino" />Mesanino</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Pátio" />Pátio</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Piso elevado" />Piso elevado</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Quintal" />Quintal</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Sala de jantar" />Sala de jantar</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Sala de TV" />Sala de TV</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Varanda" />Varanda</td>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="Vestiário" />Vestiário</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="formCARACTERISTICAS[]" value="WC para empregados" />WC para empregados</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				
					<div class="clear">&nbsp;</div>
					
					<!-- INÍCIO DA TABELA INSTALAÇÕES -->
					
					<div style="font-size: 18px">Instala&ccedil;&otilde;es</div>
					
					<div class="clear">&nbsp;</div>

					<table cellspacing="0" cellpadding="0" border="0" class="letras_">
						<tr>
							<td width="215"><input type="checkbox" name="formINSTALACOES[]" value="Antena parabólica" />Antena parabólica</td>
							<td width="215"><input type="checkbox" name="formINSTALACOES[]" value="Aquecedor" />Aquecedor</td>
							<td width="215"><input type="checkbox" name="formINSTALACOES[]" value="Ar condicionado" />Ar condicionado</td>
							<td width="215"><input type="checkbox" name="formINSTALACOES[]" value="Armário de cozinha" />Armário de cozinha</td>
						</tr><tr>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Armário embutido" />Armário embutido</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Carpete" />Carpete</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Carpete de madeira" />Carpete de madeira</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Energia elétrica" />Energia elétrica</td>
						</tr><tr>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Esgoto" />Esgoto</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Hidromassagem" />Hidromassagem</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Luminárias" />Luminárias</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Luz elétrica" />Luz elétrica</td>
						</tr><tr>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Piso frio" />Piso frio</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Piso laminado" />Piso laminado</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Piso de madeira" />Piso de madeira</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Portão Eletrônico" />Portão Eletrônico</td>
						</tr><tr>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Reservatório de água" />Reservatório de água</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Sistema de alarme" />Sistema de alarme</td>
							<td><input type="checkbox" name="formINSTALACOES[]" value="Telefone" />Telefone</td>
							<td>&nbsp;</td>
						</tr>
					</table>
					
					<div class="clear">&nbsp;</div>
					
					<!-- INÍCIO DA TABELA INFRA ESTRUTURA DO CONDOMÍNIO -->
					
					<div style="font-size: 18px">Infra estrutura do Condom&iacute;nio</div>
					
					<div class="clear">&nbsp;</div>
					
					<table cellspacing="0" cellpadding="0" border="0" class="letras_">
						<tr>
							<td width="215"><input type="checkbox" name="formINFRAESTRUTURA[]" value="Acesso para deficientes" />Acesso para deficientes</td>
							<td width="215"><input type="checkbox" name="formINFRAESTRUTURA[]" value="Água encanada" />Água encanada</td>
							<td width="215"><input type="checkbox" name="formINFRAESTRUTURA[]" value="Estacionamento" />Estacionamento</td>
							<td width="215"><input type="checkbox" name="formINFRAESTRUTURA[]" value="Estacionamento coberto" />Estacionamento coberto</td>
						</tr><tr>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Estacionamento para visitantes" />Estacionamento para visitantes</td>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Gerador" />Gerador</td>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Guarita" />Guarita</td>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Lavanderia coletiva" />Lavanderia coletiva</td>
						</tr><tr>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Portaria 24 horas" />Portaria 24 horas</td>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Portaria com controle de acesso" />Portaria com controle de acesso</td>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Rede telefônica" />Rede telefônica</td>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Ruas asfaltadas" />Ruas asfaltadas</td>
						</tr><tr>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Sistema de esgoto" />Sistema de esgoto</td>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Sistema de incêndio" />Sistema de incêndio</td>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Telefone DDR" />Telefone DDR</td>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="TV a cabo" />TV a cabo</td>
						</tr><tr>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Vestiário para diaristas" />Vestiário para diaristas</td>
							<td><input type="checkbox" name="formINFRAESTRUTURA[]" value="Vigilância 24h" />Vigilância 24h</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
					
					<div class="clear">&nbsp;</div>
					
					<!-- INÍCIO DA TABELA INFRA ESTRUTURA DO CONDOMÍNIO -->
					
					<div style="font-size: 18px">Lazer</div>

					<div class="clear">&nbsp;</div>
					
					<table name="tblAnuncioLazer" cellspacing="0" cellpadding="0" border="0" class="letras_">
						<tr>
							<td width="215"><input type="checkbox" name="formLAZER[]" value="Campo de futebol" />Campo de futebol</td>
							<td width="215"><input type="checkbox" name="formLAZER[]" value="Campo de golfe" />Campo de golfe</td>
							<td width="215"><input type="checkbox" name="formLAZER[]" value="Churrasqueira" />Churrasqueira</td>
							<td width="215"><input type="checkbox" name="formLAZER[]" value="Forno de pizza" />Forno de pizza</td>
						</tr><tr>
							<td><input type="checkbox" name="formLAZER[]" value="Jardim" />Jardim</td>
							<td><input type="checkbox" name="formLAZER[]" value="Marina" />Marina</td>
							<td><input type="checkbox" name="formLAZER[]" value="Piscina" />Piscina</td>
							<td><input type="checkbox" name="formLAZER[]" value="Piscina aquecida" />Piscina aquecida</td>
						</tr><tr>
							<td><input type="checkbox" name="formLAZER[]" value="Piscina infantil" />Piscina infantil</td>
							<td><input type="checkbox" name="formLAZER[]" value="Pista de cooper" />Pista de cooper</td>
							<td><input type="checkbox" name="formLAZER[]" value="Playground" />Playground</td>
							<td><input type="checkbox" name="formLAZER[]" value="Quadra de esportes" />Quadra de esportes</td>
						</tr><tr>
							<td><input type="checkbox" name="formLAZER[]" value="Quadra poli-esportiva" />Quadra poli-esportiva</td>
							<td><input type="checkbox" name="formLAZER[]" value="Quadra de squash" />Quadra de squash</td>
							<td><input type="checkbox" name="formLAZER[]" value="Quadra de tênis" />Quadra de tênis</td>
							<td><input type="checkbox" name="formLAZER[]" value="Sala de ginástica" />Sala de ginástica</td>
						</tr><tr>
							<td><input type="checkbox" name="formLAZER[]" value="Salão de festas" />Salão de festas</td>
							<td><input type="checkbox" name="formLAZER[]" value="Salão de Jogos" />Salão de Jogos</td>
							<td><input type="checkbox" name="formLAZER[]" value="Sauna" />Sauna</td><td></td>
						</tr>
					</table>
			
					<div class="clear">&nbsp;</div>
					<div class="clear">&nbsp;</div>

					<!-- INÍCIO DA TABELA INFORMAÇÕES ADICIONAIS -->
			
					<div class="borda_titulo">Informa&ccedil;&otilde;es Adicionais</div>
					
					<div>
						<?php
						$vformMENSAGEM = "";
						
						$sBasePath = "fckeditor/";

						$oFCKeditor = new FCKeditor('formINFORMACOES') ;
						$oFCKeditor->BasePath	= $sBasePath ;
						$oFCKeditor->Width = 940;
						$oFCKeditor->Height = 120;
						$oFCKeditor->ToolbarSet = "Basic";
						$oFCKeditor->Value = $vformMENSAGEM;
						$oFCKeditor->Create();
						?>

					</div>
			
					<div class="clear">&nbsp;</div>
					<div class="clear">&nbsp;</div>

					<!-- INÍCIO DA TABELA TERMOS DE USO DO ANÚNCIO AVULSO -->

					<iframe src="../vazio.php" scrolling="yes" frameborder="0" id="idFrame" name="target_" style="border: #cccccc 1px solid; overflow:hidden; width:800px; height:200px;" allowTransparency="true"></iframe>

					<div align="center" style="margin-top: 20px; margin-bottom: 40px">
						<input type="submit" value="       Enviar Formulário       " class="submit_">
					</div>
				</form>
				
<!-- --------------------------- FINAL DA TABELA CORPO -->				

			</div>

		</div>

	</div>

	<div class="clear">&nbsp;</div>
	<div class="clear">&nbsp;</div>
	
	<div id="boxDIALOGO"></div>

	<script type="text/javascript">
		document.getElementById("boxDIALOGO").style.top = (fElementoPos("boxEIXO").top-70) + "px";

	</script>
</body>
</html>