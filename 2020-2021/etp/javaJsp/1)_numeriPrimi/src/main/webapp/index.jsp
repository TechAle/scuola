<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html>
<head>
    <title>JSP - Hello World</title>
</head>
<body>
<form action="" method="get">
<input type="number" name="numero" id="numero">
    <input type="submit" name="invia">
</form>

<%! StringBuilder risultato = new StringBuilder();
    private Boolean isPrimo(int n) {

        if ( n <= 3 )
            return false;

        for(int i = 2; i < n / 2; ++i)
            if (n % i == 0) {
                return true;
            }
        return false;
    };
%>

<%
    String value = request.getParameter("numero");
    if (value != null) {
        int valueInt = Integer.parseInt(value);
        if (isPrimo(valueInt))
            risultato.append("Il numero e primo ");
        else
            risultato.append("Il numerp e il prodotto di almeno 2 fattori");

    }
%>
<p>
    Risultato:
    <%= risultato.toString() %>
</p>

</body>
</html>