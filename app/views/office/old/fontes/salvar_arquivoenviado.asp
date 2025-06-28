<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<!--#include file="rotinas.asp"-->
<%
Server.ScriptTimeout = 480

Dim Contador, Tamanho
Dim ConteudoBinario, ConteudoTexto
Dim Delimitador, Posicao1, Posicao2
Dim ArquivoNome, ArquivoConteudo, PastaDestino
Dim objobjTexto, objArquivo

vID_Cadastro = Request.QueryString("id")
vPasta = Request.QueryString("pasta")
vBancoDados = Request.QueryString("bd")
vTipo = Request.QueryString("tp")

f_voltar = 2

If vBancoDados = "cadastro_diretoria" Then
  PastaDestino = Replace(vPasta, "\", "/")
Else
  PastaDestino = "C:\Inetpub\vhosts\meubairrotem.com\httpdocs\documentos\fotos\" & vPasta
End If

'Determina o tamanho do conteúdo
Tamanho = Request.TotalBytes

If Tamanho > 170000 Then
%>
  <script language="Javascript" type="text/javascript">
  <!--
  alert("O tamanho do arquivo não pode ultrapassar os 170.000 Kb");
  history.back();
  //-->
  </script>
<%
End If

'Obtém o conteúdo no formato binário
ConteudoBinario = Request.BinaryRead(Tamanho)

'Transforma o conteúdo binário em string
For Contador = 1 To Tamanho
  ConteudoTexto = ConteudoTexto & Chr(AscB(MidB(ConteudoBinario, Contador, 1)))
Next 

'Determina o delimitador de campos
Delimitador = Left(ConteudoTexto, InStr(ConteudoTexto, vbCrLf) - 1)

'Percorre a String procurando os campos
'identifica os arquivo e grava no disco
Set objobjTexto = Server.CreateObject("Scripting.FileSystemObject")

Posicao1 = InStr(ConteudoTexto, Delimitador) + Len(Delimitar)
do while True
  ArquivoNome = ""
  Posicao1 = InStr(Posicao1, ConteudoTexto, "filename=")
  if Posicao1 = 0 then
    exit do
  else
   'Determina o nome do arquivo
   Posicao1 = Posicao1 + 10
   Posicao2 = InStr(Posicao1, ConteudoTexto, """")
   For contador = (Posicao2 - 1) to Posicao1 step -1
    if Mid(ConteudoTexto, Contador, 1) <> "\" then '"
      ArquivoNome = Mid(ConteudoTexto, Contador, 1) & ArquivoNome
    else
      exit for
    end if
   next
	
   'Determina o conteúdo do arquivo
   Posicao1 = InStr(Posicao1, ConteudoTexto, vbCrLf & vbCrLf) + 4
   Posicao2 = InStr(Posicao1, ConteudoTexto, Delimitador) - 2
   ArquivoConteudo = Mid(ConteudoTexto, Posicao1, (Posicao2 - Posicao1 + 1))

   'Grava o arquivo
   If ArquivoNome <> "" then
     Set objArquivo = objobjTexto.CreateTextFile(PastaDestino & "/" & ArquivoNome, true)
       objArquivo.WriteLine ArquivoConteudo
       objArquivo.Close			
     Set objArquivo = nothing
	 
	 vArquivoNovo = UCase(Left(Replace(ArquivoNome, ".", ""), 4)) & vID_Cadastro & Hour(Time()) & Minute(Time()) & Second(Time()) & Year(Date()) & Month(Date()) & Day(Date()) & ".jpg"
	 
     objobjTexto.CopyFile PastaDestino & "/" & ArquivoNome, PastaDestino & "/" & vArquivoNovo
     objobjTexto.DeleteFile PastaDestino & "/" & ArquivoNome,true

     If vBancoDados = "cadastro_diretoria" Then
	   conexao.execute("update " & vBancoDados &" set foto='" & vArquivoNovo & "' where id=" & vID_Cadastro)
	 Else
	   conexao.execute("insert into fotos values(" & vID_Cadastro & ",'" & vArquivoNovo & "','')")
	 End If
  end if
end if
Loop
Set objobjTexto = nothing

If vBancoDados = "fotos" Then
  Set objTexto = Server.CreateObject("Scripting.FileSystemObject")

  nome_pasta = "C:\Inetpub\vhosts\meubairrotem.com\httpdocs\documentos\fotos\" & StrZero(vID_Cadastro, 10)
  
'crio o objeto pasta 
  Set pasta = objTexto.GetFolder(nome_pasta) 

'pego os arquivos da pasta 
  Set arquivos = pasta.Files 
  
  f_arquivo = StrZero(vID_Cadastro, 10) & "_fotos.html"
  
  Set Arquivo = objTexto.CreateTextFile(request.serverVariables("APPL_PHYSICAL_PATH")&"documentos\include\paginas\" & f_arquivo)
  Arquivo.Close

  Set Arquivo = objTexto.OpenTextFile(request.serverVariables("APPL_PHYSICAL_PATH")&"documentos\include\paginas\" & f_arquivo, 8, True) 

  vHTML = "<!DOCTYPE HTML PUBLIC ""-//W3C//DTD HTML 4.0 Transitional//EN"">"
  vHTML = vHTML & "<html>"
  vHTML = vHTML & "<head>"
  vHTML = vHTML & "	<title></title>"
  vHTML = vHTML & "		<link rel=""stylesheet"" type=""text/css"" media=""all"" href=""styles/demoStyles.css"" />"
  vHTML = vHTML & "		<link rel=""stylesheet"" type=""text/css"" media=""all"" href=""styles/jScrollPane.css"" />"
  vHTML = vHTML & "		<script type=""text/javascript"" src=""styles/jquery.min.js""></script>"
  vHTML = vHTML & "		<script type=""text/javascript"" src=""styles/jquery.mousewheel.js""></script>"
  vHTML = vHTML & "		<script type=""text/javascript"" src=""styles/jScrollPane.js""></script>"
  vHTML = vHTML & "		<style type=""text/css"">"
  vHTML = vHTML & "			#pane2 {"
  vHTML = vHTML & "				width: 162px;"
  vHTML = vHTML & "				height: 365px;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.osX .jScrollPaneTrack {"
  vHTML = vHTML & "				background: url(styles/barra_ground.gif) repeat-y;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.osX .jScrollPaneDrag {"
  vHTML = vHTML & "				background: url(styles/barra_barra_centro.gif) repeat-y;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.osX .jScrollPaneDragTop {"
  vHTML = vHTML & "				background: url(styles/barra_barra_top.gif) no-repeat;"
  vHTML = vHTML & "				height: 6px;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.osX .jScrollPaneDragBottom {"
  vHTML = vHTML & "				background: url(styles/barra_barra_top.gif) no-repeat;"
  vHTML = vHTML & "				height: 7px;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.osX a.jScrollArrowUp {"
  vHTML = vHTML & "				height: 24px;"
  vHTML = vHTML & "				background: url(styles/barra_seta_cima.gif) no-repeat 0 -43px;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.osX a.jScrollArrowUp:hover {"
  vHTML = vHTML & "				background-position: 0 0;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.osX a.jScrollArrowDown {"
  vHTML = vHTML & "				height: 24px;"
  vHTML = vHTML & "				background: url(styles/barra_seta_baixo.gif) no-repeat 0 -43px;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.osX a.jScrollArrowDown:hover {"
  vHTML = vHTML & "				background-position: 0 0;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.left .jScrollPaneTrack {"
  vHTML = vHTML & "				left: 0;"
  vHTML = vHTML & "				right: auto;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.left a.jScrollArrowUp {"
  vHTML = vHTML & "				left: 0;"
  vHTML = vHTML & "				right: auto;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			.left a.jScrollArrowDown {"
  vHTML = vHTML & "				left: 0;"
  vHTML = vHTML & "				right: auto;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			/* IE SPECIFIC HACKED STYLES */"
  vHTML = vHTML & "			* html .osX .jScrollPaneDragBottom {"
  vHTML = vHTML & "				bottom: -1px;"
  vHTML = vHTML & "			}"
  vHTML = vHTML & "			/* /IE SPECIFIC HACKED STYLES */"
  vHTML = vHTML & "		</style>"
  vHTML = vHTML & "		<script type=""text/javascript"">"
  vHTML = vHTML & "			$(function()"
  vHTML = vHTML & "			{"
  vHTML = vHTML & "				// this initialises the demo scollpanes on the page."
  vHTML = vHTML & "				// Width: largura da barra"
  vHTML = vHTML & "				// Size: limite top/bootom para a barra de rolagem"
  vHTML = vHTML & "				$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 8, arrowSize: 24});"
  vHTML = vHTML & "			});"
  vHTML = vHTML & "</script>"
  vHTML = vHTML & "</head>"
  vHTML = vHTML & "<body style=""margin-top: 15px; margin-left: 0px; margin-bottom: 0px; margin-right: 0px"">"
  vHTML = vHTML & "<script type=""text/javascript"">			"
  vHTML = vHTML & "function fAmpliarFoto(vnFoto, vDescricao) {"
  vHTML = vHTML & "  var vFoto = new String(vnFoto);"
  vHTML = vHTML & "  document.getElementById('td" & StrZero(vID_Cadastro, 10) & "').innerHTML = ""<img src='../../fotos/" & StrZero(vID_Cadastro, 10) & "/"" + vnFoto + ""' width=400 height=300 border=0>;"";"
  vHTML = vHTML & "  document.getElementById(""descricao" & StrZero(vID_Cadastro, 10) & """).innerHTML = vDescricao;"
  vHTML = vHTML & "}"
  vHTML = vHTML & "</script>"
  vHTML = vHTML & "  <table border=""0"" cellspacing=""0"" cellpadding=""0"" id=""tbl0" & StrZero(vID_Cadastro, 10) & """ align=""center"">"
  vHTML = vHTML & "	<tr>"
  vHTML = vHTML & "	  <td valign=""top"">"
  vHTML = vHTML & "		<div class=""holder osX"">"
  vHTML = vHTML & "		  <div align=""justify"" id=""pane2"" class=""scroll-pane"">"
				  
				  vFotoDestaque = ""
				  i = 1
				  for each nome_arquivo in arquivos 
                    vImagem = Replace(UCase(nome_arquivo), UCase(Server.MapPath(".")), ".")
                    vArquivo = Trim(Replace(UCase(vImagem), UCase(nome_pasta & "\"), ""))
					
					If i = 1 Then
					  vFotoDestaque = vArquivo
					  i = i + 1
					End If
					
                    If InStr(1, vImagem, ".JPG") > 0 Or InStr(1, vImagem, ".GIF") > 0 Or InStr(1, vImagem, ".PNG") > 0 Then 
					  vHTML = vHTML & "<a href=""#fotos"" onclick=""fAmpliarFoto('" & vArquivo & "','')""><img src='" & LCase(Replace(vImagem, "C:\INETPUB\VHOSTS\MEUBAIRROTEM.COM\HTTPDOCS", "..\..\..")) & "' width='70' height='48' border='0' vspace='3' hspace='3' id='imagem" & t & "' alt='clique na imagem para ampliar'></a>"
					End If
                  next 
		    
  vHTML = vHTML & "		  </div>"
  vHTML = vHTML & "		</div>"
  vHTML = vHTML & "	  </td>"
  vHTML = vHTML & "	  <td align=""center"" width=""50""><img src=""..\..\..\images\ground_botao_login.gif"" width=""2"" height=""368""></td>"
  vHTML = vHTML & " 	  <td>"
  vHTML = vHTML & "	    <div style=""background: #dddddd; width: 400px; border: #cccccc 1px solid; padding: 3px"">"
  vHTML = vHTML & "		    <DIV id=""td" & StrZero(vID_Cadastro, 10) & """><img src='" & LCase(Replace(vImagem, "C:\INETPUB\VHOSTS\MEUBAIRROTEM.COM\HTTPDOCS", "..\..\..")) & "' width='400' height='300' border='0' vspace='3' hspace='3' id='imagem" & t & "' alt=''></DIV>"
  vHTML = vHTML & "		    <DIV id=""descricao" & StrZero(vID_Cadastro, 10) & """ style=""width: 400px; height: 60px; background: #dddddd; font-size: 12px; font-weight: bold; padding: 7px"">dscricao aqui...</DIV>"
  vHTML = vHTML & "	    </div>"
  vHTML = vHTML & "	  </td>"
  vHTML = vHTML & "	</tr>"
  vHTML = vHTML & "  </table>"
  vHTML = vHTML & "</body>"
  vHTML = vHTML & "</html>"

  Arquivo.Write(vHTML)

End If
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>:::: SysControle - Você no Controle :::: </title>
	<script language="Javascript" src="funcoes.js" type="text/javascript"></script>
    <style type="text/css">
    <!--
      @import url(estilo.css);
    -->
    </style>
</head>
  
<body style="background-color: #ffffff; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
<div align="center">
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%" class="letras_">
  <tr bgcolor="#ffffff">
    <td valign="middle" align="center">
	  <table width="400" height="150" class="letras_" cellpadding="0" cellspacing="0" border="1" bgcolor="#f0e9a2">
	    <tr>
		  <td align="center">
		    <span style="font-size: 24px; color: #1130ff">Imagem enviada com sucesso!</span><br><br><br><br>
<%If vBancoDados = "cadastro_diretoria" Then%>
		    <div style="margin-top: 30px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="gerenciar_diretoria.asp?id=<%=vID_Cadastro%>&tp=<%=vTipo%>" style="color: #ffffff">V O L T A R</a></div>
<%Else%>			
		    <div style="margin-top: 30px; background: #ff0000; width: 150px; padding: 5px; font-family: tahoma, arial; font-size: 18px; font-weight:bold"><a href="gerenciar_fotos.asp?id=<%=vID_Cadastro%>&tp=<%=vTipo%>" style="color: #ffffff">V O L T A R</a></div>
<%End If%>			
		  </td>
	    </tr>
	  </table>
    </td>
  </tr>
</table>
</div>
</body>
</html>
