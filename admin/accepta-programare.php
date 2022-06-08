<?php
$mesaj_email_admin = "";
$name = "";
$from = "";
include "header-admin.php"; 


if (isset($_GET['id'])) {$id = $_GET['id'];} 

// modific in baza de date statusul cererii (programarii), daca e cazul
if (isset($_GET['status'])) {

  $status = $_GET['status'];
  $query = 'UPDATE programari_botez SET status = ? WHERE id=? ';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('si', $status, $id);
  $result = $stmt->execute();
  $result = $stmt->get_result();
  
} 

$query = 'SELECT * FROM programari_botez WHERE id=?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$result = $stmt->execute();
$result = $stmt->get_result();

while($data = $result->fetch_assoc()) {

    $eveniment = $data['eveniment'];
    $data_si_ora = $data['data_si_ora'];
    $nume_tata = $data['nume_tata'];
    $prenume_tata = $data['prenume_tata'];
    $nume_mama = $data['nume_mama'];
    $prenume_mama = $data['prenume_mama'];

    $adresa =  $data['adresa'];
    $telefon = $data['telefon'];
    $email = $data['email'];
    $nume_copil = $data['nume_copil'];
    $prenume_copil = $data['prenume_copil'];
    $nume_botez_copil = $data['nume_botez_copil'];
    $data_nasterii_copilului = $data['data_nasterii_copilului'];
    $numar_certificat_nastere = $data['numar_certificat_nastere'];
    $data_eliberarii_certificatului = $data['data_eliberarii_certificatului'];
    $eliberat_de_primaria = $data['eliberat_de_primaria'];
    $nume_nas = $data['nume_nas'];
    $nume_nasa = $data['nume_nasa'];
    $localitate_nasi = $data['localitate_nasi'];
    $nume_cameraman = $data['nume_cameraman'];
    $telefon_cameraman = $data['telefon_cameraman'];
    $link_tata_ci = $data['link_tata_ci'];
    $link_mama_ci = $data['link_mama_ci'];
    $link_plata_contributiei = $data['link_plata_contributiei'];
    $link_certificat_nastere_copil = $data['link_certificat_nastere_copil'];
    $data_ora_cateheza = $data['data_ora_cateheza'];
}

    $target_dir = dirname($link_mama_ci);

 ?>

