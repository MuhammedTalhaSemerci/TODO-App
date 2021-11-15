*TODO UYGULAMASI*

_***Projede Kullanılacak Teknolojiler***_
- Proje PHP 7.2.x  dili ile Codeigniter 3.x kütüphanesi ile yapılacaktır.
- Veritabanı olarak Mysql 5.7.x kullanılacaktır.
- Css kütüphanesi olarak Bootstrap 4.6 kullanılacak.
- Js kütüphanesi olarak ise Jquery 3.4.x sürümü kullanılacak. 

_**Projede Özellikleri**_

***Todo listesinin listelendiği sayfa***
- [x] Listede todo’nun başlığı ve bitiş tarihi(15.05.2021 formatında görünecek) görüntülenecek. her bir todonun başında düzenle ve sil butonları olacak.
- [ ] todo listesi elemanları sıralabilecek sayfa yenilenmeden (sortable kütüphanesi kullanılabilir)
- [x] todo sil denildiğinde sweetalert2 kütüphanesi kullanılarak onay modalından onay alındıktan sonra silme işlemi tamamlanacak.
- [x] önem sırası renkleri listede de görünecek
- [x] bitiş tarihi geçtiğinde listede arka plan kırmızı olacak
- [ ] liste sayfasında todo lar içinde arama yapılacak. sonuç sayfasında da gösterilebilir aynı sayfada da bulunanlar getirilebilir.

***Todo’nun eklemede ve güncellemedeki özellikleri***
- [x] todo başlığı (aynı başlıktan tüm listede sadece 1 tane olacak(uniq)) *
- [x] önem sırası seçilecek.  *
    - [x] 1. derece(kırmızı), 2. derece (sarı), 3. derece (yeşil)
    - [x] Varsayılan 2.derece seçili olacak
- [x] bitiş tarihi (tarih seçimi olacak. text olarak girilmeyecek. boşsa null kayıt edilecek veritabanına) 
- [x] todo içerik alanı
- [ ] Etiket alanı olacak. birden fazla etiket eklenebilecek. virgül veya enter ile ayrılacak.

NOT: Yıldız olanlar zorunlu olarak kullanıcı tarafından istenen alanlar, diğerleri istenirse girilebilecek boş bırakılabilir.


