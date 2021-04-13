/*
    File: login.java

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

@WebServlet(name = "login", value = "/login")
public class login extends HttpServlet {

    public void init() {

    }

    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException {
        // Avviamo le sessioni
        HttpSession sessions = request.getSession(false);
        String id = (String) sessions.getAttribute("id");
        // Se non siamo già loggati
        if (id == null) {

            String user;
            String pss = "";
            // Controlliamo se l'accesso è fatto da demo (questo servirà per la richiesta di password
            String isDemo = request.getParameter("demoLogin");


            if ( request.getParameter("nome") == null || (isDemo == null && request.getParameter("password") == null)) {
                response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
                return;
            }

            user = request.getParameter("nome");
            if (request.getParameter("password") != null)
                pss = request.getParameter("password");

            // Iniziamo connessione al db
            DbUtility dbu = DbUtility.getInstance(getServletContext());
            try (Connection cn = DriverManager.getConnection(dbu.getUrl(), dbu.getUser(), dbu.getPassword())) {
                // Se abbiamo scelto login demo
                if (isDemo != null) {
                    // Facciamo login demo
                    String sql = "call loginDemo(?, @suc)";
                    try (PreparedStatement ps = cn.prepareStatement(sql)) {
                        ps.setString(1, user);
                        ResultSet ris = ps.executeQuery();
                        /*
                         Valori di ritorno:
                         0 : Username non esistente
                         1 : Username non demo
                         2 : Login fatto con successo
                         */
                        if (ris.next()) {
                            switch (ris.getString(1)) {
                                case "0":
                                    response.sendRedirect("errore.jsp?errore=usr");
                                    break;
                                case "1":
                                    response.sendRedirect("errore.jsp?errore=demo");
                                    break;
                                case "2":
                                    // Successo, creiamo la sessione con attributi
                                    HttpSession sessione = request.getSession(true);
                                    sessione.setAttribute("id", user);
                                    sessione.setMaxInactiveInterval(3600);
                                    sessione.setAttribute("demo", true);
                                    sessione.setMaxInactiveInterval(3600);
                                    // Redirect
                                    response.sendRedirect("successo.jsp?successo=login");
                                    break;
                            }

                        }
                    }

                } else {
                    // Se facciamo un login normale
                    String sql = "call login(?, ?, @suc)";
                    try (PreparedStatement ps = cn.prepareStatement(sql)) {

                        ps.setString(1, user);
                        ps.setString(2, pss);
                        ResultSet ris = ps.executeQuery();
                        /*
                         Valori di ritorno:
                         0 : Username non esistente
                         1 : Password sbagliata
                         2 : Login fatto con successo
                         3 : Login fatto con successo ed è demo
                         */
                        if (ris.next()) {
                            HttpSession sessione = request.getSession(true);
                            switch (ris.getString(1)) {
                                case "0":
                                    response.sendRedirect("errore.jsp?errore=usr");
                                    break;
                                case "1":
                                    response.sendRedirect("errore.jsp?errore=pass");
                                    break;
                                case "2":
                                    sessione.setAttribute("id", user);
                                    sessione.setMaxInactiveInterval(3600);
                                    response.sendRedirect("successo.jsp?successo=login");
                                    break;
                                case "3":
                                    // Successo, creiamo la sessione con attributi
                                    sessione.setAttribute("id", user);
                                    sessione.setMaxInactiveInterval(3600);
                                    sessione.setAttribute("demo", true);
                                    sessione.setMaxInactiveInterval(3600);
                                    // Redirect
                                    response.sendRedirect("successo.jsp?successo=login");
                                    break;
                            }
                        }
                    }
                }

            } catch (SQLException throwables) {
                response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
            }


        } else response.sendRedirect("/errore.jsp?errore=login0");
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException {
        response.setStatus(HttpServletResponse.SC_NOT_FOUND);
    }
}
