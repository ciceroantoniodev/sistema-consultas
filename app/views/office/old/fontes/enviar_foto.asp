<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
id_usuario = session("id_usuario")

f_id = Request.QueryString("id")
f_url = Request.QueryString("url")
f_pasta = Request.QueryString("pasta")
f_origem = Request.QueryString("o")
f_bd = Request.QueryString("bd")
f_arquivo = ""


vSecao = "DEFINIÇÃO DO NOVO BANNER"
vDescricao = "Descrição do Banner:"
vBotoes = "[1]"
 
If Not f_origem = "" Then
  If f_origem = "corpoclinico" Then
    vSecao = "DEFINIÇÃO DE NOVA FOTO"
    vDescricao = "Nome do Profissional:"
  ElseIf f_origem = "eventos" Then
    vSecao = "NOVA IMAGEM PARA EVENTOS NO HOTSITE"
    vDescricao = "Descrição do Evento:"
  ElseIf f_origem = "agenda" Then
    vSecao = "NOVA IMAGEM PARA AGENDA DE EVENTOS"
    vDescricao = "Descrição do Evento:"
  ElseIf f_origem = "sinistros" Then
    vSecao = "NOVA IMAGEM PARA SINISTRO"
    vDescricao = "Nome do Segurado:"
  ElseIf f_origem = "noticias" Then
    vSecao = "NOVA IMAGEM PARA NOTÍCIAS"
    vDescricao = "Título da Notícia:"
  ElseIf f_origem = "discografia" Then
    vSecao = "NOVA IMAGEM PARA DISCOGRAFIA"
    vDescricao = "Título do Disco:"
  End If
End If
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>:::: SysControle - Você no Controle :::: </title>
	<script language="Javascript" type="text/javascript">
	function fAtualizarFoto(vThis) {
	alert(vThis.value);
	document.foto1.src = '"' + vThis.value + '"';
	}
	</script>
    <style type="text/css">
    <!--
      @import url(estilo.css);
    -->
    </style>
</head>

<body style="background: url(./images/ground_framework.gif) repeat-x fixed; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<a name="#inicio"></a>
<table id="empresa" cellspacing="0" cellpadding="0" border="0" width="80%">
  <tr>
	<td id="descricao" valign="top">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
		<tr>
		  <td align="center" valign="top">
	        <br><br><span style="font-size: 18pt; color: #000000"><%=vSecao%></span><br><br>
		    <table border="0" cellspacing="0" cellpadding="0" class="letras_">
			  <tr>
			    <td><br><span style="font-size: 16px; color: #000000"><b><%=vDescricao%>&nbsp;<%=f_nome%></b></span><br><br></td>
			  </tr>
              <tr> 
                <td colspan="2" align="center" valign="middle" height="21">
				  <table cellspacing="0" cellpadding="5" border="0">
				    <tr>
					  <td class="td_box">
					    <%If f_arquivo = "" Then%>
						  <img src='./images/sem_imagem.gif' border='0' name="foto1">
						<%Else
						  If f_tipo = "Flash" Then
						    vFotoDestaque = ""
					        c=""
					        i=1
					        vCodigo = dbDados("codigo")
					        Do While True
					          c = Mid(vCodigo, i, 1)
						      If (Asc(c) = 34) Then c = "'"
						      vFotoDestaque = vFotoDestaque & c
						      i = i + 1

						      If i > Len(vCodigo) Then
						        Exit Do
						      End if
						
					        Loop
					        vFotoDestaque = Replace(vFotoDestaque, "[swf]", "http://www." & f_url & "/documentos/banners/" & dbDados("arquivo"))
					        vFotoDestaque = Replace(vFotoDestaque, "[nome]", Replace(dbDados("arquivo"), ".swf", ""))
							Response.Write vFotoDestaque
						  Else
						%>
						  <img src="./<%=f_pasta%>/<%=f_arquivo%>" border="0" name="foto1">
						<%
						  End If
						End If
						%>
					  </td>
					</tr>
					<tr>
					  <td align="center">
                        <form action="salvar_arquivoenviado.asp?id=<%=f_id%>&url=<%=f_url%>&pasta=<%=f_pasta%>&bd=<%=f_bd%>" name="cadastro" method="post" enctype="multipart/form-data" onSubmit="return fValidaCad()" style="margin-top: 0px; margin-bottom: 0px">
						<table border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td valign="middle"> 
                              <input type="file" name="foto1" class="form_file">
                            </td>
                            <td align="center" valign="middle" height="21">
                              &nbsp;&nbsp;<input type="submit" name="enviar" value="Enviar" class="submit_file">
                            </td>
                          </tr>
	                    </table>
                        </form>
					  </td>
					</tr>
                  </table>
			    <td>
		      </tr>
			</table>
		  </td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
</div>
</body>
</html>
