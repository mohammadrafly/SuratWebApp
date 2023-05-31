package com.example.suratapplication;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;

import androidx.appcompat.app.AppCompatActivity;

public class SplashScreen extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.splash_screen);

        ImageView spinnerImageView = findViewById(R.id.spinnerImageView);
        Animation rotationAnimation = AnimationUtils.loadAnimation(this, R.anim.spinner);
        spinnerImageView.startAnimation(rotationAnimation);

        Thread timerThread = new Thread() {
            public void run() {
                try {
                    sleep(5000);
                } catch (InterruptedException e) {
                    e.printStackTrace();
                } finally {
                    String token = getTokenFromSharedPreferences();
                    Intent intent;
                    if (token != null && !token.isEmpty()) {
                        intent = new Intent(SplashScreen.this, MainActivity.class);
                    } else {
                        intent = new Intent(SplashScreen.this, SignInActivity.class);
                    }
                    startActivity(intent);
                    finish();
                }
            }
        };
        timerThread.start();
    }

    private String getTokenFromSharedPreferences() {
        SharedPreferences sharedPreferences = getSharedPreferences("UserData", Context.MODE_PRIVATE);
        return sharedPreferences.getString("token", null);
    }
}
