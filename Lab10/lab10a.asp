<%
' Get the background color from the query string
Dim bgColor
bgColor = Request.QueryString("color")
If bgColor = "" Then
    bgColor = "white" ' Default background color if none is provided
End If

' Check for the last visit cookie
Dim lastVisit
If Request.Cookies("lastVisit") <> "" Then
    lastVisit = Request.Cookies("lastVisit")
    firstVisit = False
Else
    lastVisit = "This is your first visit!"
    firstVisit = True
End If

' Update the last visit cookie with the current date and time
Dim currentDateTime
currentDateTime = Now()
Response.Cookies("lastVisit") = currentDateTime
Response.Cookies("lastVisit").Expires = DateAdd("d", 30, Now()) ' Cookie expires in 30 days

' Output the HTML
%>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab10a - Dynamic Background</title>
</head>
<body style="background-color:<%= Server.HTMLEncode(bgColor) %>;">
    <h1>Welcome to the Dynamic Background Page!</h1>
    <p>Your chosen background color: <strong><%= Server.HTMLEncode(bgColor) %></strong></p>
    <p><% If firstVisit Then %>
        <strong>It looks like this is your first visit!</strong>
       <% Else %>
        <strong>Your last visit was on: <%= lastVisit %></strong>
       <% End If %>
    </p>
    <p>Change the background color by adding <strong>?color=colorname</strong> or <strong>?color=#hexcode</strong> to the URL.</p>
</body>
</html>
