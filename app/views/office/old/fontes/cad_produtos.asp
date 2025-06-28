<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<%
f_id = Request.QueryString("id")
id_cadastro = Session("sysoficinasIDCADASTRO")
vOrigem = Request.QueryString("o")
f_valor = 0
f_tipo = "novo"

f_descricao = ""
f_referencia = ""
f_fabricante = ""
f_marca = ""
f_veiculos = ""
f_informacoes = "" 
f_valornormal = "0"
f_desconto = "0"
f_valoravista   = "0"
f_parcelas = "0"
f_estatual = "0"

If CInt(vOrigem) = 1 Then
  Set dbDados = conexao.Execute("select * from produtos where id=" & f_id)
  
  vCheckN = ""
  vCheckU = ""
  vCheckR = ""

  If dbDados("condicao") = "NOVO" Then
    vCheckN = "checked"
  ElseIf dbDados("condicao") = "USADO" Then
    vCheckU = "checked"
  ElseIf dbDados("condicao") = "REMANUFATURADO" Then
    vCheckR = "checked"
  End If
 
  f_descricao = dbDados("descricao")
  f_referencia = dbDados("referencia")
  f_fabricante = dbDados("fabricante")
  f_marca = dbDados("marca")
  f_valornormal = dbDados("valor_normal")
  f_desconto = dbDados("desconto")
  f_valoravista   = dbDados("valor_avista")
  f_parcelas = dbDados("parcelas")
  f_veiculos = dbDados("veiculos")
  f_estatual = dbDados("estatual")
  f_informacoes = dbDados("informacoes")
  f_tipo = "alterar"
  
  Set dbDados = Nothing
End If

If vOrigem = "" Then
  vOrigem = Request.Form("o")
End If

