<%
f_tipo = Request.QueryString("tp")
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>:::: SysControle - Você no Controle :::: </title>
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
		    <span style="font-size: 28px; color: #666666">SISTEMA DE PONTUAÇÃO</span><br><br>
		    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td align="left">
				  <p>O Sistema de Pontuação credita pontos no cadastro do usuário (pessoa física ou jurídica), e sua utilização funciona da seguinte forma:</p>
				  <p><span style="font-size: 16px; color: #ff0000"><b>Pessoa Física (compradores)</b></span></p>

			      <ul type="square" style="margin-left: 15px">
				    <li>Para participar, o usuário precisar estar devidamente cadastrado no site e fazer o login no topo da página.</li><br><br>
					<li>A cada compra automaticamente 5% do valor de sua compra (excluindo o frete) será convertido em pontos. </li><br><br>
					<li>Ao atingir um limite base de pontuações, ao efetuar uma nova compra aparecerá a opção "QUERO UTILIZAR MEUS PONTOS" destacada na página de finalização de suas compras. Basta selecionar esta opção, e o sistema informará qual o valor do desconto baseado na pontuação acumulada.</li>
				  </ul>
				  <b>OBS. (leia com muita atenção):</b> 
				  <ol style="margin-left: 25px">
				    <li>Os pontos não poderão ser creditados para o pagamento de frete. O custo de entrega sempre correrá por conta do cliente, a não ser que o VENDEDOR faça uma promoção de “frete grátis.”</li><br><br>
					<li>O Portal Oficinas Automotiva reserva-se no direito de, em dado momento, cancelar qualquer promoção ou modificar seus termos sem aviso prévio. Se esse for o caso, buscaremos sempre a melhor maneira de recompensar nossos usuários pela inconveniência.</li>
				  </ol>
				  <%If f-tipo <> "usuario" Then%>
				  <br><p><span style="font-size: 16px; color: #ff0000"><b>Pessoa Jurídica (anunciantes/vendedores)</b></span></p>
				  <p>A utilização do Sistema de Pontuação por <b>Pessoa Jurídica</b>, está condicionada ao destaque que a mesma receberá dentro do Portal, sendo classificada como uma empresa ATIVA, e estando sempre acima das empresas que possuem um menor número de pontuação.</p>
				  <p>Para esta classificação, o Portal disponibiliza uma tabela de pontuação diferenciada, cujo crédito ocorrerá de acordo com a ação executada dentro do Portal.</p>
				  <p>A tabela de pontuação é a seguinte:</p>
				  <table class="letras_">
				    <tr bgcolor="#333333">
					  <td align="center"><font color="#ffffff">AÇÃO</font></td>
					  <td width="80" align="center"><font color="#ffffff">PONTOS</font></td>
					</tr>
				    <tr>
					  <td>Contratação de Hot-Site:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;1500</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Anúncio Pago na Seção Empresas:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;1000</td>
					</tr>
				    <tr>
					  <td>Super-Banner Superior (seção Shopping):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;800</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Full-Banner Superior (menos na seção Shopping):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;600</td>
					</tr>
				    <tr>
					  <td>Mini-Banner Lateral:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;400</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Contratação do Sistema de Avaliação:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;400</td>
					</tr>
				    <tr>
					  <td>Email Marketing (newsletter)</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;400</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Anúncio em Shopping-oficinas (todas as seções):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;300</td>
					</tr>
				    <tr>
					  <td>Produtos em Destaque (seção Home - Shopping Destaques):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;200</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Venda de Produto Concretizada no Shopping:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;150</td>
					</tr>
				    <tr>
					  <td>Produtos em Destaque (seção Shopping):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;150</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Empresa Avaliada (por avaliação):</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;100</td>
					</tr>
				    <tr>
					  <td>Dicas Técnicas:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;100</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Edição de Artigos</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;100</td>
					</tr>
				    <tr>
					  <td>Resposta ao Fórum:</td>
					  <td>&nbsp;&nbsp;&nbsp;&nbsp;50</td>
					</tr>
				    <tr bgcolor="#f3f3f3">
					  <td>Acesso à Área Restrita (período de 1 hora entre cada acesso):</td>
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
				  <b>OBS. (leia com muita atenção):</b> 
				  <ol style="margin-left: 25px">
				    <li>A contabilização dos pontos só será possível caso o usuário esteja devidamente logado (fazer login no topo da página).</li><br><br>
				    <li>Apenas os anúncios PAGOS aparecerão em destaque na primeira página (HOME).</li><br><br>
				    <li>Para aparecer em destaque na primeira página (HOME) como "Empresa Mais Ativa", será necessário acumular no mínimo 1500 pontos.</li><br><br>
					<li>Nas ações por cliques, serão contabilizados apenas o primeiro clique por cada usuário.</li><br><br>
					<li>As Dicas Técnicas e Edição de Artigos, estarão sujeitas à análise de conteúdo pela Equipe de Redação do Portal Oficinas Automotiva.</li><br><br>
					<li>A má conduta, o mal uso do Portal e seus Sistemas, a falta de idôneidade, a inatividade prolongada, podem resultar em perdas de até 1000 pontos a depender da ação descriminada neste item, podendo resultar na rescisão de contrato ou exclusão do Portal.</li><br><br>
					<li>O Portal Oficinas Automotiva reserva-se no direito de, em dado momento, modificar ou acrescentar itens a esta lista sem aviso prévio.</li>
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