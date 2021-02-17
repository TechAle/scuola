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
    final Object locker = new Object();

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


    private String stampaCibo(String cibo, String sezione) {

        StringBuilder toWrite = new StringBuilder();

        if (!typeFood.contains(sezione.toLowerCase()))
            return "";

        String path = rootPath + dizionarioValue.get("dataset") + '/' + sezione;

        String[] directory = home.getDirectory(new File(path));

        if (directory.length == 0)
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


        synchronized (locker) {
            ArrayList<String> output = new ArrayList<String>();

            try {
                BufferedReader bw = new BufferedReader(new FileReader(path + "/" + cibo + "/info.txt"));
                output.add(bw.readLine());
                String valueT = Integer.toString((Integer.parseInt(bw.readLine()) + 1));
                output.add(valueT);
                String temp = "";
                while ((temp = bw.readLine()) != null)
                    output.add(temp);
            } catch (IOException e) {
                e.printStackTrace();
            }
            try {
                BufferedWriter bw = new BufferedWriter(new FileWriter(path + "/" + cibo + "/info.txt"));
                for(String linea : output) {
                    bw.write(linea);
                    bw.newLine();
                }
                bw.close();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }

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
        String centro = stampaCibo(cibo, sezione);
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
