<%--
             File: nuovarisp.jsp
 Applicazione web: Domande & Risposte

           Autore: Roberto FULIGNI
  Ultima modifica: 18/03/2021

      Descrizione: Form per l'invio alla servlet DomandaServlet della risposta a una domanda.
--%>


<%@ page import="java.sql.Connection" %>
<%@ page import="java.sql.PreparedStatement" %>
<%@ page import="java.sql.ResultSet" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>

<%
    String testo = null;
    int codice = -1;
    try {
        codice = Integer.parseInt(request.getParameter("codice"));
    }
    catch (NumberFormatException e) {
        e.printStackTrace(response.getWriter());
    }

    DbUtility dbu = (DbUtility) application.getAttribute("dbutility");

    try(Connection cn = DriverManager.getConnection(dbu.getUrl(), dbu.getUser(), dbu.getPassword())) {
        String strSql = "SELECT domanda FROM dr_domande WHERE codice = ?";
        try (PreparedStatement ps = cn.prepareStatement(strSql)) {
            ps.setInt(1, codice);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next() == false) {
                    response.setStatus(HttpServletResponse.SC_NOT_FOUND);
                    return;
                }
                testo = rs.getString("domanda");
            }
        }
%>
<%@ page import="edu.fauser.DbUtility" %>
<%@ page import="java.sql.DriverManager" %>
<%@ page import="edu.fauser.netlab.AppUtility" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE HTML>
<html>
<%@include file="inc/head.jsp"%>
<body>
<%@include file="inc/header.jsp"%>
<div id="colorlib-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 animate-box">
                <h2>Nuova risposta</h2>
                <form action="risposta" method="post" enctype = "multipart/form-data">
                    <input type="hidden" name="codice" value="<%= codice %>" />
                    <div class="row form-group">
                        <div class="col-md-12">
                            <div>Domanda: <strong><%= AppUtility.escapeHTML(testo) %></strong></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="text" maxlength="100" id="risposta" name="risposta" class="form-control"
                                   placeholder="Testo della risposta" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <input type="text" maxlength="100" id="nickname" name="nickname" class="form-control"
                                   placeholder="Nickname" required>
                        </div>
                        <label for="img" class="col-md-3 col-form-label">Immagine (max. 10 kB)</label>
                        <div class="col-md-5">
                            <input type = "file" name = "img" id="img" size = "50" required />
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
<%
    } catch (Exception e) {
        e.printStackTrace(response.getWriter());
    }
%>