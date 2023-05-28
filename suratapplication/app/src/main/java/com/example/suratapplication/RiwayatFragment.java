package com.example.suratapplication;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import androidx.fragment.app.Fragment;

import com.example.suratapplication.model.UserData;
import com.example.suratapplication.riwayat.RiwayatKelahiran;

public class RiwayatFragment extends Fragment {
    public static RiwayatFragment newInstance(UserData userData) {
        RiwayatFragment fragment = new RiwayatFragment();
        Bundle args = new Bundle();
        args.putString("name", userData.getName());
        args.putString("role", userData.getRole());
        args.putString("email", userData.getEmail());
        args.putString("token", userData.getToken());
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_riwayat, container, false);

        Button suratKelahiranButton = rootView.findViewById(R.id.buttonKelahiran);
        suratKelahiranButton.setOnClickListener(v -> openRiwayatKelahiran());

        return rootView;
    }

    private void openRiwayatKelahiran() {
        Intent intent = new Intent(getActivity(), RiwayatKelahiran.class);
        startActivity(intent);
    }
}
