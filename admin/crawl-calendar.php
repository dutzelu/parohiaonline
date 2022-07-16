<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     
    <?php
    // (\d+)\s*([SDLMJVS]{1})\n(.*)

$re = '/(\d{1,2})\s*[SDLMJV]{1}\r(.*)/m';
$str = '1 S
(✝) Tăierea împrejur cea după trup a Domnului; ✝) Sfântul Ierarh Vasile cel Mare, Arhiepiscopul Cezareei Capadociei; Sfânta Emilia, mama Sfântului Ierarh Vasile cel Mare;  
2 D
Sfântul Mucenic Serghie; Sfântul Ierarh Silvestru, Episcopul Romei; Sfântul Cuvios Serafim de Sarov; Sfânta Iuliana din Lazarevo;  
3 L
Sfântul Mucenic Tit, episcopul Tomisului; Sfântul Mucenic Gordie; Sfântul Proroc Maleahi; Descoperirea moaștelor Sfântului Mucenic Efrem cel Nou;  
4 M
Cuviosul Mucenic Eftimie și cei doisprezece Cuvioși Mucenici de la Mănăstirea Vatoped; Sfântul Cuvios Nichifor Leprosul; Sfântul Mucenic Zosima; Sfântul Mucenic Atanasie; Soborul Sfinților 70 de Apostoli; Sfântul Cuvios Teoctist, egumenul de la Kucumia Siciliei; Sfânta Cuvioasă Apolinaria;  
5 M
Sfântul Mucenic Teopempt; Sfântul Mucenic Teonas; Sfânta Cuvioasă Sinclitichia; Ajunul Botezului Domnului; (Post)
6 J
(✝) Botezul Domnului (Boboteaza - Dumnezeiasca Arătare);  
7 V
✝ Soborul Sfântului Proroc Ioan Botezătorul și Înaintemergătorul Domnului;   
8 S
Sfântul Mucenic Abo, ocrotitorul orașului Tbilisi, Georgia; Sfântul Cuvios Gheorghe Hozevitul; Sfântul Cuvios Emilian Mărturisitorul; Sfânta Cuvioasă Domnica;  
9 D
Sfântul Ierarh Petru al Sevastiei; Sfântul Mucenic Polieuct; Sfântul Cuvios Eustratie; Sfântul Ierarh Filip, Mitropolitul Moscovei; 
10  L
✝) Sfântul Cuvios Antipa de la Calapodești; Sfântul Ierarh Grigorie, Episcopul Nissei; Sfântul Cuvios Dometian, Episcopul Melitenei; Sfântul Cuvios Marchian; Sfântul Teofan Zăvorâtul;  
11  M
✝ Sfântul Cuvios Teodosie cel Mare, începătorul vieții călugărești de obște din Palestina; Sfântul Cuvios Vitalie; Cinstirea Icoanei Maicii Domnului din Eleț;   
12  M
Sfânta Muceniță Eutasia; Sfânta Muceniță Tatiana, diaconița; Cinstirea Icoanei Maicii Domnului „Cea care alăptează” (Galaktotrofousa); Cinstirea Icoanei Maicii Domnului „a Imnului Acatist”; 
13  J
✝ Sfântul Mucenic Ermil; ✝ Sfântul Mucenic Stratonic; Sfântul Ierarh Iacob, Episcopul din Nisibe; Sfântul Cuvios Maxim Kavsokalivitul; Sfântul Ilarie de Poitiers;  
14  V
Sfinții Cuvioși Mucenici din Sinai și Rait; Odovania praznicului Botezului Domnului; Sfânta Nina, cea întocmai cu Apostolii și luminătoarea Georgiei; Sfântul Cuvios Sava, arhiepiscopul Serbiei și ctitorul mănăstirii Hilandar;  
15  S
Sfântul Cuvios Pavel Tebeul; Sfântul Cuvios Ioan Colibașul;   
16  D
Cinstirea lanțului Sfântului Apostol Petru; Sfântul Mucenic Pevsip și cei împreună cu el; Sfântul Mucenic Elasip; Sfântul Mucenic Mesip; Sfânta Muceniță Neonila; Sfântul Mucenic Danact citeţul; 
17  L
✝) Sfântul Cuvios Antonie cel Mare; Sfântul Cuvios Ahila; Sfântul Cuvios Antonie cel Nou de la Veria;  
18  M
✝ Sfântul Ierarh Atanasie, Arhiepiscopul Alexandriei; ✝ Sfântul Ierarh Chiril, Arhiepiscopul Alexandriei;  
19  M
Sfântul Antonie Stilitul din Georgia; Sfântul Ierarh Marcu, Mitropolitul Efesului; Sfântul Meletie Mărturisitorul; Sfântul Cuvios Macarie Egipteanul; Sfântul Cuvios Arsenie; Sfânta Muceniță Eufrasia; Sfântul Cuvios Marcu; Sfântul Cuvios Macarie Alexandrinul;  
20  J
✝) Sfântul Cuvios Eftimie cel Mare; Sfântul Mucenic Vas; Sfântul Mucenic Eusebiu; Sfântul Mucenic In; Sfântul Mucenic Pin; Sfântul Mucenic Rim; Sfântul Lavrentie de Cernigov;  
21  V
Sfântul Mucenic Valerian; Sfântul Mucenic Candid; Sfântul Cuvios Maxim Mărturisitorul; Sfântul Mucenic Neofit; Sfântul Mucenic Evghenie; Sfântul Mucenic Achila; Sfântul Maxim Grecul; Cinstirea Icoanei Maicii Domnului „Înjunghiata” de la Vatoped; Cinstirea Icoanei Maicii Domnului „Mângâietoarea” (Paramythia) de la Vatoped; Sfânta Muceniță Agnia din Roma;  
22  S
Sfântul Cuvios Mucenic Anastasie Persul; Sfântul Apostol Timotei;  
23  D
Sfântul Sfințit Mucenic Clement, Episcopul Ancirei; Sfântul Mucenic Agatanghel; Sfinţii Părinţi de la Sinodul al VI-lea Ecumenic; Sfântul Dionisie din Olimp; 
24  L
Sfântul Mucenic Agapie; Sfântul Mucenic Vavila; Sfânta Xenia din Sankt Petersburg; Sfântul Mucenic Timotei; Sfântul Ierarh Filon, episcopul Carpasiei; Cuviosul Filotheos ctitorul; Sfânta Cuvioasă Xenia;  
25  M
✝) Sfântul Ierarh Bretanion, Episcopul Tomisului; Sfântul Vladimir, Mitropolitul Kievului; ✝) Sfântul Ierarh Grigorie Teologul, Arhiepiscopul Constantinopolului; Sfântul Cuvios Publie; Cinstirea Icoanei Maicii Domnului „Potolește întristările noastre”; Cinstirea Icoanei Maicii Domnului „Bucurie neașteptată”;  
26  M
✝) Sfântul Ierarh Iosif cel Milostiv, Mitropolitul Moldovei; Sfânta Cuvioasă Muceniță Maria din Gatcina; Sfântul David Ziditorul, regele Georgiei; Sfântul Cuvios Arcadie; Sfântul Cuvios Ioan; Sfânta Cuvioasă Maria, soția Sfântului Cuvios Xenofont; Sfântul Cuvios Xenofont;  
27  J
✝ Aducerea moaștelor Sfântului Ioan Gură de Aur; Sfânta Marciana, împărăteasa;  
28  V
Sfântul Cuvios Isaac Sirul; Sfântul Cuvios Iacob Sihastrul; Sfânta Muceniță Haris; Sfântul Cuvios Efrem Sirul; Sfântul Cuvios Paladie; Cinstirea Icoanei Maicii Domnului „Totemsk-Sumorinskaya”;  
29  S
Sfântul Mucenic Parigorie; Sfântul Mucenic Iacob; Sfântul Mucenic Iperechie; Sfântul Mucenic Mochie, citeţul; Sfântul Mucenic Romano; Sfântul Mucenic Iacov; Sfântul Mucenic Silvan; Sfântul Mucenic Luca; Aducerea moaștelor Sfântului Sfințit Mucenic Ignatie Teoforul; Sfântul Mucenic Filotei; Sfântul Mucenic Aviv; Sfântul Mucenic Iulian; Sfântul Afraat Persanul;  
30  D
Sfântul Sfințit Mucenic Ipolit, Episcopul Romei; ✝) Sfinții Trei Ierarhi: Vasile cel Mare, Grigorie Teologul și Ioan Gură de Aur; Cinstirea Sfintei Icoane a Maicii Domnului din Tinos; Sfântul Theodor Hagiul Noul Mucenic din Mitilini; 
31  L
Sfântul Mucenic Diodor; Sfântul Mucenic Serapion; Sfântul Mucenic Papia; Sfântul Mucenic Nichifor; Sfântul Mucenic Claudiu; Sfântul Doctor fără de arginți, făcătorul de minuni, Chir; Sfântul Doctor fără de arginți, făcătorul de minuni, Ioan; Sfântul Mucenic Victorin; Sfântul Mucenic Victor; Sfânta Muceniță Trifena; Sfântul Arsenie din Paros;  

';


preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

// Print the entire match result
 
echo '<pre>'; print_r($matches); echo '</pre>';

?>

 







</body>
</html>