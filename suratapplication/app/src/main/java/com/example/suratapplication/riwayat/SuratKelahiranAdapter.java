package com.example.suratapplication.riwayat;

import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.core.app.NotificationCompat;
import androidx.core.content.FileProvider;
import androidx.recyclerview.widget.RecyclerView;

import com.example.suratapplication.R;
import com.example.suratapplication.helper.FileHelper;
import com.example.suratapplication.model.KelahiranData;
import com.example.suratapplication.network.ApiClient;
import com.example.suratapplication.network.ApiService;

import java.io.File;
import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Locale;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Response;

public class SuratKelahiranAdapter extends RecyclerView.Adapter<SuratKelahiranAdapter.ViewHolder> {
    private List<KelahiranData> kelahiranDataList;
    private DetailsButtonClickListener detailsButtonClickListener;
    private SharedPreferences preferences;
    private final Context context;
    public SuratKelahiranAdapter(Context context, SharedPreferences preferences) {
        this.preferences = preferences;
        this.context = context;
    }

    public void setKelahiranDataList(List<KelahiranData> kelahiranDataList) {
        this.kelahiranDataList = kelahiranDataList;
        notifyDataSetChanged();
    }

    public void setDetailsButtonClickListener(DetailsButtonClickListener listener) {
        this.detailsButtonClickListener = listener;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_surat_kelahiran, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        KelahiranData kelahiranData = kelahiranDataList.get(position);

        holder.namaTextView.setText(kelahiranData.getNamaLengkap());
        holder.statusTtdTextView.setText(String.valueOf(kelahiranData.getStatusTtd()));
        holder.disposisiTextView.setText(kelahiranData.getDisposisiSurat());
        holder.catatanTextView.setText(kelahiranData.getCatatan());

        // Format the date string
        SimpleDateFormat originalDateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss", Locale.getDefault());
        SimpleDateFormat desiredDateFormat = new SimpleDateFormat("EEEE d MMMM yyyy", new Locale("id", "ID"));

        try {
            Date originalDate = originalDateFormat.parse(kelahiranData.getTanggal());
            String formattedDate = desiredDateFormat.format(originalDate);
            holder.tanggalTextView.setText(formattedDate);
        } catch (ParseException e) {
            e.printStackTrace();
        }

        String role = preferences.getString("role", "");

        if (role.equals("warga")) {
            holder.detailsButton.setVisibility(View.GONE);
        } else {
            holder.detailsButton.setVisibility(View.VISIBLE);
            holder.detailsButton.setOnClickListener(v -> {
                int clickedPosition = holder.getAdapterPosition();
                if (clickedPosition != RecyclerView.NO_POSITION) {
                    if (detailsButtonClickListener != null) {
                        detailsButtonClickListener.onDetailsButtonClick(clickedPosition);
                    }
                }
            });
        }

        holder.downloadPdfButton.setOnClickListener(v -> {
            new DownloadFileTask(holder.itemView.getContext(), kelahiranData.getSurat()).execute();
        });
    }

    private class DownloadFileTask extends AsyncTask<Void, Void, Boolean> {
        private Context context;
        private String fileName;

        public DownloadFileTask(Context context, String fileName) {
            this.context = context;
            this.fileName = fileName;
        }

        @Override
        protected Boolean doInBackground(Void... voids) {
            ApiService apiService = ApiClient.getClient().create(ApiService.class);
            Call<ResponseBody> call = apiService.downloadPDF(fileName);

            try {
                Response<ResponseBody> response = call.execute();
                if (response.isSuccessful()) {
                    return FileHelper.saveFileLocally(context, response.body(), fileName);
                }
            } catch (IOException e) {
                e.printStackTrace();
            }

            return false;
        }

        @Override
        protected void onPostExecute(Boolean success) {
            if (success) {
                showDownloadCompleteNotification();
                Log.d("DownloadPDF", "File downloaded successfully: " + fileName);
            } else {
                Log.d("DownloadPDF", "Failed to save the file: " + fileName);
            }
        }

        private void showDownloadCompleteNotification() {
            NotificationManager notificationManager = (NotificationManager) context.getSystemService(Context.NOTIFICATION_SERVICE);
            if (notificationManager == null) {
                return;
            }

            // Create a notification channel for Android Oreo and higher
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
                String channelId = "download_channel";
                String channelName = "Download Channel";
                NotificationChannel channel = new NotificationChannel(channelId, channelName, NotificationManager.IMPORTANCE_DEFAULT);
                notificationManager.createNotificationChannel(channel);
            }

            // Create the intent to open or preview the downloaded file
            File outputFile = new File(context.getFilesDir(), fileName);
            Uri fileUri = FileProvider.getUriForFile(context, context.getApplicationContext().getPackageName() + ".provider", outputFile);
            Intent openFileIntent = new Intent(Intent.ACTION_VIEW);
            openFileIntent.setDataAndType(fileUri, "application/pdf");
            openFileIntent.addFlags(Intent.FLAG_GRANT_READ_URI_PERMISSION);

            // Create the pending intent to be triggered when the notification is clicked
            PendingIntent pendingIntent = PendingIntent.getActivity(context, 0, openFileIntent, PendingIntent.FLAG_UPDATE_CURRENT);

            // Create the notification
            NotificationCompat.Builder builder = new NotificationCompat.Builder(context, "download_channel")
                    .setSmallIcon(R.drawable.baseline_file_download_done_24)
                    .setContentTitle("File Download Complete")
                    .setContentText("File " + fileName + " has been downloaded successfully")
                    .setPriority(NotificationCompat.PRIORITY_DEFAULT)
                    .setAutoCancel(true)
                    .setContentIntent(pendingIntent);

            // Show the notification
            notificationManager.notify(0, builder.build());
        }
    }

    @Override
    public int getItemCount() {
        return kelahiranDataList != null ? kelahiranDataList.size() : 0;
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        public TextView namaTextView;
        public TextView tanggalTextView;
        public TextView statusTtdTextView;
        public TextView disposisiTextView;
        public TextView catatanTextView;
        public Button detailsButton;
        public Button downloadPdfButton;

        public ViewHolder(View itemView) {
            super(itemView);
            namaTextView = itemView.findViewById(R.id.namaTextView);
            statusTtdTextView = itemView.findViewById(R.id.statusTtdTextView);
            tanggalTextView = itemView.findViewById(R.id.tanggalTextView);
            disposisiTextView = itemView.findViewById(R.id.disposisiTextView);
            catatanTextView = itemView.findViewById(R.id.catatanTextView);
            detailsButton = itemView.findViewById(R.id.detailsButton);
            downloadPdfButton = itemView.findViewById(R.id.downloadPdfButton);
        }
    }

    public interface DetailsButtonClickListener {
        void onDetailsButtonClick(int position);
    }
}
