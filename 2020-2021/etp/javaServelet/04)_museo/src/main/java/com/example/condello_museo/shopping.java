package com.example.condello_museo;

import edu.fauser.DbUtility;

import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.*;
import java.util.HashMap;


@WebServlet( name="shopping", value = "/shopping")
public class shopping extends javax.servlet.http.HttpServlet {
    DbUtility dbu;
    public void init() {
        dbu = DbUtility.getInstance(getServletContext());
        dbu.setDevCredentials("jdbc:mysql://localhost:3306/db11465?maxPoolSize=2&pool", "root", "");
        dbu.setProdCredentials("jdbc:mysql://localhost:3306/db11465?maxPoolSize=2&pool", "db11465", "");
    }

    protected void doPost(javax.servlet.http.HttpServletRequest request,
                          javax.servlet.http.HttpServletResponse response) throws IOException {

        String nome = request.getParameter("nome");
        String data = request.getParameter("data");
        String numero = request.getParameter("numero");
        String color = request.getParameter("color");

        if (nome == null || nome.equals("") || data == null || data.equals("") || numero == null || color == null)
            response.sendRedirect(request.getContextPath() + "/shopping?errore=1");

        String usr = dbu.getUser();
        String url = dbu.getUrl();
        String pwd = dbu.getPassword();
        HashMap<String, String> colori = new HashMap<>();

        try (Connection cn = DriverManager.getConnection(url, usr, pwd)) {

            String sqlColori = "CALL aggiungi_prenotazione(?, ?, ?, ?, @valido);";

            try (PreparedStatement ps = cn.prepareStatement(sqlColori)) {
                ps.setString(1, color);
                ps.setString(2, nome);
                ps.setString(3, data);
                ps.setString(4, numero);
                ResultSet rs = ps.executeQuery();
                if (rs.next()) {
                    response.sendRedirect(request.getContextPath() + "/shopping?errore=0&valore=" + rs.getString(1));
                }else response.sendRedirect(request.getContextPath() + "/shopping?errore=2");
            }

        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }

    }

    protected void doGet(javax.servlet.http.HttpServletRequest request,
                         javax.servlet.http.HttpServletResponse response) throws IOException {

        librerie.printHeader(response.getWriter(), 0);

        printBody(response.getWriter(), request);

        librerie.printFooter(response.getWriter());
    }

