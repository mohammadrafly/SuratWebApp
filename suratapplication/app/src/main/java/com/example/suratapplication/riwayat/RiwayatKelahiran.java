package com.example.suratapplication.riwayat;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.suratapplication.R;
import com.example.suratapplication.model.KelahiranData;
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

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.riwayat_kelahiran);

        recyclerView = findViewById(R.id.recyclerView);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        adapter = new SuratKelahiranAdapter();
        recyclerView.setAdapter(adapter);

        adapter.setDetailsButtonClickListener(new SuratKelahiranAdapter.DetailsButtonClickListener() {
            @Override
            public void onDetailsButtonClick(int position) {
                if (kelahiranDataList != null && position < kelahiranDataList.size()) {
                    // Retrieve the data item at the clicked position
                    KelahiranData data = kelahiranDataList.get(position);

                    // Show the details popup or perform any desired action
                    showDetailsPopup(data);
                }
            }
        });

        findViewById(R.id.backButton).setOnClickListener(v -> finish());

        SharedPreferences preferences = getSharedPreferences("UserData", Context.MODE_PRIVATE);
        String email = preferences.getString("email", null);

        if (email != null && !email.isEmpty()) {
            fetchKelahiranData(email);
        } else {
            // Show an error message or take appropriate action
            Toast.makeText(this, "Invalid email", Toast.LENGTH_SHORT).show();
            finish(); // Finish the activity or perform any other necessary action
        }
    }

    private void fetchKelahiranData(String email) {
        ApiService apiService = ApiClient.getClient().create(ApiService.class);
        Call<List<KelahiranData>> call = apiService.getSuratByEmail(email);

        // Get the URL from the Call object
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
                    // Log the error with URL
                    Log.e("RiwayatKelahiran", "Failed to fetch kelahiran data. URL: " + url + " Response code: " + response.code());
                }
            }

            @Override
            public void onFailure(Call<List<KelahiranData>> call, Throwable t) {
                // Log the failure with URL
                Log.e("RiwayatKelahiran", "Failed to fetch kelahiran data. URL: " + url + " Error: " + t.getMessage(), t);
            }
        });
    }

    private void showDetailsPopup(KelahiranData data) {
        // Create the bottom sheet dialog
        BottomSheetDialog dialog = new BottomSheetDialog(this);
        dialog.setContentView(R.layout.details_popup);

        // Initialize views
        TextView namaTextView = dialog.findViewById(R.id.namaTextView);
        TextView statusTtdTextView = dialog.findViewById(R.id.statusTtdTextView);
        TextView disposisiTextView = dialog.findViewById(R.id.disposisiTextView);
        TextView catatanTextView = dialog.findViewById(R.id.catatanTextView);
        TextView tanggalTextView = dialog.findViewById(R.id.tanggalTextView);

        // Set the data to the views
        namaTextView.setText(data.getNamaLengkap());
        statusTtdTextView.setText(String.valueOf(data.getStatusTtd()));
        disposisiTextView.setText(data.getDisposisiSurat());
        catatanTextView.setText(data.getCatatan());

        // Parse the original date string into a Date object
        SimpleDateFormat originalDateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.getDefault());
        Date originalDate = null;
        try {
            originalDate = originalDateFormat.parse(data.getTanggal());
        } catch (Exception e) {
            e.printStackTrace();
        }

        // Format the date into the desired format
        SimpleDateFormat desiredDateFormat = new SimpleDateFormat("EEEE d MMMM yyyy", new Locale("id", "ID"));
        String formattedDate = desiredDateFormat.format(originalDate);

        // Set the formatted date to the tanggalTextView
        tanggalTextView.setText(formattedDate);

        // Show the bottom sheet dialog
        dialog.show();
    }
}
