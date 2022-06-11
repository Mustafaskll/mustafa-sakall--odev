<?php


    
// eğer giriş butonuna tıklanmdıysa burdaki ife girecek
if($_POST['Giris']){

  // kullanıcının gireceği kullanıcı adı ve şifreyi buradan değişkenlere atıyoruz 
  $k_adi = $_POST['kadi'];
  $sifre = $_POST['sifre'];

  
  // kullanıcı adı veya şifre boş girildiyse hata verecek
  if($k_adi=="" or $sifre==""){
    echo "Kullanıcı adı veya şifreniz boş lütfen kontrol edin. ";
  }
  

  // iki değer de boş değilse burdaki else girecek 
  else{

    
    //veritabanı ile bağlamtı kuruluyor.
    $baglanti = new mysqli("localhost", "root", "", "internet_proje");  
    

    // eğer bağlantı kurulurken if değeri 0 dan büyükse hata var demektir ve kodumuz buradaki if içerisine girecek
    if($baglanti->connect_errno > 0){
      die("<b>Bağlatı Hatası:". $baglanti->connect_error);
    }
      
    echo "Bağlantı Başarılı";


    // Veritabanında kayıtlı olan "kayit" tablosuna bağlanmak için  
    $sql = mysqli_query($baglanti,"select * from kayit") or die("<br>Veritabanı tablosuna ulaşılamadı.");
 


    // if içerisindeki işlem veritabanmızdaki değişkenleri diziye çevirirerek bize dönderir. 
   
      while ($veriler = mysqli_fetch_array($sql) {
        
    
      // ***veritabanında sadece bir değeri diziye atıyor tüm değerlerin diziye atanması gerekiyor ki diğer id ve şifreler de kontrol edilebilsin***

      
        // oluşan dizide aradığımız değer kullanıcının girdiği değere eşit mi diye kontrol ediyoruz.
        if ($veriler['kullanici_adi'] == $k_adi and $veriler['sifre'] == $sifre) {


          // eğer şifre doğru ise verdiğimiz bağlantıya gidecek.
          echo "<br><br>  Anasayfa ya gidiliyor.";
          header("Refresh:2;url=http://localhost/Web_proje/Anasayfa/Anasayfa.php");

      }

      }

  
      else{
        echo "<br><br>Kullancı adı veya şifre hatalı ! ";
      }


    


    }

 }

?>