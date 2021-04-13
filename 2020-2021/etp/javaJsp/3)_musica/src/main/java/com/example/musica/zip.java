/*
    File: zip.java

    Autore: Alessandro Condelllo
    Ultima modifica: 13/04/2021
 */
package com.example.musica;

import javax.servlet.ServletOutputStream;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.zip.ZipEntry;
import java.util.zip.ZipOutputStream;

@WebServlet(name = "zip", value = "/zip")
public class zip extends HttpServlet {

    public void init() {
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException {
        // Avviamo sessione
        HttpSession sessions = request.getSession(false);
        Carrello canzoni = (Carrello) sessions.getAttribute("zip");
        // Se abbiamo qualcosa dentro lo zip
        if (canzoni != null) {
            // Contenitore nome files
            ArrayList<String> nomiFiles = new ArrayList<String>();
            for (Brano br : canzoni.getBrani()) {
                nomiFiles.add(br.getTitolo() + ".mp3");
            }

            // Iniziamo conversione
            byte[] fileZip;
            try {
                // Qua noi avremo tutti i byte che poi trasferiremo
                ByteArrayOutputStream baos = new ByteArrayOutputStream();
                // Qui avremo tutti i byte dello zip
                ZipOutputStream zos = new ZipOutputStream(baos);
                // Iteriamo per ogni file
                for (String nomeFile : nomiFiles) {
                    // Diciamo al nostro file zip che avremo un nuovo file con NOME
                    zos.putNextEntry(new ZipEntry(new File(nomeFile).getName()));
                    // Leggiamo tutti i byte del file in questione
                    byte[] bytesFile = Files.readAllBytes(Paths.get(getServletContext().getRealPath("/audio/" + nomeFile)));
                    // Scriviamo e salviamo
                    zos.write(bytesFile, 0, bytesFile.length);
                    zos.closeEntry();
                }
                // Portiamo tutto nell output
                zos.flush();
                baos.flush();
                zos.close();
                baos.close();
                // Trasferiamo
                fileZip = baos.toByteArray();

            } catch (IOException ex) {
                response.setStatus(HttpServletResponse.SC_INTERNAL_SERVER_ERROR);
                return;
            }
            // Prendiamo la servlet output
            ServletOutputStream sos = response.getOutputStream();
            // Diciamo cosa stiamo avviando
            response.setContentType("application/zip");
            // Inviamo l'header
            String nomeFile1 = "acquisto.zip";
            response.setHeader("Content-disposition", String.format("attachment; filename=%s", nomeFile1));
            // Scriviamo e mandiamo all'output
            sos.write(fileZip);
            sos.flush();
        } else
            response.sendRedirect("errore.jsp?errore=zip");
    }

}
