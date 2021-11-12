<?php
 
    $id = $data['id'];
    $userid = $data['user_id'];
    $eveniment = $data['eveniment'];
    $data_si_ora = $data['data_si_ora'];

    $nume_tata = $data['nume_tata'];
    $prenume_tata = $data['prenume_tata'];
    $nume_si_prenume_tata = $nume_tata . '-' . $prenume_tata;

    $nume_mama = $data['nume_mama'];
    $prenume_mama = $data['prenume_mama'];
    $nume_si_prenume_mama = $nume_mama . '-' . $prenume_mama;

    $adresa =  $data['adresa'];
    $telefon = $data['telefon'];
    $email = $data['email'];

    $nume_copil = $data['nume_copil'];
    $prenume_copil = $data['prenume_copil'];
    $nume_si_prenume_copil = $nume_copil . '-' . $prenume_copil;

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
    $link_cerere = $data['link_cerere'];
    $data_ora_cateheza = $data['data_ora_cateheza'];
    $status = $data['status'];

    switch ($status) {

        case '': 
          $clasa_accept = 'bg-primary'; 
          $status_accept_afisat = "Programare în curs de evaluare";
          $color = '#0d6efd';
        break;
      
        case 'acceptata': 
          $clasa_accept = 'bg-success'; 
          $status_accept_afisat = "Programare acceptată"; 
          $color = '#198754';
        break;
      
        case 'detalii': 
          $clasa_accept = 'bg-warning';
          $status_accept_afisat = "Cererea necesită detalii suplimentare"; 
          $color = '#ffc107';
        break;
      
        case 'respinsa': 
          $clasa_accept = 'bg-danger';
          $status_accept_afisat = "Programare respinsă"; 
          $color = '#dc3545';
        break;
        
      }

