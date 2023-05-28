package com.example.suratapplication;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.example.suratapplication.model.UserData;
import com.google.android.material.bottomnavigation.BottomNavigationView;

public class MainActivity extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener {

    private BottomNavigationView bottomNavigationView;
    private HomeFragment homeFragment;
    private SuratFragment suratFragment;
    private ProfileFragment profileFragment;
    private UserData userData;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.dashboard_screen);

        userData = getStoredUserData();

        View backButton = findViewById(R.id.backButton);
        backButton.setOnClickListener(v -> finish());

        bottomNavigationView = findViewById(R.id.bottomNavigationView);
        bottomNavigationView.setOnNavigationItemSelectedListener(this);

        homeFragment = HomeFragment.newInstance(userData);
        suratFragment = SuratFragment.newInstance(userData);
        profileFragment = ProfileFragment.newInstance(userData);

        bottomNavigationView.setSelectedItemId(R.id.home);
    }

    @SuppressLint("NonConstantResourceId")
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case R.id.home:
                getSupportFragmentManager()
                        .beginTransaction()
                        .replace(R.id.flFragment, homeFragment)
                        .commit();
                return true;

            case R.id.surat:
                getSupportFragmentManager()
                        .beginTransaction()
                        .replace(R.id.flFragment, suratFragment)
                        .commit();
                return true;

            case R.id.profile:
                getSupportFragmentManager()
                        .beginTransaction()
                        .replace(R.id.flFragment, profileFragment)
                        .commit();
                return true;
        }
        return false;
    }

    private UserData getStoredUserData() {
        SharedPreferences sharedPreferences = getSharedPreferences("UserData", Context.MODE_PRIVATE);
        String name = sharedPreferences.getString("name", "");
        String role = sharedPreferences.getString("role", "");
        String email = sharedPreferences.getString("email", "");
        String token = sharedPreferences.getString("token", "");

        return new UserData(name, role, email, token);
    }
}
