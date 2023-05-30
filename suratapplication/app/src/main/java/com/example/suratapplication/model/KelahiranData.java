package com.example.suratapplication.model;

public class KelahiranData {
    private String author;
    private String nama_lengkap;
    private String jenis_kelamin;
    private String dilahirkan_di;
    private int kelahiran_ke;
    private int anak_ke;
    private String penolong_kelahiran;
    private String alamat_anak;
    private String nik;
    private String status_ttd;
    private String catatan;
    private String disposisi_surat;
    private String created_at;

    public String getTanggal() {
        return created_at;
    }

    public void setTanggal(String created_at) {
        this.created_at = created_at;
    }

    public String getAuthor() {
        return author;
    }

    public void setAuthor(String author) {
        this.author = author;
    }

    public String getNamaLengkap() {
        return nama_lengkap;
    }

    public void setNamaLengkap(String nama_lengkap) {
        this.nama_lengkap = nama_lengkap;
    }

    public String getJenisKelamin() {
        return jenis_kelamin;
    }

    public void setJenisKelamin(String jenis_kelamin) {
        this.jenis_kelamin = jenis_kelamin;
    }

    public String getDilahirkanDi() {
        return dilahirkan_di;
    }

    public void setDilahirkanDi(String dilahirkan_di) {
        this.dilahirkan_di = dilahirkan_di;
    }

    public int getKelahiranKe() {
        return kelahiran_ke;
    }

    public void setKelahiranKe(int kelahiran_ke) {
        this.kelahiran_ke = kelahiran_ke;
    }

    public int getAnakKe() {
        return anak_ke;
    }

    public void setAnakKe(int anak_ke) {
        this.anak_ke = anak_ke;
    }

    public String getPenolongKelahiran() {
        return penolong_kelahiran;
    }

    public void setPenolongKelahiran(String penolong_kelahiran) {
        this.penolong_kelahiran = penolong_kelahiran;
    }

    public String getAlamatAnak() {
        return alamat_anak;
    }

    public void setAlamatAnak(String alamat_anak) {
        this.alamat_anak = alamat_anak;
    }

    public String getNik() {
        return nik;
    }

    public void setNik(String nik) {
        this.nik = nik;
    }

    public String getStatusTtd() {
        return status_ttd;
    }

    public void setStatusTtd(String status_ttd) {
        this.status_ttd = status_ttd;
    }

    public String getCatatan() {
        return catatan;
    }

    public void setCatatan(String catatan) {
        this.catatan = catatan;
    }

    public String getDisposisiSurat() {
        return disposisi_surat;
    }

    public void setDisposisiSurat(String disposisi_surat) {
        this.disposisi_surat = disposisi_surat;
    }
}
