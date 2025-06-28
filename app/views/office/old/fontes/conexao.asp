<%
Set conexao = Server.CreateObject("ADODB.Connection")
'conexao.ConnectionString = "driver={MySQL ODBC 3.51 Driver}; server=localhost; uid=root_; pwd=samtio; database=oficinasauto"
conexao.ConnectionString = "driver={MySQL ODBC 5.1 Driver}; server=localhost; uid=root; pwd=samtio; database=db_meubairrotem"
conexao.Open
%>