<div class="mare">
    <div class="container-fluid">
    


    <?php ob_start(); ?>
    
        <strong>Parohia Ortodoxă Apărătorii Patriei II "Sfântul Ierarh Ambrozie" București</p>
        <strong>Eveniment:</strong> <?php echo  $eveniment;?><br />
        <strong>Ziua Catehezei: </strong> <?php echo date("d.m.Y", strtotime($data_ora_cateheza)) . ' <strong>ora:</strong> ' . date("H:i", strtotime($data_ora_cateheza));?><br />
        <strong>Ziua Botezului: </strong> <?php echo date("d.m.Y", strtotime($data_si_ora)) . ' <strong>ora:</strong> ' . date("H:i", strtotime($data_si_ora));?></p>

        <h1 style="margin-top:70px;text-align:center; font-size:20px;">Cerere tip pentru săvârșire botez</h1>
       
     <?php 
     
     if (empty($nume_tata)) {
     echo '<p>Subsemnata <strong>' . $nume_mama . ' ' . $prenume_mama . ',</strong> domiciliată în <strong>';
    } else {
        echo '<p>Subsemnații <strong>' . $nume_tata . ' ' . $prenume_tata . '</strong> și <strong>' . $nume_mama . ' ' . $prenume_mama . ',</strong> domiciliați în <strong>';
    }
     
     echo  $adresa . ',</strong> telefon <strong>' . $telefon . '</strong>, email <strong>' .  $email . '.</strong></p>';

    if (empty($nume_tata)) {
        echo '<p>În calitate de părinte al copilului:<strong> ';
    } else {echo '<p>În calitate de părinți ai copilului:<strong> ';}
    
        
    echo $nume_copil . ' ' . $prenume_copil . '</strong> născut la data de: <strong>' . $data_nasterii_copilului  .  '</strong> conform certificatului de naștere nr. <strong>' . $numar_certificat_nastere . '</strong> eliberat la data de: <strong>' . $data_eliberarii_certificatului . '</strong> de primăria <strong>' . $eliberat_de_primaria . '.</strong>' ;?>
    
    <p>Vă rugăm să aprobați săvârșirea Tainei Sfântului Botez copilului nostru, în biserica parohială «Sfântul Ambrozie», în data de: <strong><?php echo date("d.m.Y", strtotime($data_si_ora)) . '</strong> ora: <strong>' . date("H:i", strtotime($data_si_ora));?></strong></p>


    <p>Dorim ca cel botezat să poarte din botez numele de:<strong> <?php echo $nume_botez_copil . '</strong>.';?>
    <p>Menționăm că nașii copilului <strong>sunt de credință creștin ortodoxă</strong> și se numesc: <strong> <?php echo $nume_nas . '</strong> și <strong>' . $nume_nasa;?></strong> din localitatea: <strong><?php echo $localitate_nasi;?></strong></p>

    <p>Am luat la cunoștință de obligația de a participa la <strong>cursul de catehizare</strong> organizat de parohie pentru pregătirea botezului și de cuantumul contribuțiilor stabilite de Consiliul Parohial și suntem de acord cu acestea.</p>
    <p>Precizăm că am fost informați în legătură cu legislația privind protecția datelor personale de către parohie și suntem de acord cu completarea și semnarea respectivei declarații.</p>



    <?php if(!empty($nume_cameraman)) {
        echo '<p>Întrucât dorim să filmăm și să facem fotografii la eveniment, am solicitat colaborarea domnului:<strong>' . $nume_cameraman . '</strong> având numărul de telefon <strong>' . $telefon_cameraman . '</strong>.</p>' ;
    }?> 

    <p>Data: <?php echo '<strong>' . date("d-m-Y") . '</strong> ora: <strong>' . date("H:i:s") . '</strong>';?></p>

    <p>Prezenta cerere este înregistrată în condica parohiei în baza corespondenței electronice furnizate de dumneavoastră de la adresa de email: <strong><?php echo $email . '</strong>.';?></p>
    <p>Telefon: <strong><?php echo $telefon . '</strong>.';?></p>
    

    <pagebreak>

    <h1 style="margin-top:30px;text-align:center; font-size:20px;">DECLARAȚIE DE CONSIMȚĂMÂNT <br />privind prelucrarea datelor cu caracter personal, conform cu prevederile Regulamentului UE 679/2016 și cu legislația națională în vigoare</h1>

    <?php
    if (empty($nume_tata)) {
     echo '<p>Subsemnata <strong>' . $nume_mama . ' ' . $prenume_mama . ',</strong> sunt';
    } else {
        echo '<p>Subsemnații <strong>' . $nume_tata . ' ' . $prenume_tata . '</strong> și <strong>' . $nume_mama . ' ' . $prenume_mama . ',</strong> suntem';
    }
    ?>

     de acord ca Parohia Apărătorii Patriei II – Sfântul Ambrozie să fie autorizată să colecteze/proceseze/stocheze datele mele personale necesare bunei desfășurări a vieții parohiale, în următoarele scopuri: completarea actelor de evidență a serviciilor prestate și furnizarea de informații privind activitățile derulate de parohie, prin intermediul e-mail-ului, SMS-ului, telefonului, platformelor de socializare. </p>

    <p>Consimțământul meu în ceea ce privește prelucrarea/stocarea datelor cu caracter personal, precum și furnizarea datelor personale sunt voluntare. Acest consimțământ poate fi revocat în orice moment, cu efect ulterior, printr-o notificare scrisă către Parohia Apărătorii Patriei II sau prin transmiterea unui e-mail, la adresa: paroh@sfantulambrozie.ro. </p>

    <p>Am luat la cunoștință faptul că revocarea consimțământului meu nu afectează legalitatea utilizării datelor furnizate înainte de retragerea consimțământului (notificarea nu are impact retroactiv).</p>

    <p>Parohia Apărătorii Patriei II are obligația stocării datelor personale pe perioadă nelimitată.</p>

    <p>Data: <?php echo '<strong>' . date("d-m-Y") . '</strong> ora: <strong>' . date("H:i:s") . '</strong>';?></p>
  

    </div>
</div>


<?php


  // directorul unde se va încarca cererea si declaratia
 
  $file_name = 'Cerere-si-declaratie-' . str_replace(' ','-',$eveniment) . '-' . replaceSpecialChars($nume_mama) . '-' . replaceSpecialChars($prenume_mama) . '-' .date("d.m.Y", strtotime($data_si_ora)) . '.pdf';
  $link_cerere = ROOT_PATH . '/' . $target_dir . '/' . $file_name;


  $html = ob_get_clean(); 

  include '../vendorspdf/autoload.php';
  
  // Crează o instanță Mpdf ----------------
  $mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 12   
]);
  
  
  // Scriere fișierului PDF ----------------
  $mpdf->WriteHTML($html);
  
  
  // Salvarea fișierului pdf----------------
  ob_clean(); 
  $mpdf->Output(ROOT_PATH . '/' . $target_dir . '/' . $file_name, \Mpdf\Output\Destination::FILE);
  
  
// inserare link cerere în baza de date ----------------
  
$link_cerere_fara_calea_serverului = $target_dir . '/' . $file_name;

