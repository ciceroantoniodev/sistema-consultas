<%
f_tipo = Request.QueryString("tp")
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>:::: SysControle - Voc� no Controle :::: </title>
	<script language="Javascript" src="funcoes.js" type="text/javascript"></script>
	<script language="Javascript" type="text/javascript">
	function fAtivarEnquete(id) {
	window.location.href = "web_enquetes.asp?enquete=" + id;
	}
	</script>
    <style type="text/css">
    <!--
      @import url(../estilo.css);
    -->
	.box  {border: #CCCCCC;
	           border-style: solid;
           border-top-width: 1px;
           border-right-width: 0px;
           border-bottom-width: 0px;
           border-left-width: 1px}
    </style>
</head>

<body style='background-color: #ffffff; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt'>
<div align="center">
<a name="#inicio"></a>
<table id="empresa" cellspacing="0" cellpadding="0" border="0" width="80%">
  <tr>
	<td id="descricao" valign="top" bgcolor="#ffffff">
	  <form action="form_dados.asp?tit=enquetes&bd=web_enquete_perguntas" method="post" name="form_excluir">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
		<tr>
		  <td align="center" valign="top">
		    <br><br>
		    <span style="font-size: 28px; color: #666666">SISTEMA DE PONTUA��O</span><br><br>
		    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td align="left">
				  <p>O Sistema de Pontua��o credita pontos no cadastro do usu�rio (pessoa f�sica ou jur�dica), e sua utiliza��o funciona da seguinte forma:</p>
				  <p><span style="font-size: 16px; color: #ff0000"><b>Pessoa F�sica (compradores)</b></span></p>

			      <ul type="square" style="margin-left: 15px">
				    <li>Para participar, o usu�rio precisar estar devidamente cadastrado no site e fazer o login no topo da p�gina.</li><br><br>
					<li>A cada compra automaticamente 5% do valor de sua compra (excluindo o frete) ser� convertido em pontos. </li><br><br>
					<li>Ao atingir um limite base de pontua��es, ao efetuar uma nova compra aparecer� a op��o "QUERO UTILIZAR MEUS PONTOS" destacada na p�gina de finaliza��o de suas compras. Basta selecionar esta op��o, e o sistema informar� qual o valor do desconto baseado na pontua��o acumulada.</li>
				  </ul>
				  <b>OBS. (leia com muita aten��o):</b> 
				  <ol style="margin-left: 25px">
				    <li>Os pontos n�o poder�o ser creditados para o pagamento de frete. O custo de entrega sempre correr� por conta do cliente, a n�o ser que o VENDEDOR fa�a uma promo��o de �frete gr�tis.�</li><br><br>
					<li>O Portal Oficinas Automotiva reserva-se no direito de, em dado momento, cancelar qualquer promo��o ou modificar seus termos sem aviso pr�vio. Se esse for o caso, buscaremos sempre a melhor maneira de recompensar nossos usu�rios pela inconveni�ncia.</li>
				  </ol>
				  <%If f-tipo <> "usuario" Then%>
				  <br><p><span style="font-size: 16px; color: #ff0000"><b>Pessoa Jur�dica (anunciantes/vendedores)</b></span></p>
				  <p>A utiliza��o do Sistema de Pontua��o por <b>Pessoa Jur�dica</b>, est� condicionada ao destaque que a mesma receber� dentro do Portal, sendo classificada como uma empresa ATIVA, e estando sempre acima das empresas que possuem um menor n�mero de pontua��o.</p>
				  <p>Para esta classifica��o, o Portal disponibiliza uma tabela de pontua��o diferenciada, cujo cr�dito ocorrer� de acordo com a a��o executada dentro do Portal.</p>
				  <p>A tabela de pontua��o � a seguinte:</p>
				  <table class="letras_">
				    <tr bgcolor="#333333">
					  <td align="center"><font color="#ffffff">A��O</font></td>
					  <td width="80" align="center"><font color="#ffffff">PONTOS</font></td>
					</tr>
				    <tr>
					  <td>Contrata��o de Hot-Site:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;1500</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>An�ncio Pago na Se��o Empresas:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;1000</td>
					</tr>
				    <tr>
					  <td>Super-Banner Superior (se��o Shopping):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;800</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Full-Banner Superior (menos na se��o Shopping):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;600</td>
					</tr>
				    <tr>
					  <td>Mini-Banner Lateral:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;400</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Contrata��o do Sistema de Avalia��o:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;400</td>
					</tr>
				    <tr>
					  <td>Email Marketing (newsletter)</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;400</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>An�ncio em Shopping-oficinas (todas as se��es):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;300</td>
					</tr>
				    <tr>
					  <td>Produtos em Destaque (se��o Home - Shopping Destaques):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;200</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Venda de Produto Concretizada no Shopping:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;150</td>
					</tr>
				    <tr>
					  <td>Produtos em Destaque (se��o Shopping):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;150</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Empresa Avaliada (por avalia��o):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;100</td>
					</tr>
				    <tr>
					  <td>Dicas T�cnicas:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;100</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Edi��o de Artigos</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;100</td>
					</tr>
				    <tr>
					  <td>Resposta ao F�rum:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;50</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Acesso � �rea Restrita (per�odo de 1 hora entre cada acesso):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;50</td>
					</tr>
				    <tr>
					  <td>Clique em Detalhes de Produtos:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;10</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Clique em Detalhes da Empresa:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;10</td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
				  </table><br>
				  <b>OBS. (leia com muita aten��o):</b> 
				  <ol style="margin-left: 25px">
				    <li>A contabiliza��o dos pontos s� ser� poss�vel caso o usu�rio esteja devidamente logado (fazer login no topo da p�gina).</li><br><br>
				    <li>Apenas os an�ncios PAGOS aparecer�o em destaque na primeira p�gina (HOME).</li><br><br>
				    <li>Para aparecer em destaque na primeira p�gina (HOME) como "Empresa Mais Ativa", ser� necess�rio acumular no m�nimo 1500 pontos.</li><br><br>
					<li>Nas a��es por cliques, ser�o contabilizados apenas o primeiro clique por cada usu�rio.</li><br><br>
					<li>As Dicas T�cnicas e Edi��o de Artigos, estar�o sujeitas � an�lise de conte�do pela Equipe de Reda��o do Portal Oficinas Automotiva.</li><br><br>
					<li>A m� conduta, o mal uso do Portal e seus Sistemas, a falta de id�neidade, a inatividade prolongada, podem resultar em perdas de at� 1000 pontos a depender da a��o descriminada neste item, podendo resultar na rescis�o de contrato ou exclus�o do Portal.</li><br><br>
					<li>O Portal Oficinas Automotiva reserva-se no direito de, em dado momento, modificar ou acrescentar itens a esta lista sem aviso pr�vio.</li>
				  </ol>
				  <%End If%>
				</td>
			  </tr>
			</table>
		  </td>
		</tr>
	  </table>
	  </form>
	</td>
  </tr>
</table>
</div>
</body>
</html>