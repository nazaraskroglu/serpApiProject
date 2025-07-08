## 🔍 Laravel Keyword Rank Checker

Bu proje, Laravel kullanılarak geliştirilen bir anahtar kelime sıralama takip uygulamasıdır. Kullanıcıdan alınan `domain` ve `keyword` bilgilerini [SerpAPI](https://serpapi.com/) üzerinden sorgulayarak Google üzerindeki sırasını tespit eder.

### ✨ Özellikler

- Anahtar kelime ve domain bazlı SERP (arama motoru sıralaması) kontrolü
- Ajax destekli form ile anlık sonuçlar
- SerpAPI ile tam entegre Laravel servisi
- Servis-Repository mimarisi
- Tarayıcının zaman dilimine göre bölgesel arama desteği
- Hata ve yükleme animasyonları ile kullanıcı deneyimi

### 🧰 Kurulum

1. Projeyi klonlayın:
   ```bash
   git clone https://github.com/nazaraskroglu/serpApiProject.git
   cd serpApiProject
2. Bağımlılıkları Yükleyin: 
   ```bash
   composer install
3. .env dosyasını oluşturun ve yapılandırın:
    ```bash
    cp .env.example .env
    php artisan key:generate
4. Aşağıdaki SerpAPI konfigürasyonunu .env dosyanıza ekleyin:
   ```bash
    SERPAPI_URL='https://serpapi.com'
    SERPAPI_KEY=***************************
5. Sunucuyu başlatın:
   ```bash
    php artisan serve

<img width="454" alt="image" src="https://github.com/user-attachments/assets/bdedea2c-0614-4050-aed9-3118bbadfb13" />
<img width="454" alt="image" src="https://github.com/user-attachments/assets/01b2bd2b-78fc-4eb7-9f28-c48ca9c22c3c" />
<img width="454" alt="image" src="https://github.com/user-attachments/assets/978a08f3-0236-4bd0-940a-55d9edb6077d" />
<img width="454" alt="image" src="https://github.com/user-attachments/assets/17896ff7-81b7-4758-98d6-4fafcc096aae" />
<img width="454" alt="image" src="https://github.com/user-attachments/assets/3bc3c574-1a96-429a-bdc8-2389c9632859" />
<img width="309" alt="image" src="https://github.com/user-attachments/assets/14149125-8e14-4506-b670-dc5bf0d87bac" />
<img width="379" alt="image" src="https://github.com/user-attachments/assets/1bfcf5bb-1eb2-4536-9afe-ed57358d3d6b" />