If CInt(vOrigem) = 2 Then
  Set dbDados = conexao.Execute("select * from cadastros where id=" & id_cadastro)
  vEmpresa = dbDados("fantasia")
  f_cidade = dbDados("cidade")
  f_estado = dbDados("estado")
  vProdutos = CInt(Session("sysoficinasTOTALPRODUTOS")) + 1
  Set dbDados = Nothing

  conexao.Execute("update cadastros set produtos=" & vProdutos & " where id=" & id_cadastro)
  vAcao = 1

  f_id = Request.Form("id")
  f_tipo = Request.Form("tipo")
  f_condicao = Request.Form("condicao")
  f_descricao = Request.Form("descricao")
  f_referencia = Request.Form("referencia")
  f_fabricante = Request.Form("fabricante")
  f_categorias = Request.Form("categorias")
  f_marca = Request.Form("marca")
  f_valor_normal = Replace(Request.Form("valornormal"), ",", ".")
  f_desconto = Request.Form("desconto")
  f_valor_avista = Replace(Request.Form("valoravista"), ",", ".")
  f_parcelas = Request.Form("parcelas")
  f_estatual = Request.Form("estatual")
  f_veiculos = Request.Form("veiculos")
  f_informacoes = Request.Form("informacoes")
  f_dt_anuncio = Year(Date()) & "-" & Month(Date()) & "-" & Day(Date())
  f_data = Year(Date()) & "-" & Month(Date()) & "-" & Day(Date()) & " " & Time()

  If f_tipo = "novo" Then
    Set dbProdutos = conexao.execute("select * from produtos order by id desc")

    If dbProdutos.EOF And dbProdutos.BOF Then
      vCodigo = 1
    Else
      vCodigo = dbProdutos("id") + 1
    End If

    dbDados = vCodigo
    dbDados = dbDados & "," & id_cadastro
    dbDados = dbDados & ",'" & vEmpresa & "'"
    dbDados = dbDados & ",'" & f_descricao   & "'"
    dbDados = dbDados & ",'" & f_referencia  & "'"
    dbDados = dbDados & ",'" & f_marca       & "'"
    dbDados = dbDados & ",'" & f_fabricante  & "'"
    dbDados = dbDados & ",''"
    dbDados = dbDados & ",'" & f_categorias  & "'"
    dbDados = dbDados & "," & f_valor_normal
    dbDados = dbDados & "," & f_desconto
    dbDados = dbDados & "," & f_valor_avista
    dbDados = dbDados & "," & f_parcelas
    dbDados = dbDados & ",'" & f_estatual    & "'"
    dbDados = dbDados & ",'" & f_veiculos    & "'"
    dbDados = dbDados & ",'" & f_informacoes & "'"
    dbDados = dbDados & ",0"
    dbDados = dbDados & ",''"
    dbDados = dbDados & ",''"
    dbDados = dbDados & ",''"
    dbDados = dbDados & ",''"
    dbDados = dbDados & ",'" & f_dt_anuncio & "'"
    dbDados = dbDados & ",NULL"
    dbDados = dbDados & ",NULL"
    dbDados = dbDados & ",NULL"
    dbDados = dbDados & ",0"
    dbDados = dbDados & ",0"
    dbDados = dbDados & ",0"
    dbDados = dbDados & ",NULL"
    dbDados = dbDados & ",'" & f_condicao & "'"
    dbDados = dbDados & ",''"
    dbDados = dbDados & ",''"
    dbDados = dbDados & ",'" & f_cidade & "'"
    dbDados = dbDados & ",'" & f_estado & "'"
    dbDados = dbDados & ",'" & f_data & "'"

    conexao.Execute("insert into produtos values (" & dbDados & ");")
  Else
    vAlt = "update produtos set "
    vWhere = " where id=" & f_id
  
    conexao.execute(vAlt & "descricao='" & f_descricao & "'" & vWhere)
    conexao.execute(vAlt & "referencia='" & f_referencia & "'" & vWhere)
    conexao.execute(vAlt & "fabricante='" & f_fabricante & "'" & vWhere)
    conexao.execute(vAlt & "marca='" & f_marca & "'" & vWhere)
    conexao.execute(vAlt & "valor_normal=" & f_valor_normal & vWhere)
    conexao.execute(vAlt & "desconto=" & f_desconto & vWhere)
    conexao.execute(vAlt & "valor_avista=" & f_valor_avista & vWhere)
    conexao.execute(vAlt & "parcelas=" & f_parcelas & vWhere)
    conexao.execute(vAlt & "veiculos='" & f_veiculos & "'" & vWhere)
    conexao.execute(vAlt & "estatual='" & f_estatual & "'" & vWhere)
    conexao.execute(vAlt & "informacoes='" & f_informacoes & "'" & vWhere)
    conexao.execute(vAlt & "categorias='" & f_categorias & "'" & vWhere)

  End If
  
  f_descricao = ""
  f_referencia = ""
  f_fabricante = ""
  f_marca = ""
  f_veiculos = ""
  f_informacoes = "" 
  f_valornormal = "0"
  f_desconto = "0"
  f_valoravista   = "0"
  f_parcelas = "0"
  f_estatual = "0"
End If

f_codcli = id_cadastro
%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>.....:: Portal Oficinas Automotiva ::.....</title>
    <script language="JavaScript" type="text/javascript" src="funcoes.js"></script>
    <style type="text/css">
    <!--
      @import url(../estilo.css);
    -->
	
    .td_box1  {text-align: center;
	           border: #CCCCCC;
               border-style: solid;
               border-top-width: 1px;
               border-right-width: 0px;
               border-bottom-width: 0px;
               border-left-width: 1px}
			   
     .form_   {BORDER-RIGHT: #698593 1px solid;
               BORDER-TOP: #698593 1px solid;
               FONT-WEIGHT: bold;
               FONT-SIZE: 11px;
               BORDER-LEFT: #698593 1px solid;
               COLOR: #e04430;
               BORDER-BOTTOM: #698593 1px solid;
               FONT-FAMILY: Arial, Verdana, Helvetica, sans-serif}
    </style>

<script language="JavaScript" type="text/javascript">

function fValidar()
{
hoje = new Date();
if (document.cadastro.descricao.value.length == 0)
  {
  alert('DESCRIÇÃO não pode ser vazio');
      document.cadastro.descricao.value = '';
      document.cadastro.descricao.focus();
      return false;
  }
if (document.cadastro.fabricante.value.length == 0)
  {
  alert('FABRICANTE não pode ser vazio');
      document.cadastro.fabricante.value = '';
      document.cadastro.fabricante.focus();
      return false;
  }
if (document.cadastro.valornormal.value.length == 0 || document.cadastro.valor.value == "0")
  {
  alert('VALOR não pode ser vazio');
      document.cadastro.valornormal.value = '';
      document.cadastro.valornormal.focus();
      return false;
  }
}
</script>
</head>
  
