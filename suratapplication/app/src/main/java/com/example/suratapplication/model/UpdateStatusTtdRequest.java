package com.example.suratapplication.model;

import com.google.gson.annotations.SerializedName;

public class UpdateStatusTtdRequest {
    @SerializedName("status_ttd")
    private String statusTtd;

    @SerializedName("frontend")
    private boolean frontend;

    @SerializedName("id")
    private int id;

    public UpdateStatusTtdRequest(String statusTtd, boolean frontend, int id) {
        this.statusTtd = statusTtd;
        this.frontend = frontend;
        this.id = id;
    }

    public String getStatusTtd() {
        return statusTtd;
    }

    public boolean isFrontend() {
        return frontend;
    }
}
