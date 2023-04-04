package com.example.suratapplication;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
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

public class Register extends AppCompatActivity {
    private EditText emailEditText;
    private EditText nameEditText;
    private EditText passwordEditText;
    private Button registerButton;

    private RequestQueue requestQueue;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getSupportActionBar().hide();
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
                WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.register);

        emailEditText = findViewById(R.id.email);
        passwordEditText = findViewById(R.id.password);
        nameEditText = findViewById(R.id.name);
        registerButton = findViewById(R.id.register_button);

        requestQueue = Volley.newRequestQueue(this);

        registerButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String url = "https://api.pupakindonesia.xyz/register";
                String email = emailEditText.getText().toString();
                String name = nameEditText.getText().toString();
                String password = passwordEditText.getText().toString();

                JSONObject params = new JSONObject();
                try {
                    params.put("name", name);
                    params.put("email", email);
                    params.put("password", password);
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(Request.Method.POST, url, params,
                        response -> {
                            Toast.makeText(Register.this, "Registration successful", Toast.LENGTH_SHORT).show();
                        },
                        error -> {
                            Toast.makeText(Register.this, "Registration failed: " + error.getMessage(), Toast.LENGTH_SHORT).show();
                        });
                requestQueue.add(jsonObjectRequest);
                Intent i = new Intent(Register.this, MainActivity.class);
                startActivity(i);
            }
        });
    }
}
