package com.example.acqua_jbdc;

import edu.fauser.DbUtility;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;

@WebListener
public class acqua_jbdc implements ServletContextListener, HttpSessionListener, HttpSessionAttributeListener {

    public acqua_jbdc() {
    }

    @Override
    public void contextInitialized(ServletContextEvent sce) {

        DbUtility dbu = new DbUtility();

        dbu.setDevCredentials("jdbc:mysql://localhost:3306/db11465?maxPoolSize=2&pool", "root", "");
        dbu.setProdCredentials("jdbc:mysql://localhost:3306/db11465?maxPoolSize=2&pool", "db11465", "");

        ServletContext ctx = sce.getServletContext();
        ctx.setAttribute("dbutility", dbu);

    }
}
