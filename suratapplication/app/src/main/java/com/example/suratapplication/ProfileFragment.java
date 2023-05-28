package com.example.suratapplication;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import androidx.fragment.app.Fragment;

import com.example.suratapplication.model.UserData;

public class ProfileFragment extends Fragment {

    public static ProfileFragment newInstance(UserData userData) {
        ProfileFragment fragment = new ProfileFragment();
        Bundle args = new Bundle();
        args.putString("name", userData.getName());
        args.putString("role", userData.getRole());
        args.putString("email", userData.getEmail());
        args.putString("token", userData.getToken());
        fragment.setArguments(args);
        return fragment;
    }

    private TextView nameTextView;
    private TextView emailTextView;
    private TextView roleTextView;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_profile2, container, false);

        nameTextView = rootView.findViewById(R.id.name);
        emailTextView = rootView.findViewById(R.id.email);
        roleTextView = rootView.findViewById(R.id.role);

        Bundle args = getArguments();
        if (args != null) {
            String name = args.getString("name");
            String role = args.getString("role");
            String email = args.getString("email");

            nameTextView.setText(name);
            roleTextView.setText(role);
            emailTextView.setText(email);
        }

        Button logoutButton = rootView.findViewById(R.id.logout);
        logoutButton.setOnClickListener(v -> {
            SharedPreferences sharedPreferences = requireContext().getSharedPreferences("UserData", Context.MODE_PRIVATE);
            SharedPreferences.Editor editor = sharedPreferences.edit();
            editor.clear();
            editor.apply();

            Intent intent = new Intent(getActivity(), SignInActivity.class);
            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK);
            startActivity(intent);
            requireActivity().finish();
        });

        return rootView;
    }
}