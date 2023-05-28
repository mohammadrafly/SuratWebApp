package com.example.suratapplication.riwayat;

import android.os.Bundle;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.suratapplication.R;
import com.example.suratapplication.helper.Constants;
import com.example.suratapplication.surat.SuratKelahiran;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class RiwayatKelahiran extends AppCompatActivity {
    private LinearLayout suratContainer;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.riwayat_kelahiran);

        View backButton = findViewById(R.id.backButton);
        backButton.setOnClickListener(v -> finish());

        suratContainer = findViewById(R.id.suratContainer);

        // Fetch surat kelahiran data
        String email = getIntent().getStringExtra("email");
        fetchSuratKelahiran(email);
    }

    private void fetchSuratKelahiran(String email) {// Replace with your actual API endpoint URL

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, Constants.GET_SURAT_KELAHIRAN+email, null,
                response -> {
                    try {
                        List<SuratKelahiran> suratKelahiranList = new ArrayList<>();

                        for (int i = 0; i < response.length(); i++) {
                            JSONObject suratKelahiranObj = response.getJSONObject(i);
                            // Extract data from the suratKelahiranObj and create SuratKelahiran object
                            SuratKelahiran suratKelahiran = new SuratKelahiran();
                            suratKelahiran.setName(suratKelahiranObj.getString("nama_lengkap"));
                            suratKelahiran.setAnakKe(suratKelahiranObj.getInt("anak_ke"));
                            // Set other surat data fields accordingly

                            suratKelahiranList.add(suratKelahiran);
                        }

                        if (!suratKelahiranList.isEmpty()) {
                            displaySuratKelahiran(suratKelahiranList);
                        } else {
                            showNoDataText();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                        showNoDataText();
                    }
                },
                error -> {
                    error.printStackTrace();
                    showNoDataText();
                });

        requestQueue.add(request);
    }

    private void displaySuratKelahiran(List<SuratKelahiran> suratKelahiranList) {
        suratContainer.removeAllViews();

        for (SuratKelahiran suratKelahiran : suratKelahiranList) {
            View suratView = getLayoutInflater().inflate(R.layout.item_surat_kelahiran, suratContainer, false);

            // Set data to the views in the suratView
            TextView nameLabel = suratView.findViewById(R.id.nameLabel);
            TextView anakKeLabel = suratView.findViewById(R.id.anakKeLabel);
            // Set the corresponding data from suratKelahiran object
            nameLabel.setText(suratKelahiran.getName());
            anakKeLabel.setText(String.valueOf(suratKelahiran.getAnakKe()));

            // Add the suratView to the suratContainer
            suratContainer.addView(suratView);
        }
    }

    private void showNoDataText() {
        suratContainer.removeAllViews();
    }
}
