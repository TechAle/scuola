package com.example.scarpe;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

@WebServlet(name = "VenditaServlet", value = "/vendita")
public class VenditaServlet extends javax.servlet.http.HttpServlet {
    ArrayList<Acqua> disponibili;

    protected void doPost(javax.servlet.http.HttpServletRequest request,
                          javax.servlet.http.HttpServletResponse response) throws javax.servlet.ServletException,
            IOException {
         /*
         * Le richieste effettuate con il metodo POST possono specificare le seguenti operazioni:
         * "aggiungi": aggiunge un articolo al carrello della spesa
          * "elimina": elimina un articolo dal carrello
          */
        response.setContentType("text/html; charset=UTF-8");
        String operazione = request.getParameter("operazione");
        if (operazione == null) operazione = "";
        switch(operazione) {
            case "aggiungi":
                aggiungi(request, response);
                break;
            case "elimina":
                elimina(request, response);
                break;
            default:
                response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
                return;
        }
    }

    private void elimina(HttpServletRequest request, HttpServletResponse response) throws
            IOException {
        int riga;
        try {
            riga = Integer.parseInt(request.getParameter("riga"));
        }
        catch (NumberFormatException ex) {
            response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
            return;
        }
        HttpSession sessione = request.getSession();
        Carrello c = getCarrello(sessione);
        c.elimina(riga);
        sessione.setAttribute("msg", "Articolo rimosso dal carrello con successo.");
        response.sendRedirect("vendita?operazione=carrello");
    }

    private void aggiungi(HttpServletRequest request, HttpServletResponse response) throws
            IOException {
        int codice, qta, size;
        String colore;
        try {
            codice = Integer.parseInt(request.getParameter("codice"));
            qta = Integer.parseInt(request.getParameter("qta"));
            size = Integer.parseInt(request.getParameter("size"));
            colore = request.getParameter("colori");
        }
        catch (NumberFormatException ex) {
            response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
            return;
        }
        HttpSession sessione = request.getSession();
        Carrello c = getCarrello(sessione);
        for(Acqua a : disponibili) {
            if (codice == a.getCodice()) {
                c.aggiungi(new Articolo(codice, a.getDescrizione(), a.getPrezzo(), qta, size, colore));
                sessione.setAttribute("msg", "Acquisto completato. Un nuovo articolo è stato aggiunto al carrello.");
                        response.sendRedirect("vendita?operazione=carrello");
                return;
            }
        }
        response.setStatus(HttpServletResponse.SC_NOT_ACCEPTABLE);
    }

    protected void doGet(javax.servlet.http.HttpServletRequest request,
                         javax.servlet.http.HttpServletResponse response) throws javax.servlet.ServletException,
            IOException {
        /*
         * Le richieste effettuate con il metodo GET possono specificare le seguenti operazioni:
         * "acquisto": richiede l'elenco dei prodotti acquistabili (operazione di default)
         * "carrello": richiede il contenuto del carrello della spesa
         * "pagamento": conclude l'acquisto pagando gli articoli presenti nel carrello
         */
        response.setContentType("text/html; charset=UTF-8");
        String operazione = request.getParameter("operazione");
        if (operazione == null) operazione = "acquisto";
        switch (operazione) {
            case "acquisto":
                acquisto(request, response);
                break;
            case "carrello":
                carrello(request, response);
                break;
            case "pagamento":
                pagamento(request, response);
                break;
            default:
                response.setStatus(HttpServletResponse.SC_BAD_REQUEST);
                return;
        }
    }

