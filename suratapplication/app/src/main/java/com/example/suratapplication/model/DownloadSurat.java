package com.example.suratapplication.model;

import com.google.gson.annotations.SerializedName;

public class DownloadSurat {
    @SerializedName("surat")
    private String surat;

    public DownloadSurat(String surat) {
        this.surat = surat;
    }

    public String getSurat() {
        return surat;
    }
}