if (file_exists($link_cerere)) {

        $query = 'UPDATE programari_botez SET link_cerere = ? WHERE id = ?';
       
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $link_cerere_fara_calea_serverului, $id);
        $result = $stmt->execute();
   
     }  
  

// detalii mail
 
$subiect = "Programare: " . $eveniment . '  ' . date("d.m.Y", strtotime($data_si_ora)) . ' ora: ' . date("H:i", strtotime($data_si_ora));

$mesaj_email = '
<p>Doamne ajută!</p>
<p>Cererea pentru programarea dvs. online de pe site-ul Parohiei Apărătorii Patriei "Sf. Ierarh Ambrozie" a fost acceptată.</p>
<p>Să vă trăiască copilul pe care doriți să în botezați la biserica noastră.</p>';

$mesaj_email .= '<strong>Ziua Catehezei:</strong> ' . date("d.m.Y", strtotime($data_ora_cateheza));
$mesaj_email .= ' <strong>ora: </strong> ' . date("H:i", strtotime($data_ora_cateheza)) .'<br /><strong>Ziua Botezului:</strong>' . date("d.m.Y", strtotime($data_si_ora)) .  '<strong>ora:</strong> ' . date("H:i", strtotime($data_si_ora)) . '</p>';

$mesaj_email .= '<p>Am atașat la acest email cererea și declarația pentru protecția datelor personale.</p>';

$mesaj_email .= '
<p><strong>Informații utile pentru botez</strong></p>

<p>I. Ce contribuții se plătesc la botez?</p>

<p>Contribuția pentru oficierea Botezului este de <strong>300 lei</strong> din care:</p>
<ol>
    <li>150 lei contribuția pentru biserică pentru care se taie chitanță și </li>
    <li>150 lei pentru slujitori;</li>
    <li>Pentru corala bisericii nașul va dărui dirijorului suma de <strong>100 lei</strong> (fără chitanță). Aceasta se achită în ziua botezului de către naș.</li>
</ol>


<p>II. Ce pregătește nașul pentru botez?</p>


<ol>
    <li>În ziua botezului, nașul/nașa va aduce o pânză albă 1/1;</li>
    <li>o fașă (se procură de la mercerie);</li>
    <li>o sticluță cu ulei de măsline (circa 50-100ml);</li>
    <li>cruciulițe de botez, care se pun în piept invitațiilor la botez;</li>
    <li>două prosoape;</li>
    <li>două săpunuri;</li>
</ol>

<p>Nașul are îndatorirea de a învăța pe de rost <strong>Crezul (Simbolul de credință);</strong></p>
<p>Nașul dăruiește în ziua Botezului <strong>o icoană cu sfântul al cărui nume îl va purta finul/fina</strong> şi care va deveni, după botez, ocrotitorul spiritual al acestuia/acesteia.</p>

<p>III. Împodobirea cu flori a cristelniței</p>

<p>Vinerea de dinaintea oficierii botezului, părinții copilului vor lua legătura cu doamna de la pangarul bisericii, împreună cu care vor stabili detaliile privind eventuala împodobire cu flori naturale a cristelniței de botez.</p>

<p>IV. Copia certificatului de naștere al copilului necesar <strong>în ziua botezului</strong></p>

<p>În ziua botezului, părinții copilului vor prezenta <strong>o copie a certificatului de naștere al pruncului necesar</strong> înregistrării botezului în actele mitricale ale parohiei şi pentru eliberarea Certificatului de botez. Certificatul de naștere depus la programarea Botezului a fost deja arhivat. De aceea, fără acest act prezentat în ziua botezului nu se poate oficia Taina Botezului, fiind actul de identitate al copilului care urmează a fi botezat !</p>
';

$mesaj_email_admin .= '
<p>Pe site s-a înregistrat o nouă programare pe numele:<strong> ' . $nume_mama . ' ' . $prenume_mama . '</strong></p>
<p>Am atașat la acest email cererea și declarația.</p>';
$subiect_admin = "Programare: " . $eveniment . '  ' . date("d.m.Y", strtotime($data_si_ora)) . ' ora: ' . date("H:i", strtotime($data_si_ora)) .' pe numele: ' . $nume_mama . ' ' . $prenume_mama;

$email_admin = 'balan.claudiu@gmail.com';

phpmailer ($email, $from, $name, $subiect, $mesaj_email, $link_cerere);
phpmailer ($email_admin, $from, $name, $subiect_admin, $mesaj_email_admin, $link_cerere='');


if ( isset ($_GET['backpage']) ) {
    $page_no = $_GET['backpage'];
    echo '<script> location.replace("registru.php?eveniment=programari_botez&page_no=' . $page_no .  '"); </script>';
}

if ( isset ($_GET['back']) ) {
    echo '<script> location.replace("admin.php#accepta' . $id . '"); </script>';
}

?>

<script> location.replace("rezervare-unica.php?id=<?php echo $id; ?>"); </script>