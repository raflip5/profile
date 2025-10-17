<?php

$api_url = 'https://randomuser.me/api/';
$response = file_get_contents($api_url);
$data = json_decode($response, true);
$user = $data['results'][0];

$nama = $user['name']['title'] . ' ' . $user['name']['first'] . ' ' . $user['name']['last'];
$email = $user['email'];
$telepon = $user['phone'];
$cell = $user['cell'];
$foto = $user['picture']['large'];
$gender = $user['gender'] == 'male' ? 'Laki-laki' : 'Perempuan';
$tanggal_lahir = date('d F Y', strtotime($user['dob']['date']));
$umur = $user['dob']['age'];
$alamat = $user['location']['street']['number'] . ' ' . $user['location']['street']['name'] . ', ' . 
          $user['location']['city'] . ', ' . $user['location']['state'] . ', ' . 
          $user['location']['country'] . ' - ' . $user['location']['postcode'];
$username = $user['login']['username'];
$negara = $user['location']['country'];
$kota = $user['location']['city'];
$registered = date('d F Y', strtotime($user['registered']['date']));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - <?php echo $nama; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="notification" id="notification">✓ Tersalin ke clipboard!</div>
    
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-header-content">
                <div class="profile-photo-wrapper" onclick="showNotification('Foto profil diklik!')">
                    <img src="<?php echo $foto; ?>" alt="Foto Profil" class="profile-photo">
                    <div class="status-badge"></div>
                </div>
                
                <div class="profile-info-header">
                    <h1 class="profile-name" onclick="copyToClipboard('<?php echo $nama; ?>')"><?php echo $nama; ?></h1>
                    <p class="profile-username">@<?php echo $username; ?></p>
                    
                    <div class="profile-meta">
                        <div class="meta-item" onclick="showNotification('Negara: <?php echo $negara; ?>')">
                            <span class="meta-icon">🌍</span>
                            <span><?php echo $negara; ?></span>
                        </div>
                        <div class="meta-item" onclick="showNotification('Umur: <?php echo $umur; ?> tahun')">
                            <span class="meta-icon">🎂</span>
                            <span><?php echo $umur; ?> tahun</span>
                        </div>
                        <div class="meta-item" onclick="showNotification('Jenis Kelamin: <?php echo $gender; ?>')">
                            <span class="meta-icon">👤</span>
                            <span><?php echo $gender; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="tabs">
            <button class="tab active" onclick="switchTab(event, 'contact')">📱 Kontak</button>
            <button class="tab" onclick="switchTab(event, 'about')">👤 Tentang</button>
            <button class="tab" onclick="switchTab(event, 'activity')">📊 Aktivitas</button>
        </div>
        
        <div class="profile-body">
            <div id="contact" class="tab-content active">
                <div class="info-grid">
                    <div class="info-card copyable" onclick="copyToClipboard('<?php echo $email; ?>')">
                        <span class="copy-hint">Klik untuk salin</span>
                        <div class="info-label">
                            <span class="info-icon">📧</span>
                            Email
                        </div>
                        <div class="info-value"><?php echo $email; ?></div>
                    </div>
                    
                    <div class="info-card copyable" onclick="copyToClipboard('<?php echo $telepon; ?>')">
                        <span class="copy-hint">Klik untuk salin</span>
                        <div class="info-label">
                            <span class="info-icon">📱</span>
                            Telepon
                        </div>
                        <div class="info-value"><?php echo $telepon; ?></div>
                    </div>
                    
                    <div class="info-card copyable" onclick="copyToClipboard('<?php echo $cell; ?>')">
                        <span class="copy-hint">Klik untuk salin</span>
                        <div class="info-label">
                            <span class="info-icon">📞</span>
                            Seluler
                        </div>
                        <div class="info-value"><?php echo $cell; ?></div>
                    </div>
                    
                    <div class="info-card copyable" onclick="copyToClipboard('<?php echo $kota; ?>')">
                        <span class="copy-hint">Klik untuk salin</span>
                        <div class="info-label">
                            <span class="info-icon">🏙️</span>
                            Kota
                        </div>
                        <div class="info-value"><?php echo $kota; ?></div>
                    </div>
                    
                    <div class="info-card address-card copyable" onclick="copyToClipboard('<?php echo $alamat; ?>')">
                        <span class="copy-hint">Klik untuk salin</span>
                        <div class="info-label">
                            <span class="info-icon">📍</span>
                            Alamat Lengkap
                        </div>
                        <div class="info-value"><?php echo $alamat; ?></div>
                    </div>
                </div>
            </div>
            
            <div id="about" class="tab-content">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-title">🎂 Tanggal Lahir</div>
                        <div class="timeline-content"><?php echo $tanggal_lahir; ?> (<?php echo $umur; ?> tahun)</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-title">👤 Jenis Kelamin</div>
                        <div class="timeline-content"><?php echo $gender; ?></div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-title">🌍 Kewarganegaraan</div>
                        <div class="timeline-content"><?php echo $negara; ?></div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-title">📝 Terdaftar Sejak</div>
                        <div class="timeline-content"><?php echo $registered; ?></div>
                    </div>
                </div>
            </div>
            
            <div id="activity" class="tab-content">
                <div class="stats-grid">
                    <div class="stat-card" onclick="showNotification('Total koneksi: 1,234')">
                        <div class="stat-number">1.2K</div>
                        <div class="stat-label">Koneksi</div>
                    </div>
                    <div class="stat-card" onclick="showNotification('Proyek selesai: 47')">
                        <div class="stat-number">47</div>
                        <div class="stat-label">Proyek</div>
                    </div>
                    <div class="stat-card" onclick="showNotification('Postingan dibuat: 892')">
                        <div class="stat-number">892</div>
                        <div class="stat-label">Postingan</div>
                    </div>
                    <div class="stat-card" onclick="showNotification('Rating: 4.8/5.0')">
                        <div class="stat-number">4.8★</div>
                        <div class="stat-label">Rating</div>
                    </div>
                </div>
            </div>
            
            <div class="button-group">
                <form method="POST" style="flex: 1;">
                    <button type="submit" class="refresh-btn">
                        <span class="icon" style="font-size: 20px;">🔄</span>
                        <span>Muat Profil Baru</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function switchTab(event, tabName) {
            const tabs = document.querySelectorAll('.tab');
            const contents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => tab.classList.remove('active'));
            contents.forEach(content => content.classList.remove('active'));
            
            event.currentTarget.classList.add('active');
            document.getElementById(tabName).classList.add('active');
        }
        
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                showNotification('✓ Tersalin: ' + text);
            });
        }
        
        function showNotification(message) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }
    </script>
</body>
</html>