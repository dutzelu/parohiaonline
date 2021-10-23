<?php
include "header-frontend.php"; 
include "functions.php"; 

if (isset($_GET['id'])) {$id = $_GET['id'];} 

// modific in baza de date statusul cererii (programarii), daca e cazul
if (isset($_GET['status'])) {

  $status = $_GET['status'];
  $query = 'UPDATE programari_cununie SET status = ? WHERE id=? ';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('si', $status, $id);
  $result = $stmt->execute();
  $result = $stmt->get_result();
  
} 


  $query = 'SELECT * FROM programari_cununie WHERE id=?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  $result = $stmt->get_result();


  while($data = $result->fetch_assoc()) {
      include 'extras-programare-cununie.php';
  }

    $target_dir = dirname($link_mire_ci);

 ?>

<div class="mare">
    <div class="container-fluid">
    


    <?php ob_start(); ?>
    
        <strong>Parohia Ortodoxă Apărătorii Patriei II "Sfântul Ierarh Ambrozie" București</strong></p>
        <strong>Ziua Catehezei:</strong> <?php echo date("d.m.Y", strtotime($data_ora_cateheza)) . ' <strong>ora:</strong> ' . date("H:i", strtotime($data_ora_cateheza));?><br />
        <strong>Ziua Cununiei:</strong> <?php echo date("d.m.Y", strtotime($data_si_ora)) . ' <strong>ora:</strong> ' . date("H:i", strtotime($data_si_ora));?></p>

        <h1 style="margin-top:30px;text-align:center; font-size:20px;">Cerere tip pentru săvârșire cununiei</h1>
       
     <?php 
     
   
     echo '<p>Subsemnatul <strong>' . $nume_mire . ' ' . $prenume_mire . ',</strong> domiciliat în <strong>' .  $adresa_mire . ',</strong> telefon <strong>' . $telefon . '</strong>, email <strong>' .  $email . ' </strong>și</p>';
   
     echo '<p>Subsemnata <strong>' . $nume_mireasa . ' ' . $prenume_mireasa . ',</strong> domiciliată în <strong>' .  $adresa_mireasa . ', </strong></p>';?> 

    <p>Vă rugăm să aprobați săvârșirea Cununiei noastre religioase în biserica parohială «Sfântul Ambrozie», în data de <?php echo '<strong>' . date("d.m.Y", strtotime($data_si_ora)) . '</strong> la ora: <strong>' . date("H:i", strtotime($data_si_ora));?></strong>.</p>

    <p>Menţionăm că niciunul din noi nu a mai fost / (sau) a mai fost cununat religios. Dacă unul din miri a mai fost cununat religios acela va adresa o cere Arhiepiscopiei Bucureștilor, Sectorul administrativ Bisericesc <strong>(str. Calea Șerban Vodă, nr. 31, sector 4, București, email: adbis@arhiepiscopiabucurestilor.ro)</strong>, în vederea obținerii dispensei chiriarhale pentru recăsătorire. În situația în care unul dintre miri este creștin dar de confesiune alta decât ortodoxă, acela va solicita arhiepiscopiei Bucurestilor sectorul administrativ bisericesc (adresa de mai sus), aprobarea acordării dispensei chiriarhale pentru săvârșirea cununiei religioase.</p>

    <p>Menționăm de asemenea, că nașii noștri sunt de credință creștin ortodoxă și se numesc <?php echo '<strong>' .  $nume_nas . '</strong> și <strong>' . $nume_nasa . '</strong> din localitatea <strong>' . $localitate_nasi . '</strong>.';?>

    <p>Am luat la cunoștință, de asemenea, de obligația pe care o avem de a participa la Cateheza privind Taina Cununiei, precum și de cuantumul contribuțiilor stabilite de Consiliul Parohial pentru oficierea acesteia și pentru eliberarea certificatului de cununie religioasă și suntem de acord cu acestea.</p>

    <?php
    if(!empty($nume_cameraman)) {
        echo '<p>Întrucât dorim să filmăm și să facem fotografii la eveniment, am solicitat colaborarea domnului: <strong>' . $nume_cameraman . '</strong> având numărul de telefon <strong>' . $telefon_cameraman . '</strong>.</p>' ;
    }?> 

    <p>Precizăm că am fost informați de către parohie, în legătură cu legislația privind protecția datelor personale și suntem de acord cu semnarea declarației, anexată acestei cereri. Suntem de acord, de asemenea, să respectăm măsurile impuse de autorități privind prevenirea și combaterea pandemiei de COVID 19.</p>
	<p>Anexăm, în copie, următoarele acte: cărțile de identitate ale mirilor, certificatul de căsătorie civilă, certificatele de botez ale mirilor, declarația privind protecția datelor personale.</p>

    <p>Data: <?php echo '<strong>' . date("d-m-Y") . '</strong> ora: <strong>' . date("H:i:s") . '</strong>';?></p>

    <p>Prezenta cerere este înregistrată în condica parohiei în baza corespondenței electronice furnizate de dumneavoastră de la adresa de email: <strong><?php echo $email . '</strong> și telefon: <strong>' . $telefon . '</strong>.';?></p>
    
    <h1 style="margin-top:30px;text-align:center; font-size:20px;">DECLARAȚIE DE CONSIMȚĂMÂNT <br />privind prelucrarea datelor cu caracter personal, conform cu prevederile Regulamentului UE 679/2016 și cu legislația națională în vigoare</h1>

    <?php echo '<p>Subsemnații <strong>' . $nume_mire . ' ' . $prenume_mire . '</strong> și <strong>' . $nume_mireasa . ' ' . $prenume_mireasa . '</strong> '; ?>


     suntem de acord ca Parohia Apărătorii Patriei II – Sfântul Ambrozie să fie autorizată să colecteze/proceseze/stocheze datele noastre personale necesare bunei desfășurări a vieții parohiale, în următoarele scopuri: completarea actelor de evidență a serviciilor prestate și furnizarea de informații privind activitățile derulate de parohie, prin intermediul e-mail-ului, SMS-ului, telefonului, platformelor de socializare. </p>

    <p>Consimțământul meu în ceea ce privește prelucrarea/stocarea datelor cu caracter personal, precum și furnizarea datelor personale sunt voluntare. Acest consimțământ poate fi revocat în orice moment, cu efect ulterior, printr-o notificare scrisă către Parohia Apărătorii Patriei II sau prin transmiterea unui e-mail, la adresa: paroh@sfantulambrozie.ro. </p>

    <p>Am luat la cunoștință faptul că revocarea consimțământului meu nu afectează legalitatea utilizării datelor furnizate înainte de retragerea consimțământului (notificarea nu are impact retroactiv).</p>

    <p>Parohia Apărătorii Patriei II are obligația stocării datelor personale pe perioadă nelimitată.</p>

    <p>Data: <?php echo '<strong>' . date("d-m-Y") . '</strong> ora: <strong>' . date("H:i:s") . '</strong>';?></p>
  

    </div>