    private void printBody(PrintWriter wt, HttpServletRequest request) {
        wt.print("<h1 style=\"text-align: center\">Acquisti</h1>\n" +
                "                <i>Inserire i suoi dati per potere acquistare una visita nella data a  lei desiderata</i>\n" +
                "                <center>\n" +
                "                <form action=\"shopping\" method=\"post\" id=\"form_prenotazione\">\n" +
                "                    <fieldset style='width: 400px'>\n" +
                "                        <p><label>Nome:\n" +
                "                            <input type=\"text\" name=\"nome\" style=\"margin-left: 7px\">\n" +
                "                        </label></p><br>\n" +
                "                        <p><label>Data:\n" +
                "                            <input type=\"date\" name=\"data\" style=\"margin-left: 7px\">\n" +
                "                        </label></p><br>\n" +
                "                        <p><label style='text-align: left'>Numero partecipanti:\n" +
                "                            <input required type=\"number\" name=\"numero\" style=\"margin-left: 7px\">\n" +
                "                        </label></p><br>");
        // Colori

        // Scrittura select
        /// Ricavo tutti i colori

        //// Creo la connessione
        String usr = dbu.getUser();
        String url = dbu.getUrl();
        String pwd = dbu.getPassword();
        HashMap<String, String> colori = new HashMap<>();

        try (Connection cn = DriverManager.getConnection(url, usr, pwd)) {

            String sqlColori = "select nome, colore from area";
            Statement stm = cn.createStatement();
            if (stm.execute(sqlColori)) {
                ResultSet ris = stm.getResultSet();
                while (ris.next()) {
                    System.out.println("");
                    colori.put(ris.getString(1), ris.getString(2));
                }
            }

        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }

        /// Scrivo gli stili
        wt.print("<style>\n" +
                "                        label > input[type=\"radio\"] {\n" +
                "                            display: none;\n" +
                "                        }");

        for(String colore : colori.keySet()) {
            wt.printf("\n" +
                    "                        #%s + *::before {\n" +
                    "                            content: \"\";\n" +
                    "                            display: inline-block;\n" +
                    "                            vertical-align: bottom;\n" +
                    "                            width: 1rem;\n" +
                    "                            height: 1rem;\n" +
                    "                            margin-right: 0.3rem;\n" +
                    "                            border-radius: 50%%;\n" +
                    "                            border-style: solid;\n" +
                    "                            border-width: 0.15rem;\n" +
                    "                            border-color: gray;\n" +
                    "                            background-color: #%s;\n" +
                    "                        }\n" +
                    "\n" +
                    "                        #%s:checked + *::before {\n" +
                    "                            background: radial-gradient(#%s 0%%, #%s 40%%, transparent 50%%, transparent);\n" +
                    "                            border-color: #%s;\n" +
                    "                        }\n" +
                    "                        #%s:checked + * {\n" +
                    "                            color: #%s;\n" +
                    "                        }", colore, colori.get(colore), colore, colori.get(colore), colori.get(colore), colori.get(colore), colore, colori.get(colore));
        }

        wt.print("</style><br>");

        int j = 0;
        for(String colore : colori.keySet()) {
            wt.printf("<label><input type=\"radio\" name=\"color\" id=\"%s\" value=\"%s\" %s />\n" +
                    "                            <span></span></label>", colore, colore, j++ == 0 ? "checked = ''" : "");
        }

        // Fine colori

        wt.print("<input type=\"submit\" value=\"Invia i dati\" name=\"invia\" style=\"margin-top: 10px\">\n" +
                "                    </fieldset>\n" +
                "                </form>\n" +
                "                </center>");

        // Risultato
        wt.print("<div id=\"risultato\" class=\"\">");

        // Fine risultato
        wt.print("</div>\n" +
                "                </center>");


        /*
<script>
        $( function() {
            $( "#dialog" ).dialog({
                dialogClass: "no-close",
                buttons: [
                    {
                        text: "Ok",
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                ]
            });
        } );
    </script>
    <style>
        .ui-dialog {
            background-color: lightslategray;
        }
        #dialog {
            margin: 5px 5px 5px 5px;
        }
        .ui-dialog-titlebar-close {
            display: none;
        }
    </style>

    <div id="dialog">
        <p>Risultato</p>
    </div>
         */
        String errore = request.getParameter("errore");
        if (errore != null) {
            wt.write("\n" +
                    "    <script src=\"https://code.jquery.com/jquery-1.12.4.js\"></script>\n" +
                    "    <script src=\"https://code.jquery.com/ui/1.12.1/jquery-ui.js\"></script>\n<script>\n" +
                    "        $( function() {\n" +
                    "            $( \"#dialog\" ).dialog({\n" +
                    "                dialogClass: \"no-close\",\n" +
                    "                buttons: [\n" +
                    "                    {\n" +
                    "                        text: \"Ok\",\n" +
                    "                        click: function() {\n" +
                    "                            $( this ).dialog( \"close\" );\n" +
                    "                        }\n" +
                    "                    }\n" +
                    "                ]\n" +
                    "            });\n" +
                    "        } );\n" +
                    "    </script>\n" +
                    "    <style>\n" +
                    "        .ui-dialog {\n" +
                    "            background-color: lightslategray;\n" +
                    "        }\n" +
                    "        #dialog {\n" +
                    "            margin: 5px 5px 5px 5px;\n" +
                    "        }\n" +
                    "        .ui-dialog-titlebar-close {\n" +
                    "            display: none;\n" +
                    "        }\n" +
                    "    </style>\n" +
                    "\n" +
                    "    <div id=\"dialog\">\n" +
                    "        <p>");
            // Testo inserire
            if (errore.equals("1")) {
                wt.write("Errore nell'inserimento dei dati");
            }else if(errore.equals("2")) {
                wt.write("Dati non disponibile/corretta");
            }else if(errore.equals("0")) {
                String valore = request.getParameter("valore");
                if (valore == null || valore.equals(""))
                    wt.write("Qualcosa è andato storto nel cercare di ricavare il costo");
                else if (valore.equals("0"))
                    wt.write("Dati non disponibile/corretti");
                else wt.write("Pianificazione aggiunta con successo! Costo: " + valore);
            }
            // Fine testo
            wt.write("</p>\n" +
                    "    </div>");
        }
        wt.print("");
    }


}
