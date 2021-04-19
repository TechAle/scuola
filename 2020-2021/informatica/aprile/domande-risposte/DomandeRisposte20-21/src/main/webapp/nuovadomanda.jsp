<%--
             File: nuovadomanda.jsp
 Applicazione web: Domande & Risposte

           Autore: Roberto FULIGNI
  Ultima modifica: 18/03/2021

      Descrizione: Form per l'invio di una nuova domanda alla servlet DomandaServlet.
--%>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>

<!DOCTYPE HTML>
<html>
<%@include file="inc/head.jsp"%>
<body>
<%@include file="inc/header.jsp"%>
<div id="colorlib-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 animate-box">
                <h2>Nuova domanda</h2>
                <form action="domanda" method="post">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="text" maxlength="100" id="domanda" name="domanda" class="form-control"
                                   placeholder="Testo della domanda" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Invia" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<%@include file="inc/footer.jsp"%>
</body>
</html>