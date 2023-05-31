package com.example.suratapplication.model;

public class ResponseAPI {
    private boolean status;
    private String message;


    public boolean getStatus() {
        return status;
    }

    public void setStatusCode(boolean status) {
        this.status = status;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }
}