    private void acquisto(HttpServletRequest request, HttpServletResponse response)
            throws IOException {
        HttpSession sessione = request.getSession();
        Carrello c = getCarrello(sessione);
        PrintWriter out = response.getWriter();
        inizioRisposta(out, c);
        out.println("<h1>Nuovo acquisto</h1>");
        out.println("<p>Scegliere la tipologia di comprare</p>");
        out.println("<div class='row'>");
        out.println("<div class='col-sm-12 col-md-8 offset-md-2 text-center'>");
        out.println("<form action='vendita' method='post'>");
        // Campo nascosto per indicare l'operazione da eseguire
        out.println("<input type='hidden' name='operazione' value='aggiungi' />");
        out.println("<center><fieldset class='form-group'>");
        out.println("<div class='row text-left'>");
        out.println("<legend class='col-form-label col-sm-2 pt-0'>Articolo</legend>");
        out.println("<div class='col-sm-10'>");
        for(int i = 0; i < disponibili.size(); i++) {
            Acqua a = disponibili.get(i);
            out.println("<div class='form-check mb-2'>");
            out.print("<input class='form-check-input' type='radio' name='codice' ");
            out.format("id='articolo%d' value='%d' %s />", a.getCodice(),
                    a.getCodice(), i == 0 ? "checked" : "");
            out.format("<label class='form-check-label' for='articolo%d'>%s (&euro; %.2f)</label>", a.getCodice(),
                    escapeHTML(a.getDescrizione()),
                    a.getPrezzo()
 );
            out.println("</div>");
        }out.println("</div>");
        out.println("</div>");
        out.println("</fieldset></center>");
        out.println("<div class='form-group row'>");
        out.println("<label for='qta' class='col-3 col-form-label'>Quantit&agrave;</label>");
        out.println("<div class='col-3'>");
        out.println("<input type='number' class='form-control' id='qta' name='qta' value='1' min='1' max='20' />");
        out.println("</div>");
        out.println("<label for='size' class='col-3 col-form-label'>Dimensione</label>");
        out.println("<div class='col-3'>");
        out.println("<input type='number' class='form-control' id='size' name='size' value='35' min='35' max='47' />");
        out.println("</div><center style='width:100%'><div>");
        out.println("<label class='col-3' for=\"colori\">Colore:</label>\n" +
                "  <select name=\"colori\" id=\"colori\">\n" +
                "    <option value=\"blue\">blue</option>\n" +
                "    <option value=\"giallo\">giallo</option>\n" +
                "    <option value=\"verde\">verde</option>\n" +
                "    <option value=\"nero\">nero</option>\n" +
                "  </select>");
        out.println("</div></center><div class='col-sm-12 text-left'>");
        out.println("<center><button type='submit' class='btn btn-primary'>Acquista</button>");
        out.println("<a class='btn btn-secondary' href='vendita?operazione=carrello' role='button'>Carrello</a></center>");
        out.println("</div>");
        out.println("</div>");
        fineRisposta(out);
    }

    private void carrello(HttpServletRequest request, HttpServletResponse response)
            throws IOException {
        HttpSession sessione = request.getSession();
        Carrello c = getCarrello(sessione);
        PrintWriter out = response.getWriter();
        inizioRisposta(out, c);
        String msg = (String) sessione.getAttribute("msg");
        if (msg != null) {
            out.println("<div id='messaggio' class='alert alert-success' role='alert'>");
            out.println(msg);
            out.println("</div>");
            out.println("<script>");
            out.println("window.setTimeout(function() {");
            out.println(" $('#messaggio').fadeTo(500, 0).slideUp(500, function() { $(this).remove();});");
        out.println("}, 2000);");
        out.println("</script>");
        sessione.removeAttribute("msg");
    }
 out.println("<h1>Carrello della spesa</h1>");
 out.println("<table class='table'>");
 out.println("<thead class='thead-light'>");
 out.println("<tr>");
 out.println("<th scope='col'>N.</th>");
 out.println("<th scope='col'>Codice</th>");
 out.println("<th scope='col'>Descrizione</th>");
 out.println("<th scope='col'>Costo unitario</th>");
        out.println("<th scope='col'>Dimensione</th>");
        out.println("<th scope='col'>Colore</th>");
 out.println("<th scope='col'>Quantit&agrave;</th>");
 out.println("<th scope='col'>Costo totale</th>");
 out.println("<th>&nbsp;</th>");
 out.println("</tr>");
 out.println("</thead>");
 out.println("<tbody>");
    int riga = 1;
 for(Articolo a : c.getArticoli()) {
        out.println("<tr>");
        out.println(String.format("<td>%d</td>", riga));
        out.println(String.format("<td>%d</td>", a.getCodice()));
        out.println(String.format("<td style='text-align: left'>%s</td>", escapeHTML(a.getDescrizione())));
        out.println(String.format("<td>&euro; %.2f</td>", a.getCostoUnitario()));
     out.println(String.format("<td>%d</td>", a.getSize()));
     out.println(String.format("<td>%s</td>", a.getColore()));
        out.println(String.format("<td>%d</td>", a.getQuantita()));
        out.println(String.format("<td>&euro; %.2f</td>", a.getCostoTotale()));
        out.println("<td>");
        out.println("<form action='vendita' method='post'>");
        out.println(String.format("<input type='hidden' name='operazione' value='elimina'/>", riga));
                out.println(String.format("<input type='hidden' name='riga' value='%d'/>", riga));
        out.println("<button type='submit' class='btn btn-danger btn-sm'>Elimina</button>");
        out.println("</form>");
        out.println("</td>");
        out.println("</tr>");
        riga++;
    }
 out.println("</tbody>");
 out.println("<tfoot>");
 out.println("<tr>");
 out.println("<td colspan='5' class='text-right'>Totale:</td>");
 out.println(String.format("<td><strong>&euro; %.2f</strong></td>", c.totale()));
 out.println("<td>&nbsp;</td>");
 out.println("</tr>");
 out.println("</tfoot>");
 out.println("</table>");
 out.println("<div>");
 out.println("<a class='btn btn-primary' href='vendita?operazione=acquisto' role='button'>Nuovo acquisto</a>");
            out.println("<a class='btn btn-success' href='vendita?operazione=pagamento' role='button'>Paga e concludi</a>");
            out.println("</div>");
    fineRisposta(out);
}

