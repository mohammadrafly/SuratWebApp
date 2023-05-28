package com.example.suratapplication.model;

public class UserData {
    private final String name;
    private final String role;
    private final String email;
    private final String token;

    public UserData(String name, String role, String email, String token) {
        this.name = name;
        this.role = role;
        this.email = email;
        this.token = token;
    }

    public String getName() {
        return name;
    }

    public String getRole() {
        return role;
    }

    public String getEmail() {
        return email;
    }

    public String getToken() {
        return token;
    }
}
