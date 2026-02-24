# SDN 7 Bangsri API Documentation

## Base URL
```
http://127.0.0.1:8000/api/v1
```

## Authentication
API ini menggunakan **Laravel Sanctum** untuk authentication. Untuk mengakses endpoint yang protected, Anda perlu:

1. Login atau Register untuk mendapatkan token
2. Sertakan token di header: `Authorization: Bearer {your_token}`

---

## Cara Menggunakan di Postman

### Import Collection
1. Buka Postman
2. Click **Import** → **Upload Files**
3. Pilih file `SDN7-Bangsri-API.postman_collection.json`
4. Collection akan muncul di sidebar

### Setup Environment
Variable yang digunakan:
- `base_url`: `http://127.0.0.1:8000/api/v1`
- `token`: Akan otomatis terisi setelah login

---

## Endpoints

### 🔐 Authentication

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| POST | `/register` | Register user baru | ❌ |
| POST | `/login` | Login dan dapatkan token | ❌ |
| GET | `/user` | Get current user info | ✅ |
| POST | `/logout` | Logout (revoke token) | ✅ |

**Register Request:**
```json
{
    "name": "Admin",
    "email": "admin@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Login Request:**
```json
{
    "email": "admin@example.com",
    "password": "password123"
}
```

**Login Response:**
```json
{
    "success": true,
    "message": "Login berhasil",
    "data": {
        "user": { ... },
        "token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

---

### 📰 Activities (Kegiatan)

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/activities` | Get semua kegiatan | ❌ |
| GET | `/activities/{id}` | Get kegiatan by ID | ❌ |
| POST | `/activities` | Tambah kegiatan baru | ✅ |
| PUT/POST | `/activities/{id}` | Update kegiatan | ✅ |
| DELETE | `/activities/{id}` | Hapus kegiatan | ✅ |

**Query Parameters (GET):**
- `active`: Filter by status (true/false)
- `category`: Filter by category
- `search`: Search by title/description
- `per_page`: Items per page (default: 10)

**Create/Update (form-data):**
- `title`: string (required)
- `description`: string (required)
- `category`: string (optional)
- `image`: file (required for create)
- `is_active`: boolean (0/1)

---

### 🖼 Galleries (Galeri)

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/galleries` | Get semua galeri | ❌ |
| GET | `/galleries/{id}` | Get galeri by ID | ❌ |
| POST | `/galleries` | Tambah galeri baru | ✅ |
| PUT/POST | `/galleries/{id}` | Update galeri | ✅ |
| DELETE | `/galleries/{id}` | Hapus galeri | ✅ |

**Create/Update (form-data):**
- `title`: string (required)
- `description`: string (optional)
- `category`: string (optional)
- `image`: file (required for create)

---

### 👨‍🏫 Teachers (Guru)

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/teachers` | Get semua guru | ❌ |
| GET | `/teachers/{id}` | Get guru by ID | ❌ |
| POST | `/teachers` | Tambah guru baru | ✅ |
| PUT/POST | `/teachers/{id}` | Update guru | ✅ |
| DELETE | `/teachers/{id}` | Hapus guru | ✅ |

**Create/Update (form-data):**
- `name`: string (required)
- `subject`: string (optional)
- `specialty`: string (optional)
- `experience`: integer (optional)
- `photo`: file (optional)
- `is_active`: boolean (0/1)

---

### 🎠 Sliders

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/sliders` | Get semua sliders | ❌ |
| GET | `/sliders/{id}` | Get slider by ID | ❌ |
| POST | `/sliders` | Tambah slider baru | ✅ |
| PUT/POST | `/sliders/{id}` | Update slider | ✅ |
| DELETE | `/sliders/{id}` | Hapus slider | ✅ |

**Create/Update (form-data):**
- `title`: string (required)
- `subtitle`: string (optional)
- `image`: file (required for create)
- `order`: integer (optional)
- `is_active`: boolean (0/1)

---

### 🏫 School Profile

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/school-profile` | Get profil sekolah | ❌ |
| PUT | `/school-profile` | Update profil sekolah | ✅ |

**Update (JSON body):**
```json
{
    "school_name": "SDN 7 Bangsri",
    "welcome_message": "Selamat datang",
    "vision": "Visi sekolah",
    "mission": "Misi sekolah",
    "address": "Jl. Raya Bangsri",
    "phone": "0291-123456",
    "email": "sdn7bangsri@example.com"
}
```

---

## Response Format

**Success Response:**
```json
{
    "success": true,
    "message": "Operation berhasil",
    "data": { ... }
}
```

**Error Response:**
```json
{
    "success": false,
    "message": "Error message"
}
```

**Validation Error:**
```json
{
    "message": "The title field is required.",
    "errors": {
        "title": ["The title field is required."]
    }
}
```

---

## Image URLs

Semua response yang mengandung gambar akan menyertakan field `image_url` atau `photo_url` berisi URL lengkap gambar:

```json
{
    "id": 1,
    "title": "Kegiatan",
    "image": "activities/abc123.jpg",
    "image_url": "http://127.0.0.1:8000/storage/activities/abc123.jpg"
}
```

---

## Tips Upload File di Postman

1. Pilih **Body** → **form-data**
2. Untuk field image/photo, klik dropdown di sebelah key dan pilih **File**
3. Click **Select Files** untuk memilih file gambar
4. Untuk update dengan PUT method via form-data, tambahkan field `_method` dengan value `PUT`

---

## Headers yang Diperlukan

```
Accept: application/json
Content-Type: application/json (untuk JSON body)
Authorization: Bearer {token} (untuk protected routes)
```

Untuk form-data (upload file), Content-Type akan otomatis di-set oleh Postman.
