package com.example.suratapplication;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.fragment.app.Fragment;

import com.example.suratapplication.model.UserData;

public class HomeFragment extends Fragment {

    public static HomeFragment newInstance(UserData userData) {
        HomeFragment fragment = new HomeFragment();
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
        return inflater.inflate(R.layout.fragment_home, container, false);
    }
}