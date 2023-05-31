package com.example.suratapplication.network;

import com.example.suratapplication.model.KelahiranData;
import com.example.suratapplication.model.ResponseAPI;
import com.example.suratapplication.model.UpdateStatusTtdRequest;

import java.util.List;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.GET;
import retrofit2.http.Header;
import retrofit2.http.PUT;
import retrofit2.http.Path;
import retrofit2.http.Streaming;

public interface ApiService {
    @GET("api/V1/kelahiran/mobile/email/{email}")
    Call<List<KelahiranData>> getSuratByEmail(@Path("email") String email);

    @GET("api/V1/kelahiran/mobile/all")
    Call<List<KelahiranData>> getSuratAll();

    @PUT("api/V1/kelahiran/mobile/update")
    Call<ResponseAPI> updateStatusTtd(
            @Header("Content-Type") String contentType,
            @Body UpdateStatusTtdRequest requestBody
    );

    @GET("api/V1/kelahiran/mobile/download/{surat}")
    @Streaming
    Call<ResponseBody> downloadPDF(@Path("surat") String fileName);

}