    private void pagamento(HttpServletRequest request, HttpServletResponse response)
            throws IOException {
        HttpSession sessione = request.getSession();
        Carrello c = getCarrello(sessione);
        double pagato = c.totale();
        sessione.invalidate();
        response.setContentType("text/html; charset=UTF-8");
        PrintWriter out = response.getWriter();
        inizioRisposta(out, null);
        out.println("<h1>Pagamento eseguito</h1>");
        out.println("<div class='row pt-4 pb-4'>");
        out.println("<div class='col-sm-12 offset-md-2 col-md-8 text-center'>");
        out.println("<p>L'acquisto degli articoli presenti nel carrello è stato effettuato correttamente e il carrello è stato svuotato.");
        out.println(String.format("L'importo pagato è pari a <strong>&euro; %.2f</strong>.</p>", pagato));
        out.println("</div>");
        out.println("</div>");
        out.println("<a class='btn btn-primary' href='vendita?operazione=acquisto' role='button'>Nuovo acquisto</a>");
        fineRisposta(out);
    }

    public void init(ServletConfig config) throws ServletException {
        super.init(config);
        disponibili = new ArrayList<Acqua>();
        disponibili.add(new Acqua(1, "Scarpe Nike", 45.25));
        disponibili.add(new Acqua(2, "Scarpe Adidas", 93.82));
        disponibili.add(new Acqua(3, "Scarpe Discount", 31.40));
    }

    private void inizioRisposta(PrintWriter pw, Carrello c) {
        pw.println("<!doctype html>");
        pw.println("<html lang='it'>");
        pw.println("<head>");
        pw.println("<meta charset='utf-8'>");
        pw.println("<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>");
        pw.println(" <link\n" +
                "href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\"\n" +
                "rel=\"stylesheet\"\n" +
                "integrity=\"sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh\"\n" +
                "crossorigin=\"anonymous\">\n");
        // Per visualizzare i messaggi a scomparsa è richiesta la libreria JQuery
        pw.println("<script src='https://code.jquery.com/jquery-3.4.1.js' ");
        pw.println("integrity='sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=' crossorigin='anonymous'></script>");
        pw.println("<title>Vendita Scarpe</title>");
        pw.println("<style type='text/css'>");
        pw.println("body {padding-top: 0rem;}");
        pw.println("main {padding: 1rem 1.5rem; text-align: center;}");
        pw.println("</style>");
        pw.println("</head>");
        pw.println("<body>");
        pw.println("<nav style='height: 64px;' class='navbar navbar-expand-sm bg-light'>");
        if (c != null) {
            pw.println("Articoli: ");
            pw.println(String.format("<strong style='padding-left: 1em; font-size: larger'>%d (&euro; %.2f)</strong>",
            c.numeroArticoli(), c.totale()));
        }
        pw.println("</nav>");
        pw.println("<main role='main' class='container'>");
        pw.println("<h3>Vendita di scarpe on-line</h3>");
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
    private Carrello getCarrello(HttpSession sessione) {
        Carrello c = (Carrello) sessione.getAttribute("carrello");
        if (c == null) {
            c = new Carrello();
            sessione.setAttribute("carrello", c);
        }
        return c;
    }

    private void fineRisposta(PrintWriter pw) {
        pw.println("<div class='row'>");
        pw.println("<div class='col-sm-8 offset-sm-2 col-md-6 offset-md-3 text-center'>");
        pw.println("</div>");
        pw.println("</div>");
        pw.println("</main>");
        pw.println("</body>");
        pw.println("</html>");
    }

}