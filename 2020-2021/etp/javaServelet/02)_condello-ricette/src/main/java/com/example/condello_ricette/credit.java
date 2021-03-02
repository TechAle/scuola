package com.example.condello_ricette;


import java.io.*;
import java.util.HashMap;
import javax.servlet.http.*;
import javax.servlet.annotation.*;

@WebServlet(name = "crediti", value = "/crediti")
public class credit extends HttpServlet {

    private String  home1,
            home2;

    private static String rootPath = "";

    private static final HashMap<String, String> dizionarioValue = new HashMap<String, String>() {
        {
            put("home", "/base-source/crediti/");
            put("dataset", "/dataset/");
        }
    };

    public void init() {
        rootPath = getServletContext().getRealPath("WEB-INF");
        createHome();

    }

    private void createHome() {
        home1 = getFileSource(dizionarioValue.get("home") + "primo.txt");
        home2 = getFileSource(dizionarioValue.get("home") + "secondo.txt");
    }

    private static String getFileSource(String path) {
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

        PrintWriter out = response.getWriter();

        out.println(home1);
        out.println(getCredit());
        out.println(home2);
    }

    private String getCredit() {
        StringBuilder output = new StringBuilder();
        output.append("<ul class=\"list-group\" style=\"margin-top: 15px;\">");
        // Iteriamo per ogni directory
        for(String dir : home.getDirectory(new File(rootPath + dizionarioValue.get("dataset")))) {
            // Iteriamo per ogni cibo
            for(String cibo : home.getDirectory(new File(rootPath + dizionarioValue.get("dataset") + dir ))) {
                // Leggo il file
                try {
                    BufferedReader br = new BufferedReader(new FileReader(rootPath + dizionarioValue.get("dataset") + dir + "/" + cibo + "/info.txt"));
                    br.readLine();
                    output.append("<li class=\"list-group-item\">"+cibo+" crediti: " + br.readLine().trim() + "</li>");
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }
        output.append("</ul>");
        return output.toString();
    }

    public void destroy() {
    }
}
