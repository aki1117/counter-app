<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Panel Admin Antrian</title>
  <style>
    body { font-family: sans-serif; padding: 30px; background: #fff8e1; }
    button { padding: 10px 16px; font-size: 16px; margin-top: 10px; margin-right: 10px; }
    .box {
      background: #fff; padding: 20px; margin-top: 20px;
      border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    h2 { margin-bottom: 10px; }
    ul { padding-left: 20px; }
    li { margin-bottom: 10px; }
    .field { margin-bottom: 6px; }
  </style>
</head>
<body>
  <h1>Panel Admin Antrian</h1>
  <button onclick="callNext()">Panggil Antrian Berikutnya</button>
  <button onclick="resetQueue()">Reset Antrian</button>

  <div class="box">
    <h2>Sedang Dipanggil:</h2>
    <div id="currentDetails">Belum ada</div>
  </div>

  <div class="box">
    <h2>Sisa Antrian:</h2>
    <ul id="queueList"></ul>
  </div>

  <script>
    let queue = JSON.parse(localStorage.getItem('queue')) || [];
    let current = JSON.parse(localStorage.getItem('current')) || null;

    function renderQueue() {
      const list = document.getElementById('queueList');
      list.innerHTML = '';
      queue.forEach(p => {
        const li = document.createElement('li');
        li.innerHTML = `
          <strong>No ${p.number}</strong> - ${p.nama} (${p.jenisPelayanan})<br>
          <em>Keluhan:</em> ${p.keluhan}
        `;
        list.appendChild(li);
      });
    }

    function renderCurrent() {
      const div = document.getElementById('currentDetails');
      if (!current) {
        div.textContent = 'Belum ada';
        return;
      }

      div.innerHTML = `
        <div class="field"><strong>No Antrian:</strong> ${current.number}</div>
        <div class="field"><strong>Nama:</strong> ${current.nama}</div>
        <div class="field"><strong>NIK:</strong> ${current.nik}</div>
        <div class="field"><strong>Tanggal Lahir:</strong> ${current.tanggalLahir}</div>
        <div class="field"><strong>Jenis Kelamin:</strong> ${current.jenisKelamin}</div>
        <div class="field"><strong>Nama KK:</strong> ${current.kepalaKeluarga}</div>
        <div class="field"><strong>Alamat:</strong> ${current.kelurahan}, ${current.kecamatan}, ${current.kota}</div>
        <div class="field"><strong>No. Telp:</strong> ${current.telp}</div>
        <div class="field"><strong>Pendidikan:</strong> ${current.pendidikan}</div>
        <div class="field"><strong>Pekerjaan:</strong> ${current.pekerjaan}</div>
        <div class="field"><strong>Jenis Pelayanan:</strong> ${current.jenisPelayanan}</div>
        <div class="field"><strong>Keluhan:</strong> ${current.keluhan}</div>
        <div class="field"><strong>Tanggal Periksa:</strong> ${current.tanggalPemeriksaan}</div>
      `;
    }

    function callNext() {
      if (queue.length === 0) {
        alert('Tidak ada antrian.');
        return;
      }
      current = queue.shift();
      localStorage.setItem('queue', JSON.stringify(queue));
      localStorage.setItem('current', JSON.stringify(current));
      renderQueue();
      renderCurrent();
    }

    function resetQueue() {
      if (!confirm('Yakin ingin reset semua antrian?')) return;
      localStorage.removeItem('queue');
      localStorage.removeItem('current');
      localStorage.setItem('lastNumber', '0');
      queue = [];
      current = null;
      renderQueue();
      renderCurrent();
    }

    renderQueue();
    renderCurrent();
  </script>
</body>
</html>
