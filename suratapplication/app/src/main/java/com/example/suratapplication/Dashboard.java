package com.example.suratapplication;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import okhttp3.FormBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;
import java.io.IOException;

import android.content.ContentProviderOperation;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;


public class Dashboard extends AppCompatActivity {
    private static final String BASE_URL = "https://api.pupakindonesia.xyz/api/";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        TextView nameTextView = findViewById(R.id.nameTextView);
        String token = getIntent().getStringExtra("token");
        Request request = new Request.Builder()
                .url( BASE_URL + "my-profile")
                .addHeader("Authorization", "Bearer " + token)
                .build();
        try {
            OkHttpClient client = new OkHttpClient();
            Response response = client.newCall(request).execute();
            String responseBody = response.body().string();

            if (response.isSuccessful()) {
                JSONArray jsonArray = new JSONArray(responseBody);
                JSONObject userObject = jsonArray.getJSONObject(0);
                String name = userObject.getString("name");

                nameTextView.setText(name);
            } else {
                // Handle error
            }
        } catch (IOException e) {
            e.printStackTrace();
        } catch (JSONException e) {
            e.printStackTrace();
        }
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getSupportActionBar().hide();
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.dashboard);
    }
}
