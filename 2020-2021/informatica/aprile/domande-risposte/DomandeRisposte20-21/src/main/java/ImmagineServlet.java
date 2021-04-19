/*
               File: ImmagineServlet.java
   Applicazione web: Domande & Risposte

             Autore: Roberto FULIGNI
    Ultima modifica: 18/03/2021

        Descrizione: Routine per il download di immagini contenute nel database SQL.

*/

import edu.fauser.DbUtility;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;
import java.io.InputStream;
import java.sql.*;

@WebServlet(name = "ImmagineServlet", value = "/immagine")
public class ImmagineServlet extends HttpServlet {
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        Integer codice = Integer.parseInt(request.getParameter("codice"));
        if (codice == null) {
            response.sendError(HttpServletResponse.SC_BAD_REQUEST);
            return;
        }

        ServletContext ctx = request.getServletContext();
        DbUtility dbu = (DbUtility) ctx.getAttribute("dbutility");
        try (Connection cn = DriverManager.getConnection(dbu.getUrl(), dbu.getUser(), dbu.getPassword()))
        {
            String strSql = "SELECT img, tipo FROM dr_domande WHERE codice = ?";
            try (PreparedStatement ps = cn.prepareStatement(strSql)) {
                ps.setInt(1, codice);
                ResultSet rs = ps.executeQuery();
                if (rs.next() == false) {
                    response.sendError(HttpServletResponse.SC_NOT_FOUND);
                    return;
                }
                // Stream collegato alla risposta HTTP
                ServletOutputStream out = response.getOutputStream();

                // Apre uno stream collegato al campo BLOB "img"
                InputStream img = rs.getBinaryStream("img");
                String tipo = rs.getString("tipo");
                // Imposta il Content-Type in base al tipo di immagine
                response.setContentType(tipo);

                // Copia il contenuto dell'immagine nello stream di output
                byte[] buffer = new byte[4096];
                while (img.read(buffer) > 0) {
                    out.write(buffer);
                }
                out.flush();
                rs.close();
            }
        } catch (SQLException e) {
            e.printStackTrace(response.getWriter());
            response.sendError(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
        }
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        // Metodo POST non gestito da questa servlet
        response.sendError(HttpServletResponse.SC_METHOD_NOT_ALLOWED);
    }
}
