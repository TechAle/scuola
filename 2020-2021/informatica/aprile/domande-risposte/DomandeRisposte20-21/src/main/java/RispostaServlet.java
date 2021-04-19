/*
               File: RispostaServlet.java
   Applicazione web: Domande & Risposte

             Autore: Roberto FULIGNI
    Ultima modifica: 18/03/2021

        Descrizione: Memorizzazione della risposta nel database SQL.

*/

import edu.fauser.DbUtility;
import edu.fauser.netlab.AppUtility;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;
import java.sql.*;

// Upload limitato a immagini di dimensioni non superiori a 10 kB.

@WebServlet(name = "RispostaServlet", value = "/risposta")
@MultipartConfig(fileSizeThreshold = 10240, maxFileSize = 10240, maxRequestSize = 12240)
public class RispostaServlet extends HttpServlet {
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        // Metodo GET non gestito da questa servlet
        response.sendError(HttpServletResponse.SC_BAD_REQUEST);
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        request.setCharacterEncoding("UTF-8");
        String strCod = request.getParameter("codice");
        String risposta = request.getParameter("risposta");
        String nickname = request.getParameter("nickname");
        Part img = null;
        try {
            // Acquisisce la parte della richiesta contenente l'immagine
            img = request.getPart("img");
        } catch (IllegalStateException e) {
            // La dimensione dell'immagine supera il limite imposto dal server
            response.sendError(HttpServletResponse.SC_REQUEST_ENTITY_TOO_LARGE);
            return;
        }

        if (strCod == null || risposta == null || nickname == null || img == null) {
            response.sendError(HttpServletResponse.SC_BAD_REQUEST);
            return;
        }
        ServletContext ctx = request.getServletContext();
        Integer codice = Integer.parseInt(strCod);
        String nomeFile = estraiFileName(img);
        String tipo =  ctx.getMimeType(nomeFile);       // esempi:  image/jpeg, image/png, ecc.
        DbUtility dbu = (DbUtility) ctx.getAttribute("dbutility");

        try (Connection cn = DriverManager.getConnection(dbu.getUrl(), dbu.getUser(), dbu.getPassword()))
        {
            String strSql = "UPDATE dr_domande SET risposta = ?, nickname = ?, img = ?, tipo = ? WHERE codice = ?";
            try (PreparedStatement ps = cn.prepareStatement(strSql)) {
                ps.setString(1, risposta);
                ps.setString(2, nickname);
                // Copia lo stream dell'immagine nel campo BLOB "img"
                ps.setBinaryStream(3, img.getInputStream());
                ps.setString(4, tipo);
                ps.setInt(5, codice);
                if (ps.executeUpdate() == 0) {
                    // Aggiornamento fallito, si mostra l'errore SQL nella console del server
                    AppUtility.mostraErroreSql(ps.getWarnings());
                    response.sendError(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
                    return;
                }
                response.sendRedirect("index.jsp");
            }
        } catch (Exception e) {
            e.printStackTrace(response.getWriter());
        }
    }
    private static String estraiFileName(Part part) {
        // Ricava il nome del file contenuto nella richiesta HTTP
        for (String cd : part.getHeader("content-disposition").split(";")) {
            if (cd.trim().startsWith("filename")) {
                String fileName = cd.substring(cd.indexOf('=') + 1).trim().replace("\"", "");
                return fileName.substring(fileName.lastIndexOf('/') + 1).substring(fileName.lastIndexOf('\\') + 1); // MSIE fix.
            }
        }
        return null;
    }
}
