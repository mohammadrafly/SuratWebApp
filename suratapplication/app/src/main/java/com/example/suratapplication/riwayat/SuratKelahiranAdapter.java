package com.example.suratapplication.riwayat;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.suratapplication.R;
import com.example.suratapplication.model.KelahiranData;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Locale;

public class SuratKelahiranAdapter extends RecyclerView.Adapter<SuratKelahiranAdapter.ViewHolder> {
    private List<KelahiranData> kelahiranDataList;
    private DetailsButtonClickListener detailsButtonClickListener;

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

        holder.detailsButton.setOnClickListener(v -> {
            int clickedPosition = holder.getAdapterPosition();
            if (clickedPosition != RecyclerView.NO_POSITION) {
                if (detailsButtonClickListener != null) {
                    detailsButtonClickListener.onDetailsButtonClick(clickedPosition);
                }
            }
        });
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

        public ViewHolder(View itemView) {
            super(itemView);
            namaTextView = itemView.findViewById(R.id.namaTextView);
            statusTtdTextView = itemView.findViewById(R.id.statusTtdTextView);
            tanggalTextView = itemView.findViewById(R.id.tanggalTextView);
            disposisiTextView = itemView.findViewById(R.id.disposisiTextView);
            catatanTextView = itemView.findViewById(R.id.catatanTextView);
            detailsButton = itemView.findViewById(R.id.detailsButton);
        }
    }

    public interface DetailsButtonClickListener {
        void onDetailsButtonClick(int position);
    }
}
