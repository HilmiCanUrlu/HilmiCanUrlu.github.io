<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anılarımız</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
      background: #f9f3f3;
      color: #333;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }

    .container {
      max-width: 600px;
      width: 90%;
      padding: 35px 30px;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
      background: rgba(255, 255, 255, 0.92);
      border-radius: 25px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.08);
      text-align: center;
      opacity: 0;
      transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      pointer-events: auto;
      border: 1px solid rgba(255, 255, 255, 0.4);
      backdrop-filter: blur(12px);
      display: none;
    }

    .container.hidden {
      opacity: 0;
      transform: translate(-50%, -50%) scale(0.95);
      pointer-events: none;
      display: none;
    }

    .container.gallery-view {
      transform: translate(-50%, -100%);
      opacity: 0.8;
    }

    .container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 100%);
      border-radius: 25px;
      z-index: -1;
    }

    .container h1 {
      color: #2d3436;
      font-family: 'Playfair Display', serif;
      margin-bottom: 25px;
      font-size: 2em;
      font-weight: 600;
      letter-spacing: 0.5px;
      line-height: 1.3;
      background: linear-gradient(45deg, #2d3436, #636e72);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .container p {
      color: #636e72;
      font-family: 'Poppins', sans-serif;
      line-height: 1.7;
      font-size: 1em;
      margin-bottom: 1.5em;
      font-weight: 400;
      letter-spacing: 0.3px;
      text-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }

    .container p:last-of-type {
      margin-bottom: 0;
    }

    .close-btn {
      position: absolute;
      top: 18px;
      right: 18px;
      background: rgba(255, 255, 255, 0.95);
      color: #2d3436;
      border: none;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      font-size: 18px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 20;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .close-btn:hover {
      background: #2d3436;
      color: white;
      transform: scale(1.05) rotate(90deg);
    }

    .container.show {
      opacity: 1;
      display: block;
    }

    .container:not(.show) {
      opacity: 0;
      transform: translate(-50%, -50%) scale(0.95);
    }

    .polaroid-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      pointer-events: none;
      z-index: 1;
      overflow: hidden;
    }

    .polaroid {
      position: absolute;
      width: 180px;
      background: white;
      padding: 10px 10px 30px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      border-radius: 5px;
      transform: rotate(5deg);
      transition: all 0.5s ease;
      pointer-events: auto;
      will-change: transform;
      z-index: 1;
    }

    .polaroid:hover {
      transform: scale(1.1) rotate(0deg) !important;
      z-index: 100;
    }

    .polaroid img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 3px;
      margin-bottom: 8px;
    }

    .polaroid-caption {
      text-align: center;
      font-family: 'Comic Sans MS', cursive;
      color: #555;
      font-size: 14px;
    }

    .gallery-section {
      position: relative;
      padding: 100px 20px;
      margin-top: 100vh;
      background: white;
      opacity: 0;
      transition: opacity 1s;
      z-index: 1;
    }

    .gallery-title {
      text-align: center;
      color: #ff6b81;
      margin-bottom: 40px;
      font-size: 2.5em;
    }

    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .gallery-item {
      background: white;
      padding: 15px 15px 40px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      border-radius: 5px;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .gallery-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .gallery-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 3px;
      margin-bottom: 10px;
    }

    .gallery-caption {
      text-align: center;
      font-family: 'Comic Sans MS', cursive;
      color: #555;
      font-size: 16px;
    }

    footer {
      position: fixed;
      bottom: 20px;
      left: 0;
      width: 100%;
      text-align: center;
      padding: 20px;
      color: #777;
      font-size: 0.9em;
      opacity: 0;
      transition: opacity 1s;
      z-index: 10;
    }

    .toggle-container-btn {
      position: fixed;
      bottom: 25px;
      left: 50%;
      transform: translateX(-50%);
      background: linear-gradient(45deg, #ff6b81, #ff9ff3);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 30px;
      cursor: pointer;
      z-index: 9998;
      display: none;
      font-family: 'Poppins', sans-serif;
      font-size: 0.95em;
      font-weight: 500;
      box-shadow: 0 5px 15px rgba(255,107,129,0.2);
      transition: all 0.3s ease;
      letter-spacing: 0.5px;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 5px 15px rgba(255,107,129,0.2);
      }
      50% {
        box-shadow: 0 5px 25px rgba(255,107,129,0.4);
      }
      100% {
        box-shadow: 0 5px 15px rgba(255,107,129,0.2);
      }
    }

    .toggle-container-btn:hover {
      transform: translateX(-50%) scale(1.05);
      box-shadow: 0 8px 20px rgba(255,107,129,0.3);
      background: linear-gradient(45deg, #ff9ff3, #ff6b81);
      animation: none;
    }

    @media (max-width: 768px) {
      .container {
        padding: 30px 25px;
        width: 85%;
        border-radius: 20px;
      }
      
      .container h1 {
        font-size: 1.8em;
        margin-bottom: 20px;
      }
      
      .container p {
        font-size: 0.95em;
        line-height: 1.6;
        margin-bottom: 1.3em;
      }

      .toggle-container-btn {
        padding: 10px 20px;
        font-size: 0.9em;
      }
      
      .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
      }
      
      .polaroid {
        width: 140px;
      }
    }

    /* Google Fonts için link ekleyin */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Poppins:wght@400;500&display=swap');
  </style>
