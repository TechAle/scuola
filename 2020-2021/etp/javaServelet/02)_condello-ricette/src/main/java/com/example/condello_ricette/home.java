package com.example.condello_ricette;

import java.io.*;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import javax.servlet.http.*;
import javax.servlet.annotation.*;

@WebServlet(name = "home", value = "/home")
public class home extends HttpServlet {

    private String  home1,
                    home2;

    private static String rootPath = "";

    private static final HashMap<String, String> dizionarioValue = new HashMap<String, String>() {
        {
            put("home", "/base-source/home/");
            put("dataset", "/dataset/");
        }
    };

    private ArrayList<String> typeFood = new ArrayList<String>(Arrays.asList("primi", "secondi", "dessert"));

    public void init() {
        rootPath = getServletContext().getRealPath("WEB-INF");
        createHome();

    }

    private void createHome() {
        home1 = getFileSource(dizionarioValue.get("home") + "primo.txt");
        home2 = getFileSource(dizionarioValue.get("home") + "secondo.txt");
    }

    public static String getFileSource(String path) {
        StringBuilder st = new StringBuilder();

        try (BufferedReader br = new BufferedReader(new FileReader(rootPath + path))) {
            String linea;
            while ((linea = br.readLine()) != null) {
                st.append(linea);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        return st.toString();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException {
        response.setContentType("text/html");

        String want = "primi";
        // Check the get
        String scelta = request.getParameter("piatto");
        if (scelta != null) {
            // Controlliamo che possediamo quel determinato valore
            if (typeFood.contains(scelta.toLowerCase()))
                want = scelta;
            else {
                // Ritorniamo errore
                response.setStatus(HttpServletResponse.SC_NOT_FOUND);
                return;
            }
        }


        PrintWriter out = response.getWriter();

        out.println(home1);
        out.println(stampaCibi(want.toLowerCase()));
        out.println(home2);
    }
    private String stampaCibi(String volere) {
        StringBuilder output = new StringBuilder();
        // StackOverflow https://stackoverflow.com/questions/5125242/java-list-only-subdirectories-from-a-directory-not-files/5125258
        File file = new File(rootPath + dizionarioValue.get("dataset") + '/' + volere);
        String[] directories = getDirectory(file);
        // Itero per ogni directory
        if (directories == null || directories.length == 0)
            return "<h2>Nessuna ricetta e stata trovata</h2>";

        for(String parte : directories) {
            String stelle = ricavaStelle(rootPath+(dizionarioValue.get("dataset") + volere + '/' + parte + "/info.txt"));
            output.append("<div class=\"col col-6 col-md-4 col-lg-3 col-xl-2 imgPt border border-dark\" onclick=\"portaRicetta()\">\n" +
                    "            <img src=\"./img/"+parte.toLowerCase()+".jpg"+"\" style=\"padding-bottom: 5px\" alt=\""+parte+"\">\n" +
                    "            <span class=\"imgText\">"+parte+"<br></span>\n" +
                                stelle +
                    "        </div>");
        }
        return output.toString();
    }
    public static String[] getDirectory(File file) {
        return file.list((current, name) -> new File(current, name).isDirectory());
    }
    private final static String stellaAccesa = "<span class='fa fa-star checked'></span>";
    private final static String stellaSpenta = "<span class='fa fa-star'></span>";

    private String ricavaStelle(String path) {
        String stelle = "";
        try {
            BufferedReader wd = new BufferedReader(new FileReader(path));
            int numero = Integer.parseInt(wd.readLine());
            stelle = ricavaStelle(numero);
        } catch (IOException e) {
            e.printStackTrace();
        }
        return stelle;
    }
    public static String ricavaStelle(int n) {
        StringBuilder stelle = new StringBuilder();
        for(int i = 0; i < 5; i++) {
            if (i < n)
                stelle.append(stellaAccesa);
            else
                stelle.append(stellaSpenta);
        }
        return stelle.toString();
    }

    public void destroy() {
    }
}
