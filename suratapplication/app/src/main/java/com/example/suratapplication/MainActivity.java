package com.example.suratapplication;

import android.Manifest;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import com.example.suratapplication.model.UserData;
import com.google.android.material.bottomnavigation.BottomNavigationView;

public class MainActivity extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener {

    private static final int PERMISSION_REQUEST_CODE = 1;

    private BottomNavigationView bottomNavigationView;
    private HomeFragment homeFragment;
    private SuratFragment suratFragment;
    private ProfileFragment profileFragment;
    private RiwayatFragment riwayatFragment;
    private UserData userData;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.dashboard_screen);

        // Check if storage permission is granted
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M && ActivityCompat.checkSelfPermission(this, Manifest.permission.WRITE_EXTERNAL_STORAGE) != PackageManager.PERMISSION_GRANTED) {
            // Request storage permission
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE}, PERMISSION_REQUEST_CODE);
        } else {
            // Permission already granted, continue with initialization
            initializeApp();
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);

        if (requestCode == PERMISSION_REQUEST_CODE) {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                // Permission granted, continue with initialization
                initializeApp();
            } else {
                // Permission denied, handle accordingly (e.g., show an error message)
            }
        }
    }

    private void initializeApp() {
        userData = getStoredUserData();

        View backButton = findViewById(R.id.backButton);
        backButton.setOnClickListener(v -> finish());

        bottomNavigationView = findViewById(R.id.bottomNavigationView);
        bottomNavigationView.setOnNavigationItemSelectedListener(this);

        Menu navigationMenu = bottomNavigationView.getMenu();
        MenuItem suratMenuItem = navigationMenu.findItem(R.id.surat);

        if (userData.getRole().equals("kepala_desa")) {
            suratMenuItem.setVisible(false);
        } else {
            suratMenuItem.setVisible(true);
        }

        homeFragment = HomeFragment.newInstance(userData);
        riwayatFragment = new RiwayatFragment();
        profileFragment = ProfileFragment.newInstance(userData);

        if (!userData.getRole().equals("kepala_desa")) {
            suratFragment = SuratFragment.newInstance(userData);
        }

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

            case R.id.riwayat:
                getSupportFragmentManager()
                        .beginTransaction()
                        .replace(R.id.flFragment, riwayatFragment)
                        .commit();
                return true;

            case R.id.surat:
                if (!userData.getRole().equals("kepala_desa")) {
                    getSupportFragmentManager()
                            .beginTransaction()
                            .replace(R.id.flFragment, suratFragment)
                            .commit();
                    return true;
                }
                // If the user's role is "kepala_desa," do nothing and return false
                return false;

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
