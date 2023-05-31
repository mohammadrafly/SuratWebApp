package com.example.suratapplication.helper;

import android.content.Context;

import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;

import okhttp3.ResponseBody;

public class FileHelper {
    public static boolean saveFileLocally(Context context, ResponseBody responseBody, String fileName) {
        File internalDirectory = context.getFilesDir();
        File outputFile = new File(internalDirectory, fileName);

        try (BufferedOutputStream bos = new BufferedOutputStream(new FileOutputStream(outputFile))) {
            bos.write(responseBody.bytes());
            return true;
        } catch (IOException e) {
            e.printStackTrace();
            return false;
        }
    }
}
