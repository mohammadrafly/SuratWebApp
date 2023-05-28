package com.example.suratapplication;

import static android.content.ContentValues.TAG;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class SignUpActivity extends AppCompatActivity {
    private EditText nikField;
    private EditText namaField;
    private EditText emailField;
    private EditText nomorHpField;
    private EditText alamatField;
    private Button signUpButton;
    private RequestQueue requestQueue;

    private static final String API_URL = "http://192.168.18.11/backend/api/V1/sign-up";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.register_screen);

        View backButton = findViewById(R.id.backButton);
        backButton.setOnClickListener(v -> finish());

        nikField = findViewById(R.id.nik);
        namaField = findViewById(R.id.name);
        emailField = findViewById(R.id.email);
        nomorHpField = findViewById(R.id.nomorhp);
        alamatField = findViewById(R.id.alamat);
        signUpButton = findViewById(R.id.register);

        requestQueue = Volley.newRequestQueue(this);

        setupSignUpButton();
    }

    private void setupSignUpButton() {
        signUpButton.setOnClickListener(view -> sendJsonPayload());
    }

    private void sendJsonPayload() {
        String email = emailField.getText().toString();
        String name = namaField.getText().toString();
        String nik = nikField.getText().toString();
        String nomor = nomorHpField.getText().toString();
        String alamat = alamatField.getText().toString();

        JSONObject jsonPayload = new JSONObject();
        try {
            jsonPayload.put("email", email);
            jsonPayload.put("name", name);
            jsonPayload.put("nik", nik);
            jsonPayload.put("nomor_hp", nomor);
            jsonPayload.put("alamat", alamat);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, API_URL, jsonPayload,
                response -> {
                    try {
                        boolean status = response.getBoolean("status");
                        String message = response.getString("message");
                        if (status) {
                            Toast.makeText(SignUpActivity.this, message, Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent(SignUpActivity.this, SignInActivity.class);
                            startActivity(intent);
                            finish();
                        } else {
                            Toast.makeText(SignUpActivity.this, message, Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                },
                error -> {
                    Log.e(TAG, "Register Error: " + error.getMessage());
                    Toast.makeText(SignUpActivity.this, "Register failed.", Toast.LENGTH_SHORT).show();
                });

        requestQueue.add(request);
    }
}
