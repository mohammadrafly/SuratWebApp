package com.example.suratapplication;

import android.os.Bundle;
import android.view.MenuItem;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.Fragment;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class MainActivity extends AppCompatActivity implements BottomNavigationView.OnNavigationItemSelectedListener {
    BottomNavigationView bottomNavigationView;
    Toolbar toolbar;
    Fragment selectedFragment;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.dashboard_screen);

        toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        bottomNavigationView = findViewById(R.id.bottomNavigationView);
        bottomNavigationView.setOnNavigationItemSelectedListener(this);

        // Set the initial fragment
        selectedFragment = new HomeFragment();
        getSupportFragmentManager()
                .beginTransaction()
                .replace(R.id.flFragment, selectedFragment)
                .commit();

        bottomNavigationView.setSelectedItemId(R.id.home);
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case R.id.home:
                selectedFragment = new HomeFragment();
                getSupportActionBar().setTitle("Home");
                break;
            case R.id.surat:
                selectedFragment = new SuratFragment();
                getSupportActionBar().setTitle("Surat");
                break;
            case R.id.profile:
                selectedFragment = new ProfileFragment();
                getSupportActionBar().setTitle("Profile");
                break;
        }

        getSupportFragmentManager()
                .beginTransaction()
                .replace(R.id.flFragment, selectedFragment)
                .commit();

        return true;
    }
}
