package com.example.suratapplication;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

import androidx.appcompat.app.AppCompatActivity;

public class SignInActivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login_screen);

        View register = findViewById(R.id.daftar);
        register.setOnClickListener(v -> {
            Intent intent = new Intent(SignInActivity.this, SignUpActivity.class);
            startActivity(intent);
        });

        View masuk = findViewById(R.id.masuk);
        masuk.setOnClickListener(v -> {
            Intent intent = new Intent(SignInActivity.this, MainActivity.class);
            startActivity(intent);
        });

        View lupakatasandi = findViewById(R.id.lupakatasandi);
        lupakatasandi.setOnClickListener(v -> {
            Intent intent = new Intent(SignInActivity.this, LupaPasswordActivity.class);
            startActivity(intent);
        });
    }
}
