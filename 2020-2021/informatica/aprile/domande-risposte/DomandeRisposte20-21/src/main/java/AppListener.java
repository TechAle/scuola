/*
               File: AppListener.java
   Applicazione web: Domande & Risposte

             Autore: Roberto FULIGNI
    Ultima modifica: 18/03/2021

        Descrizione: Routine di inizializzazione del contesto

*/

import edu.fauser.DbUtility;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;

@WebListener
public class AppListener implements ServletContextListener, HttpSessionListener, HttpSessionAttributeListener {

    public AppListener() {
    }

    @Override
    public void contextInitialized(ServletContextEvent sce) {
        // Crea una nuova istanza della classe DbUtility e la condivide con
        // le servlet e le pagine JSP sotto forma di attributi del contesto

        DbUtility dbu = new DbUtility();
        dbu.setDevCredentials("jdbc:mariadb://localhost:3306/dbdomande?maxPoolSize=2&pool", "root", "");
        dbu.setProdCredentials("jdbc:mariadb://localhost:3306/db123?maxPoolSize=2&pool", "db123", "******");

        ServletContext ctx = sce.getServletContext();
        ctx.setAttribute("dbutility", dbu);
    }
}
