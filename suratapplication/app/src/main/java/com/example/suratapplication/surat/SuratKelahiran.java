package com.example.suratapplication.surat;

import static android.content.ContentValues.TAG;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.NetworkResponse;
import com.android.volley.ParseError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.HttpHeaderParser;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.example.suratapplication.R;
import com.example.suratapplication.SuratFragment;
import com.example.suratapplication.helper.Constants;
import com.example.suratapplication.model.UserData;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.UnsupportedEncodingException;
import java.util.HashMap;
import java.util.Map;

public class SuratKelahiran extends AppCompatActivity {
    private String name;
    private int anakKe;
    private EditText nikField;
    private EditText namaField;
    private EditText alamatField;
    private EditText anakKeField;
    private EditText penolongKelahiranField;
    private EditText kelahiranKeField;
    private EditText dilahirkanDiField;
    private Button kirimButton;
    private RequestQueue requestQueue;

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

        setupKirimButton();
    }

    public static SuratKelahiran newInstance(UserData userData) {
        SuratKelahiran suratKelahiran = new SuratKelahiran();
        Intent intent = new Intent(suratKelahiran, SuratKelahiran.class);
        intent.putExtra("name", userData.getName());
        intent.putExtra("role", userData.getRole());
        intent.putExtra("email", userData.getEmail());
        intent.putExtra("token", userData.getToken());
        return suratKelahiran;
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

        String email = getIntent().getStringExtra("email");
        String token = getIntent().getStringExtra("token");

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
            jsonPayload.put("alamat", alamat);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, Constants.SEND_SURAT_KELAHIRAN, jsonPayload,
                response -> {
                    try {
                        boolean status = response.getBoolean("status");
                        String message = response.getString("message");
                        Log.e(TAG, "Kirim Error: " + status);
                        if (status) {
                            Toast.makeText(SuratKelahiran.this, message, Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent(SuratKelahiran.this, SuratFragment.class);
                            startActivity(intent);
                            finish();
                        } else {
                            Toast.makeText(SuratKelahiran.this, message, Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                        Toast.makeText(SuratKelahiran.this, "Invalid response from the server.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> {
                    Log.e(TAG, "Kirim Error: " + error.getMessage());
                    Toast.makeText(SuratKelahiran.this, "Kirim failed.", Toast.LENGTH_SHORT).show();
                }) {
            @Override
            public Map<String, String> getHeaders() {
                Map<String, String> headers = new HashMap<>();
                headers.put("Authorization", "Bearer " + token);
                return headers;
            }

            @Override
            protected Response<JSONObject> parseNetworkResponse(NetworkResponse response) {
                try {
                    String jsonString = new String(response.data, HttpHeaderParser.parseCharset(response.headers));
                    return Response.success(new JSONObject(jsonString), HttpHeaderParser.parseCacheHeaders(response));
                } catch (UnsupportedEncodingException | JSONException e) {
                    return Response.error(new ParseError(e));
                }
            }
        };

        requestQueue.add(request);
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public int getAnakKe() {
        return anakKe;
    }

    public void setAnakKe(int anakKe) {
        this.anakKe = anakKe;
    }
}
