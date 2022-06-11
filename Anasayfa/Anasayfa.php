<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Taksi yolculuğunu paylaş</title>

</head>
<body background="ArkaPlan.png">          <!-- arka plan resmi-->        
    <table>
        <tr>
            <td>
                <img src="Logo.jpeg"width="300">                                <!--logonun yer aldığı kısım-->
                
                <td>
                    <form method="POST" action="" >
                         <br><br><br>
                        
        <!-- Yolculuk oluşturma form Kodları -->

                        <h3>Yolculuk Oluştur</h3>

                        <input type="text" name="O_Nereden" placeholder="Nereden">
                        
                        <input type="text" name="O_Nereye" placeholder="Nereye">
                        
                        <input type="datetime-local" name="O_Tarih">

                        <input type="text"   name="O_Fiyat" placeholder="Fiyat">
                
                           
                        <input type="tel" name="O_Telefon" placeholder="999-999-99-99 " pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}">

                        <br><br>
                        <input type="submit" value=" Yolculuk Oluştur ">
                        <br><br>
                        
                        <div>
                        <!--  Bu günün tarihini online olarak göstermek için  -->
                        <font color="#8000000"><b>Bugün:</b> <br> <script language="javascript" src="http://ir.sitekodlari.com/tarihvesaat1.js"></script> 
                        </font> 
                        </div>
            
            <!-- Yolculuk Arama form Kodları -->            
                    </form> 
                    <br>           
                    <td>
                        <form method="POST" action="">
                            <h3>Yolculuk Ara</h3> 
                            <input type="text" name="Nereden" placeholder="Nereden"> 
                            <input type="text" name="Nereye" placeholder="Nereye"> 
                            <input type="datetime-local" name="Tarih"> 
                            <br>
                            <br><br>
                            <input type="submit" name="Ara" value=" Yolculuk Ara  ">
        
                        </form> 
                    </td>
                </td>
            
            </td>
        </tr>       

    </table>

     <!-- buradaki tablo yolculuk arayan kullanıcının verilerinin listeleneceği tablonun 1. satırı olacak   -->
     <table>
        <tr>
            <td>Tarih &nbsp;&nbsp;</td>
            <td>Nereden&nbsp;&nbsp;</td>
            <td>Nereye&nbsp;&nbsp;</td>
            <td>Fiyat&nbsp;&nbsp;</td>
            <td>Telefon&nbsp;&nbsp;</td>
            <td>Ad&nbsp;&nbsp;</td>
            <td>Soyad</td>
            
        </tr>


<?php


    //  DB ile bağlatı kurmak için.
    $baglanti = new mysqli("localhost", "root", "1234", "internet_proje");
    if($baglanti ->connect_errno > 0){
        die("<b>Bağlatı Hatası:</b>". $baglanti->connect_error);
    }
    echo "Bağlantı Başarılı";
    

    
    // YOLCULUK OLUŞTUR VERİLERİNİN VERİ TABANINA KAYDEDİLECEĞİ İF BLOĞU

      // formdaki değerler girildi mi diye kontrol ediyoruz.
      if(isset($_POST['O_Tarih'], $_POST['O_Nereden'], $_POST['O_Nereye'], $_POST['O_Fiyat'],$_POST['O_Telefon'])){
    

        //Sİteden alınan verileri sırasıyla değişkenlere atıyoruz çünkü ileride veritabanına eklerken bu değişkenleri kullnıp ekleyeceğiz.
        $O_Tarih   =  $_POST['O_Tarih'];
        $O_Nereden =  $_POST['O_Nereden'];
        $O_Nereye  =  $_POST['O_Nereye'];
        $O_Fiyat   =  $_POST['O_Fiyat'];
        $O_Telefon =  $_POST['O_Telefon'];


        // veritabanında ki yolculuk oluştur tablomuza formdan aldığımız verileri ekliyoruz.  
        $sorgu = $baglanti->prepare("INSERT INTO yolculuk_olustur(tarih,nereden,nereye,fiyat,telefon) VALUES(?,?,?,?,?)");
        $sorgu->bind_param('sssss',$O_Tarih,$O_Nereden,$O_Nereye,$O_Fiyat,$O_Telefon);
        $sorgu->execute();

        if($baglanti->errno > 0 ){
        die("<b> Sorgu Hatası:</b>".$baglanti->error);
        }
        echo "<br>SEFERİNİZ BAŞARIYLA OLUŞTURULMUŞTUR...";
        echo "<br> MUTLU VE HUZURLU YOLCULUKLAR DİLERİZ.";
        
        
      }
            

        // Yolculuk ara kısmında çalışacak elseif kod bloğumuz
        // eğer nereden, nereye ve  tarih değişkenleri post edilmişse bu kod bloğuna girecek
        elseif (isset($_POST['Ara']/*, $_POST['Nereye'], $_POST['Tarih']*/)) {
            
        // kullanıcının sitede yolculuk ara kısmında ki girdiği verileri değişkenlere atıyoruz.    
        $nereden = $_POST['Nereden'];
        $nereye  = $_POST['Nereye'];
        $tarih   = $_POST['Tarih'];


        // tüm verileri bir diziye atıyoruz.
        //$veriler = mysql_query("select * from yolculuk_olustur where nereden = '$nereden' and nereye = '$nereye'and tarih ='$tarih'");

        
        // Veritabanında kayıtlı olan "yolculuk_olustur" tablosuna bağlanmak için 
        $sql = mysqli_query($baglanti,"select * from yolculuk_olustur") or die("Veritabanı tablosuna ulaşılamadı.");
       

        if ($row = mysqli_fetch_array($sql)) {
            
            
            // kullanıcıdan alınan nereden, nereye, tarih değerleri veritabanındaki ile aynı ise bu if girecek.
            if ($row['nereden'] == $nereden and $row['nereye'] == $nereye and $row['tarih'] == $tarih) {
              
           



                // gelen verileri bir diziye aktarıp hepsini yazdıracağız
                   
                while ($row = mysqli_fetch_assac($sql)) {
                    
                    // sol taraf bizim oluşturduğumuz değişkenler sağ tarafsa veritabanından alacağımız tablodaki sütun isimleri
                    $nereden = $dizi['nereden'];
                    $nereye  = $dizi['nereye'];
                    $tarih   = $dizi['tarih'];
                    $fiyat   = $dizi['fiyat'];
                    $telefon = $dizi['telefon'];
                     

                    echo "<tr>
                    <td>$tarih</td>
                    <td>$nereden</td>
                    <td>$nereye</td>
                    <td>$fiyat</td>
                    <td>$telefon</td>";
                    }
            
                }
            }
        }   

?>

</body>
</html>