<body style="background-color: #ffffff; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<table align="center" cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr bgcolor="#ffffff">
    <td align="center" valign="top">
	
<!---------// Inicia aqui% -->

<table align="center" cellspacing="0" cellpadding="0" border="0" width="760" class="letras_">
  <tr height="400" bgcolor="ffffff">
    <td valign="top" align="center">
	  <span style="font-family: tahoma, arial; font-size: 20pt; color: #999999"><br>
		  		    <span style="font-size: 28px; color: #666666">CADASTRO DE PRODUTOS</span><br><br>
	  <FORM ACTION="cad_produtos.asp" METHOD="POST" style="margin-bottom: 0pt" name="cadastro" onSubmit="return fValidar()">
	  <%
	  Response.Write "<input name='o' type='hidden' value='2'>"
	  Response.Write "<input name='codemp' type='hidden' value='" & id_cadastro & "'>"
	  Response.Write "<input name='id' type='hidden' value='" & f_id & "'>"
	  Response.Write "<input name='tipo' type='hidden' value='" & f_tipo & "'>"
	  %>
	  <div style='margin-left: 0pt'>
	  <table cellspacing='5' cellpadding='0' border='0' width='80%'>
	  <tr>
	    <td class='td_box' align='center'>
		  <span style="font-family: tahoma, arial; font-size: 16pt; color: #666666"><b>Total Cadastrado:&nbsp;<%=Session("sysoficinasTOTALPRODUTOS")%></b></span>
	    </td>
	  </tr>
	  <tr>
	  <td class='td_box' align='center'>
	  <br>
	  <table border='0' cellspacing='3' cellpadding='0' class='letras_'>
	    <tr>
		  <td width='150' bgcolor='#CCCCCC'>&nbsp;&nbsp;Condição de uso:</td>
		  <td width='300'><input name="condicao" type="radio" value="NOVO" <%=vCheckN%>>NOVO <input name="condicao" type="radio" value="USADO" <%=vCheckU%>>USADO <input name="condicao" type="radio" value="REMANUFATURADO" <%=vCheckR%>>REMANUFATURADO</td>
		</tr>
	    <tr>
		  <td width='100' bgcolor='#CCCCCC'>&nbsp;&nbsp;Descrição:</td>
		  <td width='230'>
		    <input name="descricao" type="text" size='50' maxlength='100' class='form_co' value='<%=f_descricao%>'>
		  </td>
		</tr>
	    <tr>
		  <td width='150' bgcolor='#CCCCCC' nowrap>&nbsp;&nbsp;Código de referência:</td>
		  <td width='230'><input name="referencia" type="text" size='20' maxlength='100' class='form_co' value='<%=f_referencia%>'></td>
		</tr>
		<tr>
		  <td width='100' bgcolor='#CCCCCC'>&nbsp;&nbsp;Fabricante:</td>
		  <td width='230'><input name="fabricante" type="text" size='30' maxlength='30' class='form_co' value='<%=f_fabricante%>'></td>
		</tr>
		<tr>
		  <td  width='100' bgcolor='#CCCCCC'>&nbsp;&nbsp;Marca:</td>
		  <td width='230'><input name="marca" type="text" size='30' maxlength='30' class='form_co' value='<%=f_marca%>'></td>
		</tr>
		<tr>
		  <td width='100' bgcolor='#CCCCCC'>&nbsp;&nbsp;Valor Normal:</td>
		  <td width='230'><input name="valornormal" type="text" size='15' maxlength='15' class='form_co' value='<%=f_valornormal%>'></td>
		</tr>
		<tr>
		  <td bgcolor='#CCCCCC'>&nbsp;&nbsp;Desconto (%):</td>
		  <td width='230'><input name="desconto" type="text" size='3' maxlength='15' class='form_co' value='<%=f_desconto%>'></td>
		</tr>
		<tr>
		  <td bgcolor='#CCCCCC'>&nbsp;&nbsp;Valor Com Desconto:</td>
		  <td width='230'><input name="valoravista" type="text" size='15' maxlength='15' class='form_co' value='<%=f_valoravista%>'></td>
		</tr>
		<tr>
		  <td width='100' bgcolor='#CCCCCC'>&nbsp;&nbsp;Parcelamento:</td>
		  <td width='230'><input name="parcelas" type="text" size='15' maxlength='15' class='form_co' value='<%=f_parcelas%>'></td>
		</tr>
		<tr>
		  <td width='100' bgcolor='#CCCCCC'>&nbsp;&nbsp;Veículos:</td>
		  <td width='230'><input name="veiculos" type="text" size='50' maxlength='200' class='form_co' value='<%=f_veiculos%>'></td>
		</tr>
		<tr>
		  <td width='100' bgcolor='#CCCCCC'>&nbsp;&nbsp;Estoque Atual:</td>
		  <td width='230'><input name="estatual" type="text" size='5' maxlength='5' class='form_co' value='<%=f_estatual%>'></td>
		</tr>
		<tr>
		  <td bgcolor='#CCCCCC'>&nbsp;&nbsp;Informações<br>&nbsp;&nbsp;Adicionais:</td>
		  <td><textarea name="informacoes" rows='7' cols='80' class='form_co'><%=f_informacoes%></textarea></td>
		</tr>
		<tr>
		  <td colspan="2"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;<b>Selecione a(s) categoria(s) a que pertence este produto:</b></td>
		</tr>
		<tr>
		  <td colspan="2">
		  <div style="margin-left: 15px; margin-right: 15px">
		  <table cellspacing='0' cellpadding='0' border='1' class="letras_">
		  <%
		  Set dbCategorias = conexao.execute("select * from categorias where id_pai=0")
		  Do While Not dbCategorias.EOF
			Response.Write "<tr><td><b>&nbsp;&nbsp;"
		    Response.Write dbCategorias("categoria")
			Response.Write "</b>&nbsp;&nbsp;</td><td>"
		    Set dbSub = conexao.execute("select * from categorias where id_pai=" & dbCategorias("id"))
			
			vCount = 0
			
		    Do While Not dbSub.EOF
			  vCount = vCount + 1
			  dbSub.MoveNext
			Loop
			
			Set dbSub = Nothing
		    Set dbSub = conexao.execute("select * from categorias where id_pai=" & dbCategorias("id"))
		    i=1
			Response.Write "<table class='letras_'><tr>"
		    Do While Not dbSub.EOF
			  If CInt(vOrigem) = 1 Then
			    Set dbTemp = conexao.execute("select * from produtos where id=" & f_id & " And categorias LIKE '%" & dbSub("categoria") & "%'")
			    If Not dbTemp.EOF Then
			      vChecked = "checked"
			    Else
			      vChecked = ""
			    End If
			    Set dbTemp = Nothing
			  End If
			  
			  If i=1 Then
			    Response.Write "<td width='170' valign='top' nowrap>"				
			  End If
			  Response.Write "<input type='checkbox' name='categorias' value='" & dbSub("categoria") & "' " & vChecked & ">&nbsp;<span style='font-size: 9px'>"				
		      Response.Write dbSub("categoria") & "</span><br>"
			  i = i + 1
			  If (i - 5) > (vCount / 3) Then
			    Response.Write "</td>"
				i=1
			  End If
			  dbSub.MoveNext
			Loop
			Response.Write "</tr></table>"
		    dbCategorias.MoveNext
		  Loop
		  %>
		  </table>
		  </td>
		</tr>
		<tr><td height='5'></td></tr>
	  </table>
	  </div>
	  <font style='font-size: 15pt'><input type="submit" value='  Salvar  ' style="{font-family: Verdana, Arial; font-size: 16px; color: #ffffff; background-color: #FF6600; border: #990000; border-style: solid; border-top-width: 2px; border-right-width: 3px; border-bottom-width: 3px; border-left-width: 2px"></font><br><br>
	  </td>
	  </tr>
	  </table><br>
	  </form>
	  </div>
	 </td>
</tr>
</table>

<!---------// Termina aqui -->

    </td>
  </tr>
</table>
</div>
</body>
</html>
<%
conexao.Close
Set conexao=Nothing
%>