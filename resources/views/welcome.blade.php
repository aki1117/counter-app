<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pendaftaran Pasien</title>
  <style>
    body {
      font-family: sans-serif;
      background: #f0f0f0;
      padding: 30px;
    }
    .card {
      max-width: 600px;
      background: white;
      margin: auto;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 10px;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 4px;
      border-radius: 6px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    button {
      margin-top: 20px;
      padding: 12px;
      width: 100%;
      font-size: 16px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
    #alertBox {
      display: none;
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      padding: 12px;
      margin-bottom: 20px;
      border-radius: 6px;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 4px;
      box-sizing: border-box;
      font-size: 14px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    textarea {
      resize: vertical;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>PELINTAS</h2>
    <h4>SILAHKAN DIBACA !!! <br> Form Pendaftaran Online ini ditujukan untuk PASIEN PRIORITAS yaitu :
1. Ibu Hamil <br>
2. Lansia (> 60 tahun) <br>
3. Balita <br>
<br>
Syarat : <br>
1. Pasien tersebut bukan peserta KIS FKTP Bangunsari dan bukan peserta BPJS Kesehatan(tidak memiliki KIS) <br>
2. Pendaftaran khusus H-1 pada jam 08.00-17.00. Untuk hari Senin/Hari Libur pendaftaran pada hari aktif sebelumnya. <br>
<br>
Pasien sudah terdaftar apabila sudah menerima balasan chat NO ANTRIAN dari Kami.<br>

Contact Person : 
Puskesmas Bangunsari 082335638747 (chat only)
</h4>


    <form id="registerForm">
    <label>Tanggal Pemeriksaan
        <input type="date" id="tanggalPemeriksaan" required>
      </label>

      <label>NIK
        <input type="text" id="nik" required>
      </label>

      <label>Nama Pasien
        <input type="text" id="namaPasien" required>
      </label>

      <label>Tanggal Lahir
        <input type="date" id="tanggalLahir" required>
      </label>

      <label>Jenis Kelamin
        <select id="jenisKelamin" required>
          <option value="">-- Pilih Jenis Kelamin --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </label>

      <label>Nama Kepala Keluarga
        <input type="text" id="kepalaKeluarga" required>
      </label>

      <label>Kelurahan
        <input type="text" id="kelurahan" required>
      </label>

      <label>Kecamatan
        <input type="text" id="kecamatan" required>
      </label>

      <label>Kota
        <input type="text" id="kota" required>
      </label>

      <label>No. Telepon
        <input type="text" id="telp" required>
      </label>

      <label>Pendidikan Terakhir
        <input type="text" id="pendidikan" required>
      </label>

      <label>Pekerjaan
        <input type="text" id="pekerjaan" required>
      </label>

      <label>Jenis Pelayanan
        <select id="jenisPelayanan" required>
          <option value="">-- Pilih Jenis Pelayanan --</option>
          <option>Umum</option>
          <option>BPJS</option>
          <option>Gigi</option>
          <option>Laboratorium</option>
          <option>Vaksinasi</option>
        </select>
      </label>

      <label>Keluhan
        <textarea id="keluhan" rows="3" required></textarea>
      </label>

      <button type="submit">Daftar</button>
      
      
    </form>
    <br>
    <div id="alertBox"></div>

  </div>
  <div id="currentBox">
    <h2>Sedang Dipanggil:</h2>
    <div id="currentPatient">Memuat...</div>
  </div>

  <script>
    const form = document.getElementById('registerForm');
    const alertBox = document.getElementById('alertBox');
    let lastNumber = parseInt(localStorage.getItem('lastNumber')) || 0;
    let queue = JSON.parse(localStorage.getItem('queue')) || [];

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const patient = {
        tanggalPemeriksaan: document.getElementById('tanggalPemeriksaan').value,
        nik: document.getElementById('nik').value,
        nama: document.getElementById('namaPasien').value,
        tanggalLahir: document.getElementById('tanggalLahir').value,
        jenisKelamin: document.getElementById('jenisKelamin').value,
        kepalaKeluarga: document.getElementById('kepalaKeluarga').value,
        kelurahan: document.getElementById('kelurahan').value,
        kecamatan: document.getElementById('kecamatan').value,
        kota: document.getElementById('kota').value,
        telp: document.getElementById('telp').value,
        pendidikan: document.getElementById('pendidikan').value,
        pekerjaan: document.getElementById('pekerjaan').value,
        jenisPelayanan: document.getElementById('jenisPelayanan').value,
        keluhan: document.getElementById('keluhan').value,
        number: ++lastNumber
      };

      queue.push(patient);
      localStorage.setItem('queue', JSON.stringify(queue));
      localStorage.setItem('lastNumber', lastNumber);

      showAlert(`Pendaftaran berhasil! Nomor antrian Anda: ${patient.number}`);
      form.reset();
    });

    function showAlert(message) {
      alertBox.textContent = message;
      alertBox.style.display = 'block';
      setTimeout(() => {
        alertBox.style.display = 'none';
      }, 50000);
    }
  </script>
</body>
</html>