</div>


<?php


  // directorul unde se va încarca cererea si declaratia
 
  $file_name = 'Cerere-si-declaratie-' . str_replace(' ','-',$eveniment) . '-' . replaceSpecialChars($nume_mire) . '-' . replaceSpecialChars($prenume_mire) . '-' .date("d.m.Y", strtotime($data_si_ora)) . '.pdf';
  $link_cerere = $target_dir . '/' . $file_name;


  $html = ob_get_clean(); 

  require_once __DIR__ . '/vendorspdf/autoload.php';
  
  // Crează o instanță Mpdf ----------------
  $mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 12   
]);
  
  
  // Scriere fișierului PDF ----------------
  $mpdf->WriteHTML($html);
  
  
  // Salvarea fișierului pdf----------------
  ob_clean(); 
  $mpdf->Output($target_dir . '/' . $file_name, \Mpdf\Output\Destination::FILE);
  
  
// inserare link cerere în baza de date ----------------
  

if (file_exists($link_cerere)) {

        $query = 'UPDATE programari_cununie SET link_cerere = ? WHERE id = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $link_cerere, $id);
        $result = $stmt->execute();
   
     }  
  

// detalii mail
 
$subiect = "Programare: " . $eveniment . '  ' . date("d.m.Y", strtotime($data_si_ora)) . ' ora: ' . date("H:i", strtotime($data_si_ora));

$mesaj_email = '
<p>Doamne ajută!</p>
<p>Cererea pentru programarea dvs. online de pe site-ul Parohiei Apărătorii Patriei "Sf. Ierarh Ambrozie" a fost acceptată.</p>';

$mesaj_email .= '<strong>Ziua Catehezei:</strong> ' . date("d.m.Y", strtotime($data_ora_cateheza));
$mesaj_email .= ' <strong>ora: </strong> ' . date("H:i", strtotime($data_ora_cateheza)) .'<br /><strong>Ziua Cununiei:</strong>' . date("d.m.Y", strtotime($data_si_ora)) .  '<strong>ora:</strong> ' . date("H:i", strtotime($data_si_ora)) . '</p>';

$mesaj_email .= '<p>Am atașat la acest email cererea și declarația pentru protecția datelor personale.</p>';

$mesaj_email .= '
<h2 class="titlu">I. Acte necesare în vederea <mark>programării cununiei.</mark></h2>

<ol class="lista">
    <li> Certificatele de căsătorie civilă al mirilor</li> 
    <li>Certificatele de Botez ale mirilor – copie (acestea se solicită preotului paroh de la parohia unde a fost botezat fiecare dintre miri, toate botezurile rămânând înregistrate în Registrele de Botez din arhiva parohiei);</li>
    <li>Cartea de Identitate a fiecăruia dintre miri;</li>
    <li>Cerere tip pentru săvârșirea Tainei Sfintei Cununii;</li>
    <li>Chitanța/viramentul bancar în valoare de 100 lei, reprezentând contribuția anuală față de biserică pe anul în curs (aceasta se achită fie la biserică, fie prin virament bancar în contul IBAN lei: RO11RNCB0083002889370001, titular: PAROHIA APARATORII PATRIEI II, deschis la B.C.R. - Dr. Obregia, Bucuresti, C.F. 5889665);</li>
    <li>Declarația privind protecția datelor personale.</li>
