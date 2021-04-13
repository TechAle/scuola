/*
    File: CarrelloGestore.java

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

@WebServlet(name = "CarrelloGestore", value = "/CarrelloGestore")
public class CarrelloGestore extends HttpServlet {

    public void init() {
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) {
        String azione = request.getParameter("Azione");

        if (azione == null)
            azione = "";

        switch (azione) {
            case "Aggiungi":
                aggiungi(request, response);
                break;
            case "Elimina":
                elimina(request, response);
                break;
            default:
                response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
        }
    }

    private void aggiungi(HttpServletRequest request, HttpServletResponse response) {

        // Controlliamo il codice
        if (request.getParameter("codice") == null) {
            response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
            return;
        }
        int codice = Integer.parseInt(request.getParameter("codice"));

        // Iniziamo la sessione
        HttpSession sessione = request.getSession();
        Carrello c = getCarrello(sessione);

        // Se abbiamo già quel determinato codice
        if (c.contains(codice)) {
            try {
                response.sendRedirect("errore.jsp?errore=es");
            } catch (java.io.IOException ignored) {
                response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
            }
            return;
        }

        // Andiamo a prendere i dati dal database
        DbUtility dbu = DbUtility.getInstance(request.getServletContext());
        try (Connection cn = DriverManager.getConnection(dbu.getUrl(), dbu.getUser(), dbu.getPassword())) {
            // Sql
            String sql = "select codice, titolo, nomeCantante, durata, prezzo from brani where codice = ?";
            // Avvio
            try (PreparedStatement ps = cn.prepareStatement(sql)) {
                ps.setString(1, Integer.toString(codice));
                ResultSet rs = ps.executeQuery();
                if (rs.next()) {
                    // Aggiungiamo le varie informazioni
                    c.aggiungi(new Brano(rs.getInt(1), rs.getString(2), rs.getString(3), rs.getInt(4), rs.getFloat(5)));
                    response.sendRedirect("carrello.jsp");
                } else response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
            }catch (SQLException | IOException e) {
                response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
            }
        }catch (java.sql.SQLException e) {
            response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
        }



    }

    private void elimina(HttpServletRequest request, HttpServletResponse response) {

        // Controlliamo che codice esiste
        if (request.getParameter("codice") == null) {
            response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
            return;
        }
        int codice = Integer.parseInt(request.getParameter("codice"));

        // Prendiamo la sessione
        HttpSession sessione = request.getSession();
        Carrello c = getCarrello(sessione);

        // Se il carrello non contiene il seguente codice
        if (!c.contains(codice)) {
            try {
                response.sendRedirect("errore.jsp?errore=esNo");
            } catch (java.io.IOException ignored) {
                response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
            }
            return;
        }
        // Elimina
        c.elimina(codice);
        try {
            response.sendRedirect("carrello.jsp");
        }catch (java.io.IOException ignored) {
            response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
        }
    }

    public static Carrello getCarrello(HttpSession sessione) {
        Carrello c = (Carrello) sessione.getAttribute("carrello");
        if (c == null) {
            c = new Carrello();
            sessione.setAttribute("carrello", c);
        }
        return c;
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException {
        response.setStatus(HttpServletResponse.SC_NOT_FOUND);
    }
}
