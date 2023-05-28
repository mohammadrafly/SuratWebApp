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
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.example.suratapplication.helper.Constants;

import org.json.JSONException;
import org.json.JSONObject;

public class LupaPasswordActivity extends AppCompatActivity {

    private EditText emailInput;
    private RequestQueue requestQueue;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.lupapassword_screen);

        emailInput = findViewById(R.id.emailInput);

        View backButton = findViewById(R.id.backButton);
        backButton.setOnClickListener(v -> finish());

        Button sendButton = findViewById(R.id.send);
        sendButton.setOnClickListener(v -> sendResetPasswordRequest());

        // Initialize the RequestQueue
        requestQueue = Volley.newRequestQueue(this);
    }

    private void sendResetPasswordRequest() {
        String email = emailInput.getText().toString();
        JSONObject jsonPayload = new JSONObject();
        try {
            jsonPayload.put("email", email);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.POST, Constants.FORGOT_PASSWORD, jsonPayload,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            boolean status = response.getBoolean("status");
                            String message = response.getString("message");
                            Toast.makeText(LupaPasswordActivity.this, message, Toast.LENGTH_SHORT).show();
                            if (status) {
                                Intent intent = new Intent(LupaPasswordActivity.this, SignInActivity.class);
                                startActivity(intent);
                                finish();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.e(TAG, "Forgot password error: " + error.getMessage());
                        Toast.makeText(LupaPasswordActivity.this, "forgot password failed.", Toast.LENGTH_SHORT).show();
                    }
                });

        requestQueue.add(request);

        Toast.makeText(this, "Reset password request sent for email: " + email, Toast.LENGTH_SHORT).show();
    }
}