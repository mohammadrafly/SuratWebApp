package com.example.suratapplication.surat;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.example.suratapplication.R;
import com.example.suratapplication.helper.Constants;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class SuratKelahiran extends AppCompatActivity {
    private EditText nikField;
    private EditText namaField;
    private EditText alamatField;
    private EditText anakKeField;
    private EditText penolongKelahiranField;
    private EditText kelahiranKeField;
    private EditText dilahirkanDiField;
    private Button kirimButton;

    private RequestQueue requestQueue;
    private SharedPreferences sharedPreferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.surat_kelahiran);

        View backButton = findViewById(R.id.backButton);
        backButton.setOnClickListener(v -> finish());

        nikField = findViewById(R.id.nik);
        namaField = findViewById(R.id.namaLengkap);
        anakKeField = findViewById(R.id.anakKe);
        penolongKelahiranField = findViewById(R.id.pengolongKelahiran);
        dilahirkanDiField = findViewById(R.id.dilahirkanDi);
        kelahiranKeField = findViewById(R.id.kelahiranKe);
        alamatField = findViewById(R.id.alamatAnak);
        kirimButton = findViewById(R.id.Kirim);

        requestQueue = Volley.newRequestQueue(this);
        sharedPreferences = getSharedPreferences("UserData", MODE_PRIVATE);

        setupKirimButton();
    }

    private void setupKirimButton() {
        kirimButton.setOnClickListener(view -> sendJsonPayload());
    }

    private void sendJsonPayload() {
        Spinner jenisKelaminSpinner = findViewById(R.id.jenisKelamin);
        String jenisKelamin = jenisKelaminSpinner.getSelectedItem().toString();
        String name = namaField.getText().toString();
        String nik = nikField.getText().toString();
        String anakKe = anakKeField.getText().toString();
        String kelahiranKe = kelahiranKeField.getText().toString();
        String penolongKelahiran = penolongKelahiranField.getText().toString();
        String alamat = alamatField.getText().toString();
        String dilahirkanDi = dilahirkanDiField.getText().toString();

        String email = sharedPreferences.getString("email", "");
        String token = sharedPreferences.getString("token", "");

        JSONObject jsonPayload = new JSONObject();
        try {
            jsonPayload.put("jenis_kelamin", jenisKelamin);
            jsonPayload.put("author", email);
            jsonPayload.put("nama_lengkap", name);
            jsonPayload.put("nik", nik);
            jsonPayload.put("anak_ke", anakKe);
            jsonPayload.put("dilahirkan_di", dilahirkanDi);
            jsonPayload.put("kelahiran_ke", kelahiranKe);
            jsonPayload.put("penolong_kelahiran", penolongKelahiran);
            jsonPayload.put("alamat_anak", alamat);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        String url = Constants.SEND_SURAT_KELAHIRAN;
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, url, jsonPayload,
                response -> {
                    Toast.makeText(SuratKelahiran.this, "Surat kelahiran berhasil dikirim", Toast.LENGTH_SHORT).show();
                    finish();
                },
                error -> Toast.makeText(SuratKelahiran.this, "Gagal mengirim surat kelahiran", Toast.LENGTH_SHORT).show()) {
            @Override
            public Map<String, String> getHeaders() {
                Map<String, String> headers = new HashMap<>();
                headers.put("Authorization", "Bearer " + token);
                headers.put("Content-Type", "application/json");
                return headers;
            }
        };

        requestQueue.add(request);
    }
}