</ol>
<p>Aceste documente va trebui să le aveți scanate sau fotografiate pentru a putea fi încărcate în aplicația online de rezervare, în momentul efectuării programării. </p>

<h2 class="titlu">II. Ce contribuții se plătesc la cununie?</h2>
<ol class="lista">
  <li>Înainte de programarea cununiei, asigurați-vă că ați achitat contribuția anuală față de biserică, stabilită de Consiliul Parohial, în cuantumul menționat mai sus și o aveți pregătită pentru a o încărca în programator.</li>
  <li>în ziua cununiei, nasul va achita după oficierea Tainei Cununiei, contribuția pentru Cununie în valoare de 600 lei (din care 300 pentru biserică (cu chitanță) şi 300 pentru slujitori (ca donație); corul va fi onorat de naș, separat, cu suma de 150 lei (ca donație);</li>
</ol>

<h2 class="titlu">III. Ce se aduce la biserică în ziua cununiei ?</h2>

<ol class="lista">
  <li>cele două verighete; </li>
  <li>două lumânări mari, de preferință de ceară curată; </li>
  <li>o sticlă de vin alb; o sticlă de ulei;</li>
  <li>pișcoturi;</li>
  <li>copia Certificatului de Căsătorie civilă (necesar emiterii Certificatului de Cununie religioasă).</li>
</ol>

<h2 class="titlu">IV. Slujba Logodnei nu poate fi oficiată separat de slujba Cununiei;</h2>

<h2 class="titlu">V. Spovedania</h2>
 <p>Vinerea de dinaintea Cununiei, mirii au îndatorirea canonică de a veni la biserică, la orele 18.00, pentru a se spovedi: nu este bine ca aceștia să intre în viaţa nouă de ”familie creștină”, nepurificați, având asupra lor păcatele tinereților;</p>

<h2 class="titlu">VI. Nașii. </h2>
<p>Potrivit rânduielilor Sfintei Bisericii şi ale sfintelor canoane, mirii vor avea la cununie o pereche de nași. Aceștia sunt martori şi chezași ai temeiniciei făgăduințelor făcute de viitorii soți unul fată de altul şi ai trăiniciei legăturii pentru tot restul vieții. De regulă, ei sunt aceiași de la botez, sau urmașii lor şi <strong>trebuie să fie de credință creștin ortodoxă şi cu bună viețuire creștinească,</strong> purtându-se față de miri ca niște părinți şi învățători ai acestora.</p>

<h2 class="titlu">VII. Situații excepționale. </h2>

<p><strong>A. Dacă unul din miri a mai fost cununat religios</strong>, acela va adresa o cerere Arhiepiscopiei Bucureștilor, Sectorul administrativ Bisericesc (str. Calea Șerban Vodă, nr. 31, sector 4, București, email: adbis@arhiepiscopiabucurestilor.ro), în vederea obținerii dispensei chiriarhale pentru recăsătorire.</p>
<p><strong>B. În situația în care unul dintre miri este creștin dar de confesiune alta decât cea ortodoxă,</strong> acela va solicita Arhiepiscopiei Bucureștilor, Sectorul Administrativ Bisericesc (adresa de mai sus), acordarea dispensei chiriarhale pentru săvârșirea cununiei religioase.</p>

<h2 class="titlu">VIII. Cateheza pentru Taina Cununiei</h2>
<p>Înainte de oficierea Tainei cununiei, mirii vor participa la cateheza despre Taina Cununiei care va avea loc la biserică la data și ora aleasă în programator.</p>

<h2 class="titlu">IX. Fotograful</h2>

<p>Pentru a se evita eventuale situații de denigrare a imaginii parohiei sau a Bisericii Ortodoxe Române, se va indica numele și numărul de telefon al fotografului sau al firmei care va filma și fotografia evenimentul.</p>

<h2 class="titlu">Măsuri sanitare</h2>

<p>Având în vedere situațiile speciale sanitare decretate de autorități, mirii înțeleg să respecte măsurile de prevenire și combatere a răspândirii bolilor în rândul invitaților lor și al personalului bisericesc. </p>

';

$mesaj_email_admin .= '
<p>Pe site s-a înregistrat o nouă programare pe numele:<strong> ' . $nume_mire . ' ' . $prenume_mire . '</strong></p>
<p>Am atașat la acest email cererea și declarația.</p>';
$subiect_admin = "Programare: " . $eveniment . '  ' . date("d.m.Y", strtotime($data_si_ora)) . ' ora: ' . date("H:i", strtotime($data_si_ora)) .' pe numele: ' . $nume_mire . ' ' . $prenume_mire;

$email_admin = 'parohiaonline@sfantulambrozie.ro';

// emailCuAtasament ($email, $subiect, $link_cerere, $mesaj_email);
// emailCuAtasament ($email_admin, $subiect_admin, $link_cerere, $mesaj_email_admin);

mail($email, $subiect, $mesaj_email);
mail($email_admin, $subiect_admin, $mesaj_email_admin);


?>

<script> location.replace("rezervare-unica-cununie.php?id=<?php echo $id; ?>"); </script>