package com.example.condello_museo;

import edu.fauser.DbUtility;

import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.*;
import java.util.HashMap;
import java.util.Locale;

@WebServlet( name="prenotazioni", value = "/prenotazioni")
public class prenotazioni extends javax.servlet.http.HttpServlet {
    DbUtility dbu;
    public void init() {
        dbu = DbUtility.getInstance(getServletContext());
        dbu.setDevCredentials("jdbc:mysql://localhost:3306/db11465?maxPoolSize=2&pool", "root", "");
        dbu.setProdCredentials("jdbc:mysql://localhost:3306/db11465?maxPoolSize=2&pool", "db11465", "");
    }

    protected void doPost(javax.servlet.http.HttpServletRequest request,
                          javax.servlet.http.HttpServletResponse response) {

    }

    protected void doGet(javax.servlet.http.HttpServletRequest request,
                          javax.servlet.http.HttpServletResponse response) throws IOException {
        PrintWriter wt = response.getWriter();
        
        librerie.printHeader(wt, 0);

        printBody(wt, request);

        librerie.printFooter(wt);

    }
    
    private void printBody(PrintWriter wt, HttpServletRequest request) {
        // Inizio form
        wt.print("<h1 style=\"text-align: center\">Prenotazioni</h1>" +
                "                <i>Inserire un area per potere visualizzare tutte le prenotazioni che sono avvenute in quell'area specifica</i>" +
                "                <form action=\"prenotazioni\" method=\"get\" id=\"form_prenotazione\">" +
                "                    Area Prenotazione:<br>");

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

        wt.print("</style>");

        int j = 0;
        for(String colore : colori.keySet()) {
            wt.printf("<label><input type=\"radio\" name=\"color\" id=\"%s\" value=\"%s\" %s />\n" +
                    "                            <span></span></label>", colore, colore, j++ == 0 ? "checked = ''" : "");
        }
        wt.print("<br>\n" +
                "                    <input type=\"submit\" value=\"Ricerca\" name=\"ricerca\"></div>");

        // Fine form
        wt.print("" +
                "                </form>");
        // Inizio risultato
        wt.print("<div id=\"risultato\">");

        String colore = request.getParameter("color");
        if (colore != null) {
            colore = colore.toLowerCase();
            try (Connection cn = DriverManager.getConnection(url, usr, pwd)) {
                String sqlColori = "select distinct nome, areaID from area";
                Statement stm = cn.createStatement();
                if (stm.execute(sqlColori)) {
                    ResultSet ris = stm.getResultSet();
                    String result = "";
                    while (ris.next() && result.equals("")) {
                        if(ris.getString(1).equals(colore))
                            result = ris.getString(2);
                    }
                    if (!result.equals("")) {
                        String sqlArea = "select p.Data, p.NomeUtente, p.Partecipanti from prenotazioni p NATURAL join area where p.areaID = " + result;
                        Statement stm1 = cn.createStatement();
                        if (stm1.execute(sqlArea)) {
                            ris = stm1.getResultSet();
                            wt.print("<style>\n" +
                                    "                        #aree {\n" +
                                    "                            font-family: Arial, Helvetica, sans-serif;\n" +
                                    "                            border-collapse: collapse;\n" +
                                    "                            width: 100%;\n" +
                                    "                        }\n" +
                                    "\n" +
                                    "                        #aree td, #aree th {\n" +
                                    "                            border: 1px solid #ddd;\n" +
                                    "                            padding: 8px;\n" +
                                    "                        }\n" +
                                    "\n" +
                                    "                        #aree tr:nth-child(even){background-color: #f2f2f2;}\n" +
                                    "\n" +
                                    "                        #aree tr:hover {background-color: #ddd;}\n" +
                                    "\n" +
                                    "                        #aree th {\n" +
                                    "                            padding-top: 12px;\n" +
                                    "                            padding-bottom: 12px;\n" +
                                    "                            text-align: left;\n" +
                                    "                            background-color: #7a7a7a;\n" +
                                    "                            color: white;\n" +
                                    "                        }\n" +
                                    "                    </style>");
                            wt.print("<div style=\"max-height: 125px; width: 100%; overflow-y: scroll\">\n" +
                                    "                        <center><table id=\"aree\" >");
                            wt.print("<tr>\n" +
                                    "                                <th>Data</th>\n" +
                                    "                                <th>Nome</th>\n" +
                                    "                                <th>Numero</th>\n" +
                                    "                            </tr>");
                            while (ris.next()) {
                                wt.printf("<tr>\n" +
                                        "                                <td>%s</td>\n" +
                                        "                                <td>%s</td>\n" +
                                        "                                <td>%s</td>\n" +
                                        "                            </tr>", ris.getString(1), ris.getString(2), ris.getString(3));
                            }
                            wt.print("</table></center>\n" +
                                    "                    </div>");
                        }
                    }else wt.print(colore + " non e stato trovato");
                }

            } catch (SQLException throwables) {
                throwables.printStackTrace();
            }
        }

        wt.print("</div>");

        /*
        +
                "                <div id=\"risultato\">" +
                "                </div>");
         */
    }


}
