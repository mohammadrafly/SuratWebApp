package com.example.suratapplication.riwayat;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.suratapplication.R;
import com.example.suratapplication.model.KelahiranData;
import com.example.suratapplication.model.ResponseAPI;
import com.example.suratapplication.model.UpdateStatusTtdRequest;
import com.example.suratapplication.network.ApiClient;
import com.example.suratapplication.network.ApiService;
import com.google.android.material.bottomsheet.BottomSheetDialog;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class RiwayatKelahiran extends AppCompatActivity {
    private RecyclerView recyclerView;
    private SuratKelahiranAdapter adapter;
    private List<KelahiranData> kelahiranDataList;
    private ApiService apiService;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.riwayat_kelahiran);

        SharedPreferences preferences = getSharedPreferences("UserData", Context.MODE_PRIVATE);

        recyclerView = findViewById(R.id.recyclerView);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        Context context = null;
        adapter = new SuratKelahiranAdapter(context, preferences);
        recyclerView.setAdapter(adapter);

        adapter.setDetailsButtonClickListener(position -> {
            if (kelahiranDataList != null && position < kelahiranDataList.size()) {
                KelahiranData data = kelahiranDataList.get(position);

                showDetailsPopup(data);
            }
        });

        findViewById(R.id.backButton).setOnClickListener(v -> finish());

        apiService = ApiClient.getClient().create(ApiService.class);

        String email = preferences.getString("email", null);
        String role = preferences.getString("role", null);

        if (role.equals("kepala_desa")) {
            fetchKelahiranData(null);
        } else {
            if (email != null && !email.isEmpty()) {
                fetchKelahiranData(email);
            } else {
                Toast.makeText(this, "Invalid email", Toast.LENGTH_SHORT).show();
                finish();
            }
        }
    }

    private void fetchKelahiranData(String email) {
        Call<List<KelahiranData>> call;

        if (email == null) {
            call = apiService.getSuratAll();
        } else {
            call = apiService.getSuratByEmail(email);
        }

        String url = call.request().url().toString();

        call.enqueue(new Callback<List<KelahiranData>>() {
            @Override
            public void onResponse(Call<List<KelahiranData>> call, Response<List<KelahiranData>> response) {
                if (response.isSuccessful()) {
                    kelahiranDataList = response.body();
                    if (kelahiranDataList != null && !kelahiranDataList.isEmpty()) {
                        adapter.setKelahiranDataList(kelahiranDataList);
                    }
                } else {
                    Log.e("RiwayatKelahiran", "Failed to fetch kelahiran data. URL: " + url + " Response code: " + response.code());
                }
            }

            @Override
            public void onFailure(Call<List<KelahiranData>> call, Throwable t) {
                Log.e("RiwayatKelahiran", "Failed to fetch kelahiran data. URL: " + url + " Error: " + t.getMessage(), t);
            }
        });
    }

    private void showDetailsPopup(KelahiranData data) {
        BottomSheetDialog dialog = new BottomSheetDialog(this);
        dialog.setContentView(R.layout.details_popup);

        TextView namaTextView = dialog.findViewById(R.id.namaTextView);
        TextView statusTtdTextView = dialog.findViewById(R.id.statusTtdTextView);
        TextView disposisiTextView = dialog.findViewById(R.id.disposisiTextView);
        TextView catatanTextView = dialog.findViewById(R.id.catatanTextView);
        TextView tanggalTextView = dialog.findViewById(R.id.tanggalTextView);

        namaTextView.setText(data.getNamaLengkap());
        statusTtdTextView.setText(String.valueOf(data.getStatusTtd()));
        disposisiTextView.setText(data.getDisposisiSurat());
        catatanTextView.setText(data.getCatatan());

        SimpleDateFormat originalDateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.getDefault());
        Date originalDate = null;
        try {
            originalDate = originalDateFormat.parse(data.getTanggal());
        } catch (Exception e) {
            e.printStackTrace();
        }

        SimpleDateFormat desiredDateFormat = new SimpleDateFormat("EEEE d MMMM yyyy", new Locale("id", "ID"));
        String formattedDate = desiredDateFormat.format(originalDate);

        tanggalTextView.setText(formattedDate);

        Button updateButton = dialog.findViewById(R.id.updateButton);
        updateButton.setOnClickListener(v -> {
            int id = data.getId();
            updateStatusTtd(id);
        });
        dialog.show();
    }

    private void updateStatusTtd(int id) {
        ApiService apiService = ApiClient.getClient().create(ApiService.class);
        UpdateStatusTtdRequest requestBody = new UpdateStatusTtdRequest("yes", true, id);

        Log.d("API Request", "URL: " + apiService.updateStatusTtd("application/json", requestBody).request().url());
        Call<ResponseAPI> call = apiService.updateStatusTtd(
                "application/json",
                requestBody
        );

        call.enqueue(new Callback<ResponseAPI>() {
            @Override
            public void onResponse(Call<ResponseAPI> call, Response<ResponseAPI> response) {
                if (response.isSuccessful()) {
                    // Handle the successful response
                    ResponseAPI result = response.body();
                    if (result.getStatus()){
                        // Update the UI or handle the response as needed
                        Toast.makeText(RiwayatKelahiran.this, "Status TTD updated successfully", Toast.LENGTH_SHORT).show();
                    } else {
                        Toast.makeText(RiwayatKelahiran.this, "Status TTD updated failed", Toast.LENGTH_SHORT).show();
                    }
                } else {
                    // Handle the unsuccessful response
                    Log.e("API Error", "Request failed with code: " + response.code());
                    Toast.makeText(RiwayatKelahiran.this, "Failed to update status TTD", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<ResponseAPI> call, Throwable t) {
                // Handle the API call failure
                Log.e("API Failure", "Request failed with exception: " + t.getMessage(), t);
                Toast.makeText(RiwayatKelahiran.this, "Failed to update status TTD", Toast.LENGTH_SHORT).show();
            }
        });
    }
}