</head>
<body>
  <div class="polaroid-container" id="polaroidContainer"></div>

  <div class="container" id="mainContainer">
    <button class="close-btn" onclick="toggleContainer()">×</button>
    <h1>Hilal... Güzelim, canımın içi...</h1>
    <p>
      Sana bunları yazarken bile içim burkuluyor. Çünkü seni düşündükçe kalbim hâlâ o ilk günkü gibi atıyor.
      Belki son zamanlarda bazı şeyler ters gitti, kelimeler eksik kaldı, bakışlarımız sustu... Ama inan, sevgim hiç eksilmedi.  
    </p>
    <p>
      Hilal, güzelim... Senin gülüşün, ses tonun, o gözlerinin içindeki ışık... Bunlar bana her zaman nefes gibi geldi.  
      Ne olursa olsun, seni sevmekten hiç vazgeçmedim. Hatalarım olduysa, bil ki öğrenmeye çalıştım.  
      Yavrum, belki konuşamadık her şeyi, belki bazı duygular boğazımıza düğümlendi ama içimde bir tek şey var:  
      Seni hâlâ, saf bir kalple seviyorum.
    </p>
    <p>
      Seninle paylaştığım her şey hâlâ gözümün önünde, içimde.  
      Güldüğün an, bir şey anlatırken parlayan gözlerin, yanımda oluşun…  
      Hepsi benim için hâlâ çok kıymetli.  
      Hiçbir şeyin soğumasını istemem, çünkü biz sıradan bir şey değiliz.  
      Seninle aramızda kurduğumuz bağ gerçek, derin ve çok güzel.
    </p>
    <p>
      Sadece bazen durup birbirimize yeniden sarılmamız gerekiyor.  
      O kadar.  
      Bence ne bir vedaya, ne uzaklaşmaya gerek yok.  
      Çünkü ben seni hâlâ aynı kalple, aynı sevgiyle içimde taşıyorum.
    </p>
    <p style="font-weight: bold; font-size: 1.2em; margin-top: 2em;">
      Hilal... Güzelim... Seni hâlâ seviyorum. Hem de kalbimin en derin yerinden.
    </p>
  </div>

  <button class="toggle-container-btn" id="toggleContainerBtn" onclick="toggleContainer()">Mesajı Göster</button>

  <div class="gallery-section" id="gallerySection">
    <h2 class="gallery-title">Tüm Anılarımız</h2>
    <div class="gallery-grid" id="galleryGrid"></div>
  </div>

  <footer>
  ❤️
  </footer>

  <script>
    photoTitles = [
  "Kalp Atışı", "İlk Sarılma", "Sessiz Sevgi",
  "Sığınak", "Bir Gülüşlük Mesafe", "Göz Gözeyken",
  "Zaman Durdu", "Kalbin Sesi", "Biz Olmak",
  "Kelebek Etkisi", "En Güzel An", "Ellerimiz",
  "Beklenmedik Mucize", "Minik Detaylar", "Adım Adım Aşk",
  "Sonsuzluk", "Bir Bakışta Her Şey", "Kalbin Aynası",
  "Yan Yana", "Uyum İçinde", "Ruh Eşi",
  "Gecenin Sessizliği", "Sabah Uyanışı", "Birlikte Güzel",
  "Aşkın Renkleri", "Aklımdasın", "Zamanın Ötesi",
  "An'ın İçinde", "Kayıp Zaman", "Sadece Biz",
  "Seninle Evim", "Sıcacık Bir An", "İlkbahar Gibi",
  "Birlikte Sessizlik", "Senle Güzel", "Aşkla Gülümsedik",
  "Kalbin Ritmi", "Usulca", "Sözsüz Mutluluk",
  "Her Şey Senken"
];

    // Her başlık için sabit bir resim numarası
    const photoMapping = {
      "Kalp Atışı": "36.jpg", "İlk Sarılma": "39.jpg", "Sessiz Sevgi": "15.jpg",
      "Sığınak": "4.jpg", "Bir Gülüşlük Mesafe": "5.jpg", "Göz Gözeyken": "41.jpg",
      "Zaman Durdu": "7.jpg", "Kalbin Sesi": "8.jpg", "Biz Olmak": "9.jpg",
      "Kelebek Etkisi": "10.jpg", "En Güzel An": "17.jpg", "Ellerimiz": "el ele.jpg",
      "Beklenmedik Mucize": "1.jpg", "Minik Detaylar": "14.jpg", "Adım Adım Aşk": "6.jpg",
      "Sonsuzluk": "16.jpg", "Bir Bakışta Her Şey": "11.jpg", "Kalbin Aynası": "18.jpg",
      "Yan Yana": "19.jpg", "Uyum İçinde": "20.jpg", "Ruh Eşi": "21.jpg",
      "Gecenin Sessizliği": "22.jpg", "Sabah Uyanışı": "23.jpg", "Birlikte Güzel": "35.jpg",
      "Aşkın Renkleri": "25.jpg", "Aklımdasın": "26.jpg", "Zamanın Ötesi": "27.jpg",
      "An'ın İçinde": "28.jpg", "Kayıp Zaman": "29.jpg", "Sadece Biz": "30.jpg",
      "Seninle Evim": "31.jpg", "Sıcacık Bir An": "32.jpg", "İlkbahar Gibi": "3.jpg",
      "Birlikte Sessizlik": "24.jpg", "Senle Güzel": "sen.jpg", "Aşkla Gülümsedik": "13.jpg",
      "Kalbin Ritmi": "37.jpg", "Usulca": "38.jpg", "Sözsüz Mutluluk": "2.jpg",
      "Her Şey Senken": "40.jpg"
    };

    function getAdjustedPositions() {
      const positions = [];
      const screenWidth = window.innerWidth;
      const screenHeight = window.innerHeight;
      const cols = 6;
      const rows = 7;
      const cellWidth = screenWidth / cols;
      const cellHeight = screenHeight / rows;
      const imgWidth = 180;
      const imgHeight = 200;
      const rotations = [-20, -15, -12, -8, -5, -3, 0, 3, 5, 8, 12, 15, 20];
      const maxOffsetX = (cellWidth - imgWidth) * 0.3;
      const maxOffsetY = (cellHeight - imgHeight) * 0.3;
      
      for (let i = 0; i < 41; i++) {
        const col = i % cols;
        const row = Math.floor(i / cols);
        const offsetX = (Math.random() - 0.5) * maxOffsetX;
        const offsetY = (Math.random() - 0.5) * maxOffsetY;
        const x = col * cellWidth + (cellWidth - imgWidth) / 2 + offsetX;
        const y = row * cellHeight + (cellHeight - imgHeight) / 2 + offsetY;
        const rotate = rotations[Math.floor(Math.random() * rotations.length)];
        const scale = 0.9 + Math.random() * 0.2;
        const translateX = (Math.random() - 0.5) * 10;
        const translateY = (Math.random() - 0.5) * 10;
        
        positions.push({
          x: x,
          y: y,
          rotate: rotate,
          scale: scale,
          translateX: translateX,
          translateY: translateY
        });
      }
      return positions;
    }

    function createRandomOrder() {
      const order = Array.from({length: 41}, (_, i) => i);
      for (let i = order.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [order[i], order[j]] = [order[j], order[i]];
      }
      return order;
    }

    function createPolaroid(index) {
      const container = document.getElementById('polaroidContainer');
      const polaroid = document.createElement('div');
      polaroid.className = 'polaroid';
      
      const pos = getAdjustedPositions()[index];
      polaroid.style.left = `${pos.x}px`;
      polaroid.style.top = `${pos.y}px`;
      polaroid.style.transform = `rotate(${pos.rotate}deg) scale(${pos.scale}) translate(${pos.translateX}px, ${pos.translateY}px)`;
      
      const title = photoTitles[index % photoTitles.length];
      const imageFile = photoMapping[title] || 'default.jpg';
      
      polaroid.innerHTML = `
        <img src="img/${imageFile}" alt="${title}" onerror="this.src='img/default.jpg'">
        <div class="polaroid-caption">${title}</div>
      `;
      
      container.appendChild(polaroid);
    }

    let isContainerManuallyOpened = false;

    function toggleContainer() {
      const container = document.getElementById('mainContainer');
      const toggleBtn = document.getElementById('toggleContainerBtn');
      
      // Konteyner'ı göster
      container.style.display = 'block';
      setTimeout(() => {
        container.style.opacity = '1';
      }, 50);
      
      // Butonu gizle
      toggleBtn.style.display = 'none';
      
      // Manuel açıldığını işaretle
      isContainerManuallyOpened = true;
      
      // Sayfayı en üste kaydır
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });

      // 1 saniye sonra flag'i sıfırla
      setTimeout(() => {
        isContainerManuallyOpened = false;
      }, 1000);
    }

    // Scroll olayını dinle
    window.addEventListener('scroll', function() {
      const container = document.getElementById('mainContainer');
      const toggleBtn = document.getElementById('toggleContainerBtn');
      const scrollPosition = window.scrollY;
      
      // Manuel açıldıysa scroll kontrolünü yapma
      if (isContainerManuallyOpened) return;
      
      // 50px'den fazla scroll yapıldığında mesajı gizle
      if (scrollPosition > 50) {
        container.style.opacity = '0';
        setTimeout(() => {
          container.style.display = 'none';
        }, 400);
        toggleBtn.style.display = 'block';
      } else {
        container.style.display = 'block';
        setTimeout(() => {
          container.style.opacity = '1';
        }, 50);
        toggleBtn.style.display = 'none';
      }
    });

    function createGallery() {
      const galleryGrid = document.getElementById('galleryGrid');
      
      for (let i = 0; i < 41; i++) {
        const galleryItem = document.createElement('div');
        galleryItem.className = 'gallery-item';
        
        const title = photoTitles[i % photoTitles.length];
        const imageFile = photoMapping[title] || 'default.jpg';
        
        galleryItem.innerHTML = `
          <img src="img/${imageFile}" alt="${title}" onerror="this.src='img/default.jpg'">
          <div class="gallery-caption">${title}</div>
        `;
        
        galleryGrid.appendChild(galleryItem);
      }
    }

    function showPhotosOneByOne() {
      let currentIndex = 0;
      const randomOrder = createRandomOrder();
      const container = document.getElementById('mainContainer');
      
      // Başlangıçta konteyner'ı gizle
      container.style.display = 'none';
      container.style.opacity = '0';
      
      function showNext() {
        if (currentIndex < 41) {
          createPolaroid(randomOrder[currentIndex]);
          currentIndex++;
          setTimeout(showNext, 100);
        } else {
          // Tüm resimler gösterildikten sonra
          setTimeout(() => {
            // Konteyner'ı göster
            container.style.display = 'block';
            setTimeout(() => {
              container.style.opacity = '1';
            }, 50);
            
            document.querySelector('footer').style.opacity = 1;
            
            setTimeout(() => {
              document.querySelector('.gallery-section').style.opacity = 1;
              document.body.style.overflow = 'auto';
              createGallery();
            }, 1000);
          }, 500);
        }
      }
      
      showNext();
    }

    window.onload = function() {
      document.body.style.overflow = 'hidden';
      const container = document.getElementById('mainContainer');
      container.style.display = 'none';
      container.style.opacity = '0';
      showPhotosOneByOne();
      document.getElementById('toggleContainerBtn').style.display = 'none';
    };

    window.addEventListener('resize', function() {
      const newPositions = getAdjustedPositions();
      const polaroids = document.querySelectorAll('.polaroid');
      polaroids.forEach((polaroid, index) => {
        const pos = newPositions[index];
        polaroid.style.left = `${pos.x}px`;
        polaroid.style.top = `${pos.y}px`;
      });
    });
  </script>
</body>
</html>