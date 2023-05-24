package com.example.suratapplication;

import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.BitmapDrawable;
import android.net.Uri;
import android.os.Bundle;
import android.provider.MediaStore;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

public class SignUpActivity extends AppCompatActivity {
    private static final int REQUEST_CAMERA_PERMISSION = 1;
    private static final int REQUEST_IMAGE_CAPTURE = 2;
    private static final int REQUEST_IMAGE_PICKER = 3;

    private Button uploadButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.register_screen);

        View backButton = findViewById(R.id.backButton);
        backButton.setOnClickListener(v -> finish());

        uploadButton = findViewById(R.id.uploadButton);
        uploadButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openImagePicker();
            }
        });
    }

    private void openImagePicker() {
        // Check for camera and storage permissions
        if (ContextCompat.checkSelfPermission(this, android.Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED ||
                ContextCompat.checkSelfPermission(this, android.Manifest.permission.WRITE_EXTERNAL_STORAGE) != PackageManager.PERMISSION_GRANTED) {
            // Permissions not granted, show the permission dialog
            AlertDialog.Builder builder = new AlertDialog.Builder(this);
            builder.setTitle("Permission Required")
                    .setMessage("Camera and Storage permissions are required to access the image picker.")
                    .setPositiveButton("Grant", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            // Request camera and storage permissions
                            ActivityCompat.requestPermissions(SignUpActivity.this, new String[]{
                                    android.Manifest.permission.CAMERA,
                                    android.Manifest.permission.WRITE_EXTERNAL_STORAGE
                            }, REQUEST_CAMERA_PERMISSION);
                        }
                    })
                    .setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            // Permission dialog canceled, do nothing
                        }
                    })
                    .create()
                    .show();
        } else {
            // Permissions already granted, launch image picker
            Intent intent = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
            startActivityForResult(intent, REQUEST_IMAGE_PICKER);
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == REQUEST_CAMERA_PERMISSION) {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED &&
                    grantResults[1] == PackageManager.PERMISSION_GRANTED) {
                // Camera and storage permissions granted, launch image picker
                Intent intent = new Intent(Intent.ACTION_PICK, MediaStore.Images.Media.EXTERNAL_CONTENT_URI);
                startActivityForResult(intent, REQUEST_IMAGE_PICKER);
            } else {
                // Permissions denied
                Toast.makeText(this, "Permissions denied.", Toast.LENGTH_SHORT).show();
            }
        }
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode == RESULT_OK) {
            if (requestCode == REQUEST_IMAGE_CAPTURE) {
                // Photo captured from camera
                // TODO: Handle the captured photo
                Uri imageUri = data.getData();
                // Do something with the captured photo (e.g., display it in an ImageView)
                Bitmap bitmap = decodeUriToBitmap(imageUri);
                BitmapDrawable drawable = new BitmapDrawable(getResources(), bitmap);
                uploadButton.setBackground(drawable);
            } else if (requestCode == REQUEST_IMAGE_PICKER) {
                // Photo selected from image picker
                // TODO: Handle the selected photo
                Uri imageUri = data.getData();
                // Do something with the selected photo (e.g., display it in an ImageView)
                Bitmap bitmap = decodeUriToBitmap(imageUri);
                BitmapDrawable drawable = new BitmapDrawable(getResources(), bitmap);
                uploadButton.setBackground(drawable);
            }
        }
    }

    // Helper method to decode the image URI to a bitmap
    private Bitmap decodeUriToBitmap(Uri uri) {
        try {
            // Decode the image URI to a bitmap
            return BitmapFactory.decodeStream(getContentResolver().openInputStream(uri));
        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }
}
