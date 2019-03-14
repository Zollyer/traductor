
'Leer portapapeles de windows
Set objeto = CreateObject("htmlfile")
'guardamos en una variable
texto = objeto.parentWindow.clipboardData.getData("Text")
'Mostrar variable
'Msgbox "Original->"+texto
'consultar sitio web con traduccion
'hello world
'formar direccion y pasar variable a php
URL = "http://localhost/traductor/index.php?q="+texto
'Msgbox "Original->"+URL

Set XD = CreateObject("MSXML2.DOMDocument")
XD.ASync = False
If XD.Load(URL) Then
        Set TitleName = XD.SelectNodes("//item/title")
        Set urlName = XD.SelectNodes("//item/link")
        For i = 0 To TitleName.Length - 1
        Msgbox (TitleName(i).Text)
        
        myData = myData & TitleName(i).Text & urlName(i).Text & vbCrLf
        Next
Else
        MsgBox("Error de internet no conecto.. al traductor")
End If

