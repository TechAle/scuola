<%--
             File: index.jsp
 Applicazione web: Domande & Risposte

           Autore: Roberto FULIGNI
  Ultima modifica: 18/03/2021

      Descrizione: Pagina principale basata su template colorlib UnApp
                   https://colorlib.com/wp/template/unapp/
--%>

<%@ page import="java.sql.*" %>
<%@ page import="edu.fauser.DbUtility" %>
<%@ page import="edu.fauser.netlab.AppUtility" %>
<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%

    DbUtility dbu = (DbUtility) application.getAttribute("dbutility");

    try(Connection cn = DriverManager.getConnection(dbu.getUrl(), dbu.getUser(), dbu.getPassword());
        Statement s = cn.createStatement();
        ResultSet rs = s.executeQuery("SELECT codice, domanda, risposta, nickname FROM dr_domande");) {
%>
<!DOCTYPE HTML>
<html>
<%@include file="inc/head.jsp"%>
<body>
<%@include file="inc/header-index.jsp"%>
<div class="colorlib-blog" id="elenco">
    <div class="container">
        <div class="row">
            <% int conta = 0;
                while (rs.next()) {
                    conta++;
                    if (conta > 1 && (conta % 3) == 1) {
            %>
                        </div><div class="row">
            <%      } %>
                    <div class="col-md-4 animate-box" >
                        <article>
                            <h2 style="height: 5em;"><%= AppUtility.escapeHTML(rs.getString("domanda")) %></h2>
                            <% if(rs.getString("risposta") == null) { %>
                                <p style="height: 5em;">
                                    <a href="nuovarisp.jsp?codice=<%= rs.getInt("codice") %>">Rispondi</a>
                                </p>
                                <p style="height: 2.5em;" class="author-wrap">&nbsp;</p>
                            <% } else { %>
                                <p style="height: 5em;"><%= AppUtility.escapeHTML(rs.getString("risposta")) %></p>
                                <p style="height: 2.5em;" class="author-wrap">
                                    <span class="author-img" style="background-image: url(immagine?codice=<%= rs.getInt("codice")%>);"></span>
                                    <span class="author">Autore: <%= AppUtility.escapeHTML(rs.getString("nickname")) %></span></p>
                            <% } %>
                        </article>
                    </div>
            <%      } // fine while %>
        </div>
    </div>
</div>

<%@include file="inc/footer.jsp"%>
</body>
</html>
<%
    } catch (Exception e) {
        e.printStackTrace(response.getWriter());
    }
%>