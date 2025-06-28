<%@ Language=VBScript %>
<!--#include file="conexao.asp"-->
<%
Server.ScriptTimeout = 480

Dim Contador, Tamanho
Dim ConteudoBinario, ConteudoTexto
Dim Delimitador, Posicao1, Posicao2
Dim ArquivoNome, ArquivoConteudo, PastaDestino
Dim objFSO, objArquivo

f_id = Request.QueryString("id")
f_foto = Request.QueryString("foto")

vFotos = 0

Set dbDados = conexao.execute("select * from produtos where id=" & f_id)

If Not Trim(dbDados("foto1")) = "" Then
  vFotos = vFotos + 1
End If

If Not Trim(dbDados("foto2")) = "" Then
  vFotos = vFotos + 1
End If

If Not Trim(dbDados("foto3")) = "" Then
  vFotos = vFotos + 1
End If

If Not Trim(dbDados("foto4")) = "" Then
  vFotos = vFotos + 1
End If

Set dbDados = Nothing

'PastaDestino = Server.MapPath("/galeria/" & Session("tblProdutos"))
PastaDestino = Request.ServerVariables("APPL_PHYSICAL_PATH") & "documentos\produtos"

'PastaDestino = "C:\Inetpub\wwwroot\samsite\dados"

'Determina o tamanho do conteúdo
Tamanho = Request.TotalBytes

If Tamanho > 70000 Then
%>
  <script language="Javascript" type="text/javascript">
  <!--
  alert("O tamanho do arquivo não pode ultrapassar os 70.000 Kb");
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
Set objFSO = Server.CreateObject("Scripting.FileSystemObject")

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
     Set objArquivo = objFSO.CreateTextFile(PastaDestino & "/" & ArquivoNome, true)
     objArquivo.WriteLine ArquivoConteudo
     objArquivo.Close
			
     Set objArquivo = nothing

     objfso.CopyFile PastaDestino & "/" & ArquivoNome, PastaDestino & "/" & ArquivoNome 
     'objFso.DeleteFile PastaDestino & "/" & ArquivoNome,true

	 conexao.execute("update produtos set foto" & f_foto & "='" & ArquivoNome & "' where id=" & f_id)
	 conexao.execute("update produtos set fotos=" & vFotos & " where id=" & f_id)
  end if
end if
Loop
Set objFSO = nothing
%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title></title>
</head>
<body>
<script language="Javascript" type="text/javascript">
<!--
history.go(-2);
//-->
</script>
</body>
</html>

