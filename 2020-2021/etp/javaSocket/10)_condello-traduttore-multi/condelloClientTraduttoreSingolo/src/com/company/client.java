/*
 * Autore: Condello Alessandro
 * Nome progetto:condello-traduttore-singolo
 * Nome file: client.java
 * Descrizione: Creare un client che permetta di comunicare con un server che li traduce le frasi
 * Portato e Modificato dall'esercizio n^3.1 "Server MultiThread"
 */
package com.company;

import java.io.*;
import java.lang.reflect.Array;
import java.net.*;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Scanner;
import java.util.regex.Pattern;

public class client {
    // Server tcp
    final static String nomeServerTcp = "localhost";
    // Utilizzo un indirizzo multicast locale
    final static String nomeServerUdp = "239.255.2.9";
    // Porta tcp
    final static int portaServerTcp = 91;
    // Porta utp
    final static int portaServerUdp = 92;
    // Formato
    static final Charset format = StandardCharsets.UTF_8;
    // Iso list
    static ArrayList<String> isoList = new ArrayList<>();
    // Iso list + traduzione
    static HashMap<String, String> isoListForm = new HashMap<>();
    // Lista possibilità
    static ArrayList<String> scelteNumeri = new ArrayList<>();

    public static void main(String[] args) {
        System.out.println("Creazione della nostra lista delle lingue");
        // Creiamola
        creaIso();
        // Crea la nostra mappa
        createFormatted();
        // Inizia connessione tcp
        serverTcp();
    }

    public static void creaIso() {
        // Prova a leggere dal file
        try (Scanner s = new Scanner(new FileReader("dataset.txt"))) {
            System.out.println("Lettura da file");
            // Se esiste, leggi
            while(s.hasNext()) {
                String p = s.nextLine();
                isoList.add(p);
            }
        // Senò, leggi dall'udp
        } catch (FileNotFoundException e) {
            serverUdp();
            try {
                // Scriviamo su un file
                BufferedWriter bw = new BufferedWriter(new FileWriter("dataset.txt"));
                for(String parte : isoList) {
                    bw.write(parte);
                }
                bw.close();
            } catch (IOException ioException) {
                ioException.printStackTrace();
            }
        }
        System.out.println("Lettura finita");
    }

