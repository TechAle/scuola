   <%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
    <%@ page import="edu.fauser.DbUtility" %>
   <%@ page import="java.sql.DriverManager" %>
   <%@ page import="java.sql.Connection" %>
   <%@ page contentType="text/html; charset=UTF-8" language="java"%>
   <%
    DbUtility dbu = (DbUtility) application.getAttribute("dbutility");
    try (Connection cn = DriverManager.getConnection(dbu.getUrl(), dbu.getUser(), dbu.getPassword())) {

    }catch (java.sql.SQLException e) {
        e.printStackTrace();
    }
       %>
   <!DOCTYPE html>
<html>
<head>
    <title>JSP - Hello World</title>
</head>
<body>
<h1><%= "Hello World!" %>
</h1>
<br/>
<a href="hello-servlet">Hello Servlet</a>
</body>
</html>