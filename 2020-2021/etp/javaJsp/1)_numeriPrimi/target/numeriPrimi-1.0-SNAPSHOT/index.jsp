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

<%! String risultato = new String();
    private String getRis(int n) {
        StringBuilder ris = new StringBuilder();

        if ( n % 2 == 0)
            ris.append("Il numero è pari");

        if ( n <= 3 )
            return ris.toString();
        boolean trovato = false;
        for(int i = 3; i < n; i++)
            if (n % i == 0) {
                if (!trovato)
                    trovato = true;
                else ris.append(" Il numero è il prodotto di 2 valori");
            }
        return ris.toString();
    };
%>

<%
    String value = request.getParameter("numero");
    if (value != null)
        risultato = getRis(Integer.parseInt(value));
%>
<p>
    Risultato:
    <%= risultato %>
</p>

</body>
</html>