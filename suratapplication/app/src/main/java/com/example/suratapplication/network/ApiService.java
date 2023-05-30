package com.example.suratapplication.network;

import com.example.suratapplication.model.KelahiranData;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Path;

public interface ApiService {
    @GET("api/V1/kelahiran/mobile/email/{email}")
    Call<List<KelahiranData>> getSuratByEmail(@Path("email") String email);
}