    public static void serverUdp() {
        // Avvio il server udp
        try (MulticastSocket sck = new MulticastSocket(portaServerUdp)) {
            // Dico che sto da udp
            System.out.println("Lettura dal server udp");
            // Connettiamoci
            InetAddress ipMulticast = InetAddress.getByName(nomeServerUdp);
            sck.joinGroup(ipMulticast);
            // Iniziamo a ciclare
            try {
                do {
                    // Siccome udp invia datagrammi, leggiamo con byte
                    byte[] bufferIn = new byte[1024];
                    DatagramPacket pktIn = new DatagramPacket(bufferIn, bufferIn.length);
                    // Riceviamo il datagramma
                    sck.receive(pktIn);
                    // Lo trasformiamo
                    String af = new String(pktIn.getData(), 0, pktIn.getLength(), format);
                    // Controlliamo se esiste
                    if (!isoList.contains(af)) {
                        // Se nò, aggiungi
                        isoList.add(af);
                    }else
                    // Senò, forse abbiamo raggiunto la fine
                    if (isoList.size() == 184) {
                        break;
                    }
                }while (true);
            // Usciamo
            } finally {
                sck.leaveGroup(ipMulticast);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public static void createFormatted() {
        // Creiamo array
        String[] temp;
        // Iteriamo
        for(String parte : isoList) {
            // Splittiamo per =
            temp = parte.toLowerCase().split("=");
            // Se contiene ,
            if (temp[1].contains(",")) {
                // Allora vuol dire che ci sono più paesi
                for(String paese : temp[1].split(","))
                    // Aggiungi per ognuno
                    isoListForm.put(paese.strip(), temp[0].strip());
            // Aggiungi
            }else isoListForm.put(temp[1].strip(), temp[0].strip());
        }
    }

    public static void serverTcp() {
        // Iniziamo la connessione
        System.out.println("Connessione al server in corso...");
        try (Socket sck = new Socket(nomeServerTcp, portaServerTcp)) {
            comunica(sck);
        } catch (UnknownHostException e) {
            System.err.format("Nome di server non valido: %s%n", e.getMessage());
        } catch (IOException e) {
            System.err.format("Errore durante la comunicazione con il server: %s%n",
                    e.getMessage());
        }
    }

    private static void comunica(Socket sck) {
        try (
                BufferedReader in = new BufferedReader(
                        new InputStreamReader(sck.getInputStream(), format));
                PrintWriter out = new PrintWriter(
                        new OutputStreamWriter(sck.getOutputStream(), format), true);
                Scanner s = new Scanner(System.in, format);
        ) {
            boolean uscita = true;
            do {
                boolean loopRichiesta = true;
                String daInviare;
                do {
                    // Richiedo la frase da inviare
                    System.out.print("(premere x per uscire) Frase da tradurre:");
                    daInviare = s.nextLine().trim();
                    // Non permettiamo di digitare /
                    if (daInviare.contains("/")) {
                        System.out.println("La frase non puo contenere il carattere /");
                    // Uscita
                    }else loopRichiesta = false;
                // Uscita
                }while (loopRichiesta);
                // Caso normale
                if (!"x".equals(daInviare)) {
                    boolean posssibilita;
                    // Richiedo il linguaggio con cui lo sta inviando
                    String inizio;
                    boolean esci = true;
                    do {
                        posssibilita = true;
                        // Richiesta in input
                        System.out.print("(0 per uscire) Lingua della frase (inserire la lingua oppure 1 vocale): ");
                        inizio = s.nextLine().trim().toLowerCase();
                        // Se dobbiamo uscire
                        if (inizio.equals("0")) esci = false;
                        // Controlliamo se esiste
                        else if (inizio.length() == 1 || isNumeric(inizio)) {
                            if (scelteNumeri.size() != 0 && isNumeric(inizio) && Integer.parseInt(inizio)  <= scelteNumeri.size() ) {
                               inizio = scelteNumeri.get(Integer.parseInt(inizio) - 1);
                            }else if(!isNumeric(inizio)) {
                                getPossibilita(inizio);
                                posssibilita = false;
                            }
                        }

                        if(isoListForm.get(inizio) != null)
                            esci = false;
                        else if (posssibilita)
                        // Senò scrivi
                            System.out.println("La lingua deve esistere.");
                    // Uscita
                    }while (esci);
                    System.out.println(inizio + " Scelta come lingua iniziale");

                    String fine = "";
                    ArrayList<String> fineArray = new ArrayList<>();
                    // Se prima non siamo usciti con x
                    esci = true;
                    do {
                        posssibilita = true;
                        // Richiesta
                        System.out.print("(0 per uscire) Lingua da ricevere (inserire la lingua oppure 1 vocale): ");
                        fine = s.nextLine().trim().toLowerCase();
                        // Se dobbiamo uscire
                        if (fine.equals("0")) esci = false;
                        // Se esiste e non è uguale ad inizio
                        else {

                            if (fine.length() == 1 || isNumeric(fine)) {
                                if (scelteNumeri.size() != 0 && isNumeric(fine) &&  Integer.parseInt(fine) <= scelteNumeri.size() ) {
                                    fine = scelteNumeri.get(Integer.parseInt(fine) - 1);
                                }else if(!isNumeric(fine)) {
                                    getPossibilita(fine);
                                    posssibilita = false;
                                }
                            }

                            if(posssibilita) {
                                if (inizio.equals(fine)) {
                                    System.out.println("La lingua non deve essere quella iniziale");
                                } else if (fineArray.contains(fine)) {
                                    System.out.println("La lingua non deve essere gia stata scelta");
                                } else if (isoListForm.get(fine) == null) {
                                    System.out.println("La lingua scelta deve esistere");
                                } else {

                                    fineArray.add(fine);
                                    if (fineArray.size() == 5) {
                                        System.out.println("Limite raggiunto, uscita in corso");
                                        esci = false;
                                    }
                                    System.out.println("Lingua " + fine + " aggiunta per la traduzione");
                                }
                            }
                        }
                    // Uscita
                    }while (esci);

                    // Se non siamo mai usciti
                    // Inviare
                    for(String parteFinale : fineArray)
                        out.println(String.format("%s/%s/%s",
                                    isoListForm.get(inizio), daInviare,
                                    isoListForm.get(parteFinale)));
                    System.out.println("In attesa di una risposta..");
                    for(int i1 = 1; i1 < fineArray.size() + 1; i1++) {
                        // Leggiamo input
                        String output = in.readLine();
                        System.out.format("Traduzione %d %s -> %s: ", i1, inizio, fineArray.get(i1-1));
                        switch (output) {
                            // Lingua non trovata
                            case "0":
                                System.out.println("Lingua non trovata");
                                break;
                            // Traduzione ancora non applicata
                            case "1":
                                System.out.println("La traduzione di questa lingua non è ancora stata implementata");
                                break;
                            // Parola non trovata
                            case "2":
                                System.out.println("Non è stato possibile trovare la parola");
                                break;
                            // Trovato
                            default:
                                System.out.printf("%s -> %s%n", daInviare, output);
                                break;
                        }
                    }


                }else break;
            // Uscita
            }while (uscita);
            out.println("x");

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private static Pattern pattern = Pattern.compile("-?\\d+(\\.\\d+)?");

    public static boolean isNumeric(String strNum) {
        if (strNum == null) {
            return false;
        }
        return pattern.matcher(strNum).matches();
    }

    public static void getPossibilita(String frase) {
        System.out.println("Possibilità: ");
        int i = 0;
        scelteNumeri.clear();
        for(String lingua : isoListForm.keySet()) {
            if (lingua.substring(0, 1).equals(frase.substring(0, 1))) {
                System.out.println(++i + ") " + lingua);
                scelteNumeri.add(lingua);
            }
        }
    }
}
