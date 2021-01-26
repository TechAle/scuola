package com.example.rappresentanti;

import java.io.*;
import java.util.ArrayList;
import java.util.HashMap;
import javax.servlet.http.*;
import javax.servlet.annotation.*;

@WebServlet(name = "classe", value = "/classe")
public class HelloServlet extends HttpServlet {
    private String message;

    private final HashMap<String, String[]> classi = new HashMap<String, String[]>() {
        {
            put("5ain", new String[] {"Alessandro Mattia", "Luca Valerio"});
            put("5ac", new String[] {"Giorgio Valeotti"});
            put("5bin", new String[] {"Giorgio Rosa", "Tiziano Rossi"});
            put("5bc", new String[] {"Enrico Elio", "Federica Beracchia", "Marco Ferno"});
        }
    };

    String primaParte = "<!DOCTYPE html>\n<html lang=\"en\" style=\"height: 100vh\">\n<head>\n    <meta charset=\"UTF-8\">\n    <title>Fauser</title>\n    <link rel=\"stylesheet\" href=\"css/bootstrap.css\">\n    <script type=\"text/javascript\" src=\"js/bootstrap.js\"></script>\n    <style>\n        label {\n            padding: 0px 1px 0px 8px;\n        }\n\n        input[type=radio],\n        input.radio {\n            margin: 2px 0 0 2px;\n        }\n         footer {\n             position: fixed;\n             left: 0;\n             bottom: 0;\n             width: 100%;\n             text-align: center;\n         }\n\n    </style>\n</head>\n<body style=\"height: 100%\">\n\n<nav class=\"navbar navbar-light bg-dark\">\n    <span class=\"navbar-brand mb-0 h1\" style=\"color: #ffc11f\">Indietro</span>\n    <span class=\"navbar-brand mb-0 h1\" style=\"color: #ffc11f\">Fauser</span>\n</nav>\n\n<div class=\"bg-light\" style=\"margin-bottom: 20px\">\n    <center>\n    <div class=\"navbar-brand mb-0 h1\" style=\"color: #1fddff; \">Rappresentanti </div>\n    </center>\n    <div class=\"navbar-brand mb-0 h5\" style=\"color: #1fddff; padding-left: 10px\">Classe ";
    String secondaParte = "</div>\n</div>\n\n<ul class=\"list-group\">";
    String terzaParte = "</ul>\n\n\n<footer class=\"bg-light text-center text-lg-start\">\n    <!-- Copyright -->\n    <div class=\"text-center p-3\" style=\"background-color: rgba(0, 0, 0, 0.2)\">\n        © 2020 Copyright: Fauser\n    </div>\n    <!-- Copyright -->\n</footer>\n\n</body>\n</html>";


    public void init() {

    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException {
        response.setContentType("text/html");

        String classe = request.getParameter("classe");

        if (classe != null) {
            classe = escapeHTML(classe.toLowerCase());
            if (classi.containsKey(classe)) {
                PrintWriter out = response.getWriter();
                out.println(primaParte);
                out.println(classe);
                out.println(secondaParte);
                for(String rappresentante : classi.get(classe)) {
                    out.println("<li class=\"list-group-item\">");
                    out.println(rappresentante);
                    out.println("</li>");
                }
                out.println(terzaParte);
            }else response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
        }else response.setStatus(HttpServletResponse.SC_BAD_REQUEST);

    }

    public static String escapeHTML(String str) {
        StringBuilder sb = new StringBuilder(str.length());
        for (int i = 0; i < str.length(); i++) {
            char ch = str.charAt(i);
            if (ch == '&' || ch == '"' || ch == '<' || ch == '>' || ch > 127) {
                sb.append(String.format("&#%d;", (int) ch));
            } else {
                sb.append(ch);
            }
        }
        return sb.toString();
    }

    public void destroy() {
    }
}