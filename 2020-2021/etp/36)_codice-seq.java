package com.company;

import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class Main {

    static String segreto = "ad61e5fa5ca45f1c8f9e40f702160bde";

    private static String hashMD5(String strCodice) throws NoSuchAlgorithmException {
        MessageDigest md = MessageDigest.getInstance("MD5");
        md.update(strCodice.getBytes());
        return String.format("%032x", new BigInteger(1, md.digest()));
    }

    public static void main(String[] args) throws NoSuchAlgorithmException {

        int password = (int) 1E6;
        long inizio = System.currentTimeMillis();
        do {
            password++;
        }while(!segreto.equals(hashMD5(Integer.toString(password))));
        long fine = System.currentTimeMillis();
        System.out.format("Password: %d\nSecondi: %.2f",password ,(fine - inizio) / 1000.0);
    }
}
