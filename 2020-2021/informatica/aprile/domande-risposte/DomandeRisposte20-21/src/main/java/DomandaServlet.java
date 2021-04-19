/*
               File: DomandaServlet.java
   Applicazione web: Domande & Risposte

             Autore: Roberto FULIGNI
    Ultima modifica: 18/03/2021

        Descrizione: Memorizzazione di una nuova domanda nel database SQL.

*/

import edu.fauser.DbUtility;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;

@WebServlet(name = "DomandaServlet", value = "/domanda")
public class DomandaServlet extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        request.setCharacterEncoding("UTF-8");
        String domanda = request.getParameter("domanda");
        System.out.println(domanda);
        if (domanda == null) {
            response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
            return;
        }
        try {
            ServletContext ctx = request.getServletContext();
            DbUtility dbu = (DbUtility) ctx.getAttribute("dbutility");
            nuovaDomanda(domanda, dbu);
            response.sendRedirect("index.jsp");
        } catch (SQLException e) {
            response.sendError(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
        }
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        // Metodo GET non gestito da questa servlet
        response.setStatus(HttpServletResponse.SC_METHOD_NOT_ALLOWED);
    }

    private void nuovaDomanda(String domanda, DbUtility dbu) throws SQLException {
        try (Connection cn = DriverManager.getConnection(dbu.getUrl(), dbu.getUser(), dbu.getPassword())) {
            String strSql = "INSERT INTO dr_domande(domanda) VALUES (?)";
            try (PreparedStatement ps = cn.prepareStatement(strSql)) {
                ps.setString(1, domanda);
                if (ps.executeUpdate() == 0) {
                    throw new SQLException("Errore di inserimento dati");
                }
            }
        }
    }
}
