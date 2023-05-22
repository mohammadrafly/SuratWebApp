package com.example.suratapplication;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.InputFilter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        SharedPreferences sharedPreferences = getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
        String token = sharedPreferences.getString("token", "");
        if (token.isEmpty()) {
            setContentView(R.layout.activity_main);

            TextView tvRegister = findViewById(R.id.tv_register);
            tvRegister.setOnClickListener(v -> {
                Intent intent = new Intent(MainActivity.this, RegisterActivity.class);
                startActivity(intent);
            });

            Button btnLogin = findViewById(R.id.btn_login);
            btnLogin.setOnClickListener(v -> performLogin());
        }
        setContentView(R.layout.activity_dashboard);
    }

    private void performLogin() {
        String loginUrl = "https://pupakindonesia.xyz/api/V1/sign-in";

        EditText nikEditText = findViewById(R.id.nik);
        int maxLength = 16;

        InputFilter[] filters = new InputFilter[1];
        filters[0] = new InputFilter.LengthFilter(maxLength);
        nikEditText.setFilters(filters);

        EditText kataSandiEditText = findViewById(R.id.kata_sandi);

        String nik = nikEditText.getText().toString().trim();
        String password = kataSandiEditText.getText().toString().trim();

        if (nik.isEmpty()) {
            nikEditText.setError("Please enter your NIK");
            nikEditText.requestFocus();
            return;
        }

        if (password.isEmpty()) {
            kataSandiEditText.setError("Please enter your password");
            kataSandiEditText.requestFocus();
            return;
        }

        // Create a JSON object to send the login credentials to the server
        JSONObject requestData = new JSONObject();
        try {
            requestData.put("email", nik);
            requestData.put("password", password);
            requestData.put("frontend", true);
        } catch (JSONException e) {
            e.printStackTrace();
            return;
        }

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(
                Request.Method.POST,
                loginUrl,
                requestData,
                response -> {
                    try {
                        boolean status = response.getBoolean("status");
                        String text = response.getString("text");
                        String dataUser = response.getString("dataUser");
                        String token = response.optString("token");

                        if (status) {
                            Toast.makeText(MainActivity.this, "Login successful", Toast.LENGTH_SHORT).show();
                            SharedPreferences sharedPreferences = getSharedPreferences("MyPrefs", Context.MODE_PRIVATE);
                            SharedPreferences.Editor editor = sharedPreferences.edit();
                            editor.putString("dataUser", dataUser);
                            editor.putString("token", token);
                            editor.apply();
                            Intent intent = new Intent(MainActivity.this, DashboardActivity.class);
                            startActivity(intent);
                        } else {
                            Toast.makeText(MainActivity.this, "Login unsuccessful, " + text, Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                },
                error -> Toast.makeText(MainActivity.this, "Login unsuccessful", Toast.LENGTH_SHORT).show()
        );

        requestQueue.add(jsonObjectRequest);
    }
}
