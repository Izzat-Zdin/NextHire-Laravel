# NextHire AI - PHP Laravel Version

Versi PHP Laravel bagi sistem **NextHire AI Smart Interview & Career Readiness Platform**, dibangunkan sebagai alternatif modular kepada versi React.

---

## 📁 Struktur Projek

```
figma-php/
├── NextHireAIWebApplication/    # Versi Asal: React + Vite + Tailwind CSS
└── NextHireAILaravel/          # Versi Baharu: PHP 8.2+ / Laravel 12 / Blade
    ├── app/
    │   ├── Http/Controllers/   # Dashboard, Profile, Resume, Interview, Assessment, Learning, Progress
    │   └── Models/             # InterviewSession, InterviewQuestion, InterviewAnswer, LearningItem
    ├── database/
    │   ├── migrations/         # Skema jadual temuduga & pembelajaran
    │   ├── seeders/            # Seeder data pengguna (Maya Chen) & bahan pembelajaran
    │   └── database.sqlite     # Pangkalan data SQLite sedia ada
    ├── public/
    │   └── css/nexthire.css    # Sistem reka bentuk CSS premium (score rings, gradients, badges)
    ├── resources/views/
    │   ├── layouts/app.blade.php  # Shell reka bentuk master (sidebar, topbar, mobile drawer)
    │   ├── dashboard.blade.php    # Career Dashboard
    │   ├── profile.blade.php      # User Profile Management
    │   ├── resume.blade.php       # AI Resume Analyzer
    │   ├── interview/             # AI Mock Interview Engine (setup, room, complete)
    │   ├── assessment.blade.php   # Career Readiness Assessment
    │   ├── learning.blade.php     # Learning Recommendation
    │   └── progress.blade.php     # Recommendation & Progress Tracking
    └── routes/web.php             # Laluan routing RESTful
```

---

## 🚀 Cara Menjalankan Aplikasi

Pastikan anda berada di dalam folder `NextHireAILaravel`:

```bash
cd NextHireAILaravel
```

### 1. Jalankan Server Pembangunan
```bash
php artisan serve
```
Akses di pelayar web: **`http://127.0.0.1:8000`**

### 2. Jalankan Ujian Automatik (PHPUnit)
```bash
php artisan test
```

---

## ✨ Ciri-Ciri Utama yang Dimigrasikan

1. **Dashboard Eksekutif**:
   - Hero banner kecerunan biru gelap dengan skor cincin (Score Ring) kesediaan kerjaya (+6 mata).
   - 4 kad metrik utama (Kelengkapan profil, skor resume, temuduga terkini, jurang kemahiran).
   - Carta trend skor temuduga dan senarai keutamaan kemahiran.
   - Alur kerja 6 fasa interaktif serta cadangan kursus.

2. **Pengurusan Profil Pengguna (`/profile`)**:
   - Paparan maklumat Maya Chen (Northbridge University, Product Operations Intern BrightLabs).
   - Fungsi edit & simpan profil interaktif terus ke sesi Laravel.

3. **AI Resume Analyzer (`/resume`)**:
   - Zon muat naik fail PDF/DOCX dengan pratonton nama fail.
   - Analisis skor 76/100, pecahan penjajaran peranan, ringkasan profil, kekuatan, kelemahan, dan cadangan penambahbaikan.

4. **AI Mock Interview Engine (`/interview`)**:
   - **Persediaan**: Pilihan temuduga Behavioural, HR, atau Technical; pemilihan jawatan sasaran, tahap kesukaran, dan bilangan soalan.
   - **Bilik Temuduga (`/interview/room/{session}`)**: Kiraan masa aktif, progress bar, kad soalan dengan panduan STAR, kotak jawapan teks dinamik, dan simulasi butang rakaman audio dengan denyutan (pulsing animation).
   - **Penilaian Selesai (`/interview/complete/{session}`)**: Rekod disimpan dalam jadual SQLite `interview_sessions` dan `interview_answers`.

5. **Penilaian Kesediaan Temuduga (`/assessment`)**:
   - Tab "Overview", "Question feedback" (Q1–Q5), dan "Full report".
   - Butang eksport / cetak laporan temuduga NextHire AI.

6. **Cadangan Pembelajaran (`/learning`)**:
   - Kad kursus berkeutamaan tinggi (SQL, Metrik Produk, Sijil Analisis Data Google).
   - Carian teks dan penapisan kategori (Course, Project, Certification, Tutorial, Practice).
   - Butang tandakan siap ("Mark completed") dan simpan rancangan ("Bookmark").

7. **Jejak Kemajuan (`/progress`)**:
   - Pemilihan tempoh (3 bulan, 6 bulan, 12 bulan) dengan kemas kini carta trend bulanan.
   - Carta status pembelajaran (Donut chart) dan pelan tindakan perkembangan kerjaya (Roadmap).
