package com.example.suratapplication.helper;

public class Constants {
    public static final String API_URL = "http://192.168.18.11/backend-api/";
    public static final String PREFIX = "api/V1/";
    public static final String SIGN_IN_URL = API_URL + PREFIX + "sign-in";
    public static final String SIGN_UP_URL = API_URL + PREFIX + "sign-up";
    public static final String FORGOT_PASSWORD = API_URL + PREFIX + "reset-password-request";
    public static final String SEND_SURAT_KELAHIRAN = API_URL + PREFIX + "kelahiran/mobile/insert";
    public static final String GET_SURAT_KELAHIRAN = API_URL + PREFIX + "kelahiran/mobile/email/";
}
