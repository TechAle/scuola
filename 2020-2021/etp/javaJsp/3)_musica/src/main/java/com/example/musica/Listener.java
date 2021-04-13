/*
    File: Listener.java

    Autore: Alessandro Condelllo
    Ultima modifica: 13/04/2021
 */
package com.example.musica;

import edu.fauser.DbUtility;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;

@WebListener
public class Listener implements ServletContextListener, HttpSessionListener, HttpSessionAttributeListener {

    public Listener() {
    }

    @Override
    public void contextInitialized(ServletContextEvent sce) {
        /* This method is called when the servlet context is initialized(when the Web application is deployed). */
        DbUtility dbu = new DbUtility();
        dbu.setDevCredentials("jdbc:mariadb://localhost:3306/db11465", "root", "");
        dbu.setProdCredentials("jdbc:mysql://localhost:3306/db11465", "db11465", "");
        ServletContext ctx = sce.getServletContext();
        ctx.setAttribute("dbUtility", dbu);
    }

    @Override
    public void contextDestroyed(ServletContextEvent sce) {
        /* This method is called when the servlet Context is undeployed or Application Server shuts down. */
    }

    @Override
    public void sessionCreated(HttpSessionEvent se) {
        /* Session is created. */
    }

    @Override
    public void sessionDestroyed(HttpSessionEvent se) {
        /* Session is destroyed. */
    }

    @Override
    public void attributeAdded(HttpSessionBindingEvent sbe) {
        /* This method is called when an attribute is added to a session. */
    }

    @Override
    public void attributeRemoved(HttpSessionBindingEvent sbe) {
        /* This method is called when an attribute is removed from a session. */
    }

    @Override
    public void attributeReplaced(HttpSessionBindingEvent sbe) {
        /* This method is called when an attribute is replaced in a session. */
    }
}
