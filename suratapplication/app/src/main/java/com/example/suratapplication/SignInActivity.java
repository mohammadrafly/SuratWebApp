package com.example.suratapplication;

import static android.content.ContentValues.TAG;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.example.suratapplication.helper.Constants;

import org.json.JSONException;
import org.json.JSONObject;

public class SignInActivity extends AppCompatActivity {

    private EditText emailField;
    private EditText passwordField;
    private Button signInButton;
    private RequestQueue requestQueue;
    private ProgressBar progressBar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login_screen);

        View register = findViewById(R.id.daftar);
        register.setOnClickListener(v -> {
            Intent intent = new Intent(SignInActivity.this, SignUpActivity.class);
            startActivity(intent);
        });
        
        emailField = findViewById(R.id.nikInput);
        passwordField = findViewById(R.id.passwordInput);
        signInButton = findViewById(R.id.masuk);
        progressBar = findViewById(R.id.progressBar);

        requestQueue = Volley.newRequestQueue(this);

        setupSignInButton();

        View lupakatasandi = findViewById(R.id.lupakatasandi);
        lupakatasandi.setOnClickListener(v -> {
            Intent intent = new Intent(SignInActivity.this, LupaPasswordActivity.class);
            startActivity(intent);
        });
    }

    private void setupSignInButton() {
        signInButton.setOnClickListener(view -> {
            String nik = emailField.getText().toString().trim();
            String password = passwordField.getText().toString().trim();

            if (nik.isEmpty() || password.isEmpty()) {
                Toast.makeText(this, "NIK and password cannot be empty.", Toast.LENGTH_SHORT).show();
            } else {
                showProgressBar();

                sendJsonPayload();
            }
        });
    }

    private void showProgressBar() {
        progressBar.setVisibility(View.VISIBLE);
    }

    private void hideProgressBar() {
        progressBar.setVisibility(View.GONE);
    }

    private void sendJsonPayload() {
        String email = emailField.getText().toString();
        String password = passwordField.getText().toString();
        boolean frontend = true;

        JSONObject jsonPayload = new JSONObject();
        try {
            jsonPayload.put("email", email);
            jsonPayload.put("password", password);
            jsonPayload.put("frontend", frontend);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, Constants.SIGN_IN_URL, jsonPayload,
                response -> {
                    try {
                        boolean status = response.getBoolean("status");
                        String message = response.getString("message");
                        if (status) {
                            JSONObject dataUser = response.getJSONObject("dataUser");
                            String storeName = dataUser.getString("name");
                            String storeRole = dataUser.getString("role");
                            String storeEmail = dataUser.getString("email");
                            String token = response.optString("token");

                            saveUserData(storeName, storeRole, storeEmail, token);

                            Toast.makeText(SignInActivity.this, message, Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent(SignInActivity.this, MainActivity.class);
                            startActivity(intent);
                            finish();
                        } else {
                            Toast.makeText(SignInActivity.this, message, Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                    hideProgressBar();
                },
                error -> {
                    Log.e(TAG, "Login Error: " + error.getMessage());
                    Toast.makeText(SignInActivity.this, "Login failed.", Toast.LENGTH_SHORT).show();
                    hideProgressBar();
                });
        requestQueue.add(request);
    }

    private void saveUserData(String name, String role, String email, String token) {
        SharedPreferences sharedPreferences = getSharedPreferences("UserData", Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putString("name", name);
        editor.putString("role", role);
        editor.putString("email", email);
        editor.putString("token", token);
        editor.apply();
    }
}
