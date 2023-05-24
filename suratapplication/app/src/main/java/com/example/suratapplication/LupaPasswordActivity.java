package com.example.suratapplication;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

import androidx.appcompat.app.AppCompatActivity;

public class LupaPasswordActivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.lupapassword_screen);

        View backButton = findViewById(R.id.backButton);
        backButton.setOnClickListener(v -> finish());

        View register = findViewById(R.id.daftarButton);
        register.setOnClickListener(v -> {
            Intent intent = new Intent(LupaPasswordActivity.this, SignUpActivity.class);
            startActivity(intent);
        });
    }
}
