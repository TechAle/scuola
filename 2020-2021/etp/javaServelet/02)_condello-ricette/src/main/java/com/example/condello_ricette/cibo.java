package com.example.condello_ricette;


import java.io.*;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.Locale;
import javax.servlet.http.*;
import javax.servlet.annotation.*;

@WebServlet(name = "cibo", value = "/cibo")
public class cibo extends HttpServlet {

    private String  home1,
            home2;

    private static String rootPath = "";

    private static final HashMap<String, String> dizionarioValue = new HashMap<String, String>() {
        {
            put("home", "/base-source/cibo/");
            put("dataset", "/dataset/");
        }
    };

    public void init() {
        rootPath = getServletContext().getRealPath("WEB-INF");
        createHome();

    }

    private void createHome() {
        home1 = home.getFileSource(dizionarioValue.get("home") + "primo.txt");
        home2 = home.getFileSource(dizionarioValue.get("home") + "secondo.txt");
    }


    private String stampaCibo(String cibo, String sezione, HttpServletResponse response) throws IOException {

        StringBuilder toWrite = new StringBuilder();

        if (!typeFood.contains(sezione.toLowerCase()))
            return "";

        String path = rootPath + dizionarioValue.get("dataset") + '/' + sezione.toLowerCase();



        String[] directory = home.getDirectory(new File(path));


        if (directory == null || directory.length == 0)
            return "";

        boolean found = false;
        for(String parte : directory)
            if (parte.equalsIgnoreCase(cibo))
                found = true;

        if (!found)
            return "";

        // Iniziamo ad aggiungere la prima parte
        toWrite.append(cibo);
        toWrite.append("</h1>\n" +
                "<h3 class=\"center\" id=\"sotto\">Ricetta</h3>");

        // Iniziamo a prendere i valori
        String stelle = "";
        String tempo = "";
        String ingredienti = "";
        String procedimento = "";
        try {
            BufferedReader bw = new BufferedReader(new FileReader(path + "/" + cibo + "/info.txt"));
            // Prendiamo il primo valore, le stelle
            stelle = home.ricavaStelle(Integer.parseInt(bw.readLine()));
            // Saltiamo una linea, che è quella dei crediti
            bw.readLine();
            tempo = bw.readLine().trim();
            // Iniziamo a leggere gli ingredienti
            String temp;
            StringBuilder contIngr = new StringBuilder();
            contIngr.append("<ol>");
            while (!(temp = bw.readLine()).contains("|")) {
                contIngr.append("<li>" + temp + "</li>");
            }
            contIngr.append("</ol>");
            ingredienti = contIngr.toString();
            contIngr = new StringBuilder();
            contIngr.append("<ol>");
            // Andiamo per il procedimento ora
            while ((temp = bw.readLine()) != null)
                contIngr.append("<li>" + temp + "</li>");
            contIngr.append("</ol>");
            procedimento = contIngr.toString();
        } catch (IOException e) {
            e.printStackTrace();
            return "";
        }

        toWrite.append("" +
                "<div class=\"container\">\n" +
                "    <div class=\"row\">\n" +
                "        <div class=\"col col-12 col-sm-6 imgPt border border-dark imgDimMin\" style=\"min-width: 400px; min-height: 400px\">\n" +
                "            <img src=\"./img/"+cibo.toLowerCase()+".jpg"+"\" class=\"imgDimMin\" style=\"padding-bottom: 5px\" alt=\""+cibo+"\">\n" +
                "        </div>\n" +
                "        <div class=\"col col-12 col-sm-6 imgPt border border-dark\" style=\"width: 100%\" >\n" +
                "            <span class=\"imgText\" id=\"imgSpace\">"+cibo+"</span>\n" +
                                stelle +
                "            <hr>\n" +
                "            <div>\n" +
                "                Tempo: "+tempo+" Minuti <i class=\"fas fa-stopwatch\"></i>\n" +
                "            </div>\n" +
                "            <hr>\n" +
                "            <div>\n" +
                "                Ingredienti:\n" +
                                    ingredienti +
                "            </div>\n" +
                "        </div>\n" +
                "        <div class=\"col col-12 border-left border-right border-bottom border-dark\">\n" +
                            procedimento +
                "        </div>\n" +
                "\n" +
                "    </div>\n" +
                "</div>");

        return toWrite.toString();
    }

    private final ArrayList<String> typeFood = new ArrayList<String>(Arrays.asList("primi", "secondi", "dessert"));


    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException {
        response.setContentType("text/html");
        String cibo = request.getParameter("cibo");
        String sezione = request.getParameter("sezione");
        if (cibo == null || sezione == null) {
            response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
            return;
        }
        String centro = stampaCibo(cibo, sezione, response);
        if (centro.equals("")) {
            response.setStatus(HttpServletResponse.SC_NOT_FOUND);
            return;
        }
        PrintWriter out = response.getWriter();

        out.println(home1);
        out.println(centro);
        out.println(home2);
    }

    public void destroy() {
    }
}
