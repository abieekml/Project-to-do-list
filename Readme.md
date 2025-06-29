# To-Do List PHP Application

Aplikasi To-Do List sederhana yang dibuat menggunakan PHP, MySQL, dan JavaScript dengan desain yang modern dan responsif.

## Fitur

- ✅ Menambah tugas baru
- ✅ Menandai tugas sebagai selesai/belum selesai
- ✅ Menghapus tugas
- ✅ Filter tugas (Semua, Selesai, Belum Selesai)
- ✅ Statistik tugas
- ✅ Desain responsif
- ✅ Animasi dan transisi yang smooth
- ✅ Notifikasi untuk setiap aksi

## Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server (Apache/Nginx)
- PDO MySQL extension

## Instalasi

1. *Jalankan Aplikasi*
   - Letakkan folder aplikasi di document root web server
   - Akses melalui browser: http://localhost/todo-app

## Struktur Database

### Table: todos
| Field | Type | Description |
|-------|------|-------------|
| id | INT AUTO_INCREMENT | Primary key |
| task | VARCHAR(255) | Isi tugas |
| completed | BOOLEAN | Status selesai (0/1) |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

## Struktur File


todo-app/
├── index.php              
├── config/
│   └── database.php  
├── includes/
│   ├── header.php         
│   └── footer.php        
├── classes/
│   └── TodoManager.php 
├── assets/
│   ├── css/
│   │   └── style.css     
│   └── js/
│       └── script.js     
├── sql/
│   └── todo_database.sql 
└── README.md            


## Teknologi yang Digunakan

- *Backend*: PHP dengan PDO untuk database connection
- *Database*: MySQL
- *Frontend*: HTML5, CSS3, JavaScript
- *Styling*: Custom CSS dengan Flexbox dan Grid
- *Icons*: Font Awesome
- *Responsive*: Mobile-first approach

## Fitur Keamanan

- Prepared statements untuk mencegah SQL injection
- HTML escaping untuk mencegah XSS
- Input validation dan sanitization
- CSRF protection dengan session

## Contributing

1. Fork repository
2. Buat feature branch (git checkout -b feature/AmazingFeature)
3. Commit changes (git commit -m 'Add some AmazingFeature')
4. Push ke branch (git push origin feature/AmazingFeature)
5. Buat Pull Request

---

*Happy Coding! 🚀*
