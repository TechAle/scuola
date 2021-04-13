/*
    File: cambioPass.java

    Autore: Alessandro Condelllo
    Ultima modifica: 13/04/2021
 */
package com.example.musica;

import edu.fauser.DbUtility;

import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.IOException;
import java.sql.*;

@WebServlet(name = "cambioPass", value = "/cambioPass")
public class cambioPass extends HttpServlet {

    public void init() {

    }

    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException {
        HttpSession sessions = request.getSession(false);
        String id = (String) sessions.getAttribute("id");
        // Se è loggato
        if (id != null) {

            Boolean demo = (Boolean) sessions.getAttribute("demo");
            // Se è demo
            if (demo != null) {
                // Prendiamo password nuova
                if ( request.getParameter("passwordNuova") == null ) {
                    response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
                    return;
                }
                String passwordNuova = request.getParameter("passwordNuova");
                // Iniziamo la connessione
                DbUtility dbu = DbUtility.getInstance(getServletContext());
                try (Connection cn = DriverManager.getConnection(dbu.getUrl(), dbu.getUser(), dbu.getPassword())) {
                    // Guardiamo che tipologia di reset lui ha chiesto
                    String passwordRichiesta = request.getParameter("resetPass");
                    // Se ha richiesto un reset senza password
                    if (passwordRichiesta == null) {
                        // Chiamiamo la funzione per il cambio senza password
                        String sql = "call cambioPassNo(?, ?, @suc)";
                        try (PreparedStatement ps = cn.prepareStatement(sql)) {
                            // Settiamo i valori
                            ps.setString(1, id);
                            ps.setString(2, passwordNuova);
                            ResultSet ris = ps.executeQuery();
                            // La nostra funzione ritorna un valore (@suc) che determina il risultato
                            /*
                             Valori di ritorno:
                             0 : Username non esistente
                             1 : Utente non abilitato al cambio
                             2 : Password non corretta
                             3 : Password cambiata
                             */
                            if (ris.next()) {
                                switch (ris.getString(1)) {
                                    case "0":
                                        response.sendRedirect("/musica/errore.jsp?errore=usr");
                                        break;
                                    case "1":
                                        response.sendRedirect("/musica/errore.jsp?errore=demo");
                                        break;
                                    case "2":
                                        response.sendRedirect("/musica/errore.jsp?errore=pass");
                                        break;
                                    case "3":
                                        response.sendRedirect("/musica/successo.jsp?successo=pass");
                                        break;
                                }
                            } else response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
                        }

                    } else {
                        // Questo else è per il caso dove vogliamo fare il reset con la password

                        if (request.getParameter("passwordVecchia") == null) {
                            response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
                            return;
                        }
                        String passwordVecchia = request.getParameter("passwordVecchia");

                        String sql = "call cambioPass(?, ?, ?, @suc)";
                        // Controllare sopra per i commenti, la procedura è pressochè la stessa
                        try (PreparedStatement ps = cn.prepareStatement(sql)) {

                            ps.setString(1, id);
                            ps.setString(2, passwordVecchia);
                            ps.setString(3, passwordNuova);
                            ResultSet ris = ps.executeQuery();

                            if (ris.next()) {
                                switch (ris.getString(1)) {
                                    case "0":
                                        response.sendRedirect("/musica/errore.jsp?errore=usr");
                                        break;
                                    case "1":
                                        response.sendRedirect("/musica/errore.jsp?errore=demo");
                                        break;
                                    case "2":
                                        response.sendRedirect("/musica/errore.jsp?errore=pass");
                                        break;
                                    case "3":
                                        response.sendRedirect("/musica/successo.jsp?successo=pass");
                                        break;
                                }
                            } else response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
                        }

                    }
                } catch (SQLException throwables) {
                    response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
                }

            }else response.sendRedirect("/errore.jsp?errore=demo");

        } else response.sendRedirect("/errore.jsp?errore=login0");
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException {
        response.setStatus(HttpServletResponse.SC_NOT_FOUND);
    }
}
